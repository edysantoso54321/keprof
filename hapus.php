<?php 
	include('cookie.php');
	include('conn.php');
	if(isset($_GET['id'])){
		$id_barang=addslashes($_GET['id']);
		mysqli_query($conn,"delete from shop_chart where id_transaksi='$_COOKIE[$cookie_name]' and id_barang=$id_barang");
		header ("Location: shopping-cart.php");
	}else{
		header ("Location: index.php");
	}
 ?>