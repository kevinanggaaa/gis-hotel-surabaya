<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\facades\DB;

class WebModel extends Model
{
    use HasFactory;

    public function DataKecamatan()
    {
        return DB::table('tbl_kecamatan')
            ->get();
    }

    public function DataBintang()
    {
        return DB::table('tbl_bintang')
            ->get();
    }

    public function DetailBintang($id_bintang)
    {
        return DB::table('tbl_bintang')
            ->where('id_bintang',$id_bintang)->first();
    }

    public function DataHotelBintang($id_bintang)
    {
        return DB::table('tbl_hotel')
        ->join('tbl_bintang', 'tbl_bintang.id_bintang', '=', 'tbl_hotel.id_bintang')
        ->join('tbl_kecamatan', 'tbl_kecamatan.id_kecamatan', '=', 'tbl_hotel.id_kecamatan')
        ->where('tbl_hotel.id_bintang', $id_bintang)
        ->get();
    }

    public function DetailKecamatan($id_kecamatan)
    {
        return DB::table('tbl_kecamatan')
            ->where('id_kecamatan',$id_kecamatan)->first();
    }

    public function DataHotel($id_kecamatan)
    {
        return DB::table('tbl_hotel')
        ->join('tbl_bintang', 'tbl_bintang.id_bintang', '=', 'tbl_hotel.id_bintang')
        ->join('tbl_kecamatan', 'tbl_kecamatan.id_kecamatan', '=', 'tbl_hotel.id_kecamatan')
        ->where('tbl_hotel.id_kecamatan', $id_kecamatan)
        ->get();
    }

    public function AllDataHotel()
    {
        return DB::table('tbl_hotel')
        ->join('tbl_bintang', 'tbl_bintang.id_bintang', '=', 'tbl_hotel.id_bintang')
        ->join('tbl_kecamatan', 'tbl_kecamatan.id_kecamatan', '=', 'tbl_hotel.id_kecamatan')
        ->get();
    }

    public function DetailHotel($id_hotel)
    {
        return DB::table('tbl_hotel')
        ->join('tbl_bintang', 'tbl_bintang.id_bintang', '=', 'tbl_hotel.id_bintang')
        ->join('tbl_kecamatan', 'tbl_kecamatan.id_kecamatan', '=', 'tbl_hotel.id_kecamatan')
        ->where('id_hotel', $id_hotel)
        ->first();
    }
}
