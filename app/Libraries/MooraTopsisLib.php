<?php

namespace App\Libraries;

class MooraTopsisLib {
    var $peserta            = array();
    var $kriteria           = array();
    var $nilaiKriteria      = array();
    var $bobotKriteria      = array();
    var $totalKriteria      = array();
    var $kriteriaBenefit    = array();
    var $kriteriaCost       = array();


    var $jumKriteriaBenefit = 0;
    var $jumKriteriaCost = 0;


    // topsis
    public $aPlus = [];
    public $aMinus = [];



    var $pesertaKriteria = array();

    public function __construct(
        public array $dataPeserta,
        public array $dataKriteria,
        public array $dataSubkriteria,
    ) {
        // moora
        $this->setBobotKriteria();
        $this->insertKriteria();
        $this->setPesertaKriteriaValue();
        $this->sumKriteriaValue();
        $this->insertToPeserta();
        // $this->sortPeserta();

        // topsis
        $this->hitungAplus();
        $this->hitungAminus();
        $this->hitungSolusiIdealPositive();
        $this->hitungSolusiIdealNegative();
        $this->hitungNilaiAkhir();


        $this->sortPeserta();
    }

    public function getAllPeserta() {
        return $this->peserta;
    }

    private function setNilaiKriteria() {
        foreach ($this->dataKriteria as $dk) {
            array_push($this->nilaiKriteria, $dk['nilai']);
        }
    }

    // Hitung bobot kriteria
    private function setBobotKriteria() {
        $nilaiKriteria = array();
        foreach ($this->dataKriteria as $dk) {
            array_push($nilaiKriteria, $dk['nilai']);
        }

        foreach ($this->dataKriteria as $dk) {
            $this->bobotKriteria[$dk['keterangan']] = $this->hitungBobot($dk['nilai'], $nilaiKriteria);
        }
    }

    // Insert data nilai kriteria ke dalam array peserta
    private function insertKriteria() {
        $this->peserta = $this->dataPeserta;

        foreach ($this->dataPeserta  as $key => $ps) {
            foreach ($this->dataKriteria as $kunci => $dk) {
                $k = 'k_' . $dk['id'];

                foreach ($this->dataSubkriteria as $ds) {
                    if ($ps[$k] == $ds['id']) {
                        $this->peserta[$key]['data_kriteria'][$dk['keterangan']]          = $ds['subkriteria'];
                        $this->peserta[$key]['data_kriteria_nilai'][$dk['keterangan']]    = $ds['nilai'];
                    } else if ($ps[$k] == null) {
                        $this->peserta[$key]['data_kriteria'][$dk['keterangan']]          = 0;
                        $this->peserta[$key]['data_kriteria_nilai'][$dk['keterangan']]    = 0;
                    }
                }
            }
        }
    }


    // Menampung data kriteria tertentu dari setiap peserta
    private function setPesertaKriteriaValue() {
        foreach ($this->dataKriteria as $dk) {
            $this->pesertaKriteria[$dk['keterangan']] = array();

            foreach ($this->peserta as $dp) {
                $k = isset($dp['data_kriteria_nilai'][$dk['keterangan']]) ? $dp['data_kriteria_nilai'][$dk['keterangan']] : 0;
                array_push($this->pesertaKriteria[$dk['keterangan']], $k);
            }
        }
    }

    // Menghitung total nilai kriteria tertentu dari seluruh peserta
    private function sumKriteriaValue() {
        foreach ($this->pesertaKriteria as $key => $k) {
            $this->totalKriteria[$key] = array_sum($k);
        }
    }

