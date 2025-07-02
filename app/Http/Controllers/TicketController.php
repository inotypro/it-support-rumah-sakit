<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Exports\TicketsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['create', 'store', 'success']);
    }

    public function index()
    {
        $tickets = Ticket::latest()->paginate(10);
        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'unit' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $ticket = new Ticket();
        $ticket->ticket_number = 'TIK-' . strtoupper(Str::random(8));
        $ticket->name = $validated['name'];
        $ticket->unit = $validated['unit'];
        $ticket->phone = $validated['phone'];
        $ticket->description = $validated['description'];
        $ticket->status = 'pending';

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/tickets', $imageName);
            $ticket->image_path = 'tickets/' . $imageName;
        }

        $ticket->save();

        return redirect()->route('tickets.success');
    }

    public function show(Ticket $ticket)
    {
        return view('tickets.show', compact('ticket'));
    }

    public function success()
    {
        return view('tickets.success');
    }

    public function adminIndex(Request $request)
    {
        $query = Ticket::query();

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('unit', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $tickets = $query->latest()->paginate(10);
        return view('admin.tickets.index', compact('tickets'));
    }

    public function adminShow(Ticket $ticket)
    {
        return response()->json($ticket);
    }

    public function adminUpdate(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,completed',
            'response' => 'nullable|string'
        ]);

        $ticket->update($validated);

        return redirect()->route('admin.tickets.index')
            ->with('success', 'Tiket berhasil diperbarui');
    }

    public function updateTicket(Request $request, Ticket $ticket)
    {
        try {
            $ticket->update([
                'status' => $request->status,
                'notes' => $request->notes
            ]);
            return back()->with('success', 'Status tiket berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui status: ' . $e->getMessage());
        }
    }

    public function destroyTicket(Ticket $ticket)
    {
        try {
            if ($ticket->image_path) {
                Storage::disk('public')->delete($ticket->image_path);
            }
            
            $ticket->delete();
            return redirect()->route('admin.tickets.index')
                ->with('success', 'Tiket berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus tiket: ' . $e->getMessage());
        }
    }

    public function search(Request $request)
    {
        $query = Ticket::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('unit', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $tickets = $query->latest()->paginate(10);
        
        if ($request->ajax()) {
            return response()->json([
                'html' => view('admin.tickets._table', compact('tickets'))->render(),
                'pagination' => view('admin.tickets._pagination', compact('tickets'))->render(),
            ]);
        }

        return view('admin.tickets.index', compact('tickets'));
    }

    public function export()
    {
        $tickets = Ticket::all();
        
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Headers
        $sheet->setCellValue('A1', 'No.');
        $sheet->setCellValue('B1', 'Unit');
        $sheet->setCellValue('C1', 'Deskripsi');
        $sheet->setCellValue('D1', 'Status');
        $sheet->setCellValue('E1', 'Tanggal Dibuat');
        
        // Data
        $row = 2;
        foreach ($tickets as $index => $ticket) {
            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, $ticket->unit);
            $sheet->setCellValue('C' . $row, $ticket->description);
            $sheet->setCellValue('D' . $row, ucfirst($ticket->status));
            $sheet->setCellValue('E' . $row, $ticket->created_at->format('d/m/Y H:i'));
            $row++;
        }
        
        // Auto-size columns
        foreach (range('A', 'E') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }
        
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        
        $filename = 'tickets-' . date('Y-m-d') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output');
    }

    public function updateStatus(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,completed,cancelled'
        ]);

        $ticket->update($validated);

        return response()->json(['success' => true]);
    }

    public function adminDestroy(Ticket $ticket)
    {
        if ($ticket->image_path) {
            Storage::disk('public')->delete($ticket->image_path);
        }
        
        $ticket->delete();
        
        return response()->json(['success' => true]);
    }
} 