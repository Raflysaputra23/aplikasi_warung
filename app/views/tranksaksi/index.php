<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <!-- BOOTSTRAP -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <!-- SWETALERT -->
  <link rel="stylesheet" href="framework/swetalert/sweetalert2.min.css">
  <script src="framework/swetalert/sweetalert2.all.min.js"></script>

  <!-- FONTSGOOGLE -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Madimi+One&family=Poppins:wght@300&family=Shadows+Into+Light&family=Tillana&display=swap" rel="stylesheet">

  <!-- FONTAWESOME -->
  <link rel="stylesheet" href="framework/fontawesome/css/font-awesome.min.css">

  <style>
    <?= require_once 'css/style.css' ?>
  </style>

</head>
<body onload="print()">
  <h1 class="text-center font-tilana text-primary mt-5">Terima kasih sudah <span class="text-danger">belanja diwebsite kami</span></h1>
  <div class="container mt-3 font-poppins" style="max-width: 700px;">
    <div class="d-flex border p-2 my-2 rounded-2 justify-content-between align-items-center gx-0">
      <h6 class="fw-semibold m-0">ID Tranksaksi : <?= $data['tranksaksi'][0]['id_tranksaksi']?></h6>
      <h6 class="fw-semibold m-0">Tanggal Tranksaksi : <?= $data['tranksaksi'][0]['tanggal_tranksaksi']?></h6>
    </div>
    <table class="table table-bordered table-striped table-hover m-0">
       <thead>
        <tr>
          <th>No</th>
          <th>Nama Produk</th>
          <th>Harga Produk</th>
          <th>Jumlah Produk</th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1;
          foreach ($data['tranksaksi'] as $produk): ?>
          <tr>
            <td><?= $no?></td>
            <td><?= $produk['nama_produk']?></td>
            <td><?= $produk['harga_produk']?></td>
            <td><?= $produk['quantity']?></td>
          </tr>
         <?php 
          $no++;
          endforeach ?>
        <tr>
          <td colspan="3">Total Harga</td>
          <td><?= $data['total_harga']['totalHarga']?></td>
        </tr>
      </tbody>
    </table>
    <a href="<?= Constant::BASEURL ?>tranksaksi/hapusKeranjang/<?= $data['tranksaksi'][0]['id_keranjang']?>" class="btn btn-primary mt-2 print"><i class="fa fa-arrow-left"></i> Kembali</a>
  </div>
<!-- BOOTSTRAP -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>