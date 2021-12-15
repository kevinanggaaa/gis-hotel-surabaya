<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HotelModel;
use App\Models\BintangModel;
use App\Models\KecamatanModel;

class HotelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->HotelModel = new HotelModel();
        $this->BintangModel = new BintangModel();
        $this->KecamatanModel = new KecamatanModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Hotel',
            'hotel' => $this->HotelModel->AllData(),
        ];
        return view('admin.hotel.index', $data);
    }

    public function add()
    {
        $data = [
            'title'=> 'Add Hotel',
            'bintang' => $this->BintangModel->AllData(),
            'kecamatan' => $this->KecamatanModel->AllData(),
        ];
        return view('admin.hotel.add', $data);
    }

    public function insert()
    {
        Request()->validate([
            'nama_hotel' => 'required',
            'id_bintang' => 'required',
            'id_kecamatan' => 'required',
            'alamat' => 'required',
            'posisi' => 'required',
            'deskripsi' => 'required',
            'foto' => 'required|max:1024',
        ],
        [
            'nama_hotel.required' => 'Wajib diisi !!!',
            'id_bintang.required' => 'Wajib diisi !!!',
            'id_kecamatan.required' => 'Wajib diisi !!!',
            'alamat.required' => 'Wajib diisi !!!',
            'posisi.required' => 'Wajib diisi !!!',
            'deskripsi.required' => 'Wajib diisi !!!',
            'foto.required' => 'Wajib diisi !!!',
            'foto.max' => 'Foto maksimal 1024 KB',
        ]
        );

        $file = Request()->foto;
        $filename = $file->getClientOriginalName();
        $file->move(public_path('foto'),$filename);

        $data = [
            'nama_hotel' => Request()->nama_hotel,
            'id_bintang' => Request()->id_bintang,
            'id_kecamatan' => Request()->id_kecamatan,
            'alamat' => Request()->alamat,
            'posisi' => Request()->posisi,
            'deskripsi' => Request()->deskripsi,
            'foto' => $filename,
        ];
        $this->HotelModel->InsertData($data);
        return redirect()->route('hotel')->with('pesan','Data berhasil ditambahkan');
    }

    public function edit($id_hotel)
    {
        $data = [
            'title'=> 'Edit Hotel',
            'bintang' => $this->BintangModel->AllData(),
            'kecamatan' => $this->KecamatanModel->AllData(),
            'hotel' => $this->HotelModel->DetailData($id_hotel), 
        ];
        return view('admin.hotel.edit', $data);
    }

    public function update($id_hotel)
    {
        Request()->validate([
            'nama_hotel' => 'required',
            'id_bintang' => 'required',
            'id_kecamatan' => 'required',
            'alamat' => 'required',
            'posisi' => 'required',
            'deskripsi' => 'required',
            'foto' => 'max:1024',
        ],
        [
            'nama_hotel.required' => 'Wajib diisi !!!',
            'id_bintang.required' => 'Wajib diisi !!!',
            'id_kecamatan.required' => 'Wajib diisi !!!',
            'alamat.required' => 'Wajib diisi !!!',
            'posisi.required' => 'Wajib diisi !!!',
            'deskripsi.required' => 'Wajib diisi !!!',
            'foto.max' => 'Foto maksimal 1024 KB',
        ]
        );

        if (Request()->foto <> ""){
            // hapus foto lama
            $hotel = $this->HotelModel->DetailData($id_hotel);
            if($hotel->foto <> "") {
                unlink(public_path('foto') . '/' . $hotel->foto);
            }
            // jika ganti foto
            $file = Request()->foto;
            $filename = $file->getClientOriginalName();
            $file->move(public_path('foto'),$filename);
    
            $data = [
                'nama_hotel' => Request()->nama_hotel,
                'id_bintang' => Request()->id_bintang,
                'id_kecamatan' => Request()->id_kecamatan,
                'alamat' => Request()->alamat,
                'posisi' => Request()->posisi,
                'deskripsi' => Request()->deskripsi,
                'foto' => $filename,
            ];
            $this->HotelModel->UpdateData($id_hotel, $data);
        }else{
            // jika tidak ganti foto
            $data = [
                'nama_hotel' => Request()->nama_hotel,
                'id_bintang' => Request()->id_bintang,
                'id_kecamatan' => Request()->id_kecamatan,
                'alamat' => Request()->alamat,
                'posisi' => Request()->posisi,
                'deskripsi' => Request()->deskripsi,
            ];
            $this->HotelModel->UpdateData($id_hotel, $data);
        }

        return redirect()->route('hotel')->with('pesan','Data berhasil diupdate');        
    }

    public function delete($id_hotel)
    {
        $hotel = $this->HotelModel->DetailData($id_hotel);
        if($hotel->foto <> "") {
            unlink(public_path('foto') . '/' . $hotel->foto);
        }

        $this->HotelModel->DeleteData($id_hotel);
        return redirect()->route('hotel')->with('pesan','Data berhasil dihapus');
    }
}
