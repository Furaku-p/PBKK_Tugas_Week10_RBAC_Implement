@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin-theme.css') }}">
@stop

@section('title', 'Dashboard Admin')

@section('content_header')
    <h1>Dashboard Akademik</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-3 mb-4">
        <div class="col-lg-4 col-md-6">
            <div class="info-box shadow-sm">
                <span class="info-box-icon text-bg-primary"><i class="bi bi-people"></i></span>
                <div class="info-box-content"><span class="info-box-text">Total Mahasiswa</span><span class="info-box-number">{{ number_format($totalMahasiswa) }}</span></div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="info-box shadow-sm">
                <span class="info-box-icon text-bg-success"><i class="bi bi-person-badge"></i></span>
                <div class="info-box-content"><span class="info-box-text">Total Dosen</span><span class="info-box-number">{{ number_format($totalDosen) }}</span></div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="info-box shadow-sm">
                <span class="info-box-icon text-bg-warning"><i class="bi bi-journal-check"></i></span>
                <div class="info-box-content"><span class="info-box-text">Tugas Aktif</span><span class="info-box-number">{{ number_format($totalTugasAktif) }}</span></div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header"><h3 class="card-title">Mahasiswa Terbaru</h3></div>
                <div class="card-body p-0 table-responsive">
                    <table class="table table-striped mb-0 align-middle">
                        <thead><tr><th>NRP</th><th>Nama</th><th>Departemen</th><th>Status</th></tr></thead>
                        <tbody>
                            @forelse($recentMahasiswa as $mahasiswa)
                                <tr>
                                    <td>{{ $mahasiswa->nrp }}</td><td>{{ $mahasiswa->nama }}</td><td>{{ $mahasiswa->departemen_id }}</td>
                                    <td><span class="badge {{ $mahasiswa->is_active ? 'text-bg-success' : 'text-bg-secondary' }}">{{ $mahasiswa->is_active ? 'Aktif' : 'Cuti' }}</span></td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="text-center text-body-secondary py-4">Belum ada data mahasiswa.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer"><a href="{{ route('admin.mahasiswa.index') }}">Lihat semua mahasiswa →</a></div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header"><h3 class="card-title">Ringkasan Sistem</h3></div>
                <div class="card-body">
                    <p class="mb-2">Mahasiswa aktif <strong class="float-end">{{ number_format($totalMahasiswaAktif) }}</strong></p>
                    <div class="progress mb-3" role="progressbar" aria-label="Mahasiswa aktif" aria-valuenow="{{ $totalMahasiswa ? round($totalMahasiswaAktif / $totalMahasiswa * 100) : 0 }}" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-success" style="width: {{ $totalMahasiswa ? ($totalMahasiswaAktif / $totalMahasiswa * 100) : 0 }}%"></div>
                    </div>
                    <p class="text-body-secondary small mb-0">Semua angka pada widget diambil langsung dari database menggunakan query Eloquent count().</p>
                </div>
            </div>
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="fw-semibold">Login sebagai</div>
                    <div>{{ auth()->user()->name }}</div>
                    <span class="badge text-bg-primary mt-2">{{ auth()->user()->getRoleNames()->first() }}</span>
                </div>
            </div>
        </div>
    </div>
@stop
