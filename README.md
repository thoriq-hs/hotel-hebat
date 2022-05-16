# hotel-hebat
membuat project baru untuk tugas ukk

<!-- Awal resepsionis/pelanggan.php -->

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
          <th>Nama Tamu</th>
          <th>Tanngal Pesan</th>
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
			}else{
				$resultPelanggan = mysqli_query($conn, "SELECT * FROM pelanggan,kamar WHERE pelanggan.id_kamar = kamar.id_kamar");
			}
			while($rowPelanggan = mysqli_fetch_array($resultPelanggan)){
        ?>
      <tbody>
      <tr>
            <td><span class="badge bg-warning"><?= $rowPelanggan['status']; ?></span></td>
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


      <!-- <tbody>
        <?php
        $resultPelanggan = mysqli_query($conn, "SELECT * FROM pelanggan,kamar WHERE pelanggan.id_kamar = kamar.id_kamar");
        ?>
        <?php while ($rowPelanggan = mysqli_fetch_assoc($resultPelanggan)) : ?>
          <tr>
            <td><span class="badge bg-warning"><?= $rowPelanggan['status']; ?></span></td>
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


        <?php endwhile; ?>
      </tbody>
    </table> -->
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
<!-- Akhir resepsionis/pelanggan.php -->















<!-- Awal resepsionis/proses.php -->
<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "hotel-hebat");
?>
<?php
function Proses($data)
{
  global $conn;

  $id = $_GET["id"];
  $nama_pemesan = htmlspecialchars($data["nama_pemesan"]);
  $email = htmlspecialchars($data["email"]);
  $hp = htmlspecialchars($data["hp"]);
  $nama_tamu = htmlspecialchars($data["nama_tamu"]);
  $tgl_pesan = htmlspecialchars($data["tgl_pesan"]);
  $checkin = htmlspecialchars($data["checkin"]);
  $checkout = htmlspecialchars($data["checkout"]);
  $jml_kamar = htmlspecialchars($data["jml_kamar"]);
  $status = htmlspecialchars($data["status"]);
  $id_kamar = htmlspecialchars($data["id_kamar"]);

  $queryProses = "UPDATE pelanggan SET
      id = $id,
      nama_pemesan = '$nama_pemesan',
      email = '$email',
      hp = '$hp',
      nama_tamu = '$nama_tamu',
      tgl_pesan = '$tgl_pesan',
      checkin = '$checkin',
      checkout = '$checkout',
      jml_kamar = '$jml_kamar',
      status = '$status',
      id_kamar = '$id_kamar'
      WHERE id = $id
    ";
  // var_dump($query); die;
  mysqli_query($conn, $queryProses);

  return mysqli_affected_rows($conn);
}

