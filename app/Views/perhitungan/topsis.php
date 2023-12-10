<div class="tab-pane fade" id="topsis" role="tabpanel" aria-labelledby="topsis-tab" tabindex="0">
    <div class="row">
        <h3 class="m-3">Perhitungan Metode Topsis</h3>
        <div class="row">
            <div class="col">
                <div class="card border border-secondary">
                    <div class="card-header">
                        <h3>Tabel Data Normalisasi Topsis</h3>
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
                                            <?php foreach ($ps['topsis_normalisasi'] as $key => $dn) : ?>
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
    </div>

    <hr>

    <div class="row">
        <div class="col">
            <div class="card border border-secondary">
                <div class="card-header">
                    <h3>Tabel Max Min Kriteria</h3>

                </div>

                <div id="data" class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" colspacing="0">
                            <thead>
                                <tr>
                                    <th>Kategori</th>
                                    <?php foreach ($dataKriteria as $dt) : ?>
                                        <th><?= $dt['keterangan']; ?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Max</td>
                                    <?php
                                    foreach ($topsisKriteriaMax as $dt) : ?>
                                        <td><?= $dt; ?></td>
                                    <?php endforeach; ?>
                                </tr>
                                <tr>
                                    <td>Min</td>
                                    <?php
                                    foreach ($topsisKriteriaMin as $dt) : ?>
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
                    <h3>Tabel Data Normalisasi Topsis</h3>
                </div>
                <div id="data" class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" colspacing="0">
                            <thead>
                                <tr>
                                    <th width="80px">No</th>
                                    <th>Peserta</th>
                                    <th>D+</th>
                                    <th>D-</th>
                                    <th>Nilai V</th>
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
                                        <td><?= $ps["topsis_dplus"] ?></td>
                                        <td><?= $ps["topsis_dminus"] ?></td>
                                        <td><?= $ps["topsis_nilaiv"] ?></td>
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