<?php

namespace App\Libraries;


class EntropyTopsis {
    var $dataAkhir;
    var $dataKriteriaMax;
    var $dataJumlahNormalisasiMatrixAwal;
    var $dataEntropyKriteria;
    var $dataBobotEntropy;
    var $dataBobotEntropyBaru;
    var $dataBobotEntropyAKhir;


    // 
    var $jumlahKriteria;
    var $jumlahKriteriaEntropy;
    var $nilaiK;
    var $totalEntropy;
    var $totalBobotEntropyBaru;

    public function __construct(
        public array $dataPeserta,
        public array $dataKriteria,
        public array $dataSubkriteria
    ) {
        $this->setDataInfo();
        $this->setNilai();
        $this->hitungMaxKriteria();
        $this->hitungNormalisasiMatrixAwal();
        $this->hitungJumlahNormalisasiMatrixAwal();
        $this->hitungNilaiEntropy();
        $this->hitungJumlahKriteria();
        $this->hitungJumlahKriteriaEntropy();
        $this->hitungNilaiK();
        $this->hitungEntropyKriteria();
        $this->hitungTotalEntropy();
        $this->hitungBobotEntropy();
        $this->hitungBobotEntropyBaru();
        $this->hitungTotalBobotEntropyBaru();
        $this->hitungBobotEntropyAkhir();
    }

    private function setDataInfo() {
        foreach ($this->dataPeserta as $key => $ps) {
            $this->dataAkhir[$key] = $ps;
        }
    }

    public function hitungNormalisasiMatrixAwal() {
        foreach ($this->dataPeserta as $key => $ps) {
            foreach ($this->dataKriteria as $dk) {
                $this->dataAkhir[$key]["normalisasi_matrixawal"][$dk["keterangan"]] = $this->dataAkhir[$key]["kriteria_nilai"][$dk["keterangan"]] / $this->dataKriteriaMax[$dk["keterangan"]];
            }
        }
    }

    public function hitungJumlahNormalisasiMatrixAwal() {
        foreach ($this->dataKriteria as $dk) {
            $jumlah = 0;
            foreach ($this->dataPeserta as $key => $ps) {
                $jumlah = $jumlah + $this->dataAkhir[$key]["normalisasi_matrixawal"][$dk["keterangan"]];
                $this->dataJumlahNormalisasiMatrixAwal[$dk["keterangan"]] = $jumlah;
            }
        }
    }




    private function setNilai() {
        foreach ($this->dataPeserta as $key => $ps) {
            foreach ($this->dataKriteria as $dk) {
                $k = 'k_' . $dk['id'];

                foreach ($this->dataSubkriteria as $ds) {
                    if ($ps[$k] == $ds["id"]) {
                        $this->dataAkhir[$key]["kriteria_nilai"][$dk["keterangan"]] = $ds['nilai'];
                        $this->dataAkhir[$key]["kriteria_keterangan"][$dk["keterangan"]] = $ds['subkriteria'];
                    } else if ($ps[$k] == null) {
                        $this->dataAkhir[$key]["kriteria_nilai"][$dk["keterangan"]] = 0;
                        $this->dataAkhir[$key]["kriteria_keterangan"][$dk["keterangan"]] = 0;
                    }
                }
            }
        }
    }

    public function hitungMaxKriteria() {
        foreach ($this->dataKriteria as $dk) {
            $max = 0;
            foreach ($this->dataPeserta as $key => $ps) {
                if ($this->dataAkhir[$key]["kriteria_nilai"][$dk["keterangan"]] > $max) {
                    $max = $this->dataAkhir[$key]["kriteria_nilai"][$dk["keterangan"]];
                }

                $this->dataKriteriaMax[$dk["keterangan"]] = $max;
            }
        }
    }

