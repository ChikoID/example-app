<?php
namespace App\Http\Controllers;

use App\Models\Portofolio;
use Illuminate\Http\Request;

class PortofolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Portofolio::first();
        return view('portofolio.index', compact('data'));
    }

    public function table()
    {
        $data = Portofolio::first();
        return view('portofolio.table', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('portofolio.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'about'      => 'required|string',
            'email'      => 'required|email|unique:users,email',
            'phone'      => 'required|numeric',
            'photo_url'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'about'      => $request->about,
            'email'      => $request->email,
            'phone'      => $request->phone,
        ];

        if ($request->hasFile('photo_url')) {
            $data['photo_url'] = $request->file('photo_url')->store('gambars', 'public');
        }

        Portofolio::create($data);
        return redirect()->route('portofolio.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     $data = Portofolio::findOrFail($id);
    //     return view('portofolio.show', compact('data'));
    // }

/**
 * Show the form for editing the specified resource.
 */
    public function edit(string $id)
    {
        $data = Portofolio::findOrFail($id);
        return view('portofolio.edit', compact('data'));
    }

/**
 * Update the specified resource in storage.
 */
    public function update(Request $request, string $id)
    {
        $portofolio = Portofolio::findOrFail($id);

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'about'      => 'required|string',
            'email'      => 'required|email|unique:portofolios,email,' . $id,
            'phone'      => 'required|numeric',
            'photo_url'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'about'      => $request->about,
            'email'      => $request->email,
            'phone'      => $request->phone,
        ];

        if ($request->hasFile('photo_url')) {
            if ($portofolio->photo_url && \Storage::disk('public')->exists($portofolio->photo_url)) {
                \Storage::disk('public')->delete($portofolio->photo_url);
            }

            $data['photo_url'] = $request->file('photo_url')->store('gambars', 'public');
        }

        $portofolio->update($data);

        return redirect()->route('portofolio.index')->with('success', 'Data berhasil diupdate');
    }

/**
 * Remove the specified resource from storage.
 */
    public function destroy(string $id)
    {
        $portofolio = Portofolio::findOrFail($id);

        if ($portofolio->photo_url && \Storage::disk('public')->exists($portofolio->photo_url)) {
            \Storage::disk('public')->delete($portofolio->photo_url);
        }

        $portofolio->delete();

        return redirect()->route('portofolio.index')->with('success', 'Data berhasil dihapus');
    }
}
