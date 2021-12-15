<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'kecamatan' => DB::table('tbl_kecamatan')->count(),
            'bintang' => DB::table('tbl_bintang')->count(),
            'hotel' => DB::table('tbl_hotel')->count(),
            'user' => DB::table('users')->count(),
        ];
        return view('home', $data);
    }
}
