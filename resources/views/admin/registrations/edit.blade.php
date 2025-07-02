@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Data Pendaftaran</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.registrations.index') }}">Pendaftaran</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-warning text-white">
                            <h4 class="mb-0">Form Edit Data Pasien</h4>
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
                            <form action="{{ route('admin.registrations.update', $registration) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label">No. Rekam Medis</label>
                                    <input type="text" name="medical_record_number" class="form-control @error('medical_record_number') is-invalid @enderror" value="{{ old('medical_record_number', $registration->medical_record_number) }}">
                                    @error('medical_record_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Nama Lengkap</label>
                                    <input type="text" name="full_name" class="form-control @error('full_name') is-invalid @enderror" value="{{ old('full_name', $registration->full_name) }}" required>
                                    @error('full_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">NIK</label>
                                    <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik', $registration->nik) }}" maxlength="16" required>
                                    @error('nik')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Jenis Kelamin</label>
                                    <select name="gender" class="form-select @error('gender') is-invalid @enderror" required>
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki" {{ old('gender', $registration->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan" {{ old('gender', $registration->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Tanggal Lahir</label>
                                    <input type="date" name="birth_date" class="form-control @error('birth_date') is-invalid @enderror" value="{{ old('birth_date', $registration->birth_date ? date('Y-m-d', strtotime($registration->birth_date)) : '') }}" required>
                                    @error('birth_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Nomor HP/WhatsApp</label>
                                    <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number', $registration->phone_number) }}" required>
                                    @error('phone_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Agama</label>
                                    <select name="religion" class="form-select @error('religion') is-invalid @enderror">
                                        <option value="">Pilih Agama</option>
                                        <option value="Islam" {{ old('religion', $registration->religion) == 'Islam' ? 'selected' : '' }}>Islam</option>
                                        <option value="Kristen" {{ old('religion', $registration->religion) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                        <option value="Katolik" {{ old('religion', $registration->religion) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                        <option value="Hindu" {{ old('religion', $registration->religion) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                        <option value="Budha" {{ old('religion', $registration->religion) == 'Budha' ? 'selected' : '' }}>Budha</option>
                                        <option value="Lainnya" {{ old('religion', $registration->religion) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                    @error('religion')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Pendidikan Terakhir</label>
                                    <select name="education" class="form-select @error('education') is-invalid @enderror">
                                        <option value="">Pilih Pendidikan</option>
                                        <option value="SD" {{ old('education', $registration->education) == 'SD' ? 'selected' : '' }}>SD</option>
                                        <option value="SMP" {{ old('education', $registration->education) == 'SMP' ? 'selected' : '' }}>SMP</option>
                                        <option value="SMA/SMK" {{ old('education', $registration->education) == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                                        <option value="D3" {{ old('education', $registration->education) == 'D3' ? 'selected' : '' }}>D3</option>
                                        <option value="S1" {{ old('education', $registration->education) == 'S1' ? 'selected' : '' }}>S1</option>
                                        <option value="S2" {{ old('education', $registration->education) == 'S2' ? 'selected' : '' }}>S2</option>
                                        <option value="S3" {{ old('education', $registration->education) == 'S3' ? 'selected' : '' }}>S3</option>
                                        <option value="Lainnya" {{ old('education', $registration->education) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                    @error('education')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Status Perkawinan</label>
                                    <select name="marital_status" class="form-select @error('marital_status') is-invalid @enderror">
                                        <option value="">Pilih Status</option>
                                        <option value="Belum Menikah" {{ old('marital_status', $registration->marital_status) == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                                        <option value="Menikah" {{ old('marital_status', $registration->marital_status) == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                                        <option value="Cerai" {{ old('marital_status', $registration->marital_status) == 'Cerai' ? 'selected' : '' }}>Cerai</option>
                                    </select>
                                    @error('marital_status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nama Suami/Istri/Orang Tua</label>
                                    <input type="text" name="spouse_parent_name" class="form-control @error('spouse_parent_name') is-invalid @enderror" value="{{ old('spouse_parent_name', $registration->spouse_parent_name) }}">
                                    @error('spouse_parent_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nama Ibu</label>
                                    <input type="text" name="mother_name" class="form-control @error('mother_name') is-invalid @enderror" value="{{ old('mother_name', $registration->mother_name) }}">
                                    @error('mother_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Alamat Domisili</label>
                                    <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="3">{{ old('address', $registration->address) }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Poli Tujuan</label>
                                    <select name="poly" class="form-select @error('poly') is-invalid @enderror" required>
                                        <option value="">Pilih Poli</option>
                                        <option value="Poli Umum" {{ old('poly', $registration->poly) == 'Poli Umum' ? 'selected' : '' }}>Poli Umum</option>
                                        <option value="Poli Gigi" {{ old('poly', $registration->poly) == 'Poli Gigi' ? 'selected' : '' }}>Poli Gigi</option>
                                        <option value="Poli Kandungan" {{ old('poly', $registration->poly) == 'Poli Kandungan' ? 'selected' : '' }}>Poli Kandungan</option>
                                        <option value="Poli Penyakit Dalam" {{ old('poly', $registration->poly) == 'Poli Penyakit Dalam' ? 'selected' : '' }}>Poli Penyakit Dalam</option>
                                        <option value="Poli Bedah" {{ old('poly', $registration->poly) == 'Poli Bedah' ? 'selected' : '' }}>Poli Bedah</option>
                                    </select>
                                    @error('poly')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Status</label>
                                    <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                        <option value="proses" {{ old('status', $registration->status) == 'proses' ? 'selected' : '' }}>Proses</option>
                                        <option value="selesai" {{ old('status', $registration->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                        <option value="batal" {{ old('status', $registration->status) == 'batal' ? 'selected' : '' }}>Batal</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Tipe Pasien</label>
                                    <select name="patient_type" class="form-select @error('patient_type') is-invalid @enderror" required>
                                        <option value="baru" {{ old('patient_type', $registration->patient_type) == 'baru' ? 'selected' : '' }}>Baru</option>
                                        <option value="lama" {{ old('patient_type', $registration->patient_type) == 'lama' ? 'selected' : '' }}>Lama</option>
                                    </select>
                                    @error('patient_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('admin.registrations.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Batal</a>
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
