@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Detail Survey</h3>
                    <a href="{{ route('admin.surveys.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <th style="width: 200px;">Nama</th>
                                    <td>{{ $survey->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $survey->email }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Submit</th>
                                    <td>{{ $survey->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h4>Rating</h4>
                        </div>
                        @php
                        $ratings = [
                            'Pelayanan Medis' => $survey->pelayanan_medis_rating,
                            'Fasilitas' => $survey->fasilitas_rating,
                            'Kebersihan' => $survey->kebersihan_rating,
                            'Kecepatan Pelayanan' => $survey->kecepatan_pelayanan_rating,
                            'Keramahan Staff' => $survey->keramahan_staff_rating
                        ];
                        @endphp

                        @foreach($ratings as $category => $rating)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $category }}</h5>
                                    <div class="d-flex align-items-center">
                                        <div class="h2 mb-0 me-2">{{ $rating }}</div>
                                        <div class="text-warning">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $rating)
                                                    <i class="fas fa-star"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height: 5px;">
                                        <div class="progress-bar {{ $rating >= 4 ? 'bg-success' : ($rating >= 3 ? 'bg-warning' : 'bg-danger') }}" 
                                             role="progressbar" 
                                             style="width: {{ ($rating/5)*100 }}%" 
                                             aria-valuenow="{{ $rating }}" 
                                             aria-valuemin="0" 
                                             aria-valuemax="5">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    @if($survey->saran)
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Saran dan Masukan</h5>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">{{ $survey->saran }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 