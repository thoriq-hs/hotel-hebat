<?php
session_start();

// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "hotel-hebat");

if (!isset($_SESSION["login"])) {
  header("Location: ./pelanggan.php");
  exit;
}
if ($_SESSION['role'] != "Resepsionis") {
  echo "
            <script>
                alert('Anda bukan resepsionis!');
                window.location.href = '../admin/kamar.php';
            </script>
        ";
}
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
  <title>Pelanggan</title>
</head>

<body style="margin-top: 80px;">
  <!-- Navbar -->
  <?php
  include './navbar.php'
  ?>
  <!-- Navbar -->

<!-- Tombol filter tanggal -->
<form method="get">
			<label>-----PILIH TANGGAL</label>
			<input type="date" name="tanggal">
			<input type="submit" value="FILTER">
		</form>

<!-- Akhr filter -->

  <!-- Tampil -->
  <div class="container-fluid card-body">
    <table id="pelanggan" class="table table-striped" style="width:100%">
      <thead class="bg-dark text-light">
        <tr>
          <th>Status</th>
          <th>No Pendaftaran</th> 
          <th>Nama Tamu</th>
          <th>Tanggal Pesan</th>
          <th>Check In</th>
          <th>Check Out</th>
          <th>Kamar</th>
          <th>Jumlah Kamar</th>
          <th class="text-center">Aksi</th>
        </tr>
      </thead>

      <?php 
 
			if(isset($_GET['tanggal'])){
				$tgl = $_GET['tanggal'];
				$resultPelanggan = mysqli_query($conn,"select * from pelanggan,kamar WHERE checkin='$tgl' AND pelanggan.id_kamar = kamar.id_kamar");
			}elseif(isset($_GET['nama_tamu'])){
        $nm = $_GET['nama_tamu'];
        $resultPelanggan = mysqli_query($conn, "select * from pelanggan,kamar WHERE nama_tamu='$nm' AND pelanggan.id_kamar = kamar.id_kamar");
      }else{
        $resultPelanggan = mysqli_query($conn, "SELECT * FROM pelanggan,kamar WHERE pelanggan.id_kamar = kamar.id_kamar");
      }
			while($rowPelanggan = mysqli_fetch_array($resultPelanggan)){
        ?>
      <tbody>
      <tr>
            <td><span class="badge bg-warning"><?= $rowPelanggan['status']; ?></span></td>
            <td><?= $rowPelanggan['no_reg']; ?></td>
            <td><?= $rowPelanggan['nama_tamu']; ?></td>
            <td><?= $rowPelanggan['tgl_pesan']; ?></td>
            <td><?= $rowPelanggan['checkin']; ?></td>
            <td><?= $rowPelanggan['checkout']; ?></td>
            <td><?= $rowPelanggan['nama_kamar']; ?></td>
            <td><?= $rowPelanggan['jml_kamar']; ?></td>
            <td>
              <a href="detail.php?id=<?= $rowPelanggan['id']; ?>" class="btn btn-outline-dark">Detail</a>
              <a href="proses.php?id=<?= $rowPelanggan['id']; ?>" class="btn btn-outline-dark mx-1">Proses</a>
              <a href="hapus.php?id=<?= $rowPelanggan['id']; ?>" class="btn btn-outline-dark">Hapus</a>
            </td>
          </tr>
      </tbody>
      <?php  } ?>
    </table>


  </div>
  <!-- Tampil -->

  <!-- Bootstrap JS -->
  <script src="../vendor/bootstrap.bundle.min.js"></script>
  <!-- Data Tabel -->
  <script>
    $(document).ready(function() {
      $('#pelanggan').DataTable();
    });
  </script>

</body>

</html>