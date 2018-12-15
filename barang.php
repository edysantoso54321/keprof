<?php 
	include('cookie.php');
	include('conn.php');
	function rupiah($angka){
		$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
		return $hasil_rupiah;
	}
	if(isset($_GET['id'])){
		$id=$_GET['id'];
		if($id=="jual"){
			$data=mysqli_query($conn,"select * from barang where tipe='jual' and stok>0");
			$id='beli';
		}else{
			$data=mysqli_query($conn,"select * from barang where tipe='sewa'");
			$id='sewa';
		}
	}else{
		$data=mysqli_query($conn,"select * from barang where tipe='jual' and stok>0");
		$id='beli';
	}
	$transaksi=mysqli_query($conn,"select count(*) as jumlah from shop_chart where id_transaksi='$_COOKIE[$cookie_name]'");
	$jumlah=mysqli_fetch_array($transaksi);
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
		<!--Items-->
		<div id="items" class="content">
			<div class="container">
				<div class="row top">
					<div class="col-100">
						<h1><?php 
							if($id=='beli'){
								echo "Barang Dijual";
							}else{
								echo "Barang Disewakan";
							}
						 ?></h1>
					</div>
				</div>
				<div class="row text-center">
					<?php 
					foreach ($data as $key):
				 	?>
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
							<a href="detail-<?php echo $id ?>.php?id=<?php echo $key['id_barang'] ?>"></a>
						</div>
					</div>
					<?php 
						endforeach;
					 ?>
				</div>
			</div>
		</div>
		<!--End Items-->
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