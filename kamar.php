<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "hotel-hebat");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CSS Bootstrap -->
  <link rel="stylesheet" href="./vendor/bootstrap.min.css">
  <title>Kamar</title>

  <!-- Vendor CSS File -->
  <link href="./temp/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="./temp/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="./temp/vendor/animate/animate.min.css" rel="stylesheet">
        <link href="./temp/vendor/slick/slick.css" rel="stylesheet">
        <link href="./temp/vendor/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

</head>

<body style="margin-top: 80px;">
  <!-- Navbar -->
  <?php
  include './navbar.php'
  ?>
  <!-- Navbar -->

  <!-- SCRIPT TOMBOL PESAN SEKARANG -->
  <div class="container mt-2">
    <div class="d-flex justify-content-center">
      <div class="row">
        <div class="col-sm form-floating mb-3 mt-4">
          <a href="pesan.php" class="btn btn-primary">Mulai Pesan Sekarang</a>
        </div>
      </div>
    </div>
  </div>

  <!-- SCRIPT KAMAR -->
  <div class="container mt-2 col-sm-7" id="panel_kamar">
    <h2 class="text-center">TIPE KAMAR KAMI</h2>
    <h5 class="text-center">Hotel Hebat</h5>

    <div class="justify-content-center">
      <!-- Mulai Script Panggil SlideShow Dari Tabel Fasilitas Umum menggunakan PHP -->
      <?php
      $resultFasilitasKamar = mysqli_query($conn, "SELECT * FROM fasilitas_kamar,kamar WHERE fasilitas_kamar.id_kamar = kamar.id_kamar");
      ?>
      <?php while ($rowFasilitasKamar = mysqli_fetch_assoc($resultFasilitasKamar)) : ?>
        <div class="card mt-2 mb-4">
          <h5 class="card-title">Tipe Kamar: <?= $rowFasilitasKamar['nama_kamar']; ?> </h5>
          <ul>
            <li><?= $rowFasilitasKamar['fasilitas']; ?></li>
          </ul>
          <img class="img-fluid" src="./vendor/img/fasilitas_kamar/<?= $rowFasilitasKamar['gambar']; ?>" alt="Card image">
        </div>
      <?php endwhile; ?>
    </div>
  </div>


  <!-- SCRIPT FOOTER -->
<div class="mt-5 p-2 bg-secondary text-white text-center">
  <p>Login Sebagai Petugas?</p>
  <a href="login.php" class="btn btn-info">Login</a>
</div>

  <!-- Bootstrap JS -->
  <script src="./vendor/bootstrap.bundle.min.js"></script>

</body>

</html>