<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebModel;

class WebController extends Controller
{
    public function __construct()
    {
        $this->WebModel = new WebModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Pemetaan',
            'kecamatan' => $this->WebModel->DataKecamatan(),
            'hotel' => $this->WebModel->AllDataHotel(),
            'bintang' => $this->WebModel->DataBintang(),
        ];
        return view('web', $data);
    }

    public function kecamatan($id_kecamatan)
    {
        $kec = $this->WebModel->DetailKecamatan($id_kecamatan);
        $data = [
            'title' => 'Kecamatan ' . $kec->kecamatan,
            'kecamatan' => $this->WebModel->DataKecamatan(),
            'hotel' => $this->WebModel->DataHotel($id_kecamatan),
            'bintang' => $this->WebModel->DataBintang(),
            'kec' => $kec,
        ];
        return view('kecamatan', $data);
    }

    public function bintang($id_bintang)
    {
        $bntg = $this->WebModel->DetailBintang($id_bintang);
        $data = [
            'title' => 'Bintang ' . $bntg->bintang,
            'kecamatan' => $this->WebModel->DataKecamatan(),
            'hotel' => $this->WebModel->DataHotelBintang($id_bintang),
            'bintang' => $this->WebModel->DataBintang(),
        ];
        return view('bintang', $data);
    }

    public function detailhotel($id_hotel)
    {
        $hotel = $this->WebModel->DetailHotel($id_hotel);
        $data = [
            'title' => 'Detail ' . $hotel->nama_hotel,
            'kecamatan' => $this->WebModel->DataKecamatan(),
            'bintang' => $this->WebModel->DataBintang(),
            'hotel' => $hotel,
        ];
        return view('detailhotel', $data);
    }
}
