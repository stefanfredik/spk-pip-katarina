<?= $this->extend('/temp/index'); ?>
<?= $this->section("content"); ?>
<div class="row">
    <div class="row">
        <div class="col">
            <div class="card border border-secondary">
                <div class="card-header">
                    <h3><?= $meta["title"]; ?></h3>
                </div>
                <div id="data" class="card-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-bordered" width="100%" colspacing="0">
                            <thead>
                                <tr class="align-middle">
                                    <?php if (in_groups("kepala-sekolah")) : ?>
                                        <th>Action</th>
                                    <?php endif; ?>
                                    <th>No</th>
                                    <th class="text-center" width="80">Rangking</th>
                                    <th>NISN</td>
                                    <th>Nama Lengkap</th>
                                    <th>Jenis Kelamin</td>
                                    <th>Nilai Akhir</td>
                                    <th>Keputusan</th>
                                    <th>Periode</th>
                                    <th>Waktu Terima</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($peserta as $ps) :
                                ?>
                                    <tr>
                                        <!-- <?php if (in_groups("kepala-sekolah")) : ?>
                                            <td><?php if ($ps['validasi'] != 'Valid') : ?><button data-id="<?= $ps["id"]; ?>" onclick="validasi(this)" class="btn btn-sm btn-primary"><i class="bi bi-check-all mx-2"></i>Validasi</button><?php endif; ?></td>
                                        <?php endif; ?> -->

                                        <!-- <td><span class="badge <?= $ps['validasi'] == 'Valid' ? 'bg-success' : 'bg-danger'; ?>"><?= $ps['validasi']; ?></span></td> -->
                                        <td><?= $no++ ?></td>
                                        <td class="text-center "><span class="badge bg-cyan rounded rounded-circle"><?= $ps["rangking"]; ?></span></td>
                                        <td><?= $ps['nisn'] ?></td>
                                        <td><?= $ps['nama_lengkap'] ?></td>
                                        <td><?= $ps['jenis_kelamin'] ?></td>
                                        <td><?= $ps['topsis_nilaiv']; ?></td>
                                        <td><?= $ps['status']; ?></td>
                                        <td><?= $ps['periode']; ?></td>
                                        <td><?= $ps['tanggalTerima']; ?></td>
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

<?= $this->endSection(); ?>
<?= $this->section("script"); ?>
<script>
    async function validasi(target) {
        // target.event();

        let id = target.getAttribute("data-id");
        Swal.fire({
            title: "Validasi Pehitungan",
            text: "Apakah anda yakin untuk menvalidasi?",
            icon: "warning",
            showCancelButton: true,
            cancelButtonText: "Batal",
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Validasi"
        }).then(async result => {
            if (result.isConfirmed) {
                axios.get(`/keputusan/validasi/${id}`).then(res => {
                    console.log(res.data.status);

                    if (res.data.status == "success") {
                        Toast.fire({
                            icon: res.data.status,
                            title: res.data.msg
                        });
                        location.reload();
                    }
                }).catch(e => {
                    debug(e);

                    Toast.fire({
                        icon: "error",
                        title: "Gagal Menvalidasi!"
                    })
                })
            }
        })
    }
</script>

<script>
    $('.table').DataTable(configDataTable)
</script>

<?= $this->endSection(); ?>