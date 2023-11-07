<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KelayakanModel;
use App\Models\KriteriaModel;
use App\Models\PesertaModel;
use App\Models\SiswaModel;
use App\Models\SubkriteriaModel;
use App\Libraries\Moora;
use App\Libraries\MooraTopsisLib;
use App\Libraries\TopsisLib;

class Perhitungan extends BaseController
{
    var $meta = [
        'url' => 'perhitungan',
        'title' => 'Data Pehitungan',
        'subtitle' => 'Halaman Pehitungan Moora dan Topsis'
    ];

    private $totalNilaiKriteria;

    public function __construct()
    {
        $this->kriteriaModel = new KriteriaModel();
        $this->siswaModel = new SiswaModel();
        $this->subkriteriaModel = new SubkriteriaModel();
        $this->pesertaModel = new PesertaModel();
        $this->kelayakanModel = new KelayakanModel();
    }

    public function index()
    {
        $kriteria       = $this->kriteriaModel->findAll();
        $subkriteria    = $this->subkriteriaModel->findAll();
        $peserta        = $this->pesertaModel->findAllPeserta();

        helper('Check');

        $check = checkdata($peserta, $kriteria, $subkriteria);
        if ($check) return view('/error/index', ['title' => 'Error', 'listError' => $check]);

        // $moora = new Moora($peserta, $kriteria, $subkriteria, $kelayakan);
        $moora = new Moora($peserta, $kriteria, $subkriteria);
        $topsis = new TopsisLib($peserta, $kriteria, $subkriteria);
        $mooraTopsis = new MooraTopsisLib($peserta, $kriteria, $subkriteria);

        $topsis->sortPeserta();
        $moora->sortPeserta();

        // dd($data);
        // dd($topsis);

        $data = [
            'title' => 'Data Perhitungan dan Table Moora',
            'dataKriteria' => $this->kriteriaModel->findAll(),
            'totalNilaiKriteria' => $this->totalNilaiKriteria,
            'mooraPeserta' => $moora->getAllPeserta(),
            'topsisPeserta' => $topsis->getAllPeserta(),
            'jumKriteriaBenefit' => $moora->jumKriteriaBenefit,
            'jumKriteriaCost' => $moora->jumKriteriaCost,
            'dataSubkriteria' => $this->subkriteriaModel->findAll(),
            'bobotKriteria' => $moora->bobotKriteria,
            'topsisAplus' => $topsis->aPlus,
            'topsisAminus' => $topsis->aMinus,
            "meta"  => $this->meta,
            // moora and topsis
            "mooraTopsisPeserta" => $mooraTopsis->getAllPeserta(),
            'mooraTopsisAplus' => $mooraTopsis->aPlus,
            'mooraTopsisAminus' => $mooraTopsis->aMinus,
        ];

        return view('/perhitungan/index', $data);
    }
}
