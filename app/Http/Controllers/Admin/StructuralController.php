<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Structural;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StructuralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $structurals = Structural::when($search, function ($query) use ($search) {
                        return $query->where('nama', 'like', "%{$search}%")
                                     ->orWhere('jabatan', 'like', "%{$search}%");
                    })
                    ->orderBy('urutan', 'asc')
                    ->paginate(10)
                    ->withQueryString();

        return view('admin.structurals.index', compact('structurals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.structurals.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB Max
            'urutan' => 'required|integer',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('structurals', 'public');
        }

        Structural::create($validated);

        return redirect()->route('admin.structurals.index')
                         ->with('success', 'Data struktural berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Structural $structural)
    {
        return view('admin.structurals.edit', compact('structural'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Structural $structural)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'urutan' => 'required|integer',
        ]);

        if ($request->hasFile('foto')) {
            // Delete old photo
            if ($structural->foto) {
                Storage::delete('public/' . $structural->foto);
            }
            $validated['foto'] = $request->file('foto')->store('structurals', 'public');
        }

        $structural->update($validated);

        return redirect()->route('admin.structurals.index')
                         ->with('success', 'Data struktural berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Structural $structural)
    {
        if ($structural->foto) {
            Storage::delete('public/' . $structural->foto);
        }

        $structural->delete();

        return redirect()->route('admin.structurals.index')
                         ->with('success', 'Data struktural berhasil dihapus.');
    }
}
