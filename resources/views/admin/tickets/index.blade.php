@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-ticket-alt me-1"></i>
                    Daftar Tiket IT Support
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-8">
                        <div class="input-group">
                            <input type="text" id="searchInput" class="form-control"
                                placeholder="Cari berdasarkan unit atau deskripsi...">
                            <button class="btn btn-primary" type="button" id="searchButton">
                                <i class="fas fa-search"></i> Cari
                            </button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <select id="statusFilter" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="pending">Pending</option>
                            <option value="progress">Dalam Proses</option>
                            <option value="completed">Selesai</option>
                            <option value="cancelled">Dibatalkan</option>
                        </select>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="ticketsTable">
                        <thead class="table-light">
                            <tr>
                                <th>No. Tiket</th>
                                <th>Unit</th>
                                <th>Deskripsi</th>
                                <th>Tanggapan</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tickets as $ticket)
                                <tr>
                                    <td>{{ $ticket->ticket_number }}</td>
                                    <td>{{ $ticket->unit }}</td>
                                    <td>{{ Str::limit($ticket->description, 50) }}</td>
                                    <td>{{ Str::limit($ticket->response, 50) }}</td>
                                    <td><span class="badge bg-{{ $ticket->status == 'pending' ? 'warning' : ($ticket->status == 'progress' ? 'info' : 'success') }}">{{ $ticket->status}}</span></td>
                                    <td>{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('admin.tickets.edit', $ticket->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.tickets.destroy', $ticket->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus tiket ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $tickets->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal View Ticket -->
    <div class="modal fade" id="viewTicketModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Tiket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>No. Tiket:</strong> <span id="modalTicketNumber"></span></p>
                            <p><strong>Unit:</strong> <span id="modalUnit"></span></p>
                            <p><strong>Status:</strong> <span id="modalStatus"></span></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Tanggal:</strong> <span id="modalDate"></span></p>
                            <p><strong>Nama:</strong> <span id="modalName"></span></p>
                            <p><strong>No. HP:</strong> <span id="modalPhone"></span></p>
                        </div>
                    </div>
                    <div class="mb-3">
                        <strong>Deskripsi:</strong>
                        <p id="modalDescription"></p>
                    </div>
                    <div id="modalImageContainer">
                        <strong>Lampiran:</strong><br>
                        <img id="modalImage" src="" alt="Lampiran" class="img-fluid mt-2"
                            style="max-width: 100%; display: none;">
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection