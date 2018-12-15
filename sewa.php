<?php 
	include('cookie.php');
	include('conn.php');
	if(isset($_POST['submit'])){
		if(isset($_POST['tanggal']) && isset($_POST['lama']) && isset($_POST['id'])){
			if($_POST['id']==$_COOKIE['id_barang']){
				$lama=addslashes($_POST['lama']);
				$id_barang=addslashes($_COOKIE['id_barang']);
				$id_transaksi=addslashes($_COOKIE[$cookie_name]);
				$tanggal=explode("/", $_POST['tanggal'])[0];
				$bulan=explode("/", $_POST['tanggal'])[1];
				$tahun=explode("/", $_POST['tanggal'])[2];
				setcookie("id_barang",null, time() + (86400 * 30), "/");
				unset($_COOKIE['id_barang']);
				if(isset($_COOKIE['jenis']) && $_COOKIE['jenis']=='sewa'){
					mysqli_query($conn,"insert into shop_chart values(0,$lama,$id_barang,'$tahun-$bulan-$tanggal','$id_transaksi')");
					setcookie("jenis",null, time() + (86400 * 30), "/");
					unset($_COOKIE['jenis']);
					header ("Location: shopping-cart.php");
				}else{
					header ("Location: index.php");	
				}
			}else{
				header ("Location: index.php");
			}
		}else{
			header ("Location: index.php");
		}
	}else{
		header ("Location: index.php");
	}
 ?>