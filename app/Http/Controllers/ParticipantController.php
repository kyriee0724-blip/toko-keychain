<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Schema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParticipantController extends Controller
{
    /**
     * Menampilkan daftar peserta (Khusus Admin)
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $participants = Participant::with('schema')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return view('participants.index', compact('participants', 'search'));
    }

    /**
     * Menampilkan form tambah peserta (Khusus Admin)
     */
    public function create()
    {
        $schemas = Schema::all();
        return view('participants.create', compact('schemas'));
    }

    /**
     * Memproses penyimpanan peserta baru (Khusus Admin)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:participants,email',
            'phone'     => 'nullable|string|max:20',
            'schema_id' => 'required|exists:schemas,id',
            'address'   => 'nullable|string',
        ]);

        Participant::create($validated);

        return redirect()->route('participants.index')->with('success', 'Peserta berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail informasi satu peserta (Khusus Admin)
     */
    public function show(Participant $participant)
    {
        $participant->load('schema');
        return view('participants.show', compact('participant'));
    }

    /**
     * Menampilkan form edit peserta (Khusus Admin)
     */
    public function edit(Participant $participant)
    {
        $schemas = Schema::all();
        return view('participants.edit', compact('participant', 'schemas'));
    }

    /**
     * Memproses pembaruan data peserta (Khusus Admin)
     */
    public function update(Request $request, Participant $participant)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:participants,email,' . $participant->id,
            'phone'     => 'nullable|string|max:20',
            'schema_id' => 'required|exists:schemas,id',
            'address'   => 'nullable|string',
        ]);

        $participant->update($validated);

        return redirect()->route('participants.index')->with('success', 'Data peserta berhasil diperbarui!');
    }

    /**
     * Menghapus data peserta (Khusus Admin)
     */
    public function destroy(Participant $participant)
    {
        $participant->delete();
        return redirect()->route('participants.index')->with('success', 'Peserta berhasil dihapus!');
    }

    /**
     * Menampilkan halaman edit profil untuk User Biasa (Data Diri Sendiri)
     */
    public function editProfile()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Memproses pembaruan profil mandiri oleh User Biasa
     */
    public function updateProfile(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone' => ['nullable', 'string', 'max:20'],
            'nik'   => ['nullable', 'string', 'max:16'],
        ]);

        $user->update($validated);

        return redirect()->route('dashboard')->with('success', 'Data diri berhasil diperbarui!');
    }
}