if (isset($_POST["proses"])) {

  if (Proses($_POST) > 0) {
    echo "<script>
      alert('Data berhasil di proses,silahkan cetak bukti pemesanan!');
      document.location.href = './pelanggan.php';
      </script>";
  } else {
    echo mysqli_error($conn);
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "hotel-hebat");
// ambil data di URL
$id = $_GET["id"];
// query data berdasarkan id
$DetailProses = mysqli_query($conn, "SELECT * FROM pelanggan WHERE id = '$id'");
// ambil baris dari query
$ResultDetailProses = mysqli_fetch_assoc($DetailProses);
?>

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
  <title>Cetak</title>
</head>

<body style="margin-top: 80px;">
  <!-- Navbar -->
  <?php
  include './navbar.php'
  ?>
  <!-- Navbar -->

  <div class="container card p-2">
    <form action="" method="post">
      <input type="hidden" name="nama_pemesan" value="<?= $ResultDetailProses["nama_pemesan"]; ?>">
      <input type="hidden" name="email" value="<?= $ResultDetailProses["email"]; ?>">
      <input type="hidden" name="hp" value="<?= $ResultDetailProses["hp"]; ?>">
      <input type="hidden" name="nama_tamu" value="<?= $ResultDetailProses["nama_tamu"]; ?>">
      <input type="hidden" name="tgl_pesan" value="<?= $ResultDetailProses["tgl_pesan"]; ?>">
      <input type="hidden" name="checkin" value="<?= $ResultDetailProses["checkin"]; ?>">
      <input type="hidden" name="checkout" value="<?= $ResultDetailProses["checkout"]; ?>">
      <input type="hidden" name="jml_kamar" value="<?= $ResultDetailProses["jml_kamar"]; ?>">
      <input type="hidden" name="id_kamar" value="<?= $ResultDetailProses["id_kamar"]; ?>">
      <?php if ($ResultDetailProses['status'] == 'Sedang Diproses') : ?>
        <label class="form-label">Status :</label>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="status" id="status1" value="Sedang Diproses" style="background-color:transparent" checked>
          <label class="form-check-label" for="status1">
            Sedang Diproses
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="status" id="status2" value="Telah Diproses" style="background-color:transparent">
          <label class="form-check-label" for="status2">
            Telah Diproses
          </label>
        </div>
      <?php endif; ?>
      <?php if ($ResultDetailProses['status'] == 'Telah Diproses') : ?>
        <label class="form-label">Jenis Kelamin res$ResultDetailProses :</label>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="status" id="status1" value="Sedang Diproses" style="background-color:transparent">
          <label class="form-check-label" for="status1">
            Sedang Diproses
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="status" id="status2" value="Telah Diproses" style="background-color:transparent" checked>
          <label class="form-check-label" for="status2">
            Telah Diproses
          </label>
        </div>
      <?php endif; ?>

      <button class="btn btn-info" type="submit" name="proses">Proses</button>
      <a href="pelanggan.php" class="btn btn-warning">Kembali</a>
    </form>
  </div>

  <!-- Bootstrap JS -->
  <script src="../vendor/bootstrap.bundle.min.js"></script>

</body>

</html>
<!-- Akhir resepsionis/proses.php -->

















<!-- Awal resepsionis/navbar.php -->
<nav class="navbar fixed-top border-bottom border-light navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
  <a class="navbar-brand" href="#">Hotel</a>
    <div class="ml-auto">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-link" href="./pelanggan.php">Pelanggan</a>
          <a href="../logout.php" class="btn btn-outline-light">Logout</a>
        </div>
      </div>
    </div>
  </div>
</nav>
<!-- Akhir resepsioniss/navbar.php -->




<!-- Awal resepsionis/hapus.php -->
<!-- Hapus -->
<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "hotel-hebat");

$id = $_GET["id"];

function hapusKamar($id)
{ 
  global $conn;
  mysqli_query($conn, "DELETE FROM pelanggan WHERE id = '$id'");
  return mysqli_affected_rows($conn);
}

if (hapusKamar($id) > 0) {
  echo "
		<script>
			alert('data berhasil dihapus!');
			document.location.href = './pelanggan.php';
		</script>
	";
} else {
  echo mysqli_error($conn);
}
?>
<!-- Hapus -->
<!-- Akhir resepsionis/hapus.php  -->











<!-- Awal resepsionis/detail.php -->
<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "hotel-hebat");
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

<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "hotel-hebat");
// ambil data di URL
$id = $_GET["id"];
// query data berdasarkan id
$DetailProses = mysqli_query($conn, "SELECT * FROM pelanggan,kamar WHERE pelanggan.id_kamar = kamar.id_kamar AND  id = '$id'");
// ambil baris dari query
$ResultDetailProses = mysqli_fetch_assoc($DetailProses);
?>

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
  <title>Cetak</title>
</head>

