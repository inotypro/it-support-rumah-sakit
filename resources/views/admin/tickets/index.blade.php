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
                        <input type="text" id="searchInput" class="form-control" placeholder="Cari berdasarkan unit atau deskripsi...">
                        <button class="btn btn-primary" type="button" id="searchButton">
                            <i class="fas fa-search"></i> Cari
                        </button>
                    </div>
                </div>
                <div class="col-md-4">
                    <select id="statusFilter" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="pending">Pending</option>
                        <option value="in_progress">Dalam Proses</option>
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
                            <td>
                                <select class="form-select status-select" data-ticket-id="{{ $ticket->id }}">
                                    <option value="pending" {{ $ticket->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="in_progress" {{ $ticket->status == 'in_progress' ? 'selected' : '' }}>Dalam Proses</option>
                                    <option value="completed" {{ $ticket->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                                    <option value="cancelled" {{ $ticket->status == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                                </select>
                            </td>
                            <td>{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <button class="btn btn-info btn-sm view-ticket" data-ticket-id="{{ $ticket->id }}">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-danger btn-sm delete-ticket" data-ticket-id="{{ $ticket->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
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
                    <img id="modalImage" src="" alt="Lampiran" class="img-fluid mt-2" style="max-width: 100%; display: none;">
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Search functionality
    $('#searchButton').click(function() {
        performSearch();
    });

    $('#searchInput').keypress(function(e) {
        if (e.which == 13) {
            performSearch();
        }
    });

    function performSearch() {
        var searchQuery = $('#searchInput').val();
        var status = $('#statusFilter').val();
        window.location.href = "{{ route('admin.tickets.index') }}?search=" + searchQuery + "&status=" + status;
    }

    // Status filter
    $('#statusFilter').change(function() {
        performSearch();
    });

    // Status update
    $('.status-select').change(function() {
        var ticketId = $(this).data('ticket-id');
        var newStatus = $(this).val();
        
        $.ajax({
            url: `/admin/tickets/${ticketId}/status`,
            method: 'PUT',
            data: {
                status: newStatus,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    toastr.success('Status tiket berhasil diperbarui');
                } else {
                    toastr.error('Gagal memperbarui status tiket');
                }
            },
            error: function() {
                toastr.error('Terjadi kesalahan saat memperbarui status');
            }
        });
    });

    // View ticket details
    $('.view-ticket').click(function() {
        var ticketId = $(this).data('ticket-id');
        
        $.get(`/admin/tickets/${ticketId}`, function(ticket) {
            $('#modalTicketNumber').text(ticket.ticket_number);
            $('#modalUnit').text(ticket.unit);
            $('#modalStatus').text(getStatusText(ticket.status));
            $('#modalDate').text(formatDate(ticket.created_at));
            $('#modalName').text(ticket.name);
            $('#modalPhone').text(ticket.phone);
            $('#modalDescription').text(ticket.description);
            
            if (ticket.image_path) {
                $('#modalImage').attr('src', '/storage/' + ticket.image_path).show();
                $('#modalImageContainer').show();
            } else {
                $('#modalImage').hide();
                $('#modalImageContainer').hide();
            }
            
            $('#viewTicketModal').modal('show');
        });
    });

    // Delete ticket
    $('.delete-ticket').click(function() {
        var ticketId = $(this).data('ticket-id');
        
        if (confirm('Apakah Anda yakin ingin menghapus tiket ini?')) {
            $.ajax({
                url: `/admin/tickets/${ticketId}`,
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success('Tiket berhasil dihapus');
                        location.reload();
                    } else {
                        toastr.error('Gagal menghapus tiket');
                    }
                },
                error: function() {
                    toastr.error('Terjadi kesalahan saat menghapus tiket');
                }
            });
        }
    });

    function getStatusText(status) {
        const statusMap = {
            'pending': 'Pending',
            'in_progress': 'Dalam Proses',
            'completed': 'Selesai',
            'cancelled': 'Dibatalkan'
        };
        return statusMap[status] || status;
    }

    function formatDate(dateString) {
        const options = { 
            day: '2-digit', 
            month: '2-digit', 
            year: 'numeric',
            hour: '2-digit', 
            minute: '2-digit'
        };
        return new Date(dateString).toLocaleString('id-ID', options);
    }
});
</script>
@endsection 