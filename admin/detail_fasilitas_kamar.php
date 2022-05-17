<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "hotel-hebat");
// ambil data di URL
$id = $_GET["id"];
// query data berdasarkan id
$Detailfasilitas_kamar = mysqli_query($conn, "SELECT * FROM fasilitas_kamar,kamar where fasilitas_kamar.id_kamar=kamar.id_kamar");
// ambil baris dari query
$Resultdetail_fasilitas_kamar = mysqli_fetch_assoc($Detailfasilitas_kamar);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CSS Bootstrap -->
  <link rel="stylesheet" href="../vendor/bootstrap.min.css">
  <!-- Data Tabel -->
  <link rel="stylesheet" href="../vendor/dataTables.bootstrap5.min.css">
  <script src="../vendor/jquery-3.5.1.js"></script>
  <script src="../vendor/jquery.dataTables.min.js"></script>
  <script src="../vendor//dataTables.bootstrap5.min.js"></script>
  <title>Detail Fasiitas Kamar</title>
</head>

<body style="margin-top: 80px;">
  <!-- Navbar -->
  <?php
  include './navbar.php'
  ?>
  <!-- Navbar -->

  <!-- Detail Kamar -->
  <div class="container">
    <table class="table table-striped" style="width:100%">
      <tbody>
        <tr>
        <td>
            <h4>Nama kamar: </h3>
              <h5><?= $Resultdetail_fasilitas_kamar['nama_kamar']; ?></h5>
          </td>
          <td>
            <h4>Nama Fasilitas kamar: </h3>
              <h5><?= $Resultdetail_fasilitas_kamar['fasilitas']; ?></h5>
          </td>
          <td>
            <h4>Gambar: </h3><img src="../vendor/img/fasilitas_kamar/<?= $Resultdetail_fasilitas_kamar['gambar']; ?>" alt="" style="width: 120px; height: 70px;">
              <h5><?= $Resultdetail_fasilitas_kamar['gambar']; ?></h5>
          <td>
      </tbody>
    </table>
  </div>
  <!-- Detail Kamar -->


  <!-- SCRIPT TOMBOL KEMBALI  -->
  <div class="container mt-2">
    <div class="d-flex justify-content-center">
      <div class="row">
        <div class="col-sm form-floating mb-3 mt-4">
          <a href="fasilitas_kamar.php" class="btn btn-warning">Kembali</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="../vendor/bootstrap.bundle.min.js"></script>
  <!-- Data Tabel -->
  <script>
    $(document).ready(function() {
      $('#fasilitas_kamar').DataTable();
    });
  </script>

</body>

</html>