<body style="margin-top: 70px;">
  <!-- Navbar -->
  <?php
  include './navbar.php'
  ?>
  <!-- Navbar -->

  <!-- Cetak -->

  <div class="toolbar hidden-print container-fluid">
    <div class="text-right">
      <!-- <a href="./pelanggan.php" class="btn btn-warning"><i class="fa fa-print"></i>Kembali</a> -->
      <button id="cetakBukti" class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Print as PDF</button>
      <a href="pelanggan.php" class="btn btn-warning">Kembali</a>
    </div>
    <hr>
  </div>
  <div id="cetakBukti" class="container-fluid">
    <div class="row">
      <h1 class="card p-1 mb-1 text-center"><?= $ResultDetailProses['status']; ?></h1>
      
      <div class="col-lg-12">
        <div class="card p-2">
          <h4>Nama pemesan : <?= $ResultDetailProses['nama_pemesan']; ?></h4>
          <div class="email">Email : <a href="mailto:<?= $ResultDetailProses['email']; ?> "><?= $ResultDetailProses['email']; ?></a></div>
          <div>No Handphone : <?= $ResultDetailProses['hp']; ?></div>
          <div>Nama Tamu : <?= $ResultDetailProses['nama_tamu']; ?></div>
          <div>Tipekamar yg dipesan : <?= $ResultDetailProses['nama_kamar']; ?></div>
          <div>Tanggal Pesan : <?= $ResultDetailProses['tgl_pesan']; ?></div>
          <div>Jumlah kamar dipesan : <?= $ResultDetailProses['jml_kamar']; ?></div>
          <div>Chekin : <?= $ResultDetailProses['checkin']; ?></div>
          <div>Chekout : <?= $ResultDetailProses['checkout']; ?></div>
        </div>
      </div>
    </div>
  </div>
  <!-- Cetak -->

  <!-- Bootstrap JS -->
  <script src="../vendor/bootstrap.bundle.min.js"></script>
  <!-- Data Tabel -->
  <script>
    $(document).ready(function() {
      $('#cetakBukti').click(function() {
        window.print();
      });
    });
  </script>

</body>

</html>
<!-- Akhir resepsionis/detail.php-->






























<!-- Awal script pesan sebelum diubah -->
<?php 

$conn = new mysqli("localhost","root","","hotel-hebat");

$no = mysqli_query($conn, "select no_reg from pelanggan order by no_reg desc");
$no_reg = mysqli_fetch_array($no);
$kode = $no_reg['no_reg'];
// var_dump($kode); die;

$urut = substr($kode, 8, 3);
$tambah = (int) $urut + 1;
$bulan = date("m");
$tahun = date("y");

