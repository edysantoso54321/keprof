<?php 
	include('cookie.php');
	include('conn.php');
	if(isset($_POST['submit'])){
		if(isset($_POST['id']) && isset($_POST['jmlh'])){
			if($_POST['id']==$_COOKIE['id_barang']){
				$jmlh=addslashes($_POST['jmlh']);
				$id_barang=addslashes($_COOKIE['id_barang']);
				$id_transaksi=addslashes($_COOKIE[$cookie_name]);
				setcookie("id_barang",null, time() + (86400 * 30), "/");
				unset($_COOKIE['id_barang']);
				if(isset($_COOKIE['jenis']) && $_COOKIE['jenis']=='beli'){
					mysqli_query($conn,"insert into shop_chart values($jmlh,0,$id_barang,'','$id_transaksi')");
					setcookie("jenis",null, time() + (86400 * 30), "/");
					unset($_COOKIE['jenis']);
					echo "insert into shop_chart values($jmlh,0,'$id_barang','','$id_transaksi')";
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