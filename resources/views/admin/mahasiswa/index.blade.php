@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin-theme.css') }}">
@stop

@section('title', 'Data Mahasiswa')

@section('content_header')
    <h1>Data Mahasiswa</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header"><h3 class="card-title">Pencarian & Filter</h3></div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.mahasiswa.index') }}" class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label for="search" class="form-label">Keyword (Nama / NRP / Email)</label>
                    <input id="search" name="search" type="search" class="form-control" value="{{ request('search') }}" placeholder="Cari mahasiswa...">
                </div>
                <div class="col-md-3">
                    <label for="departemen_id" class="form-label">Departemen</label>
                    <select id="departemen_id" name="departemen_id" class="form-select">
                        <option value="">Semua departemen</option>
                        @foreach($departemen as $id => $nama)
                            <option value="{{ $id }}" @selected(request('departemen_id') === $id)>{{ $nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="status" class="form-label">Status</label>
                    <select id="status" name="status" class="form-select">
                        <option value="">Semua status</option>
                        <option value="aktif" @selected(request('status') === 'aktif')>Aktif</option>
                        <option value="cuti" @selected(request('status') === 'cuti')>Cuti</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex gap-2">
                    <button class="btn btn-primary flex-grow-1" type="submit"><i class="bi bi-search"></i> Cari</button>
                    <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header"><h3 class="card-title">Daftar Mahasiswa</h3><span class="badge text-bg-secondary float-end">{{ $mahasiswas->total() }} data</span></div>
        <div class="card-body p-0 table-responsive">
            <table class="table table-hover table-striped align-middle mb-0">
                <thead><tr><th class="ps-3">#</th><th>NRP</th><th>Nama</th><th>Email</th><th>Departemen</th><th>Status</th>@can('delete-mahasiswa')<th class="text-end pe-3">Aksi</th>@endcan</tr></thead>
                <tbody>
                    @forelse($mahasiswas as $mahasiswa)
                        <tr>
                            <td class="ps-3">{{ $mahasiswas->firstItem() + $loop->index }}</td>
                            <td>{{ $mahasiswa->nrp }}</td>
                            <td>{{ $mahasiswa->nama }}</td>
                            <td>{{ $mahasiswa->email }}</td>
                            <td>{{ $departemen[$mahasiswa->departemen_id] ?? $mahasiswa->departemen_id }}</td>
                            <td><span class="badge {{ $mahasiswa->is_active ? 'text-bg-success' : 'text-bg-secondary' }}">{{ $mahasiswa->is_active ? 'Aktif' : 'Cuti' }}</span></td>
                            @can('delete-mahasiswa')
                                <td class="text-end pe-3">
                                    <form method="POST" action="{{ route('admin.mahasiswa.destroy', $mahasiswa) }}" onsubmit="return confirm('Yakin ingin menghapus data mahasiswa ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i> Hapus</button>
                                    </form>
                                </td>
                            @endcan
                        </tr>
                    @empty
                        <tr><td colspan="{{ auth()->user()->can('delete-mahasiswa') ? 7 : 6 }}" class="text-center text-body-secondary py-4">Data mahasiswa tidak ditemukan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">{{ $mahasiswas->links() }}</div>
    </div>
@stop
