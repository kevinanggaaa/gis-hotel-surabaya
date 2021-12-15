<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\facades\DB;


class BintangModel extends Model
{
    public function AllData()
    {
        return DB::table('tbl_bintang')
            ->get();
    }

    public function InsertData($data)
    {
        DB::table('tbl_bintang')
            ->insert($data);
    }

    public function DetailData($id_bintang)
    {
        return DB::table('tbl_bintang')
            ->where('id_bintang',$id_bintang)->first();
    }

    public function UpdateData($id_bintang, $data)
    {
        return DB::table('tbl_bintang')
            ->where('id_bintang',$id_bintang)
            ->update($data);
    }

    public function DeleteData($id_bintang)
    {
        return DB::table('tbl_bintang')
            ->where('id_bintang',$id_bintang)
            ->delete();
    }    
}
