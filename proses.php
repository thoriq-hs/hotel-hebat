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


