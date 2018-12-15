<?php 
	include('cookie.php');
	include('conn.php');
	$jual=mysqli_query($conn,"select * from barang where tipe='jual' and stok>0 limit 0,4");
	$sewa=mysqli_query($conn,"select * from barang where tipe='sewa' limit 0,4");
	$transaksi=mysqli_query($conn,"select count(*) as jumlah from shop_chart where id_transaksi='$_COOKIE[$cookie_name]'");
	$jumlah=mysqli_fetch_array($transaksi);
	function rupiah($angka){
		$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
		return $hasil_rupiah;
	}
 ?>
<!DOCTYPE html>
<html>
    <head>
		<link type="text/css" rel="stylesheet" href="css/style.css"/>
		<link type="text/css" rel="stylesheet" href="css/font-awesome.min.css"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>Al-Fath Store</title>
	</head>
	<body>
		<!--Navbar-->
		<nav>
			<div class="container">
				<div class="logo">
					<a href="index.php"><img src="img/logo.png"></a>
				</div>
				<div class="sc">
					<a href="shopping-cart.php">
						<i class="fa fa-shopping-cart fa-3x"></i>
						<?php 
							if($jumlah['jumlah']!=0):
						 ?>
						<span class="circle"><?php echo $jumlah['jumlah']; ?></span>
						<?php 
							endif;
						 ?>
					</a>
				</div>
			</div>
		</nav>
		<!--End Navbar-->
		<!--Header-->
		<header>
			<div class="container">
				<h1>Al-Fath Store</h1>
				<p></p>
				<div class="btn-ctr">
					<a class="btn btn-red" href="#buy">Beli</a>
					<a class="btn btn-red" href="#rent">Sewa</a>
				</div>
			</div>
		</header>
		<!--End Header-->
		<!--How It Works-->
		<div id="how" class="content">
			<div class="container">
				<div class="row top">
					<div class="col-100">
						<h1>Cara Kerja</h1>
					</div>
				</div>
				<div class="row text-center">
					<div class="col-33">
						<img src="img/1.png">
						<p class="big">Cara</p>
						<p>Penjelasan</p>
					</div>
					<div class="col-33">
						<img src="img/2.png">
						<p class="big">Cara</p>
						<p>Penjelasan</p>
					</div>
					<div class="col-33">
						<img src="img/3.png">
						<p class="big">Cara</p>
						<p>Penjelasan</p>
					</div>
				</div>
			</div>
		</div>
		<!--End How It Works-->
		<!--Buy-->
		<div id="buy" class="content">
			<div class="container">
				<div class="row top">
					<div class="col-50">
						<h1>Barang Dijual</h1>
					</div>
					<div class="col-50 text-right">
						<a href="barang.php?id=jual" class="link">lihat semua barang</a>
					</div>
				</div>
				<div class="row text-center">
					<?php foreach ($jual as $key):?>
					<div class="col-25">
						<div class="items">
							<?php 
								$string="admin/upload/".$key['gambar'];
								echo "<img src='$string'>";
							 ?>
							<p class="big"><?php 
								echo $key['nama'];
							 ?></p>
							<p><?php 
								echo rupiah($key['harga']);
							 ?></p>
							<a href="detail-beli.php?id=<?php echo $key['id_barang'] ?>"></a>
						</div>
					</div>
					<?php 
						endforeach;
					 ?>
				</div>
			</div>
		</div>
		<!--End Buy-->
		<!--Rent-->
		<div id="rent" class="content">
			<div class="container">
				<div class="row top">
					<div class="col-50">
						<h1>Barang Disewakan</h1>
					</div>
					<div class="col-50 text-right">
						<a href="barang.php?id=sewa" class="link">lihat semua barang</a>
					</div>
				</div>
				<div class="row text-center">
					<?php foreach ($sewa as $key):?>
					<div class="col-25">
						<div class="items">
							<?php 
								$string="admin/upload/".$key['gambar'];
								echo "<img src='$string'>";
							 ?>
							<p class="big"><?php 
								echo $key['nama'];
							 ?></p>
							<p><?php 
								echo rupiah($key['harga']);
							 ?></p>
							<a href="detail-sewa.php?id=<?php echo $key['id_barang'] ?>"></a>
						</div>
					</div>
					<?php 
						endforeach;
					 ?>
				</div>
			</div>
		</div>
		<!--End Rent-->
		<!--Footer-->
		<footer>
			<div class="container">
				<div class="left"><p>Copyright &copy 2018</p></div>
				<div class="right">
					<a href="#"><span class="fa-stack fa-lg facebook">
						<i class="fa fa-circle fa-stack-2x"></i>
						<i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
					</span></a>
					<a href="#"><span class="fa-stack fa-lg instagram">
						<i class="fa fa-circle fa-stack-2x"></i>
						<i class="fa fa-instagram fa-stack-1x fa-inverse"></i>
					</span></a>
					<a href="#"><span class="fa-stack fa-lg pinterest">
						<i class="fa fa-circle fa-stack-2x"></i>
						<i class="fa fa-pinterest fa-stack-1x fa-inverse"></i>
					</span></a>
					<a href="#"><span class="fa-stack fa-lg twitter">
						<i class="fa fa-circle fa-stack-2x"></i>
						<i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
					</span></a>
				</div>
			</div>
		</footer>
		<!--End Footer-->
		<!--Javascript-->
		<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
	</body>
</html>