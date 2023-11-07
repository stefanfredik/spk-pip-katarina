<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KriteriaModel;
use App\Models\KuotaModel;
use App\Models\PesertaModel;
use App\Models\SiswaModel;
use App\Models\SubkriteriaModel;
use App\Models\Users;

class Dashboard extends BaseController {
    var $meta = [
        "url"   => 'dashboard',
        "title" => "Dashboard",
        "subtitle" => "Halaman Dashboard"
    ];

    public function index() {

        $dataUser = new Users();
        $dataSiswa = new SiswaModel();
        $dataPeserta = new PesertaModel();
        $dataKuota = new KuotaModel();
        $dataKriteria = new KriteriaModel();
        $dataSubKriteria = new SubkriteriaModel();


        $data = [
            'meta' => $this->meta,
            'title' => 'Halaman Dashboard',
            "dataUserCount" => $dataUser->countAll(),
            "dataSiswaCount" => $dataSiswa->countAll(),
            "dataPesertaCount" => $dataPeserta->countAll(),
            "dataKuotaCount" => $dataKuota->countAll(),
            "dataKriteriaCount"=> $dataKriteria->countAll(),
            "dataSubKriteriaCount" => $dataSubKriteria->countAll(),
        ];

        return view("dashboard/index", $data);
    }
}
