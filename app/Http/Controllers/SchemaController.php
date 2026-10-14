<?php

namespace App\Http\Controllers;

use App\Models\Schema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SchemaController extends Controller
{
    public function index()
    {
        $schemas = Schema::withCount('participants')
            ->latest()
            ->paginate(10);

        if (Auth::user()->role === 'admin') {
            return view('schemas.index', compact('schemas'));
        }

        return view('schemas.user-index', compact('schemas'));
    }

    public function create()
    {
        return view('schemas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:schemas,code',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Schema::create($validated);

        return redirect()
            ->route('admin.schemas.index')
            ->with('success', 'Skema berhasil ditambahkan!');
    }

    public function show(Schema $schema)
    {
        $schema->loadCount('participants');

        return view('schemas.show', compact('schema'));
    }

    public function edit(Schema $schema)
    {
        return view('schemas.edit', compact('schema'));
    }

    public function update(Request $request, Schema $schema)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:schemas,code,' . $schema->id,
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $schema->update($validated);

        return redirect()
            ->route('admin.schemas.index')
            ->with('success', 'Skema berhasil diperbarui!');
    }

    public function destroy(Schema $schema)
    {
        if ($schema->participants()->count() > 0) {
            return back()->with(
                'error',
                'Skema tidak bisa dihapus karena masih memiliki peserta!'
            );
        }

        $schema->delete();

        return redirect()
            ->route('admin.schemas.index')
            ->with('success', 'Skema berhasil dihapus!');
    }
}