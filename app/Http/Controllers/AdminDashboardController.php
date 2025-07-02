<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Survey;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'totalTickets' => 0,
            'pendingTickets' => 0,
            'inProgressTickets' => 0,
            'completedTickets' => 0,
            'recentTickets' => collect(),
            'totalRegistrations' => 0,
            'pendingRegistrations' => 0,
            'processingRegistrations' => 0,
            'completedRegistrations' => 0,
            'totalSurveys' => 0,
            'averageRatings' => null
        ];

        // Data untuk superadmin dan admin_pendaftaran
        if (Auth::user()->role === 'superadmin' || Auth::user()->role === 'admin_pendaftaran') {
            $data['totalTickets'] = Ticket::count();
            $data['pendingTickets'] = Ticket::where('status', 'pending')->count();
            $data['inProgressTickets'] = Ticket::where('status', 'in_progress')->count();
            $data['completedTickets'] = Ticket::where('status', 'completed')->count();
            $data['recentTickets'] = Ticket::latest()->take(5)->get();
            
            $data['totalRegistrations'] = Registration::count();
            $data['pendingRegistrations'] = Registration::where('status', 'proses')->count();
            $data['processingRegistrations'] = Registration::where('status', 'selesai')->count();
            $data['completedRegistrations'] = Registration::where('status', 'batal')->count();
        }

        // Data khusus superadmin
        if (Auth::user()->role === 'superadmin') {
            $data['totalSurveys'] = Survey::count();
            
            // Calculate average ratings
            if ($data['totalSurveys'] > 0) {
                $data['averageRatings'] = [
                    'pelayanan_medis' => Survey::avg('pelayanan_medis_rating') ?? 0,
                    'fasilitas' => Survey::avg('fasilitas_rating') ?? 0,
                    'kebersihan' => Survey::avg('kebersihan_rating') ?? 0,
                    'kecepatan_pelayanan' => Survey::avg('kecepatan_pelayanan_rating') ?? 0,
                    'keramahan_staff' => Survey::avg('keramahan_staff_rating') ?? 0
                ];
            }
        }

        return view('admin.dashboard', $data);
    }

    public function registration()
    {
        try {
            $query = Registration::query();

            // Filter berdasarkan pencarian
            if (request('search')) {
                $search = request('search');
                $query->where(function($q) use ($search) {
                    $q->where('full_name', 'like', "%{$search}%")
                      ->orWhere('medical_record_number', 'like', "%{$search}%")
                      ->orWhere('nik', 'like', "%{$search}%");
                });
            }

            // Filter berdasarkan status
            if (request('status')) {
                $query->where('status', request('status'));
            }

            // Filter berdasarkan bulan
            if (request('month')) {
                $month = request('month');
                $query->whereYear('created_at', substr($month, 0, 4))
                      ->whereMonth('created_at', substr($month, 5, 2));
            }

            // Ambil data dengan pagination
            $registrations = $query->latest()->paginate(10)->withQueryString();

            return view('admin.registrations.index', [
                'registrations' => $registrations,
                'pendingRegistrations' => Registration::where('status', 'proses')->count(),
                'processedRegistrations' => Registration::where('status', 'selesai')->count(),
                'completedRegistrations' => Registration::where('status', 'batal')->count(),
                'totalRegistrations' => Registration::count()
            ]);

        } catch (\Exception $e) {
            Log::error('Error in registration dashboard: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function updateTicket(Request $request, Ticket $ticket)
    {
        try {
            $ticket->update([
                'status' => $request->status
            ]);
            return back()->with('success', 'Status tiket berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui status: ' . $e->getMessage());
        }
    }

    public function destroyTicket(Ticket $ticket)
    {
        try {
            $ticket->delete();
            return back()->with('success', 'Tiket berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus tiket: ' . $e->getMessage());
        }
    }

    public function search(Request $request)
    {
        try {
            $query = Registration::query();

            if ($request->search) {
                $query->where(function($q) use ($request) {
                    $q->where('patient_name', 'like', "%{$request->search}%")
                      ->orWhere('medical_record_number', 'like', "%{$request->search}%");
                });
            }

            if ($request->status) {
                $query->where('status', $request->status);
            }

            if ($request->patient_type) {
                $query->where('patient_type', $request->patient_type);
            }

            $registrations = $query->latest('registration_date')->paginate(10);

            return response()->json([
                'data' => $registrations,
                'links' => $registrations->links()->toHtml()
            ]);
        } catch (\Exception $e) {
            Log::error('Error in registration search: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan saat mencari data'], 500);
        }
    }

    public function updateRegistration(Request $request, Registration $registration)
    {
        try {
            $registration->update([
                'status' => $request->status
            ]);

            return back()->with('success', 'Status pendaftaran berhasil diperbarui');
        } catch (\Exception $e) {
            Log::error('Error updating registration: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memperbarui status');
        }
    }

    public function destroyRegistration(Registration $registration)
    {
        try {
            $registration->delete();
            return back()->with('success', 'Data pendaftaran berhasil dihapus');
        } catch (\Exception $e) {
            Log::error('Error deleting registration: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menghapus data');
        }
    }

    public function show(Registration $registration)
    {
        return view('admin.registrations.show', [
            'registration' => $registration
        ]);
    }

    public function edit(Registration $registration)
    {
        return view('admin.registrations.edit', [
            'registration' => $registration
        ]);
    }

    public function update(Request $request, Registration $registration)
    {
        try {
            $validated = $request->validate([
                'medical_record_number' => 'nullable|string|max:50',
                'full_name' => 'required|string|max:255',
                'nik' => 'required|string|size:16',
                'gender' => 'required|in:Laki-laki,Perempuan',
                'birth_date' => 'required|date',
                'phone_number' => 'required|string|max:20',
                'religion' => 'required|string|max:50',
                'education' => 'required|string|max:50',
                'marital_status' => 'required|string|max:50',
                'spouse_parent_name' => 'required|string|max:255',
                'mother_name' => 'required|string|max:255',
                'address' => 'required|string',
                'poly' => 'required|string|max:100',
                'status' => 'required|in:proses,selesai,batal'
            ]);

            $registration->update($validated);

            return redirect()
                ->route('admin.registrations.index')
                ->with('success', 'Data pendaftaran berhasil diperbarui');
        } catch (\Exception $e) {
            Log::error('Error updating registration: ' . $e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }
    }

    public function verify(Registration $registration)
    {
        try {
            $registration->update([
                'is_verified' => !$registration->is_verified
            ]);

            $status = $registration->is_verified ? 'terverifikasi' : 'batal verifikasi';
            return back()->with('success', "Pendaftaran berhasil $status");
        } catch (\Exception $e) {
            Log::error('Error verifying registration: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memverifikasi pendaftaran');
        }
    }
} 