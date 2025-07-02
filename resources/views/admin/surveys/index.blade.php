@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Manajemen Survey Kepuasan</h5>
            <a href="{{ route('admin.surveys.export') }}" class="btn btn-light">
                <i class="fas fa-file-excel"></i> Export Excel
            </a>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.surveys.search') }}" method="GET" class="mb-4">
            <div class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan nama..."
                           value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="rating" class="form-select">
                        <option value="">Semua Rating</option>
                        <option value="1" {{ request('rating') == '1' ? 'selected' : '' }}>1 Bintang</option>
                        <option value="2" {{ request('rating') == '2' ? 'selected' : '' }}>2 Bintang</option>
                        <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>3 Bintang</option>
                        <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>4 Bintang</option>
                        <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>5 Bintang</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>No. HP</th>
                        <th>Rating Rata-rata</th>
                        <th>Saran</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($surveys as $index => $survey)
                        <tr>
                            <td>{{ $surveys->firstItem() + $index }}</td>
                            <td>{{ $survey->name }}</td>
                            <td>{{ $survey->phone_number }}</td>
                            <td>
                                @php
                                    $avgRating = ($survey->pelayanan_medis_rating + $survey->fasilitas_rating + $survey->kebersihan_rating + $survey->kecepatan_pelayanan_rating + $survey->keramahan_staff_rating) / 5;
                                @endphp
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $avgRating ? 'text-warning' : 'text-secondary' }}"></i>
                                @endfor
                                <span class="ms-1">({{ number_format($avgRating, 1) }})</span>
                            </td>
                            <td>{{ Str::limit($survey->saran, 50) }}</td>
                            <td>{{ $survey->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                            data-bs-target="#detailModal{{ $survey->id }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <form action="{{ route('admin.surveys.destroy', $survey) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus survey ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Detail -->
                        <div class="modal fade" id="detailModal{{ $survey->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Detail Survey</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <dl class="row">
                                            <dt class="col-sm-4">Nama</dt>
                                            <dd class="col-sm-8">{{ $survey->name }}</dd>

                                            <dt class="col-sm-4">No. HP</dt>
                                            <dd class="col-sm-8">{{ $survey->phone_number }}</dd>

                                            <dt class="col-sm-4">Pelayanan Medis</dt>
                                            <dd class="col-sm-8">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $survey->pelayanan_medis_rating ? 'text-warning' : 'text-secondary' }}"></i>
                                                @endfor
                                                ({{ $survey->pelayanan_medis_rating }}/5)
                                            </dd>

                                            <dt class="col-sm-4">Fasilitas</dt>
                                            <dd class="col-sm-8">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $survey->fasilitas_rating ? 'text-warning' : 'text-secondary' }}"></i>
                                                @endfor
                                                ({{ $survey->fasilitas_rating }}/5)
                                            </dd>

                                            <dt class="col-sm-4">Kebersihan</dt>
                                            <dd class="col-sm-8">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $survey->kebersihan_rating ? 'text-warning' : 'text-secondary' }}"></i>
                                                @endfor
                                                ({{ $survey->kebersihan_rating }}/5)
                                            </dd>

                                            <dt class="col-sm-4">Kecepatan Pelayanan</dt>
                                            <dd class="col-sm-8">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $survey->kecepatan_pelayanan_rating ? 'text-warning' : 'text-secondary' }}"></i>
                                                @endfor
                                                ({{ $survey->kecepatan_pelayanan_rating }}/5)
                                            </dd>

                                            <dt class="col-sm-4">Keramahan Staff</dt>
                                            <dd class="col-sm-8">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $survey->keramahan_staff_rating ? 'text-warning' : 'text-secondary' }}"></i>
                                                @endfor
                                                ({{ $survey->keramahan_staff_rating }}/5)
                                            </dd>

                                            <dt class="col-sm-4">Saran</dt>
                                            <dd class="col-sm-8">{{ $survey->saran ?: 'Tidak ada saran' }}</dd>

                                            <dt class="col-sm-4">Tanggal</dt>
                                            <dd class="col-sm-8">{{ $survey->created_at->format('d/m/Y H:i') }}</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data survey.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-3">
            {{ $surveys->links() }}
        </div>
    </div>
</div>
@endsection
