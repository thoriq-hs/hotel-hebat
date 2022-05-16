$(function(){	
	/* Add Data Kategori dengan Admin */
    $("#konfirmasi").on('click', function(){
     var nama    = $("#nama").val();
     var email   = $("#email").val();   
     var hp      = $("#hp").val();
     var tamu    = $("#tamu").val();
     var masuk   = document.getElementById("masuk");
     var checkin = masuk.value;
     var keluar  = document.getElementById("keluar");
     var checkout= keluar.value;
     var status  = $("status1").val;
     var idkamar = $("#idkamar").val();
     var jkamar  = $("#jkamar").val();
	 //alert(description);
	 if ( (nama=="") || (email=="") || (hp=="") || (tamu=="") || (idkamar=="") || (jkamar=="") || (masuk="") || (keluar=""))
	 {
        alert("Terjadi kesalahan. Ada data yang kosong!");
        return;
	 }
	 
     $.ajax({
     url: "./pesan2.php",
     method: "POST",
     data:{
		   nama:nama, 
		   email:email,
           hp:hp,
           tamu:tamu,
           checkin:checkin,
           checkout:checkout,
           status:status,
           idkamar:idkamar,
           jkamar: jkamar
	      },
     success: function(data)
      {
        //alert(data);
        if (data=="OK") 
         {
             alert("Pesan TERKIRIM!");
             document.getElementById("form_pesan").reset();
             window.location.href="./bukti_pesan.php?id="+ idkamar + "&nama="+ tamu + "&tm="+ checkin + "&tk=" 
             +checkout+ "&jk="+jkamar + "&email="+email +"&status="+status;
		     } 
        if (data=="ERROR") 
         {
            alert("Pesan TIDAK terkirim!")
	       }
	  }
	  
      });  
    });
	
  });