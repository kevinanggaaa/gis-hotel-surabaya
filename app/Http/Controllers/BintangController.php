<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BintangModel;

class BintangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->BintangModel = new BintangModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Bintang',
            'bintang' => $this->BintangModel->AllData(),
        ];
        return view('admin.bintang.index', $data);
    }

    public function add()
    {
        $data = [
            'title'=> 'Add Bintang',
        ];
        return view('admin.bintang.add', $data);
    }
    
    public function insert()
    {
        Request()->validate([
            'bintang' => 'required',
            'icon' => 'required|max:1024',
        ], [
            'bintang.required' => 'Wajib diisi',
            'icon.required' => 'Wajib diisi',
        ]);

        $file = Request()->icon;
        $filename = $file->getClientOriginalName();
        $file->move(public_path('icon'),$filename);

        $data = [
            'bintang' => Request()->bintang,
            'icon' => $filename,
        ];

        $this->BintangModel->insertData($data);

        return redirect()->route('bintang')->with('pesan','Data berhasil ditambahkan');
    }

    public function edit($id_bintang)
    {
        $data = [
            'title' => 'Edit Bintang',
            'bintang' => $this->BintangModel->DetailData($id_bintang),
        ];
        return view('admin.bintang.edit', $data);
    }

    public function update($id_bintang)
    {
        Request()->validate([
            'bintang' => 'required',
            'icon' => 'max:1024',
        ], [
            'bintang.required' => 'Wajib diisi',
        ]);

        if (Request()->icon <> ""){
            // hapus icon lama
            $bintang = $this->BintangModel->DetailData($id_bintang);
            if($bintang->icon <> "") {
                unlink(public_path('icon') . '/' . $bintang->icon);
            }
            // jika ganti icon
            $file = Request()->icon;
            $filename = $file->getClientOriginalName();
            $file->move(public_path('icon'),$filename);

            $data = [
                'bintang' => Request()->bintang,
                'icon' => $filename,
            ];
    
            $this->BintangModel->UpdateData($id_bintang, $data);
        }else{
            // jika tidak ganti icon
            $data = [
                'bintang' => Request()->bintang,
            ];
    
            $this->BintangModel->UpdateData($id_bintang, $data);
        }

        return redirect()->route('bintang')->with('pesan','Data berhasil diupdate');        
    }

    public function delete($id_bintang)
    {
        $bintang = $this->BintangModel->DetailData($id_bintang);
        if($bintang->icon <> "") {
            unlink(public_path('icon') . '/' . $bintang->icon);
        }

        $this->BintangModel->DeleteData($id_bintang);
        return redirect()->route('bintang')->with('pesan','Data berhasil dihapus');
    }

}