if(strlen($tambah) == 1){
  $format = "REG-".$bulan.$tahun."00".$tambah;
} else if(strlen($tambah) == 2){
  $format = "REG-".$bulan.$tahun."0".$tambah;
  
} else{
  $format = "REG-".$bulan.$tahun.$tambah;

}
$jumlah = 0;

 ?>
    
    <!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>HOTEL HEBAT </title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Favicons -->
        <link href="../temp/img/favicon.ico" rel="icon">
        <link href="../temp/img/apple-favicon.png" rel="apple-touch-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet"> 

        <!-- Vendor CSS File -->
        <link href="../temp/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../temp/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="../temp/vendor/animate/animate.min.css" rel="stylesheet">
        <link href="../temp/vendor/slick/slick.css" rel="stylesheet">
        <link href="../temp/vendor/slick/slick-theme.css" rel="stylesheet">
        <link href="../temp/vendor/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

        <!-- Main Stylesheet File -->
        <link href="../temp/css/hover-style.css" rel="stylesheet">
        <link href="../temp/css/style.css" rel="stylesheet">
    </head>

    <body>
        <!-- Header Section Start -->
        <header id="header">
            <a href="index.php" class="logo" style="color:white">HOTEL HEBAT</a>
            <div class="phone"><i class="fa fa-phone"></i>+852 6361 0123</div>
            <nav class="main-menu" >
                <ul>
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="../about.php">Tentang Kami</a></li>
                    <li><a href="../user/lihat_kamar.php">Kamar</a></li>
                    <li><a href="../user/lihat_fashotel.php">Fasilitas Hotel</a></li>
                    <li class="active"><a href="index.php">Reservasi</a></li>
                    <li><a href="../login.php">Login</a></li>
                </ul>
            </nav>
        </header>
        <!-- Header Section End -->
    
    <br>
    <center><font size="10">HOTEL HEBAT</font></center>
    <br>


    <br>


    <br>
    <header>
        <h3 class="formulir" style="padding-left:100px"> Formulir Pemesanan Kamar</h3> <br>
    </header>
    

    <form action="proses.php" method="POST">
    <div style="padding-right:100px; padding-left:100px">
        
    <div class="form-group">
            <label for="no_reg">ID Reservasi</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" name="no_reg" value="<?php echo $format; ?>" Readonly>
        </div>

        
        <div class="form-group">
            <label for="nama_pemesan">Nama Pemesan</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Your Name" name="nama_pemesan">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" name="email">
        </div>
        <div class="form-group">
            <label for="hp">Nomor Telepon</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="example:081234567891" name="hp">
        </div>
        <div class="form-group">
            <label for="nama_tamu">Nama Tamu</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="example:james" name="nama_tamu">
        </div>
        
        <div class="form-group">
            <label for="tgl_pesan">Tanggal Pemesanan</label> <br>
            <input type="date" class="form-control" id="exampleFormControlInput1" name="tgl_pesan" >
        </div>

        <div class="form-group">
            <label for="checkin">Check In</label> <br>
            <input type="date" class="form-control" id="exampleFormControlInput1" name="checkin" >
        </div>
        <div class="form-group">
            <label for="checkout">Check Out</label> <br>
            <input type="date" class="form-control" id="exampleFormControlInput1" name="checkout" >
        </div>

        <div class="form-group">
            <label for="jml_kamar">Jumlah Kamar</label>
            <input type="number" class="form-control" id="exampleFormControlInput1" name="jml_kamar">
        </div>

        <div class="form-group">
            <input type="hidden" class="form-control" id="exampleFormControlInput1" name="status" value="Sedang Diproses">
        </div>

        <div class="form-group">
        <label for="id_kamar">Tipe Kamar</label>
            <div class="form-line">
            <select name="id_kamar" class="form-control" >
            
            <option value="">-- Pilih Tipe Kamar  --</option>
            <?php
                $sql = $conn -> query("select * from kamar order by id_kamar");
                while ($data=$sql->fetch_assoc()) {
                echo "<option value='$data[id_kamar]'>$data[id_kamar]</option>";
                }
            ?>
            </select>
            </div>
        </div>



        <input type="submit" value="Pesan" name="Tambah" />            
</div>
    </form>
    <br><br><br><br><br><br>

    </body>



</html>

<!-- akhir script pesan sebelum diubah -->


























<!-- Awal script Proses -->
<?php

$conn = new mysqli("localhost","root","","hotel-hebat");
//var_dump($_POST); die;


                            
   if (isset($_POST['Tambah'])) {

      $id_tamu= ""; 
      $no_reg= $_POST['no_reg'];
      $nama_pemesan= $_POST['nama_pemesan'];     
      $email= $_POST['email'];
      $no_telp= $_POST['hp'] ;
      $nama_tamu= $_POST['nama_tamu'];
      $tgl_pesan= $_POST['tgl_pesan'];
      $checkin= $_POST['checkin'];
      $checkout= $_POST['checkout'];
      $id_kamar= $_POST['id_kamar'];
      $status= $_POST['status'];
      $jml_kamar= $_POST['jml_kamar'];


                                $sql = $conn->query("INSERT into pelanggan  values ('', '$no_reg','$nama_pemesan','$email','$no_telp', '$nama_tamu','$tgl_pesan','$checkin','$checkout','$jml_kamar','$status','$id_kamar')") or die(mysqli_error($conn));
                                
                                if ($sql) {
                                    ?>
                                    
                                        <script type="text/javascript">
                                        alert("Reservasi Berhasil Dilakukan, Silahkan Cetak Bukti Reservasi!");
                                        window.location.href="cetak.php?no_reg=<?php echo $no_reg ?>"  
                                        </script>

                                        
                                        <?php
                                       
                                }
                            
                            }
