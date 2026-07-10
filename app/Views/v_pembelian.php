<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<?php helper('number'); ?>

<style>
.btn-action{
    font-size: 9px;
    padding: 2px 6px;
    line-height: 1.2;
}
</style>

<h5>History Transaksi Pembelian</h5>
<hr>

<div class="table-responsive">
    <table class="table datatable">
        <thead>
<tr>
    <th width="5%">#</th>
    <th width="10%">ID Pembelian</th>
    <th width="15%">Pembeli</th>
    <th width="18%">Waktu Pembelian</th>
    <th width="15%">Total Bayar</th>
    <th width="18%">Alamat</th>
    <th width="10%">Status</th>
    <th width="9%">Aksi</th>
</tr>
</thead>

        <tbody>

        <?php if (!empty($transactions)) : ?>
            <?php foreach ($transactions as $index => $item) : ?>

                <tr>

                    <td><?= $index + 1 ?></td>

                    <td><?= $item['id'] ?></td>

                    <td><?= $item['username'] ?></td>

                    <td><?= $item['created_at'] ?></td>

                    <td><?= number_to_currency($item['total_harga'], 'IDR') ?></td>

                    <td><?= $item['alamat'] ?></td>

                    <td>
                        <?php if ($item['status'] == 1) : ?>
                            <span class="badge bg-primary">Sudah Selesai</span>
                        <?php else : ?>
                            <span class="badge bg-warning">Belum Selesai</span>
                        <?php endif; ?>
                    </td>

<td>
    <button
    class="btn btn-success btn-sm px-2 py-1"
    style="font-size:12px;"
    data-bs-toggle="modal"
    data-bs-target="#detailModal-<?= $item['id'] ?>">
    Detail
</button>
</td>

<td>
    <button
    class="btn btn-info btn-sm px-2 py-1"
    style="font-size:12px;"
    data-bs-toggle="modal"
    data-bs-target="#statusModal<?= $item['id'] ?>">
    Ubah Status
</button>
</td>

    <div class="modal fade" id="statusModal<?= $item['id'] ?>" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="<?= base_url('pembelian/updateStatus/'.$item['id']) ?>" method="post">

                <div class="modal-header">
                    <h5 class="modal-title">
                        Ubah Status Transaksi #<?= $item['id'] ?>
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <label>Status</label>

                    <select name="status" class="form-select">

    <option value="0"
        <?= $item['status'] == 0 ? 'selected' : '' ?>>
        Belum Selesai
    </option>

    <option value="1"
        <?= $item['status'] == 1 ? 'selected' : '' ?>>
        Sudah Selesai
    </option>

</select>

                </div>

                <div class="modal-footer">

                    <button type="submit" class="btn btn-success">
                        Simpan
                    </button>

                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                        Batal
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>
</td>

                </tr>

            <?php endforeach; ?>
        <?php endif; ?>

        </tbody>
    </table>
    
</div>

<!-- Modal Detail -->
<?php if (!empty($transactions)) : ?>

    <?php foreach ($transactions as $item) : ?>

        <div class="modal fade"
             id="detailModal-<?= $item['id'] ?>"
             tabindex="-1">

            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">

                    <div class="modal-header">

                        <h5 class="modal-title">
                            Detail Transaksi #<?= $item['id'] ?>
                        </h5>

                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal">
                        </button>

                    </div>

                    <div class="modal-body">
                        <div class="row">

                        <!-- Kolom Detail -->
                <div class="col-md-8">

                        <?php if (!empty($products[$item['id']])) : ?>

                            <?php foreach ($products[$item['id']] as $no => $produk) : ?>

                                <div class="row mb-3">

                                    <div class="col-3">

                                        <?php if (!empty($produk['foto'])) : ?>

                                            <img
                                                src="<?= base_url('img/' . $produk['foto']) ?>"
                                                class="img-fluid rounded">

                                        <?php endif; ?>

                                    </div>

                                    <div class="col-9">

                                        <strong><?= $produk['nama'] ?></strong>

                                        <?= number_to_currency($produk['harga'], 'IDR') ?>

                                        <br>

                                        (<?= $produk['jumlah'] ?> pcs)

                                        <br>

                                        <?= number_to_currency($produk['subtotal_harga'], 'IDR') ?>

                                    </div>

                                </div>

                                <hr>

                            <?php endforeach; ?>

                        <?php else : ?>

                            <p class="text-danger">
                                Tidak ada detail produk.
                            </p>

                        <?php endif; ?>

                        <strong>
                            Ongkir :
                        </strong>

                        <?= number_to_currency($item['ongkir'], 'IDR') ?>

                    </div>

                </div>

            </div>

        </div>

    <?php endforeach; ?>

<?php endif; ?>

<?= $this->endSection() ?>