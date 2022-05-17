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
      <a href="index.php" class="btn btn-warning">Home</a>

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