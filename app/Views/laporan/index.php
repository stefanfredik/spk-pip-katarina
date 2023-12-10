<?= $this->extend('temp/index'); ?>
<?= $this->section("content"); ?>

<a target="__blank" class="btn btn btn-primary my-2" href="/laporan/cetak"><i class="bi bi-printer-fill mx-2"></i>Cetak Laporan</a>
<div class="row">
    <div class="col">
        <div class="card  shadow">
            <div class="card-header">
                <h3><?= $title; ?></h3>
            </div>
            <div id="data" class="card-body">
                <?= $this->include("/laporan/table"); ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section("script"); ?>
<script>
    $('#table').DataTable(configDataTable)
</script>
<?= $this->endSection(); ?>