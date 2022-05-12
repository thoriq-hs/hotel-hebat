<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "hotel-hebat");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <?php
  // koneksi ke database
  $conn = mysqli_connect("localhost", "root", "", "hotel-hebat");
  // ambil data di URL
  $id = $_GET["id_fasilitas_kamar"];
  // query data berdasarkan id
  $DetailFasilitasKamar = mysqli_query($conn, "SELECT * FROM fasilitas_kamar WHERE id = '$id'");
  // ambil baris dari query
  $ResultDetailFasilitasKamar = mysqli_fetch_assoc($DetailFasilitasKamar);
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
    <title>Edit</title>
  </head>

<body style="margin-top: 80px;">
  <!-- Navbar -->
  <?php
  include './navbar.php'
  ?>
  <!-- Navbar -->

  <!-- Edit -->
  <!-- Upload Gambar -->
  <?php
  function uploadGambarFasilitasKamar()
  {
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if ($error === 4) {
      echo "<script>
				alert('pilih gambar terlebih dahulu!');
			  </script>";
      return false;
    }

    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
      echo "<script>
				alert('yang anda upload bukan gambar!');
			  </script>";
      return false;
    }

    // cek jika ukurannya terlalu besar
    if ($ukuranFile > 1000000) {
      echo "<script>
				alert('ukuran gambar terlalu besar!');
			  </script>";
      return false;
    }

    // lolos pengecekan, gambar siap diupload
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, '../vendor/img/fasilitas_kamar/' . $namaFileBaru);

    return $namaFileBaru;
  }
  ?>
  <!-- Upload Gambar -->

  <?php
  function editFasilitasKamar($data)
  {
    global $conn;

    $id = $_GET["id_fasilitas_kamar"];
    $id_kamar = htmlspecialchars($data["id_kamar"]);
    $fasilitas = htmlspecialchars($data["fasilitas"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    // cek apakah user pilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4) {
      $gambar = $gambarLama;
    } else {
      $gambar = uploadGambarFasilitasKamar();
    }

    $queryEditFasilitasKamar = "UPDATE fasilitas_kamar SET
				id = $id,
				id_kamar = '$id_kamar',
				fasilitas = '$fasilitas',
				gambar = '$gambar'
			  WHERE id = $id
			";
    // var_dump($query); die;
    mysqli_query($conn, $queryEditFasilitasKamar);

    return mysqli_affected_rows($conn);
  }

  if (isset($_POST["fasilitas_kamar"])) {

    if (editFasilitasKamar($_POST) > 0) {
      echo "<script>
        alert('Data berhasil diubah!');
        document.location.href = './fasilitas_kamar.php';
        </script>";
    } else {
      echo mysqli_error($conn);
    }
  }
  ?>

  <div class="container card p-2">
    <form action="" method="post" enctype="multipart/form-data">

      <input type="hidden" name="gambarLama" value="<?= $ResultDetailFasilitasKamar["gambar"]; ?>">

      <div class="mb-2">
      <label for="id_kamar">Tipe Kamar</label>
      <select class="form-select mt-3" id="id_kamar" name="id_kamar">
                  <?php
                    $sql = "SELECT * FROM kamar";
                    $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                      //membaca data pada baris tabel
                      while($row = $result->fetch_assoc()) {
                  ?>
                        <option value="<?php echo $row["id_kamar"]; ?>"> <?php echo $row["nama_kamar"]; ?> </option>                 
                  <?php 
                    }
                   }
                  ?>
                   </select>
      </div>

      <div class="mb-3">
        <label for="fasilitas" class="form-label">Fasilitas</label>
        <textarea name="fasilitas" class="form-control" id="fasilitas" rows="3"><?= $ResultDetailFasilitasKamar['fasilitas']; ?></textarea>
      </div>

      <div class="mb-2">
        <label for="gambar" class="form-label">Gambar</label>
        <img src="../vendor/img/fasilitas_Kamar/<?= $ResultDetailFasilitasKamar['gambar']; ?>" style="width: 120px; height: 70px; margin-bottom: 10px;">
        <input type="file" class="form-control" name="gambar" id="gambar">
      </div>

      <!-- Tombol Edit -->
      <button class="btn btn-warning" type="submit" name="fasilitas_kamar">Edit</button>

    </form>
  </div>
  <!-- Edit -->

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
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- CSS Bootstrap -->
<link rel="stylesheet" href="../vendor/bootstrap.min.css">
<!-- Data Tabel -->
<link rel="stylesheet" href="../vendor/dataTables.bootstrap5.min.css">
<script src="../vendor/jquery-3.5.1.js"></script>
<script src="../vendor/jquery.dataTables.min.js"></script>
<script src="../vendor//dataTables.bootstrap5.min.js"></script>
<title>Kamar</title>
</head>

<body style="margin-top: 80px;">
  <!-- Navbar -->
  <?php
  include './navbar.php'
  ?>
  <!-- Navbar -->


  <!-- Bootstrap JS -->
  <script src="../vendor/bootstrap.bundle.min.js"></script>
 

</body>

</html>