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
  <link rel="stylesheet" href="../vendor/bootstrap.min.css">
  <!-- Data Tabel -->
  <link rel="stylesheet" href="../vendor/dataTables.bootstrap5.min.css">
  <script src="../vendor/jquery-3.5.1.js"></script>
  <script src="../vendor/jquery.dataTables.min.js"></script>
  <script src="../vendor//dataTables.bootstrap5.min.js"></script>
  <title>Tambah</title>
</head>

<body style="margin-top: 80px;">
  <!-- Navbar -->
  <?php
  include './navbar.php'
  ?>
  <!-- Navbar -->

  <!-- Tambah -->
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
  function tambahFasilitasKamar($data)
  {
    global $conn;

    $id_kamar = htmlspecialchars($data["id_kamar"]);
    $fasilitas = htmlspecialchars($data["fasilitas"]);
    // upload gambar
    $gambarFasilitasKamar = uploadGambarFasilitasKamar();
    if (!$gambarFasilitasKamar) {
      return false;
    }

    $result = mysqli_query($conn, "SELECT id_kamar FROM fasilitas_kamar,kamar WHERE id_kamar = '$id_kamar'");

    if (mysqli_fetch_assoc($result)) {
      echo "<script>
            alert('Sudah terdaftar!')
            </script>";
      return false; 
    }


    $queryTamabahFasilitasKamar = "INSERT INTO fasilitas_kamar
          VALUES
          ('','$id_kamar','$fasilitas','$gambarFasilitasKamar')
        ";
    mysqli_query($conn, $queryTamabahFasilitasKamar);

    return mysqli_affected_rows($conn);
  }

  if (isset($_POST["tambah_fasilitas_kamar"])) {

    if (tambahFasilitasKamar($_POST) > 0) {
      echo "<script>
              alert('Data berhasil ditambahkan!');
              document.location.href = './fasilitas_kamar.php';
            </script>";
    } else {
      echo mysqli_error($conn);
    }
  }
  ?>

  <div class="container card p-2">
    <form action="" method="post" enctype="multipart/form-data">

      <div class="mb-2">
          <!-- dari rian tanto -->
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
                    
                    <!-- dari rian tanto -->
      </div>

      <div class="mb-3">
        <label for="fasilitas" class="form-label">Fasilitas Kamar</label>
        <input name="fasilitas" type="text" class="form-control" id="fasilitas" placeholder="Nama Fasilitas">
      </div>

      <div class="mb-2">
        <label for="gambar" class="form-label">Gambar</label>
        <input name="gambar" class="form-control" type="file" id="gambar">
      </div>


      <!-- Modal footer -->
      <div class="modal-footer">
        <button class="btn btn-success" type="submit" name="tambah_fasilitas_kamar">Tambah</button>
      </div>

    </form>
  </div>
  <!-- Tambah -->

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