<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    public function index()
    {
        return 'Menampilkan data matakuliah';
    }

    public function create()
    {
        return 'Form tambah matakuliah';
    }

    public function store(Request $request)
    {
        return 'Menyimpan data matakuliah';
    }

    public function show(?string $kode = null)
    {
        if ($kode === null || $kode === '') {
            return 'Masukkan kode matakuliah!';
        }

        return 'Anda mengakses matakuliah ' . $kode;
    }

    public function edit(string $id)
    {
        return 'Form edit matakuliah ' . $id;
    }

    public function update(Request $request, string $id)
    {
        return 'Mengubah data matakuliah ' . $id;
    }

    public function destroy(string $id)
    {
        return 'Menghapus data matakuliah ' . $id;
    }
}
