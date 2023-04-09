<?php
    if( empty( $_SESSION['id_user'] ) ){

    	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
    	header('Location: ./');
    	die();
    } else {
?>

<html>
<head>
    <link href="css/bootstrap.css" rel="stylesheet"/>
</head>
<body onload="window.print()">
    <div class="container">

<?php

    $id_transaksi = $_REQUEST['id_transaksi'];

    $sql = mysqli_query($koneksi, "SELECT no_nota, nama_costumer, biaya_service, total, bayar, kembali,  tanggal, id_user FROM transaksi WHERE id_transaksi='$id_transaksi'");

    list($no_nota, $nama_costumer, $biaya_service, $total, $bayar, $kembali, $tanggal, $id_user) = mysqli_fetch_array($sql);

    echo '
        <center><h3>Cetak Nota Cuci Motor & Mobil</h3></center>
        <hr/>
        <h4>Nota Nomor : <b>'.$no_nota.'</b></h4>
        <table class="table table-bordered">
         <thead>
           <tr class="info">
             <th width="15%">Nama Pelanggan</th>
             <th width="12%">Biaya Service</th>
             <th width="10%">Total Bayar</th>
      
           </tr>
           
           
         </thead>
         
         <tbody>

           <tr>
             <td>'.$nama_costumer.'</td>
             <td>RP.'.number_format ($biaya_service).'</td>
             <td>RP. '.number_format($total).'</td>
       
             <tr/>

        </tbody>
      </table>
    
      <table class="table table-bordered">

        <tbody>
        <thead>
          <tr>
            <th width="25%">Tanggal Transaksi</th>
            <td width="75%">'.date("d M Y", strtotime($tanggal)).'</td>
          </tr>
          </thead>
        </tbody>

        <tbody>
          
            <tr>
              <th width="25%">Bayar</th>
              <td width="75%">RP. '.number_format($bayar).'</td>
            </tr>
        
          
        </tbody>
      

         <tbody>
        <thead>
          <tr>
           <th width="25%">Kembalian</th>
           <td width="75%">RP. '.number_format($kembali).'</td>
          </tr>
          </thead>
        </tbody>
       

       
        
        </table>
    

    <div style="margin: 0 0 50px 75%;">
        <p style="margin-bottom: 60px;">Petugas Kasir</p>
        <p>';
        $id_user = $_SESSION['id_user'];
        $sql = mysqli_query($koneksi, "SELECT nama FROM user WHERE id_user='$id_user'");
        list($nama_user) = mysqli_fetch_array($sql);

        echo "<b><u>$nama_user</u></b>";

        echo '</p>
    </div>

    <center>-------------------- Terima Kasih ------------------- </center>

    </div>
</body>
</html>';
}
?>
