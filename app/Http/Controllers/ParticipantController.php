<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Schema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParticipantController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $participants = Participant::with('schema')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10);

        if (Auth::user()->role === 'admin') {
            return view('participants.index', compact('participants', 'search'));
        }

        return view('participants.user-index', compact('participants', 'search'));
    }

    public function create()
    {
        $schemas = Schema::all();

        return view('participants.create', compact('schemas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:participants,email',
            'phone' => 'required|string|max:20',
            'schema_id' => 'required|exists:schemas,id',
            'address' => 'nullable|string',
        ]);

        Participant::create($validated);

        return redirect()
            ->route('admin.participants.index')
            ->with('success', 'Peserta berhasil ditambahkan!');
    }

    public function show(Participant $participant)
    {
        $participant->load('schema');

        return view('participants.show', compact('participant'));
    }

    public function edit(Participant $participant)
    {
        $schemas = Schema::all();

        return view('participants.edit', compact('participant', 'schemas'));
    }

    public function update(Request $request, Participant $participant)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:participants,email,' . $participant->id,
            'phone' => 'required|string|max:20',
            'schema_id' => 'required|exists:schemas,id',
            'address' => 'nullable|string',
        ]);

        $participant->update($validated);

        return redirect()
            ->route('admin.participants.index')
            ->with('success', 'Data peserta berhasil diperbarui!');
    }

    public function destroy(Participant $participant)
    {
        $participant->delete();

        return redirect()
            ->route('admin.participants.index')
            ->with('success', 'Peserta berhasil dihapus!');
    }

    public function editProfile()
    {
        $user = Auth::user();

        return view('profile.edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'nik' => 'nullable|string|max:16',
            'gender' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        foreach ($validated as $key => $value) {
            $user->$key = $value;
        }

        return redirect()
            ->route('dashboard')
            ->with('success', 'Data diri berhasil diperbarui!');
    }
}