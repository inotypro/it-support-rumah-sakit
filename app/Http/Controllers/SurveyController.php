<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;
use App\Exports\SurveysExport;
use Maatwebsite\Excel\Facades\Excel;

class SurveyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['create', 'store', 'success']);
    }

    public function adminIndex()
    {
        $surveys = Survey::latest()->paginate(10);
        $averageRatings = [
            'pelayanan_medis' => Survey::avg('pelayanan_medis_rating'),
            'fasilitas' => Survey::avg('fasilitas_rating'),
            'kebersihan' => Survey::avg('kebersihan_rating'),
            'kecepatan_pelayanan' => Survey::avg('kecepatan_pelayanan_rating'),
            'keramahan_staff' => Survey::avg('keramahan_staff_rating'),
        ];

        return view('admin.surveys.index', compact('surveys', 'averageRatings'));
    }

    public function adminSearch(Request $request)
    {
        $query = Survey::latest();

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('phone_number', 'like', '%' . $request->search . '%');
        }

        if ($request->rating) {
            // Calculate average rating for filtering
            $query->whereRaw('(pelayanan_medis_rating + fasilitas_rating + kebersihan_rating + kecepatan_pelayanan_rating + keramahan_staff_rating) / 5 >= ?', [$request->rating]);
        }

        $surveys = $query->paginate(10);

        // Calculate average ratings for display
        $averageRatings = [
            'pelayanan_medis' => Survey::avg('pelayanan_medis_rating'),
            'fasilitas' => Survey::avg('fasilitas_rating'),
            'kebersihan' => Survey::avg('kebersihan_rating'),
            'kecepatan_pelayanan' => Survey::avg('kecepatan_pelayanan_rating'),
            'keramahan_staff' => Survey::avg('keramahan_staff_rating'),
        ];

        return view('admin.surveys.index', compact('surveys', 'averageRatings'));
    }

    public function adminShow(Survey $survey)
    {
        return view('admin.surveys.show', compact('survey'));
    }

    public function adminDestroy(Survey $survey)
    {
        $survey->delete();
        return redirect()->route('admin.surveys.index')->with('success', 'Survey berhasil dihapus.');
    }

    public function export()
    {
        return Excel::download(new SurveysExport, 'surveys.xlsx');
    }

    public function create()
    {
        return view('surveys.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'pelayanan_medis' => 'required|integer|min:1|max:5',
            'fasilitas' => 'required|integer|min:1|max:5',
            'kebersihan' => 'required|integer|min:1|max:5',
            'kecepatan_pelayanan' => 'required|integer|min:1|max:5',
            'keramahan_staff' => 'required|integer|min:1|max:5',
            'saran' => 'nullable|string|max:1000',
        ]);

        // Map the form field names to database column names
        $survey = new Survey();
        $survey->name = $validated['name'];
        $survey->phone_number = $validated['phone_number'];
        $survey->pelayanan_medis_rating = $validated['pelayanan_medis'];
        $survey->fasilitas_rating = $validated['fasilitas'];
        $survey->kebersihan_rating = $validated['kebersihan'];
        $survey->kecepatan_pelayanan_rating = $validated['kecepatan_pelayanan'];
        $survey->keramahan_staff_rating = $validated['keramahan_staff'];
        $survey->saran = $validated['saran'];
        $survey->save();

        return redirect()->route('surveys.success')
                        ->with('success', 'Terima kasih atas penilaian Anda!');
    }

    public function success()
    {
        return view('surveys.success');
    }
}