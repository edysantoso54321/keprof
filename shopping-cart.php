<?php
	function rupiah($angka){
		$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
		return $hasil_rupiah;
	}
	include('cookie.php');
	include('conn.php');
	$transaksi=mysqli_query($conn,"select count(*) as jumlah from shop_chart where id_transaksi='$_COOKIE[$cookie_name]'");
	$jumlah=mysqli_fetch_array($transaksi);
	$data=mysqli_query($conn,"select jumlah,nama,harga,tipe,gambar,id_barang,tgl_peminjaman,durasi_sewa from shop_chart join barang using (id_barang) where id_transaksi='$_COOKIE[$cookie_name]'");
	$total=mysqli_query($conn,"select sum(harga*jumlah) as total from shop_chart join barang using (id_barang) where id_transaksi='$_COOKIE[$cookie_name]'");
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
		<!--Main-->
		<main>
			<div class="container">
				<div class="checkout-nav text-center">
					<div class="c-nav-itm active">
						<div class="circle">1</div>
						<p>Shopping Cart</p>
					</div>
					<div class="c-nav-itm">
						<div class="circle">2</div>
						<p>Checkout</p>
					</div>
					<div class="c-nav-itm">
						<div class="circle">3</div>
						<p>Pay</p>
					</div>
				</div>
				<div class="row">
					<h1 class="thin">Invoice ID <?php echo $_COOKIE[$cookie_name]; ?></h1>
				</div>
				<div class="cart">
					<div class="cart-itm-ctr">
						<?php foreach ($data as $key): ?>
						<?php if($key['tipe']=='sewa'): ?>
						<div class="row cart-itm">
							<div class="col img">
								<img src="admin/upload/<?php echo $key['gambar'] ?>">
							</div>
							<div class="col inf">
								<p class="big"><?php echo $key['nama']; ?></p>
								<p><?php echo $key['tgl_peminjaman']." (".$key['durasi_sewa'].")"; ?></p>
								<div class="prc-mobile">
									<p>Rp123 x 2 hari</p>
									<p class="big">Rp12345</p>
								</div>
							</div>
							<div class="col prc">
								<p><?php echo rupiah($key['harga']); ?> x <?php echo $key['durasi_sewa']; ?></p>
								<h1><?php echo rupiah(($key['harga']*$key['durasi_sewa'])); ?></h1>
							</div>
							<div class="cancel">
								<a href="hapus.php?id=<?php echo $key['id_barang'] ?>"><i class="fa fa-times"></i> hapus dari shopping cart</a>
							</div>
						</div>
						<?php else: ?>
						<div class="row cart-itm">
							<div class="col img">
								<img src="admin/upload/<?php echo $key['gambar'] ?>">
							</div>
							<div class="col inf">
								<p class="big"><?php echo $key['nama']; ?></p>
								<p>Jumlah beli = <?php echo $key['jumlah']; ?></p>
								<div class="prc-mobile">
									<p>Rp123 x 2</p>
									<p class="big">Rp12345</p>
								</div>
							</div>
							<div class="col prc">
								<p><?php echo rupiah($key['harga']); ?> x <?php echo $key['jumlah']; ?></p>
								<h1><?php echo rupiah(($key['harga']*$key['jumlah'])); ?></h1>
							</div>
							<div class="cancel">
								<a href="hapus.php?id=<?php echo $key['id_barang'] ?>"><i class="fa fa-times"></i> hapus dari shopping cart</a>
							</div>
						</div>
						<?php endif; ?>
						<?php endforeach; ?>
					</div>
					<div class="line"></div>
					<div class="total-ctr text-right">
						<div class="total">
							<h2>Grand Total</h2>
							<h1><?php 
								if($total=mysqli_fetch_array($total)){
									echo rupiah($total['total']);
								}else{
									echo rupaih(0);
								}
							 ?></h1>
						</div>
					</div>
					<div class="row btn-ctr">
						<div class="col">
							<a href="index.php" class="btn btn-continue">Go back</a>
						</div>
						<div class="col text-right">
							<a href="checkout.php" class="btn btn-proceed">Proceed to checkout</a>
						</div>
					</div>
				</div>
			</div>
		</main>
		<!--End Main-->
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