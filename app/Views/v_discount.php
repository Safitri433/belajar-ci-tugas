<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<style>
.dataTable-top{
    margin-bottom:15px;
}

.dataTable-search input{
    width:170px;
}

.dataTable-table{
    width:100%;
}

.dataTable-table th,
.dataTable-table td{
    vertical-align:middle;
}

.dataTable-table tbody tr{
    border-bottom:1px solid #dee2e6;
}
</style>

<?php if(session()->getFlashdata('success')) : ?>
<div class="alert alert-success">
    <?= session()->getFlashdata('success'); ?>
</div>
<?php endif; ?>

<?php if(session()->getFlashdata('error')) : ?>
<div class="alert alert-danger">
    <?= session()->getFlashdata('error'); ?>
</div>
<?php endif; ?>

<button
    type="button"
    class="btn btn-primary mb-3"
    data-bs-toggle="modal"
    data-bs-target="#modalTambah">
    Tambah Data
</button>

<table id="tableDiscount" class="table">
    <thead>
        <tr>
            <th width="5%">#</th>
            <th>Tanggal</th>
            <th>Nominal</th>
            <th width="20%"></th>
        </tr>
    </thead>

    <tbody>

    <?php if(!empty($discounts)) : ?>

        <?php foreach($discounts as $key => $item) : ?>

        <tr>

            <td><?= $key + 1 ?></td>

            <td><?= $item['tanggal']; ?></td>

           <td><?= $item['nominal']; ?></td>

            <td>

                <button
                    class="btn btn-success btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#edit<?= $item['id']; ?>">
                    Ubah
                </button>

                <button class="btn btn-danger btn-sm">
                    Hapus
                </button>

            </td>

        </tr>
        <div class="modal fade" id="edit<?= $item['id']; ?>">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="<?= base_url('discount/update/'.$item['id']) ?>" method="post">

                <div class="modal-header">
                    <h5 class="modal-title">Edit Data</h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Tanggal</label>

                        <input
                            type="date"
                            class="form-control"
                            name="tanggal"
                            value="<?= $item['tanggal']; ?>"
                            readonly>
                    </div>

                    <div class="mb-3">
                        <label>Nominal</label>

                        <input
                            type="number"
                            class="form-control"
                            name="nominal"
                            value="<?= $item['nominal']; ?>"
                            required>
                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                        Close

                    </button>

                    <button
                        type="submit"
                        class="btn btn-primary">

                        Simpan

                    </button>

                </div>

            </form>

        </div>
    </div>
</div>

        <?php endforeach; ?>

    <?php else : ?>

        <tr>
            <td colspan="4" class="text-center">
                Belum ada data
            </td>
        </tr>

    <?php endif; ?>

    </tbody>

</table>

<div class="modal fade" id="modalTambah">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="<?= base_url('discount/store') ?>" method="post">
                <?= csrf_field(); ?>

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data</h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Tanggal</label>

                        <input
                            type="date"
                            name="tanggal"
                            class="form-control"
                            required>
                    </div>

                    <div class="mb-3">
                        <label>Nominal</label>

                        <input
                            type="number"
                            name="nominal"
                            class="form-control"
                            required>
                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                        Close

                    </button>

                    <button
                        type="submit"
                        class="btn btn-primary">

                        Simpan

                    </button>

                </div>

            </form>

        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>

<script>
new simpleDatatables.DataTable("#tableDiscount");
</script>

<?= $this->endSection() ?>