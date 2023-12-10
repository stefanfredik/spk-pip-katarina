<?= $this->extend('temp/cetak/index'); ?>
<?= $this->section("table"); ?>
<div class="table-responsive">
    <?= $this->include("/laporan/table"); ?>
</div>

<?= $this->endSection(); ?>