<?php 
	include('cookie.php');
	include('conn.php');
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
		<!--Main-->
		<main>
			<div class="container">
				<div class="checkout-nav text-center">
					<div class="c-nav-itm active">
						<div class="circle">1</div>
						<p>Shopping Cart</p>
					</div>
					<div class="c-nav-itm active">
						<div class="circle">2</div>
						<p>Checkout</p>
					</div>
					<div class="c-nav-itm">
						<div class="circle">3</div>
						<p>Pay</p>
					</div>
				</div>
				<div class="checkout">
					<h2 class="thin">Invoice ID <?php echo $_COOKIE[$cookie_name]; ?></h2>
					<p class="big">Isi data diri anda</p>
					<form action="chek.php" method="POST">
						<div class="form-cont">
							<label>Nama lengkap</label>
							<input class="form-inp" type="text" placeholder="Nama lengkap" required name="nama">
						</div>
						<div class="form-cont">
							<label>NIM</label>
							<input class="form-inp" type="text" placeholder="NIM" required name="nim">
						</div>
						<div class="form-cont">
							<label>ID Line</label>
							<input class="form-inp" type="text" placeholder="ID Line" required name="line">
						</div>
						<button type="submit" class="btn btn-red" name="submit">Submit</button>
					</form>
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