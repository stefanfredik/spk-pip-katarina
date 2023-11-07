<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Moora;
use App\Libraries\MooraTopsisLib;
use App\Libraries\TopsisLib;
use App\Models\KelayakanModel;
use App\Models\KriteriaModel;
use App\Models\KuotaModel;
use App\Models\PesertaModel;
use App\Models\SiswaModel;
use App\Models\SubkriteriaModel;
use CodeIgniter\API\ResponseTrait;

class Keputusan extends BaseController {
    use ResponseTrait;
    var $meta = [
        'url' => 'keputusan',
        'title' => 'Data Keputusan',
        'subtitle' => 'Halaman Keputusan'
    ];

    public function __construct() {
        $this->kriteriaModel = new KriteriaModel();
        $this->siswaModel = new SiswaModel();
        $this->subkriteriaModel = new SubkriteriaModel();
        $this->pesertaModel = new PesertaModel();
        $this->kuotaModel = new KuotaModel();
    }

    // public function index()
    // {
    //     $kriteria       = $this->kriteriaModel->findAll();
    //     $subkriteria    = $this->subkriteriaModel->findAll();
    //     $peserta        = $this->pesertaModel->findAllPeserta();
    //     $dataKuota      = $this->kuotaModel->findAll();

    //     helper('Check');
    //     $check = checkdata($peserta, $kriteria, $subkriteria);
    //     if ($check) return view('/error/index', ['title' => 'Error', 'listError' => $check]);

    //     $moora = new Moora($peserta, $kriteria, $subkriteria);
    //     $moora->sortPeserta();
    //     $moora->setRangking();
    //     $mooraPeserta = $moora->getAllPeserta();

    //     $topsis = new TopsisLib($peserta, $kriteria, $subkriteria);
    //     $topsis->sortPeserta();
    //     $topsis->setRangking();
    //     $topsisPeserta = $topsis->getAllPeserta();

    //     $data = [
    //         'title'         => 'Data Perhitungan dan Table Moora',
    //         'url'           => $this->meta['url'],
    //         'mooraPeserta'       => $this->statusKeputusan($mooraPeserta, $dataKuota),
    //         'topsisPeserta'       => $this->statusKeputusan($topsisPeserta, $dataKuota),
    //     ];

    //     return view('/keputusan/index', $data);
    // }


    public function index() {
        $data = [
            'title' => $this->meta['title'],
            'dataKriteria' => $this->kriteriaModel->findAll(),
            'dataSubkriteria' => $this->subkriteriaModel->findAll(),
            'peserta' => $this->data(),
            "meta"  => $this->meta
        ];

        // dd($data);
        return view('/keputusan/index', $data);
    }


    private function data() {
        $peserta = $this->pesertaModel->findAllPeserta();
        $kriteria = $this->kriteriaModel->findAll();
        $subkriteria = $this->subkriteriaModel->findAll();

        // $moora = new Moora($peserta, $kriteria, $subkriteria);
        // $topsis = new TopsisLib($peserta, $kriteria, $subkriteria);
        $mooraTopsis = new MooraTopsisLib($peserta, $kriteria, $subkriteria);

        $mooraTopsis->setRangking();

        $mooraTopsisPeserta = $mooraTopsis->getAllPeserta();
        // $topsisPeserta = $topsis->getAllPeserta();

        $dataKuota = $this->kuotaModel->findAll();

        $data = $this->statusKeputusan($mooraTopsisPeserta, $dataKuota);

        // dd($mooraPeserta)
        // foreach ($mooraPeserta  as $key => $moora) {
        //     $data[$key]["nilaiMoora"] = $moora["kriteria_nilai"];
        // }

        // foreach ($topsisPeserta  as $key => $topsis) {
        //     $data[$key]["nilaiTopsis"] = $topsis["nilaiAkhir"];
        // }

        usort($data, fn ($a, $b) => $b['nilaiAkhir'] <=> $a['nilaiAkhir']);
        return $data;
    }

    private function statusKeputusan($dataPeserta, $dataKuota) {
        // hitung kuota tahunan
        $kuotaTahun = [];
        foreach ($dataKuota as $row) {
            $tahun = $row['tahun'];
            $jumlahKuota = $row['jumlah_kuota'];

            if (isset($kuotaTahun[$tahun])) {
                $kuotaTahun[$tahun] += $jumlahKuota;
            } else {
                $kuotaTahun[$tahun] = $jumlahKuota;
            }
        }


        foreach ($dataPeserta as $key => $ps) {
            $tahun = $ps['tahun'];
            $rangking = $ps['rangking'];
            $kuotaPeriode = 0;

            foreach ($dataKuota as $ku) {
                if ($tahun == $ku['tahun'] && $rangking <= $kuotaTahun[$tahun]) {
                    $kuotaPeriode += $ku['jumlah_kuota'];

                    $dataPeserta[$key]['status'] = 'Mendapatkan Bantuan';
                    if ($rangking <= $kuotaPeriode) {
                        $dataPeserta[$key]['periode'] = $ku['periode'];
                        $dataPeserta[$key]['tanggalTerima'] = $ku['tanggal_terima'];
                        break;
                    }
                } else {
                    $dataPeserta[$key]['periode'] = 'Tidak Tersedia';
                    $dataPeserta[$key]['tanggalTerima'] = 'Tidak Tersedia';
                    $dataPeserta[$key]['status'] = 'Tidak Mendapatkan Bantuan';
                }
            }
        }

        return $dataPeserta;
    }


    public function validasi($id) {
        $this->pesertaModel->update($id, ['validasi' => 'Valid']);

        $res = [
            'status'    => 'success',
            'msg'     => 'Data berhasil di update.',
        ];

        return $this->respond($res, 200);
    }
}
