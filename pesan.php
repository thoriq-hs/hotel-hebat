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
        <link href="./temp/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="./temp/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="./temp/vendor/animate/animate.min.css" rel="stylesheet">
        <link href="./temp/vendor/slick/slick.css" rel="stylesheet">
        <link href="./temp/vendor/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

        <!-- Main Stylesheet File -->
    </head>

    <body>
        <!-- Header Section Start -->
        <header id="header">
        <?php
  include './navbar.php'
  ?>
        </header>
        <!-- Header Section End -->
    
    <br>
    <center><font size="1">HOTEL HEBAT</font></center>
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
        </div>



        <input type="submit" value="Pesan" name="Tambah" />            
</div>
    </form>
    <br><br><br><br><br><br>

    </body>



</html>