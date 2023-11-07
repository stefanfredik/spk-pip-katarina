<div class="tab-pane fade" id="moora" role="tabpanel" aria-labelledby="moora-tab" tabindex="0">
    <h3 class="my-5">Perhitungan Moora</h3>
    <div class="row">
        <div class="col">
            <div class="card border border-secondary">
                <div class="card-header">
                    <h3>Tabel Normalisasi</h3>
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
                                foreach ($mooraPeserta as $ps) :
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $ps['nama_lengkap']; ?></td>
                                        <?php foreach ($ps['data_normalisasi'] as $key => $dn) : ?>
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
                    <h3>Tabel Optimasi</h3>
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
                                <tr>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($mooraPeserta as $ps) :
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $ps['nama_lengkap']; ?></td>
                                        <?php foreach ($ps['data_optimasi'] as  $do) : ?>
                                            <td><?= $do ?></td>
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
                    <h3>Tabel Yi</h3>
                </div>
                <div id="data" class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" width="100%" colspacing="0">
                            <thead style="text-align: center;">
                                <tr>
                                    <th width="80px" rowspan="2">No</th>
                                    <th rowspan="2">Peserta</th>
                                    <th colspan="<?= $jumKriteriaBenefit; ?>">Benefit</th>
                                    <th colspan="<?= $jumKriteriaCost; ?>">Cost</th>
                                </tr>
                                <tr>
                                    <?php foreach ($dataKriteria as $dt) : ?>
                                        <?= ($dt['type'] == 'benefit') ? '<th>' . $dt['keterangan'] . '</th>' : ''; ?>
                                    <?php endforeach; ?>

                                    <?php foreach ($dataKriteria as $dt) : ?>
                                        <?= ($dt['type'] == 'cost') ? '<th>' . $dt['keterangan'] . '</th>' : ''; ?>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($mooraPeserta as $ps) :
                                ?>
                                    <tr>
                                        <td style="text-align: center;"><?= $no++; ?></td>
                                        <td style="text-align: left ;"><?= $ps['nama_lengkap']; ?></td>
                                        <?php foreach ($ps['data_kriteria_benefit'] as $key => $dn) : ?>
                                            <td><?= $dn ?></td>
                                        <?php endforeach; ?>
                                        <?php foreach ($ps['data_kriteria_cost'] as $key => $dn) : ?>
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
                    <h3>Tabel Nilai</h3>
                </div>
                <div id="data" class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" colspacing="0">
                            <thead>
                                <tr>
                                    <th width="80px">No</th>
                                    <th width="80px" class="text-center">Rangking</th>
                                    <th>Peserta</th>
                                    <th>Max</th>
                                    <th>Min</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 0;
                                foreach ($mooraPeserta as $ps) :
                                ?>
                                    <tr>
                                        <td><?= ++$no; ?></td>
                                        <td width="80px" class="text-center"><?= $no ?></td>
                                        <td><?= $ps['nama_lengkap']; ?></td>
                                        <td><?= $ps['kriteria_max']; ?></td>
                                        <td><?= $ps['kriteria_min']; ?></td>
                                        <td><?= $ps['kriteria_nilai']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>