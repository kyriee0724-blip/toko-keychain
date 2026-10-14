<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Schema;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // Method index digunakan untuk menampilkan halaman dashboard berdasarkan role
    public function index()
    {
        $user = Auth::user();

        // Jika role user adalah admin, tampilkan dashboard admin beserta statistik lengkap
        if ($user->role === 'admin') {
            $totalPeserta = Participant::count();
            $totalSkema = Schema::count();

            return view('dashboard.admin', compact('totalPeserta', 'totalSkema', 'user'));
        }

        // Jika user biasa, tampilkan dashboard user (hanya data diri / profil miliknya sendiri)
        return view('dashboard.user', compact('user'));
    }
}