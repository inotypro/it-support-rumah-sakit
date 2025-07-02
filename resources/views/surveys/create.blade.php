@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Survey Kepuasan Pasien</h4>
                </div>
                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('surveys.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="form-label">Pelayanan Medis</label>
                            <div class="rating-stars">
                                @for($i = 5; $i >= 1; $i--)
                                    <input type="radio" id="pelayanan_medis_{{ $i }}" name="pelayanan_medis" value="{{ $i }}" class="btn-check" required {{ old('pelayanan_medis') == $i ? 'checked' : '' }}>
                                    <label class="btn btn-outline-warning me-2" for="pelayanan_medis_{{ $i }}">
                                        {{ $i }} <i class="fas fa-star"></i>
                                    </label>
                                @endfor
                            </div>
                            @error('pelayanan_medis')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Fasilitas Rumah Sakit</label>
                            <div class="rating-stars">
                                @for($i = 5; $i >= 1; $i--)
                                    <input type="radio" id="fasilitas_{{ $i }}" name="fasilitas" value="{{ $i }}" class="btn-check" required {{ old('fasilitas') == $i ? 'checked' : '' }}>
                                    <label class="btn btn-outline-warning me-2" for="fasilitas_{{ $i }}">
                                        {{ $i }} <i class="fas fa-star"></i>
                                    </label>
                                @endfor
                            </div>
                            @error('fasilitas')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Kebersihan</label>
                            <div class="rating-stars">
                                @for($i = 5; $i >= 1; $i--)
                                    <input type="radio" id="kebersihan_{{ $i }}" name="kebersihan" value="{{ $i }}" class="btn-check" required {{ old('kebersihan') == $i ? 'checked' : '' }}>
                                    <label class="btn btn-outline-warning me-2" for="kebersihan_{{ $i }}">
                                        {{ $i }} <i class="fas fa-star"></i>
                                    </label>
                                @endfor
                            </div>
                            @error('kebersihan')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Kecepatan Pelayanan</label>
                            <div class="rating-stars">
                                @for($i = 5; $i >= 1; $i--)
                                    <input type="radio" id="kecepatan_{{ $i }}" name="kecepatan_pelayanan" value="{{ $i }}" class="btn-check" required {{ old('kecepatan_pelayanan') == $i ? 'checked' : '' }}>
                                    <label class="btn btn-outline-warning me-2" for="kecepatan_{{ $i }}">
                                        {{ $i }} <i class="fas fa-star"></i>
                                    </label>
                                @endfor
                            </div>
                            @error('kecepatan_pelayanan')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Keramahan Staff</label>
                            <div class="rating-stars">
                                @for($i = 5; $i >= 1; $i--)
                                    <input type="radio" id="keramahan_{{ $i }}" name="keramahan_staff" value="{{ $i }}" class="btn-check" required {{ old('keramahan_staff') == $i ? 'checked' : '' }}>
                                    <label class="btn btn-outline-warning me-2" for="keramahan_{{ $i }}">
                                        {{ $i }} <i class="fas fa-star"></i>
                                    </label>
                                @endfor
                            </div>
                            @error('keramahan_staff')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="saran" class="form-label">Saran dan Masukan (Opsional)</label>
                            <textarea class="form-control @error('saran') is-invalid @enderror" id="saran" name="saran" rows="4">{{ old('saran') }}</textarea>
                            @error('saran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane me-2"></i>Kirim Penilaian
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.rating-stars {
    display: flex;
    gap: 0.5rem;
}

.btn-outline-warning {
    color: #ffc107;
    border-color: #ffc107;
}

.btn-outline-warning:hover,
.btn-check:checked + .btn-outline-warning {
    color: #000;
    background-color: #ffc107;
    border-color: #ffc107;
}
</style>
@endsection 