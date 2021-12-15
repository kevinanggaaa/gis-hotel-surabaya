<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KecamatanModel;

class KecamatanController extends Controller
{
    public function __construct()
    {
        $this->KecamatanModel = new KecamatanModel();
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'title'=> 'Kecamatan',
            'kecamatan' => $this->KecamatanModel->AllData(),
        ];
        return view('admin.kecamatan.index', $data);
    }

    public function add()
    {
        $data = [
            'title'=> 'Add Data Kecamatan',
        ];
        return view('admin.kecamatan.add', $data);
    }

    public function insert()
    {
        Request()->validate([
            'kecamatan' => 'required',
            'warna' => 'required',
            'geojson' => 'required',
        ],
        [
            'kecamatan.required' => 'Wajib diisi !!!',
            'warna.required' => 'Wajib diisi !!!',
            'geojson.required' => 'Wajib diisi !!!',
        ]
        );

        $data = [
            'kecamatan' => Request()->kecamatan,
            'warna' => Request()->warna,
            'geojson' => Request()->geojson,
        ];
        $this->KecamatanModel->InsertData($data);
        return redirect()->route('kecamatan')->with('pesan','Data berhasil ditambahkan');
    }

    public function edit($id_kecamatan)
    {
        $data = [
            'title' => 'Edit Data Kecamatan',
            'kecamatan' => $this->KecamatanModel->DetailData($id_kecamatan),
        ];
        return view('admin.kecamatan.edit', $data);
    }

    public function update($id_kecamatan)
    {
        Request()->validate([
            'kecamatan' => 'required',
            'warna' => 'required',
            'geojson' => 'required',
        ],
        [
            'kecamatan.required' => 'Wajib diisi !!!',
            'warna.required' => 'Wajib diisi !!!',
            'geojson.required' => 'Wajib diisi !!!',
        ]
        );

        $data = [
            'kecamatan' => Request()->kecamatan,
            'warna' => Request()->warna,
            'geojson' => Request()->geojson,
        ];
        $this->KecamatanModel->UpdateData($id_kecamatan, $data);
        return redirect()->route('kecamatan')->with('pesan','Data berhasil diupdate');
    }

    public function delete($id_kecamatan)
    {
        $this->KecamatanModel->DeleteData($id_kecamatan);
        return redirect()->route('kecamatan')->with('pesan','Data berhasil dihapus');
    }
}
