<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "hotel-hebat");
// ambil data di URL
$id_pelanggan = $_GET["id"];
// query data berdasarkan id
$DetailPelanggan = mysqli_query($conn, "SELECT * FROM pelanggan WHERE id = $id_pelanggan");
// ambil baris dari query
$ResultDetailPelanggan = mysqli_fetch_assoc($DetailPelanggan);
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
  <title>Detail</title>
</head>

<body style="margin-top: 80px;">
  <!-- Navbar -->
  <?php
  include './navbar.php'
  ?>
  <!-- Navbar -->

  <!-- Detail -->
  <div class="container">
    <table class="table table-striped" style="width:100%">
      <tbody>
        <td>
            <h4>Nama Pemesan: </h4>
            <h5><?= $ResultDetailPelanggan['nama_pemesan']; ?></h5>
          </td>
          <td>
            <h4>Email: </h4>
            <h5><?= $ResultDetailPelanggan['email']; ?></h5>
          </td>
          <td>
            <h4>No HP: </h4>
            <h5><?= $ResultDetailPelanggan['hp']; ?></h5>
          </td>
          <td>
            <h4>Nama Tamu: </h4>
            <h5><?= $ResultDetailPelanggan['nama_tamu']; ?></h5>
          </td>
          <td>
            <h4>Tanggal Pesan: </h4>
            <h5><?= $ResultDetailPelanggan['tgl_pesan']; ?></h5>
          </td>
          <td>
            <h4>Check In: </h4>
            <h5><?= $ResultDetailPelanggan['checkin']; ?></h5>
          </td>
          <td>
            <h4>Check Out: </h4>
            <h5><?= $ResultDetailPelanggan['checkout']; ?></h5>
          </td>
          <td>
            <h4>Jumlah Kamar: </h4>
            <h5><?= $ResultDetailPelanggan['jml_kamar']; ?></h5>
          </td>
          <td>
            <h4>Status: </h4>
            <h5><?= $ResultDetailPelanggan['status']; ?></h5>
          </td>
          <td>
            <h4>Nama Kamar: </h4>
            <h5><?= $ResultDetailPelanggan['id_kamar']; ?></h5>
          </td>
          
        </tr>
      </tbody>
    </table>
  </div>
  <!-- Detail -->

  <!-- Bootstrap JS -->
  <script src="../vendor/bootstrap.bundle.min.js"></script>
  <!-- Data Tabel -->
  <script>
    $(document).ready(function() {
      $('#kamar').DataTable();
    });
  </script>

</body>

</html>