?>



<!-- Akhir Script proses -->

























<!-- Awal script cetak sebelum diubah -->
<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "hotel-hebat");
?>

<html>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<body style="padding: 0 20;">
    <div>

    
    <?php 

        $no_reg = $_GET['no_reg']; 
       $sql2 = mysqli_query($conn, "SELECT pelanggan.*, kamar.id_kamar AS nama_kamar FROM pelanggan LEFT JOIN kamar ON pelanggan.id_kamar = kamar.id_kamar WHERE no_reg='$no_reg'");     
      $tampil = mysqli_fetch_assoc($sql2);
    ?>
      <section class="content">
        <div class="row">
            <div>
                <div class="span12">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><h1 align="center"><strong>Cetak Reservasi</strong></h1></td>
                            </tr><hr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
          <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
              
              <h3>DETAIL RESERVASI</h3>
            </div>
            <!-- /.col -->
          
          </div>
          <div class="row">
            <div class="col-xs-12 table-responsive">
              <table class="table table-striped" align="center">
                <tr>
                  <td width="100" height="20" bold>ID Pemesanan</td>
                  <td width="5">:</td>
                  <td width="280"><?php echo $tampil['no_reg'] ?></td>
                </tr>
 
                <tr>
                  <td height="20">Nama Pemesan</td>
                  <td>:</td>
                  <td><?php echo $tampil['nama_pemesan'] ?></td>
                </tr>
                <tr>
                  <td height="20">Email</td>
                  <td>:</td>
                  <td><?php echo $tampil['email'] ?></td>
                </tr>
                <tr>
                  <td height="20">No. Telepon</td>
                  <td>:</td>
                  <td><?php echo $tampil['hp'] ?></td>
                </tr>
                <tr>
                  <td height="20">Nama Tamu</td>
                  <td>:</td>
                  <td><?php echo $tampil['nama_tamu'] ?></td>
                </tr>
                <tr>
                  <td height="20">Tanggal Pesan</td>
                  <td>:</td>
                  <td><?php echo $tampil['tgl_pesan'] ?></td>

                <tr>
                  <td height="20">Tanggal Check-In</td>
                  <td>:</td>
                  <td><?php echo $tampil['checkin'] ?></td>
                </tr>
                <tr>
                  <td height="20">Tanggal Check-Out</td>
                  <td>:</td>
                  <td><?php echo $tampil['checkout'] ?></td>
                </tr>
                <tr>
                  <td height="20">Jumlah Kamar</td>
                  <td>:</td>
                  <td><?php echo $tampil['jml_kamar'] ?></td>
                </tr>
                <tr>
                  <td height="20">Status Pemesanan</td>
                  <td>:</td>
                  <td><?php echo $tampil['status'] ?></td>
                </tr>
                <tr>
                  <td height="20">Tipe Kamar</td>
                  <td>:</td>
                  <td><?php echo $tampil['nama_kamar'] ?></td>
                </tr>
               

            </table>
          </div>
      </section>
    </div>
  </body>

 
   
   <script>
       
      window.print()
  </script>
<!-- Akhir Script cetak sebelum diubah -->















<!-- Awal Script admin/fasilitas_umum.php-->
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
  <title>Fasilitas Umum</title>
</head>