    private function insertToPeserta() {
        // Normalisasi data ke array
        foreach ($this->peserta as $i => $ps) {
            foreach ($ps['data_kriteria_nilai'] as $key => $dk) {
                $this->peserta[$i]['data_normalisasi'][$key] = $this->normalisasi($dk, $this->pesertaKriteria[$key]);
            }
        }

        // Optimasi data ke array
        foreach ($this->peserta as $i => $ps) {
            foreach ($ps['data_normalisasi'] as $key => $dn) {
                $this->peserta[$i]['data_optimasi'][$key]  =  $this->optimasi($dn, $this->bobotKriteria[$key]);
            }
        }

        // Data benefit ke array
        foreach ($this->peserta as $i => $ps) {
            $this->peserta[$i]['data_kriteria_benefit'] = array();

            foreach ($ps['data_optimasi'] as $key => $dkn) {
                foreach ($this->dataKriteria as $dk) {
                    $k = $key;

                    if ($k == $dk['keterangan']) {
                        if ($dk['type'] == 'benefit') {
                            $this->peserta[$i]['data_kriteria_benefit'][$key] = $dkn;
                        }
                    }
                }
            }
        }

        // Data Cost ke array
        foreach ($this->peserta as $i => $ps) {
            $this->peserta[$i]['data_kriteria_cost'] = array();

            foreach ($ps['data_optimasi'] as $key => $dkn) {
                foreach ($this->dataKriteria as $dk) {
                    $k = $key;

                    if ($k == $dk['keterangan']) {
                        if ($dk['type'] == 'cost') {
                            $this->peserta[$i]['data_kriteria_cost'][$key] = $dkn;
                            // array_push($peserta[$i]['data_kriteria_cost'][$key], $dkn);
                        }
                    }
                }
            }
        }
    }


    // helper function 
    public function sortPeserta() {
        usort($this->peserta, fn ($a, $b) => $b['nilaiAkhir'] <=> $a['nilaiAkhir']);
    }

    private function hitungBobot(int $nk, array $allNk) {
        if ($nk == 0 || $allNk == 0) {
            return 0;
        }
        $total = array_sum($allNk);
        return number_format(($nk / $total), 3);
        // return ($nk / $total);
    }

    #bobot              = bobot peserta dalam sebuah kriteria
    #semuaBobot         = semua bobot peserta dalam satu buat kriteria

    private function normalisasi(float $bobot, array $semuabobot): float {
        $nilai = 0;

        if ($bobot == 0) {
            return 0;
        }

        // dd($semuabobot);

        foreach ($semuabobot as $arr) {
            $nilai += pow($arr, 2);
        }


        return number_format($bobot / sqrt($nilai), 4);
        // return ($bobot / sqrt($nilai));
    }

    private function optimasi($nilai, $bobot): float {
        return number_format($nilai * $bobot, 3);
        // return ($nilai * $bobot);
    }


    // Topsis
    private function hitungAplus() {
        foreach ($this->dataKriteria as $dk) {
            $tempMax[$dk["keterangan"]] = [];

            foreach ($this->peserta as $key =>  $da) {
                array_push($tempMax[$dk["keterangan"]], $da['data_optimasi'][$dk["keterangan"]]);
            }

            $this->aPlus[$dk["keterangan"]] = max($tempMax[$dk["keterangan"]]);
        }
    }

    private function hitungAminus() {
        foreach ($this->dataKriteria as $dk) {
            $tempMax[$dk["keterangan"]] = [];

            foreach ($this->peserta as $key =>  $da) {
                array_push($tempMax[$dk["keterangan"]], $da['data_optimasi'][$dk["keterangan"]]);
            }

            $this->aMinus[$dk["keterangan"]] = min($tempMax[$dk["keterangan"]]);
        }
    }

    private function hitungSolusiIdealPositive() {

        foreach ($this->peserta as $key => $da) {
            $temp = 0;
            foreach ($this->dataKriteria as $dk) {
                $temp += pow($this->aPlus[$dk["keterangan"]] - $da['data_optimasi'][$dk["keterangan"]], 2);
            }

            $this->peserta[$key]["idealPositive"] =  number_format(sqrt($temp), 3);
        }
    }


    private function hitungSolusiIdealNegative() {

        foreach ($this->peserta as $key => $da) {
            $temp = 0;
            foreach ($this->dataKriteria as $dk) {
                $temp += pow($this->aMinus[$dk["keterangan"]] - $da['data_optimasi'][$dk["keterangan"]], 2);
            }

            $this->peserta[$key]["idealNegative"] = number_format(sqrt($temp), 3);
        }
    }


    private function hitungNilaiAkhir() {
        foreach ($this->peserta as $key => $da) {
            $this->peserta[$key]['nilaiAkhir'] = number_format($da["idealNegative"] / ($da['idealNegative'] + $da['idealPositive']), 3);
        }
    }

    public function setRangking() {
        foreach ($this->peserta as $key => $da) {
            $this->peserta[$key]['rangking'] = $key + 1;
            $this->peserta[$key]['periode'] = "";
        }
    }
}
