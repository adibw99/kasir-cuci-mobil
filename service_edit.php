<?php
if( empty( $_SESSION['id_user'] ) ){

	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {

	if( isset( $_REQUEST['submit'] )){

		$id_service = $_REQUEST['id_service'];
		$jenis_kendaraan = $_REQUEST['jenis_kendaraan'];
		$biaya = $_REQUEST['biaya'];

		$sql = mysqli_query($koneksi, "UPDATE service SET jenis_kendaraan='$jenis_kendaraan', biaya='$biaya' WHERE id_service='$id_service'");

		if($sql == true){
			header('Location: ./admin.php?hlm=biaya');
			die();
		} else {
			echo 'ERROR! Periksa penulisan querynya.';
		}
	} else {

		$id_service = $_REQUEST['id_service'];

		$sql = mysqli_query($koneksi, "SELECT * FROM service WHERE id_service='$id_service'");
		while($row = mysqli_fetch_array($sql)){

?>
<h2>Edit Data Master total Jasa</h2>
<hr>
<form method="post" action="" class="form-horizontal" role="form">
	<div class="form-group">
		<label for="jenis" class="col-sm-2 control-label">Jenis Kendaraan</label>
		<div class="col-sm-4">
			<input type="hidden" name="id_total" value="<?php echo $row['id_total']; ?>">
			<input type="text" class="form-control" id="jenis" value="<?php echo $row['jenis_kendaraan']; ?>" name="jenis_kendaraan" placeholder="Jenis Kendaraan" required>
		</div>
	</div>
	<div class="form-group">
		<label for="biaya" class="col-sm-2 control-label">total Jasa</label>
		<div class="col-sm-3">
			<input type="number" class="form-control" id="biaya" value="<?php echo $row['biaya']; ?>" name="biaya" placeholder="total Jasa" required>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" name="submit" class="btn btn-success">Simpan</button>
			<a href="./admin.php?hlm=biaya" class="btn btn-danger">Batal</a>
		</div>
	</div>
</form>
<?php

	}
	}
}
?>
