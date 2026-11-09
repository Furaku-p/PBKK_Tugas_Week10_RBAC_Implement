<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Tugas;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'totalMahasiswa' => Mahasiswa::count(),
            'totalDosen' => Dosen::count(),
            'totalTugasAktif' => Tugas::where('is_active', true)->count(),
            'totalMahasiswaAktif' => Mahasiswa::where('is_active', true)->count(),
            'recentMahasiswa' => Mahasiswa::latest()->take(5)->get(),
        ]);
    }
}
