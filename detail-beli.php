<?php 
	include('cookie.php');
	include('conn.php');
	if(isset($_GET['id'])){
		$id=(int) addslashes($_GET['id']);
		if(!is_int($id)){
			$id=1;
		}
		$id=abs($id);
	}else{
		$id=1;
	}
	$data=mysqli_query($conn,"select * from barang where id_barang=$id and tipe='jual' and stok>0");
	$discount=mysqli_query($conn,"select * from discount where id_barang=$id");
	$jual=mysqli_query($conn,"select * from barang where tipe='jual' and id_barang!=$id and stok>0 limit 0,4");
	function rupiah($angka){
		$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
		return $hasil_rupiah;
	}
	$transaksi=mysqli_query($conn,"select count(*) as jumlah from shop_chart where id_transaksi='$_COOKIE[$cookie_name]'");
	$jumlah=mysqli_fetch_array($transaksi);
	setcookie("id_barang", $id, time() + (86400 * 30), "/");
	setcookie("jenis", "beli", time() + (86400 * 30), "/");
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
		<nav class="bg-red">
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
		<!--Detail Content-->
		<div id="detail" class="content">
			<?php 
				if($rs=mysqli_fetch_array($data)):
			 ?>
			<div class="container">
				<div class="row top">
					<div class="col-100">
						<h1><?php 
							echo $rs['nama'];
						 ?></h1>
					</div>
				</div>
				<div class="row">
					<div class="col-50">
						<img src="admin/upload/<?php echo $rs['gambar'] ?>">
					</div>
					<div class="col-50">
						<?php
							if($rst=mysqli_fetch_array($discount)):
						 ?>
						<h2><strike><?php echo $rs['harga']; ?></strike></h2>
						<h1><?php echo ((100-$rst['persen_disc'])*$rs['harga']/100); ?></h1>
						<?php
							else:
						 ?>
						 <h1><?php echo rupiah($rs['harga']); ?></h1>
						 <?php 
						 	endif;
						  ?>
						<p class="big">Deskripsi</p>
						<p><?php echo $rs['deskripsi']; ?></p>
						<p class="big">Jumlah beli</p>
						<form action="transaksi.php" method="POST">
							<input type="number" min="1" class="form-inp" placeholder="Jumlah Beli" required="" name="jmlh">
							<input type="hidden" name="id" value="<?php echo $rs['id_barang'] ?>">
							<input type="submit" value="Masukkan ke shopping cart" class="btn btn-red" name="submit">
						</form>
					</div>
				</div>
			</div>
			<?php 
				endif;
			 ?>
		</div>
		<!--End Detail Content-->
		<!--Other-->
		<div id="other" class="content">
			<div class="container">
				<div class="row top">
					<div class="col-50">
						<h1>Produk lain</h1>
					</div>
					<div class="col-50 text-right">
						<a href="barang.php?id=jual" class="link">lihat semua barang</a>
					</div>
				</div>
				<div class="row text-center">
					<?php 
						foreach ($jual as $key):
					 ?>
					<div class="col-25">
						<div class="items">
							<img src="admin/upload/<?php echo $key['gambar'] ?>">
							<p class="big"><?php echo $key['nama']; ?></p>
							<p><?php echo rupiah($key['harga']); ?></p>
							<a href="detail-beli.php?id=<?php echo $key['id_barang'] ?>"></a>
						</div>
					</div>
					<?php 
						endforeach;
					 ?>
				</div>
			</div>
		</div>
		<!--End Other-->
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