<body style="margin-top: 80px;">
  <!-- Navbar -->
  <?php
  include './navbar.php'
  ?>
  <!-- Navbar -->

  <!-- Tampil -->
  <div class="card container">
    <div class="table-responsive p-2">
      <!-- Tombol Tambah -->
      <a href="tambah_fasilitas_umum.php" class="btn btn-primary mb-2 d-block">Tambah
        Fasilitas Umum</a>

      <table id="fasilitas-umum" class="table table-striped" style="width:100%">
        <thead class="bg-dark text-light">
          <tr>
            <th>Nama Fasilitas</th>
            <th>Keterangan</th>
            <th>Gambar</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>
          <?php
          $resultFasilitasUmum = mysqli_query($conn, "SELECT * FROM fasilitas_umum");
          ?>
          <?php while ($rowFasilitasUmum = mysqli_fetch_assoc($resultFasilitasUmum)) : ?>
            <tr>
              <td><?= $rowFasilitasUmum['nama_fasilitas']; ?></td>
              <td><?= $rowFasilitasUmum['keterangan']; ?></td>
              <td><img src="../vendor/img/fasilitas_umum/<?= $rowFasilitasUmum['gambar']; ?>" alt="gambar" style="width: 120px; height: 70px;"></td>
              <td>
                <a href="detail_fasilitas_umum.php?id=<?= $rowFasilitasUmum['id']; ?>" class="btn btn-outline-dark">Detail</a>
                <a href="edit_fasilitas_umum.php?id=<?= $rowFasilitasUmum['id']; ?>" class="btn btn-outline-dark">Edit</a>
                <a href="hapus_fasilitas_umum.php?id=<?= $rowFasilitasUmum['id']; ?>" class="btn btn-outline-dark">Hapus</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
  <!-- Tampil -->

  <!-- Bootstrap JS -->
  <script src="../vendor/bootstrap.bundle.min.js"></script>
  <!-- Data Tabel -->
  <script>
    $(document).ready(function() {
      $('#fasilitas-umum').DataTable();
    });
  </script>

</body>

</html>
<!-- Akhir  -->










<!-- Awal admin/tambah_fasilitas_umum.php -->
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
  function uploadGambarFasilitasUmum()
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

    move_uploaded_file($tmpName, '../vendor/img/fasilitas_umum/' . $namaFileBaru);

    return $namaFileBaru;
  }
  ?>
  <!-- Upload Gambar -->

  <?php
  function tambahFasilitasUmum($data)
  {
    global $conn;

    $nama_fasilitas = htmlspecialchars($data["nama_fasilitas"]);
    $keterangan = htmlspecialchars($data["keterangan"]);
    // upload gambar
    $gambarFasilitasKamar = uploadGambarFasilitasUmum();
    if (!$gambarFasilitasKamar) {
      return false;
    }

    $result = mysqli_query($conn, "SELECT nama_fasilitas FROM fasilitas_umum WHERE nama_fasilitas = '$nama_fasilitas'");

    if (mysqli_fetch_assoc($result)) {
      echo "<script>
            alert('Sudah terdaftar!')
            </script>";
      return false;
    }


    $queryTamabahFasilitasKamar = "INSERT INTO fasilitas_umum
          VALUES
          ('','$nama_fasilitas','$keterangan','$gambarFasilitasKamar')
        ";
    mysqli_query($conn, $queryTamabahFasilitasKamar);

    return mysqli_affected_rows($conn);
  }

  if (isset($_POST["tambah_fasilitas_kamar"])) {

    if (tambahFasilitasUmum($_POST) > 0) {
      echo "<script>
              alert('Data berhasil ditambahkan!');
              document.location.href = './fasilitas_umum.php';
            </script>";
    } else {
      echo mysqli_error($conn);
    }
  }
  ?>

  <div class="container card p-2">
    <form action="" method="post" enctype="multipart/form-data">

      <div class="mb-2">
        <label for="nama_fasilitas" class="form-label">Nama Fasilitas</label>
        <input name="nama_fasilitas" type="text" class="form-control" id="nama_fasilitas" placeholder="Nama Fasilitas">
      </div>

      <div class="mb-3">
        <label for="keterangan" class="form-label">Keterangan</label>
        <textarea name="keterangan" class="form-control" id="keterangan" rows="3"></textarea>
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
<!-- akhir -->














