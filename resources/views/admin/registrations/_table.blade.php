<table class="table table-hover" id="registrationsTable">
    <thead>
        <tr>
            <th>No.</th>
            <th>Tanggal</th>
            <th>Nama</th>
            <th>Email</th>
            <th>No. Telepon</th>
            <th>Tipe Pasien</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($registrations as $registration)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $registration->created_at->format('d/m/Y H:i') }}</td>
            <td>{{ $registration->name }}</td>
            <td>{{ $registration->email }}</td>
            <td>{{ $registration->phone }}</td>
            <td>
                <span class="badge bg-info">
                    {{ ucfirst($registration->patient_type) }}
                </span>
            </td>
            <td>
                <span class="badge {{ $registration->status == 'pending' ? 'bg-warning' : ($registration->status == 'approved' ? 'bg-success' : 'bg-danger') }}">
                    {{ ucfirst($registration->status) }}
                </span>
            </td>
            <td>
                <a href="{{ route('admin.registrations.show', $registration) }}" class="btn btn-sm btn-info">
                    <i class="fas fa-eye"></i>
                </a>
                <a href="{{ route('admin.registrations.edit', $registration) }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-edit"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table> 