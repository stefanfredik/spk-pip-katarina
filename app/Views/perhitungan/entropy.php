<div class="tab-pane fade" id="entrophy" role="tabpanel" aria-labelledby="peserta-tab" tabindex="0">
    <h3 class="my-5">Data Peserta</h3>
    <div class="row">
        <div class="col">
            <div class="card border border-secondary">
                <div class="card-header">
                    <h3>Tabel Data Nilai</h3>
                </div>
                <div id="data" class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" colspacing="0">
                            <thead>
                                <tr>
                                    <th width="80px">No</th>
                                    <th>Peserta</th>
                                    <?php foreach ($dataKriteria as $dt) : ?>
                                        <th><?= $dt['keterangan']; ?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($entropyTopsis as $ps) :
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $ps['nama_lengkap']; ?></td>
                                        <?php foreach ($ps['kriteria_nilai'] as $key => $dn) : ?>
                                            <td><?= $dn ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>


    <div class="row">
        <div class="col">
            <div class="card border border-secondary">
                <div class="card-header">
                    <h3>Tabel Normalisasi Matrix Awal</h3>
                </div>

                <div id="data" class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" colspacing="0">
                            <thead>
                                <tr>
                                    <th width="80px">No</th>
                                    <th>Peserta</th>
                                    <?php foreach ($dataKriteria as $dt) : ?>
                                        <th><?= $dt['keterangan']; ?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- <tr>
                                <td style="font-weight: bold;" colspan="2">Total</td>
                                <?php foreach ($jumlahNormalisasiMatrixAwal as $dt) : ?>
                                    <td style="font-weight: bold;"><?= $dt; ?></td>
                                <?php endforeach; ?>
                            </tr> -->

                                <?php
                                $no = 1;
                                foreach ($entropyTopsis as $ps) :
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $ps['nama_lengkap']; ?></td>
                                        <?php foreach ($ps['normalisasi_matrixawal'] as $key => $dn) : ?>
                                            <td><?= $dn ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col">
            <div class="card border border-secondary">
                <div class="card-header">
                    <h3>Tabel Perhitungan Entropy Kriteria</h3>
                </div>

                <div id="data" class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" colspacing="0">
                            <thead>
                                <tr>
                                    <th width="80px">No</th>
                                    <th>Peserta</th>
                                    <?php foreach ($dataKriteria as $dt) : ?>
                                        <th><?= $dt['keterangan']; ?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- <tr>
                                <td style="font-weight: bold;" colspan="2">Total</td>
                                <?php foreach ($jumlahKriteriaEntropy as $dt) : ?>
                                    <td style="font-weight: bold;"><?= $dt; ?></td>
                                <?php endforeach; ?>
                            </tr> -->

                                <?php
                                $no = 1;
                                foreach ($entropyTopsis as $ps) :
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $ps['nama_lengkap']; ?></td>
                                        <?php foreach ($ps['nilai_entropy'] as $key => $dn) : ?>
                                            <td><?= $dn ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col">
            <div class="card border border-secondary">
                <div class="card-header">
                    <h3>Tabel Entropy Setiap Kriteria</h3>
                </div>

                <div id="data" class="card-body">
                    <p>Nilai K = <?= $nilaiK ?></p>
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" colspacing="0">
                            <thead>
                                <tr>
                                    <?php foreach ($dataKriteria as $dt) : ?>
                                        <th><?= $dt['keterangan']; ?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                    foreach ($dataEntropyKriteria as $dt) : ?>
                                        <td><?= $dt; ?></td>
                                    <?php endforeach; ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>
    <div class="row">
        <div class="col">
            <div class="card border border-secondary">
                <div class="card-header">
                    <h3>Tabel Bobot Kriteria</h3>

                </div>

                <div id="data" class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" colspacing="0">
                            <thead>
                                <tr>
                                    <?php foreach ($dataKriteria as $dt) : ?>
                                        <th><?= $dt['keterangan']; ?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                    foreach ($dataBobotEntropy as $dt) : ?>
                                        <td><?= $dt; ?></td>
                                    <?php endforeach; ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>
    <div class="row">
        <div class="col">
            <div class="card border border-secondary">
                <div class="card-header">
                    <h3>Tabel Bobot Kriteria Baru</h3>

                </div>

                <div id="data" class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" colspacing="0">
                            <thead>
                                <tr>
                                    <?php foreach ($dataKriteria as $dt) : ?>
                                        <th><?= $dt['keterangan']; ?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                    foreach ($dataBobotEntropyBaru as $dt) : ?>
                                        <td><?= $dt; ?></td>
                                    <?php endforeach; ?>
                                </tr>
                                <!-- <tr>
                                    <td colspan="4">Total</td>
                                    <td><?= $totalBobotEntropyBaru ?></td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col">
            <div class="card border border-secondary">
                <div class="card-header">
                    <h3>Tabel Bobot Kriteria Akhir</h3>

                </div>

                <div id="data" class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" colspacing="0">
                            <thead>
                                <tr>
                                    <?php foreach ($dataKriteria as $dt) : ?>
                                        <th><?= $dt['keterangan']; ?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                    foreach ($dataBobotEntropyAkhir as $dt) : ?>
                                        <td><?= $dt; ?></td>
                                    <?php endforeach; ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>