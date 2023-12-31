<div class="tab-pane fade  show active" id="peserta" role="tabpanel" aria-labelledby="peserta-tab" tabindex="0">
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
                                        <?php foreach ($ps['kriteria_keterangan'] as $key => $dn) : ?>
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