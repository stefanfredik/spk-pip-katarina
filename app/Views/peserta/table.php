<div class="table-responsive">
    <table class="table table-bordered" id="table" width="100%" colspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Tahun</th>
                <th>NISN</th>
                <th>Nama</th>
                <th>Krteria</th>
                <th>Keterangan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            // dd($dataPeserta);
            foreach ($dataPeserta as $peserta) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $peserta['tahun']; ?></td>
                    <td><?= $peserta['nisn']; ?></td>
                    <td><?= $peserta['nama_lengkap']; ?></td>
                    <td>
                        <?php foreach ($dataKriteria as $dt) : ?>
                            <p>
                                <?= $dt['keterangan'] . ' - ' . $dt['kriteria']; ?>
                            </p>
                        <?php endforeach; ?>
                    </td>
                    <td>
                        <?php foreach ($dataKriteria as $dt) : ?>
                            <?php
                            $k = 'k_' . $dt['id'];
                            foreach ($dataSubkriteria as $sk) :
                                if ($dt['id'] == $sk['id_kriteria']) {
                                    if (isset($peserta[$k])) {
                                        echo ($peserta[$k] == $sk['id']) ? "<p>" . $sk['subkriteria'] . "</p>" : false;
                                    } else {
                                        'Data Belum Lengkap';
                                    }
                                }
                            endforeach; ?>
                        <?php endforeach; ?>
                    </td>

                    <td style="text-align: center" width="120px">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <?php if (in_groups("operator")) :  ?>
                                <button onclick="remove('<?= $meta['url']; ?>', this)" class="btn  btn-sm text-white btn-danger" data-id="<?= $peserta['id'] ?>"><i class="bi bi-trash mr-2"></i></button>
                                <button onclick="edit('<?= $meta['url']; ?>', this)" class="btn  btn-sm btn-primary" data-id="<?= $peserta['id'] ?>"><i class="bi bi-pencil-square mr-2"></i></button>
                            <?php endif; ?>
                            <button onclick="detail('<?= $meta['url']; ?>', this)" class="btn  btn-sm btn-info" data-id="<?= $peserta['id'] ?>">Detail</button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>