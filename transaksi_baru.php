<?php
if( empty( $_SESSION['id_user'] ) ){

	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {

	if( isset( $_REQUEST['submit'] )){

		$no_nota = $_REQUEST['no_nota'];
		$biaya_service = $_REQUEST['biaya'];
		$nama = $_REQUEST['nama_costumer'];
		$bayar = $_REQUEST['bayar'];
		$kembali = $_REQUEST['kembali'];
		$total = $_REQUEST['total'];
		$id_user = $_SESSION['id_user'];
		$id_service = $_REQUEST['id_service'];
		

		$sql = mysqli_query($koneksi, "INSERT INTO transaksi(no_nota, biaya_service, nama_costumer, bayar, kembali, total, tanggal, id_user, id_service) VALUES('$no_nota', '$biaya_service', '$nama', '$bayar', '$kembali', '$total', NOW(), '$id_user', '$id_service')");

		if($sql == true){
			header('Location: ./admin.php?hlm=transaksi');
			die();
		} else {
			echo 'ERROR! Periksa penulisan querynya.';
		}
	} else {
?>
<h2>Tambah Transaksi Baru</h2>
<hr>
<form method="post" action="" class="form-horizontal" role="form">
	<div class="form-group">
		<label for="no_nota" class="col-sm-2 control-label">No. Nota</label>
		<div class="col-sm-3">

		<?php

			$sql = mysqli_query($koneksi, "SELECT no_nota FROM transaksi");
				echo '<input type="text" class="form-control" id="no_nota" value="';

			$no_nota = "C001";
			if(mysqli_num_rows($sql) == 0){
				echo $no_nota;
			}

			$result = mysqli_num_rows($sql);
			$counter = 0;
			while(list($no_nota) = mysqli_fetch_array($sql)){
				if (++$counter == $result) {
					$no_nota++;
					echo $no_nota;
				}
			}
				echo '"name="no_nota" placeholder="No. Nota" readonly>';

		?>

		</div>
	</div>
	<div class="form-group">
		<label for="jenis_kendaraan" class="col-sm-2 control-label">Jenis Kendaraan</label>
		<div class="col-sm-3">
			<select name="jenis_kendaraan" class="form-control" id="jenis" required>
				<option value="" disable>--- Pilih Jenis Kendaraan ---</option>
			<?php

				$q = mysqli_query($koneksi, "SELECT * FROM service");
				while($data = mysqli_fetch_array($q)){
					echo '<option value="'.$data['id_service'].'" >'.$data['id_service'].' . '.$data['jenis_kendaraan'].' harga Rp.'.$data['biaya'].'</option>';
				}

			?>
			</select>
		</div>
	</div>
	
	<div class="form-group">
		<label for="id_service" class="col-sm-2 control-label">ID Kendaraan</label>
		<div class="col-sm-3">
			<input type="text" class="form-control" id="id_service" name="id_service" value="" required readonly>
		</div>
	</div>

	<div class="form-group">
		<label for="biaya" class="col-sm-2 control-label">Biaya</label>
		<div class="col-sm-3">
			<input type="number" class="form-control" id="biaya" name="biaya" value="" required >
		</div>
	</div>
	<div class="form-group">
		<label for="bayar" class="col-sm-2 control-label">Bayar</label>
		<div class="col-sm-3">
			<input type="number" class="form-control" id="bayar" name="bayar" placeholder="Isi dengan angka" required>
		</div>
	</div>
	<div class="form-group">
		<label for="kembali" class="col-sm-2 control-label">Kembalian</label>
		<div class="col-sm-3">
			<input type="number" class="form-control" id="kembali" name="kembali" placeholder="Kembalian" required readonly>
		</div>
	</div>
	<div class="form-group">
		<label for="total" class="col-sm-2 control-label">Total Bayar</label>
		<div class="col-sm-3">
			<input type="number" class="form-control" id="total" name="total" placeholder="Total Bayar" required readonly>
		</div>
	</div>
	<div class="form-group">
		<label for="nama" class="col-sm-2 control-label">Nama Pelanggan</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="nama" name="nama_costumer" placeholder="Nama Pelanggan" required>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" name="submit" class="btn btn-success">Simpan</button>
			<a href="./admin.php?hlm=transaksi" class="btn btn-danger">Batal</a>
		</div>
	</div>
</form>
<?php
	}
}
?>
<script>

  $(document).ready(function(){

    // $("#jenis").change(function(){
    //   var biaya = $(this).val();
    //   $("#biaya").val(biaya);
    // });

	$("#jenis").change(function(){
      var id_service = $(this).val();
      $("#id_service").val(id_service);

    });

    $("#bayar").keyup(function(){
        var biaya = $("#biaya").val();
        var bayar = $("#bayar").val();
        $("#kembali").val(bayar - biaya);
        $("#total").val(biaya);
    });

  });
</script>
