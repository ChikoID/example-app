<?php
namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['dataPelanggan'] = Pelanggan::all();
        return view('admin.pelanggan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pelanggan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'birthday'   => 'required|date',
            'gender'     => 'required|in:Male,Female',
            'email'      => 'required|email',
            'phone'      => 'required|numeric',
        ], [
            'first_name.required' => 'Nama depan wajib diisi.',
            'last_name.required'  => 'Nama belakang wajib diisi.',
            'birthday.required'   => 'Tanggal lahir wajib diisi.',
            'birthday.date'       => 'Tanggal lahir harus berupa tanggal yang valid.',
            'gender.required'     => 'Jenis kelamin wajib dipilih.',
            'gender.in'           => 'Jenis kelamin harus Male atau Female.',
            'email.required'      => 'Email wajib diisi.',
            'email.email'         => 'Format email tidak valid.',
            'phone.required'      => 'Nomor telepon wajib diisi.',
            'phone.numeric'       => 'Nomor telepon harus berupa angka.',
        ]);

        $data = [
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'birthday'   => $request->birthday,
            'gender'     => $request->gender,
            'email'      => $request->email,
            'phone'      => $request->phone,
        ];

        Pelanggan::create($data);

        return redirect()->route('pelanggan.index')->with('success', 'Penambahan Data Berhasil!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['dataPelanggan'] = Pelanggan::findOrFail($id);
        return view('admin.pelanggan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'birthday'   => 'required|date',
            'gender'     => 'required|in:Male,Female',
            'email'      => 'required|email',
            'phone'      => 'required|numeric',
        ], [
            'first_name.required' => 'Nama depan wajib diisi.',
            'last_name.required'  => 'Nama belakang wajib diisi.',
            'birthday.required'   => 'Tanggal lahir wajib diisi.',
            'birthday.date'       => 'Tanggal lahir harus berupa tanggal yang valid.',
            'gender.required'     => 'Jenis kelamin wajib dipilih.',
            'gender.in'           => 'Jenis kelamin harus Male atau Female.',
            'email.required'      => 'Email wajib diisi.',
            'email.email'         => 'Format email tidak valid.',
            'phone.required'      => 'Nomor telepon wajib diisi.',
            'phone.numeric'       => 'Nomor telepon harus berupa angka.',
        ]);

        $pelanggan = Pelanggan::findOrFail($id);

        $pelanggan->first_name = $request->first_name;
        $pelanggan->last_name  = $request->last_name;
        $pelanggan->birthday   = $request->birthday;
        $pelanggan->gender     = $request->gender;
        $pelanggan->email      = $request->email;
        $pelanggan->phone      = $request->phone;

        $pelanggan->save();

        return redirect()
            ->route('pelanggan.index')
            ->with('success', 'Perubahan Data Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $pelanggan->delete();
        return redirect()->route('pelanggan.index')->with('success', 'Data berhasil dihapus');
    }
}
