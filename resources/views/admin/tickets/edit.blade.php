@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">Edit Tiket</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.tickets.update', $ticket->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Gambar</label>
                            @if($ticket->image_path)
                                <img src="{{ asset('storage/' . $ticket->image_path) }}" alt="Gambar Tiket" class="img-fluid" style="width: 100%;">
                            @else
                                <p>Tidak ada gambar</p>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $ticket->name) }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Unit</label>
                            <input type="text" name="unit" class="form-control" value="{{ old('unit', $ticket->unit) }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">No. HP</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $ticket->phone) }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="description" class="form-control" rows="3" disabled>{{ old('description', $ticket->description) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="pending" {{ old('status', $ticket->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="progress" {{ old('status', $ticket->status) == 'progress' ? 'selected' : '' }}>Progress</option>
                                <option value="completed" {{ old('status', $ticket->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggapan/Respon</label>
                            <textarea name="response" class="form-control @error('response') is-invalid @enderror" rows="3">{{ old('response', $ticket->response) }}</textarea>
                            @error('response')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <a href="{{ route('admin.tickets.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
