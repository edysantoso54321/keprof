<?php 
	require "function.php";
	$jmlProduk = count(query("SELECT * FROM barang"));
	$jmlDiscount = count(query("SELECT * FROM discount"));
	$jmlOrder = count(query("SELECT* FROM formulir"));
?>
<!DOCTYPE html>
<html>
    <head>
		<link type="text/css" rel="stylesheet" href="css/style.css"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>Admin</title>
	</head>
	
	<body>
		<nav>
			<a class="logo" href="index.php"><img src="img/alfath2.png"></a>
			<div class="nav-mobile"><a id="nav-toggle" href="#!"><span></span></a></div>
			<ul>
				<li class="active"><a href="home.php">Home</a></li>
			</ul>
			
				
			
		</nav>
		<main>
			<div class="row">
				<aside class="col-20">
					<ul>
						<li><a href="produk.php">Product</a></li>
						<li><a href="harga.php">Harga</a></li>
						<li><a href="order.php">Order</a></li>
						<li><a href="index.php">LogOut</a></li>
					</ul>
				</aside>
				<div id="content" class="col-80">
					<h2>Welcome Admin</h2>
					<div class="line"></div>
					<h3>Produk Saat Ini</h3>
					<table class="table">
						<tr>
							<th>Kategori</th>	
							<th>Keadaan</th>
						</tr>
						<tr>
							<td>Jumlah Produk yang Sedang Di iklankan</td>
							<td><?= $jmlProduk ?></td>
						</tr>
						<tr>
							<td>Jumlah Produk yang Sedang Discount</td>
							<td><?= $jmlDiscount ?></td>
						</tr>
						<tr>
							<td>Jumlah Orderan</td>
							<td><?= $jmlOrder ?></td>
						</tr>
						
					</table>
				</div>
			</div>
		</main>
		<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
	</body>
</html>