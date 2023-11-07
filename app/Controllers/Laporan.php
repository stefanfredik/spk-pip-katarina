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
use App\Models\SubkriteriaModel;
use Dompdf\Dompdf;

class Laporan extends BaseController
{
    var $meta = [
        'url' => 'laporan',
        'title' => 'Laporan',
        'subtitle' => 'Halaman Laporan'
    ];

    public function __construct()
    {
        $this->pesertaModel = new PesertaModel();
        $this->kriteriaModel = new KriteriaModel();
        $this->subkriteriaModel = new SubkriteriaModel();
        $this->kelayakanModel = new KelayakanModel();
        $this->kuotaModel = new KuotaModel();
    }


    public function index()
    {
        $data = [
            'title' => $this->meta['title'],
            'dataKriteria' => $this->kriteriaModel->findAll(),
            'dataSubkriteria' => $this->subkriteriaModel->findAll(),
            'peserta' => $this->data(),
            "meta"  => $this->meta
        ];

        return view('/laporan/index', $data);
    }



    public function cetak()
    {
        $data['peserta'] = $this->data();
        $data["title"] = 'LAPORAN ' . APP_DESC;
        $this->pdf($data, "laporan/cetak");
    }

    private function data()
    {
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


    private function statusKeputusan($dataPeserta, $dataKuota)
    {
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


    private function pdf(array $data, String $view)
    {
        $pdf = new Dompdf(array('DOMPDF_ENABLE_REMOTE' => true));

        $html = view($view, $data);
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();

        return $pdf->stream();
    }
}