<!-- Awal admin/edit_fasilitas_umum.php -->
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
  $id = $_GET["id"];
  // query data berdasarkan id
  $DetailFasilitasUmum = mysqli_query($conn, "SELECT * FROM fasilitas_umum WHERE id = '$id'");
  // ambil baris dari query
  $ResultDetailFasilitasUmum = mysqli_fetch_assoc($DetailFasilitasUmum);
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
  function uploadGambarFasilitasUmum()
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

    move_uploaded_file($tmpName, '../vendor/img/fasilitas_umum/' . $namaFileBaru);

    return $namaFileBaru;
  }
  ?>
  <!-- Upload Gambar -->

  <?php
  function editFasilitasUmum($data)
  {
    global $conn;

    $id = $_GET["id"];
    $nama_fasilitas = htmlspecialchars($data["nama_fasilitas"]);
    $keterangan = htmlspecialchars($data["keterangan"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    // cek apakah user pilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4) {
      $gambar = $gambarLama;
    } else {
      $gambar = uploadGambarFasilitasUmum();
    }

    $queryEditFasilitasUmum = "UPDATE fasilitas_umum SET
				id = $id,
				nama_fasilitas = '$nama_fasilitas',
				keterangan = '$keterangan',
				gambar = '$gambar'
			  WHERE id = $id
			";
    // var_dump($query); die;
    mysqli_query($conn, $queryEditFasilitasUmum);

    return mysqli_affected_rows($conn);
  }

  if (isset($_POST["fasilitas_umum"])) {

    if (editFasilitasUmum($_POST) > 0) {
      echo "<script>
        alert('Data berhasil diubah!');
        document.location.href = './fasilitas_umum.php';
        </script>";
    } else {
      echo mysqli_error($conn);
    }
  }
  ?>

  <div class="container card p-2">
    <form action="" method="post" enctype="multipart/form-data">

      <input type="hidden" name="gambarLama" value="<?= $ResultDetailFasilitasUmum["gambar"]; ?>">

      <div class="mb-2">
        <label for="nama_fasilitas" class="form-label">Nama Fasilitas</label>
        <input name="nama_fasilitas" type="text" class="form-control" id="nama_fasilitas" placeholder="Nama Fasilitas" value="<?= $ResultDetailFasilitasUmum['nama_fasilitas']; ?>">
      </div>

      <div class="mb-3">
        <label for="keterangan" class="form-label">Keterangan</label>
        <textarea name="keterangan" class="form-control" id="keterangan" rows="3"><?= $ResultDetailFasilitasUmum['keterangan']; ?></textarea>
      </div>

      <div class="mb-2">
        <label for="gambar" class="form-label">Gambar</label>
        <img src="../img/fasilitas_umum/<?= $ResultDetailFasilitasUmum['gambar']; ?>" style="width: 120px; height: 70px; margin-bottom: 10px;">
        <input type="file" class="form-control" name="gambar" id="gambar">
      </div>

      <!-- Tombol Edit -->
      <button class="btn btn-warning" type="submit" name="fasilitas_umum">Edit</button>

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
<!-- akhir -->

















<!-- Awal admin/hapus_fasilitas_umum.php -->
<!-- Hapus -->
<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "hotel-hebat");

$id = $_GET["id"];

function hapusFasilitasUmum($id)
{
  global $conn;
  mysqli_query($conn, "DELETE FROM fasilitas_umum WHERE id = '$id'");
  return mysqli_affected_rows($conn);
}

if (hapusFasilitasUmum($id) > 0) {
  echo "
		<script>
			alert('data berhasil dihapus!');
			document.location.href = './fasilitas_umum.php';
		</script>
	";
} else {
  echo mysqli_error($conn);
}
?>
<!-- Hapus -->

<!-- akhir -->