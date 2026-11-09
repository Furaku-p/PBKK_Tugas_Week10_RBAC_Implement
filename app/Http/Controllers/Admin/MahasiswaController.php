<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MahasiswaController extends Controller
{
    public function index(Request $request): View
    {
        $mahasiswas = Mahasiswa::query()
            ->when($request->search, function ($query, $search) {
                return $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('nama', 'like', "%{$search}%")
                        ->orWhere('nrp', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($request->departemen_id, fn ($query, $departemenId) => $query->where('departemen_id', $departemenId))
            ->when($request->status !== null && $request->status !== '', fn ($query) => $query->where('is_active', $request->status === 'aktif'))
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString();

        return view('admin.mahasiswa.index', [
            'mahasiswas' => $mahasiswas,
            'departemen' => ['IF' => 'Informatika', 'SI' => 'Sistem Informasi', 'EL' => 'Teknik Elektro', 'BD' => 'Bisnis Digital'],
        ]);
    }

    public function destroy(Mahasiswa $mahasiswa): RedirectResponse
    {
        abort_unless(auth()->user()->can('delete-mahasiswa'), 403);

        $mahasiswa->delete();

        return redirect()->route('admin.mahasiswa.index', request()->query())
            ->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}
