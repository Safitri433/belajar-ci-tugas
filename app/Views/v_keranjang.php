<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<?php
if (session()->getFlashData('success')) {
?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
?> 
<?= form_open('keranjang/edit') ?>
<!-- Table with stripped rows -->
<table class="table datatable">
    <thead>
        <tr>
            <th scope="col">Nama</th>
            <th scope="col">Foto</th>
            <th scope="col">Harga</th> 
            <th scope="col">Jumlah</th>
            <th scope="col">Subtotal</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        if (!empty($items)) :
            foreach ($items as $index => $item) :
        ?>
                <tr>
                    <td><?= $item['name'] ?></td>
                    <td><img src="<?= base_url() . "img/" . $item['options']['foto'] ?>" width="100px"></td>
                    <td>
        <?php
            $hargaDiskon = $item['price'] - $diskon;
            if($hargaDiskon < 0){
            $hargaDiskon = 0;
        }   
        ?>

                    <del class="text-danger">
                    <?= number_to_currency($item['price'], 'IDR') ?>
                    </del>
                    <br>

                    <?= number_to_currency($hargaDiskon, 'IDR') ?>
                    </td>
                    <td><input type="number" min="1" name="qty<?= $i++ ?>" class="form-control" value="<?= $item['qty'] ?>"></td>
                    <td>
                        <?= number_to_currency($hargaDiskon * $item['qty'], 'IDR') ?>
                    </td>
                    <td>
                       <a href="<?= base_url('keranjang/delete/' . $item['rowid'] . '') ?>" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
        <?php
            endforeach;
        endif;
        ?>
    </tbody>
</table>
<?php
$totalDiskon = 0;

foreach($items as $item){

    $hargaDiskon = $item['price'] - $diskon;

    if($hargaDiskon < 0){
        $hargaDiskon = 0;
    }

    $totalDiskon += $hargaDiskon * $item['qty'];
}
?>

<div class="alert alert-info">
    Total = <?= number_to_currency($totalDiskon, 'IDR') ?>
</div>
<button type="submit" class="btn btn-primary">Perbarui Keranjang</button>
 <a class="btn btn-warning" href="<?= base_url() ?>keranjang/clear">Kosongkan Keranjang</a>
<?php if (!empty($items)) : ?>
    <a class="btn btn-success" href="<?php echo base_url() ?>checkout">Selesai Belanja</a>
<?php endif; ?>
 <?php echo form_close() ?>
<?= $this->endSection() ?>