<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\facades\DB;

class HotelModel extends Model
{
    public function AllData()
    {
        return DB::table('tbl_hotel')
            ->join('tbl_bintang', 'tbl_bintang.id_bintang', '=', 'tbl_hotel.id_bintang')
            ->join('tbl_kecamatan', 'tbl_kecamatan.id_kecamatan', '=', 'tbl_hotel.id_kecamatan')
            ->get();
    }

    public function InsertData($data)
    {
        DB::table('tbl_hotel')
            ->insert($data);
    }

    public function DetailData($id_hotel)
    {
        return DB::table('tbl_hotel')
            ->join('tbl_bintang', 'tbl_bintang.id_bintang', '=', 'tbl_hotel.id_bintang')
            ->join('tbl_kecamatan', 'tbl_kecamatan.id_kecamatan', '=', 'tbl_hotel.id_kecamatan')
            ->where('id_hotel',$id_hotel)->first();
    }

    public function UpdateData($id_hotel, $data)
    {
        return DB::table('tbl_hotel')
            ->where('id_hotel',$id_hotel)
            ->update($data);
    }

    public function DeleteData($id_hotel)
    {
        return DB::table('tbl_hotel')
            ->where('id_hotel',$id_hotel)
            ->delete();
    } 
}
