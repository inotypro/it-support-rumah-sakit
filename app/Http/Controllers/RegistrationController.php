<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use App\Exports\RegistrationsExport;
use Maatwebsite\Excel\Facades\Excel;

class RegistrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['adminIndex', 'adminSearch', 'show', 'adminUpdate', 'adminDestroy', 'export', 'updateStatus']);
    }

    // Halaman index untuk publik
    public function index()
    {
        return view('registrations.index');
    }

    // Halaman pilih tipe pendaftaran
    public function selectType()
    {
        return view('registrations.select_type');
    }

    // Form pendaftaran
    public function create()
    {
        return view('registrations.create');
    }

    // Simpan pendaftaran baru
    public function store(Request $request)
    {
        try {
            // Basic validation rules for all registrations
            $baseRules = [
                'full_name' => 'required|string|max:255',
                'phone_number' => 'required|string|max:20',
                'poly' => 'required|string|max:100',
                'patient_type' => 'required|string|in:baru,lama',
                'gender' => 'required|string|in:Laki-laki,Perempuan',
                'birth_date' => 'required|date'
            ];

            // Additional rules for new patients
            $newPatientRules = [
                'address' => 'required|string',
                'religion' => 'required|string|max:50',
                'education' => 'required|string|max:50',
                'marital_status' => 'required|string|max:50',
                'spouse_parent_name' => 'required|string|max:255',
                'mother_name' => 'required|string|max:255',
                'nik' => 'required|string|size:16'
            ];

            // Determine validation rules based on patient type
            $validationRules = $baseRules;
            if ($request->patient_type === 'baru') {
                $validationRules = array_merge($baseRules, $newPatientRules);
            }

            // Add medical record number validation for existing patients
            if ($request->patient_type === 'lama') {
                $validationRules['medical_record_number'] = 'nullable|string|max:50';
            }

            // Validate the request
            $validated = $request->validate($validationRules);

            // Create the registration
            $registration = Registration::create($validated);

            // Store in session for reference
            session(['last_registration_id' => $registration->id]);

            return redirect()->route('registrations.success')
                ->with('success', 'Pendaftaran berhasil disimpan!');

        } catch (\Exception $e) {
            \Log::error('Error creating registration: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menyimpan pendaftaran. Silakan coba lagi.')
                        ->withInput();
        }
    }

    // Halaman sukses
    public function success()
    {
        return view('registrations.success');
    }

    // Halaman index untuk admin
    public function adminIndex()
    {
        $registrations = Registration::latest()->paginate(10);
        return view('admin.registrations.index', compact('registrations'));
    }

    // Pencarian untuk admin
    public function adminSearch(Request $request)
    {
        $query = Registration::latest();

        // Search by name or medical record number
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('full_name', 'like', "%{$request->search}%")
                  ->orWhere('medical_record_number', 'like', "%{$request->search}%");
            });
        }

        // Filter by patient type
        if ($request->patient_type) {
            $query->where('patient_type', $request->patient_type);
        }

        // Filter by status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // Filter by verification status
        if ($request->has('verified')) {
            $query->where('is_verified', $request->verified);
        }

        $registrations = $query->paginate(10);
        return view('admin.registrations.index', compact('registrations'));
    }

    // Detail pendaftaran
    public function show(Registration $registration)
    {
        return view('admin.registrations.show', compact('registration'));
    }

    // Update pendaftaran
    public function adminUpdate(Request $request, Registration $registration)
    {
        $validated = $request->validate([
            'medical_record_number' => 'nullable|string|max:50|unique:registrations,medical_record_number,' . $registration->id,
            'full_name' => 'required|string|max:255',
            'nik' => 'required|string|size:16|unique:registrations,nik,' . $registration->id,
            'gender' => 'required|string|in:Laki-laki,Perempuan',
            'birth_date' => 'required|date',
            'phone_number' => 'required|string|max:20',
            'religion' => 'nullable|string|max:50',
            'education' => 'nullable|string|max:50',
            'marital_status' => 'nullable|string|max:50',
            'spouse_parent_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'poly' => 'required|string|max:100',
            'status' => 'required|in:proses,selesai,batal',
            'patient_type' => 'required|in:baru,lama',
            'is_verified' => 'boolean'
        ]);

        $registration->update($validated);

        return redirect()->route('admin.registrations.index')
            ->with('success', 'Data pendaftaran berhasil diperbarui');
    }

    // Hapus pendaftaran
    public function adminDestroy(Registration $registration)
    {
        $registration->delete();
        return redirect()->route('admin.registrations.index')
            ->with('success', 'Data pendaftaran berhasil dihapus');
    }

    // Export ke Excel
    public function export()
    {
        return Excel::download(new RegistrationsExport, 'registrations.xlsx');
    }

    // Update status
    public function updateStatus(Request $request, Registration $registration)
    {
        $request->validate([
            'status' => 'required|in:proses,selesai,batal'
        ]);

        $registration->update([
            'status' => $request->status
        ]);

        $statusMap = [
            'proses' => 'diproses',
            'selesai' => 'diselesaikan',
            'batal' => 'dibatalkan'
        ];

        return redirect()->back()->with('success', 'Pendaftaran berhasil ' . $statusMap[$request->status]);
    }

    public function verify(Registration $registration)
    {
        $registration->update([
            'is_verified' => !$registration->is_verified
        ]);

        $status = $registration->is_verified ? 'terverifikasi' : 'batal verifikasi';
        return redirect()->back()->with('success', "Pendaftaran berhasil $status");
    }

    public function search(Request $request)
    {
        $query = Registration::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
        }

        if ($request->filled('patient_type')) {
            $query->where('patient_type', $request->input('patient_type'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $registrations = $query->latest()->paginate(10);
        
        if ($request->ajax()) {
            return response()->json([
                'html' => view('admin.registrations._table', compact('registrations'))->render(),
                'pagination' => view('admin.registrations._pagination', compact('registrations'))->render(),
            ]);
        }

        return view('admin.registrations.index', compact('registrations'));
    }
} 