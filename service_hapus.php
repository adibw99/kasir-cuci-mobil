<?php
if( empty( $_SESSION['id_user'] ) ){

	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {

if(isset($_REQUEST['submit'])){

    $id_service = $_REQUEST['id_service'];

    $sql = mysqli_query($koneksi, "DELETE FROM service WHERE id_service='$id_service'");
    if($sql == true){
        header("Location: ./admin.php?hlm=biaya");
        die();
    }
    }
}
?>
