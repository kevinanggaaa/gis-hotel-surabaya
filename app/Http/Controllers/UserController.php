<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->UserModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'User',
            'user' => $this->UserModel->AllData(),
        ];
        return view('admin.user.index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Add User',
        ];
        return view('admin.user.add', $data);
    }

    public function insert()
    {
        Request()->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'foto' => 'required|max:1024',
            'password' => 'required|min:8',
        ], [
            'name.required' => 'Wajib diisi',
            'email.required' => 'Wajib diisi',
            'email.unique' => 'Email ini telah digunakan, silahkan gunakan email yang lain',
            'foto.required' => 'Wajib diisi',
            'password.required' => 'Wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
        ]);

        $file = Request()->foto;
        $filename = $file->getClientOriginalName();
        $file->move(public_path('foto'),$filename);

        $data = [
            'name' => Request()->name,
            'email' => Request()->email,
            'password' => Hash::make(Request()->password),
            'foto' => $filename,
        ];

        $this->UserModel->insertData($data);

        return redirect()->route('user')->with('pesan','Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit User',
            'user' => $this->UserModel->DetailData($id),
        ];
        return view('admin.user.edit', $data);
    }

    public function update($id)
    {
        Request()->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:8',
        ], [
            'name.required' => 'Wajib diisi',
            'email.required' => 'Wajib diisi',
            'password.required' => 'Wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
        ]);

        if (Request()->foto <> ""){
            // hapus foto lama
            $user = $this->UserModel->DetailData($id);
            if($user->foto <> "") {
                unlink(public_path('foto') . '/' . $user->foto);
            }
            // jika ganti foto
            $file = Request()->foto;
            $filename = $file->getClientOriginalName();
            $file->move(public_path('foto'),$filename);

            $data = [
                'name' => Request()->name,
                'foto' => $filename,
            ];
    
            $this->UserModel->UpdateData($id, $data);
        }else{
            // jika tidak ganti foto
            $data = [
                'name' => Request()->name,
            ];
    
            $this->UserModel->UpdateData($id, $data);
        }

        return redirect()->route('user')->with('pesan','Data berhasil diupdate');        
    }

    public function delete($id)
    {
        $user = $this->UserModel->DetailData($id);
        if($user->foto <> "") {
            unlink(public_path('foto') . '/' . $user->foto);
        }

        $this->UserModel->DeleteData($id);
        return redirect()->route('user')->with('pesan','Data berhasil dihapus');
    }
}