    public function hitungNilaiEntropy() {
        foreach ($this->dataPeserta as $key => $ps) {
            foreach ($this->dataKriteria as $dk) {
                $nilaiNormalisasi       = $this->dataAkhir[$key]["normalisasi_matrixawal"][$dk["keterangan"]];
                $nilaiJumlahNormalisasi = $this->dataJumlahNormalisasiMatrixAwal[$dk["keterangan"]];
                $nilaiEntropy           = ($nilaiNormalisasi / $nilaiJumlahNormalisasi) * (log($nilaiNormalisasi / $nilaiJumlahNormalisasi));

                $this->dataAkhir[$key]["nilai_entropy"][$dk["keterangan"]] = $nilaiEntropy;
            }
        }
    }

    public function hitungJumlahKriteriaEntropy() {
        foreach ($this->dataKriteria as $dk) {
            $jumlah = 0;
            foreach ($this->dataPeserta as $key => $ps) {
                $jumlah = $jumlah + $this->dataAkhir[$key]["nilai_entropy"][$dk["keterangan"]];
                $this->jumlahKriteriaEntropy[$dk["keterangan"]] = $jumlah;
            }
        }
    }

    public function hitungEntropyKriteria() {
        foreach ($this->dataKriteria as $dk) {
            $entropyKriteria = 0;
            $entropyKriteria = ($this->jumlahKriteriaEntropy[$dk["keterangan"]]) * (-$this->nilaiK);
            $this->dataEntropyKriteria[$dk["keterangan"]] = $entropyKriteria;
        }
    }


    public function hitungNilaiK() {
        $k = 1 / log($this->jumlahKriteria);
        $this->nilaiK = $k;
    }

    public function hitungTotalEntropy() {
        $total = 0;
        foreach ($this->dataEntropyKriteria as $de) {
            $total += $de;
            // dd($de);
        }

        $this->totalEntropy = $total;
    }


    public function hitungBobotEntropy() {
        foreach ($this->dataKriteria as $dk) {
            $bobotKriteria = 0;

            $bobotKriteria = (1 / ($this->jumlahKriteria - $this->totalEntropy)) *  (1 - $this->dataEntropyKriteria[$dk["keterangan"]]);
            $this->dataBobotEntropy[$dk["keterangan"]] = $bobotKriteria;
        }
    }


    public function hitungBobotEntropyBaru() {
        foreach ($this->dataKriteria as $dk) {
            $this->dataBobotEntropyBaru[$dk["keterangan"]] = $this->dataBobotEntropy[$dk["keterangan"]] * $dk["nilai"];
        }
    }

    public function hitungTotalBobotEntropyBaru() {
        $total = 0;
        foreach ($this->dataBobotEntropyBaru as $dt) {
            $total += $dt;
            // dd($de);
        }

        $this->totalBobotEntropyBaru = $total;
    }


    public function hitungBobotEntropyAkhir() {
        foreach ($this->dataKriteria as $dk) {
            $this->dataBobotEntropyAKhir[$dk["keterangan"]] = $this->dataBobotEntropyBaru[$dk["keterangan"]] / $this->totalBobotEntropyBaru;
        }
    }


    // private function

    private function hitungNormalisasi() {
    }


    private function hitungJumlahKriteria() {
        $jumlah = count($this->dataKriteria);
        return $this->jumlahKriteria  = $jumlah;
    }

    // unload function
    public function getAllPeserta() {
        return $this->dataAkhir;
    }


    // Topsis


    public function hitungNormalisasiTopsis() {
        foreach ($this->dataPeserta as $key => $ps) {
            foreach ($this->dataKriteria as $dk) {
                $k = 'k_' . $dk['id'];

                foreach ($this->dataSubkriteria as $ds) {
                    if ($ps[$k] == $ds["id"]) {
                        $nilai  = 0;
                        $nilai  = 
                        $this->dataAkhir[$key]["normalisasi_topsis"][$dk["keterangan"]] = $ds['nilai'];
                    } else if ($ps[$k] == null) {
                        $this->dataAkhir[$key]["kriteria_nilai"][$dk["keterangan"]] = 0;
                        $this->dataAkhir[$key]["kriteria_keterangan"][$dk["keterangan"]] = 0;
                    }
                }
            }
        }
    }
}
