<div class="tab-pane fade" id="mooraTopsis" role="tabpanel" aria-labelledby="mooraTopsis-tab" tabindex="0">
    <div class="bg-primary p-3 text-white rounded">
        <h3 class="my-5 text-white">Perhitungan Moora</h3>
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
    </div>
    <hr>


    <!-- Topsis -->
    <div class="bg-secondary p-3 text-white rounded">
        <h3 class="my-5 text-white">Perhitungan Topsis</h3>
        <div class="row">
            <div class="col">
                <div class="card border border-secondary">
                    <div class="card-header">
                        <h3>Tabel A Plus dan A Minus</h3>
                    </div>
                    <div id="data" class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" colspacing="0">
                                <thead>
                                    <tr>
                                        <th width="80px">Kriteria</th>
                                        <?php foreach ($dataKriteria as $dt) : ?>
                                            <th><?= $dt['keterangan']; ?></th>
                                        <?php endforeach; ?>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>A Plus</td>
                                        <?php
                                        foreach ($mooraTopsisAplus as $key => $plus) : ?>
                                            <td><?= $plus; ?></td>
                                        <?php endforeach; ?>
                                    </tr>

                                    <tr>
                                        <td>A Minus</td>
                                        <?php
                                        foreach ($mooraTopsisAminus as $key => $minus) : ?>
                                            <td><?= $minus; ?></td>
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
                        <h3>Tabel Solusi Ideal</h3>
                    </div>
                    <div id="data" class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" colspacing="0">
                                <thead>
                                    <tr>
                                        <th width="80px">No</th>
                                        <th>Peserta</th>
                                        <th>Ideal Positive</th>
                                        <th>Ideal Negative</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($mooraTopsisPeserta as $ps) :
                                    ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $ps['nama_lengkap']; ?></td>
                                            <td><?= $ps['idealPositive']; ?></td>
                                            <td><?= $ps['idealNegative']; ?></td>
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
                                        <th>Peserta</th>
                                        <th>Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($mooraTopsisPeserta as $ps) :
                                    ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $ps['nama_lengkap']; ?></td>
                                            <td><?= $ps['nilaiAkhir']; ?></td>
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
</div>