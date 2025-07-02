@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Form Pendaftaran {{ request('type') === 'baru' ? 'Pasien Baru' : 'Pasien Lama' }}</h4>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('registrations.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="patient_type" value="{{ request('type', 'baru') }}">

                        @if(request('type') === 'lama')
                        <div class="mb-3">
                            <label class="form-label">Nomor Rekam Medis (RM) / Kartu Berobat</label>
                            <input type="text" class="form-control @error('medical_record_number') is-invalid @enderror" 
                                   name="medical_record_number" 
                                   value="{{ old('medical_record_number') }}">
                            <small class="text-muted">Opsional, kosongkan jika lupa</small>
                            @error('medical_record_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        @endif

                        <div class="mb-3">
                            <label class="form-label required">Nama Lengkap</label>
                            <input type="text" class="form-control @error('full_name') is-invalid @enderror" 
                                   name="full_name" 
                                   value="{{ old('full_name') }}" 
                                   required>
                            @error('full_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label required">Jenis Kelamin</label>
                            <select class="form-select @error('gender') is-invalid @enderror" 
                                    name="gender" 
                                    required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki" {{ old('gender') === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('gender') === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label required">Tanggal Lahir</label>
                            <input type="date" class="form-control @error('birth_date') is-invalid @enderror" 
                                   name="birth_date" 
                                   value="{{ old('birth_date') }}" 
                                   required>
                            @error('birth_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label required">Nomor HP/WhatsApp</label>
                            <input type="text" class="form-control @error('phone_number') is-invalid @enderror" 
                                   name="phone_number" 
                                   value="{{ old('phone_number') }}" 
                                   required>
                            @error('phone_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        @if(request('type') === 'baru')
                        <div class="mb-3">
                            <label class="form-label required">Agama</label>
                            <select class="form-select @error('religion') is-invalid @enderror" 
                                    name="religion" 
                                    required>
                                <option value="">Pilih Agama</option>
                                <option value="Islam" {{ old('religion') === 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen" {{ old('religion') === 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                <option value="Katolik" {{ old('religion') === 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                <option value="Hindu" {{ old('religion') === 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Budha" {{ old('religion') === 'Budha' ? 'selected' : '' }}>Budha</option>
                                <option value="Lainnya" {{ old('religion') === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('religion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label required">Pendidikan Terakhir</label>
                            <select class="form-select @error('education') is-invalid @enderror" 
                                    name="education" 
                                    required>
                                <option value="">Pilih Pendidikan</option>
                                <option value="SD" {{ old('education') === 'SD' ? 'selected' : '' }}>SD</option>
                                <option value="SMP" {{ old('education') === 'SMP' ? 'selected' : '' }}>SMP</option>
                                <option value="SMA/SMK" {{ old('education') === 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                                <option value="D3" {{ old('education') === 'D3' ? 'selected' : '' }}>D3</option>
                                <option value="S1" {{ old('education') === 'S1' ? 'selected' : '' }}>S1</option>
                                <option value="S2" {{ old('education') === 'S2' ? 'selected' : '' }}>S2</option>
                                <option value="S3" {{ old('education') === 'S3' ? 'selected' : '' }}>S3</option>
                                <option value="Lainnya" {{ old('education') === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('education')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label required">Status Perkawinan</label>
                            <select class="form-select @error('marital_status') is-invalid @enderror" 
                                    name="marital_status" 
                                    required>
                                <option value="">Pilih Status</option>
                                <option value="Belum Menikah" {{ old('marital_status') === 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                                <option value="Menikah" {{ old('marital_status') === 'Menikah' ? 'selected' : '' }}>Menikah</option>
                                <option value="Cerai" {{ old('marital_status') === 'Cerai' ? 'selected' : '' }}>Cerai</option>
                            </select>
                            @error('marital_status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label required">Nama Suami/Istri/Orang Tua</label>
                            <input type="text" class="form-control @error('spouse_parent_name') is-invalid @enderror" 
                                   name="spouse_parent_name" 
                                   value="{{ old('spouse_parent_name') }}" 
                                   required>
                            @error('spouse_parent_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label required">Nama Ibu</label>
                            <input type="text" class="form-control @error('mother_name') is-invalid @enderror" 
                                   name="mother_name" 
                                   value="{{ old('mother_name') }}" 
                                   required>
                            @error('mother_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label required">NIK</label>
                            <input type="text" class="form-control @error('nik') is-invalid @enderror" 
                                   name="nik" 
                                   value="{{ old('nik') }}" 
                                   required 
                                   maxlength="16">
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label required">Alamat Domisili</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                      name="address" 
                                      required 
                                      rows="3">{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        @endif

                        <div class="mb-3">
                            <label class="form-label required">Poli Tujuan</label>
                            <select class="form-select @error('poly') is-invalid @enderror" 
                                    name="poly" 
                                    required>
                                <option value="">Pilih Poli</option>
                                <option value="Poli Umum" {{ old('poly') === 'Poli Umum' ? 'selected' : '' }}>Poli Umum</option>
                                <option value="Poli Gigi" {{ old('poly') === 'Poli Gigi' ? 'selected' : '' }}>Poli Gigi</option>
                                <option value="Poli Kandungan" {{ old('poly') === 'Poli Kandungan' ? 'selected' : '' }}>Poli Kandungan</option>
                                <option value="Poli Penyakit Dalam" {{ old('poly') === 'Poli Penyakit Dalam' ? 'selected' : '' }}>Poli Penyakit Dalam</option>
                                <option value="Poli Bedah" {{ old('poly') === 'Poli Bedah' ? 'selected' : '' }}>Poli Bedah</option>
                            </select>
                            @error('poly')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-end">
                            <a href="{{ route('registrations.select-type') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Daftar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.required:after {
    content: " *";
    color: red;
}
</style>
@endsection 