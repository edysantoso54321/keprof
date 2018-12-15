<?php 
	include('cookie.php');
	include('conn.php');
	if(isset($_POST['submit']) && isset($_POST['nama']) && isset($_POST['nim']) && isset($_POST['line'])){
		$id_transaksi=addslashes($_COOKIE[$cookie_name]);
		$nama=addslashes($_POST['nama']);
		$nim=addslashes($_POST['nim']);
		$line=addslashes($_POST['line']);
		mysqli_query($conn,"insert into formulir values('$nama',$nim,'$line','$id_transaksi','kredit')");
		header("Location: pay.php");
	}else{
		header("Location: index.php");
	}
 ?>