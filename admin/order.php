<?php 
	require "function.php";
	
?>
<!DOCTYPE html>
<html>
    <head>
		<link type="text/css" rel="stylesheet" href="css/style.css"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>Admin</title>
	</head>
	
	<body>
	<?php 
			$jumlahDataPerhalaman = 10;
			$jumlahData = count(query("SELECT * FROM formulir"));
			$jumlahHalaman = ceil($jumlahData/$jumlahDataPerhalaman);

			if(isset($_GET["page"])){
				$halamanAktif = $_GET["page"];
			}else{
				$halamanAktif =1;
			}

			$awalData = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;
			

			$pay = query("SELECT * from formulir LIMIT $awalData, $jumlahDataPerhalaman");
			if(isset($_POST["cari"])){
				$pay = cariOrder($_POST["keyword"]);
			}
			
		?>
		<nav>
			<a class="logo" href="index.php"><img src="img/alfath2.png"></a>
			<div class="nav-mobile"><a id="nav-toggle" href="#!"><span></span></a></div>
			<ul>
				<li><a href="home.php">Home</a></li>
			</ul>
		</nav>
		<main>
			<div class="row">
				<aside class="col-20">
					<ul>
						<li><a href="produk.php">Product</a></li>
						<li><a href="harga.php">Harga</a></li>
						<li class="active"><a href="order.php">Order</a></li>
					</ul>
				</aside>
				<div id="content" class="col-80">
				<h3>Daftar Orderan</h3>
					<form action="" method="post">
						<input type="text" placeholder="Masukkan Keyword Pencarian" style="width: 30%;" name="keyword" autofocus autocomplete="off">
						<button class="btn" style="height: 40px;" type="submit" name="cari">Search</button>
					</form>
				<table class="table">
						<tr>	
							<th>ID Transaksi</th>
							<th>Nama</th>
							<th>Nim</th>
							<th>Id Line</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
						
						<?php foreach ($pay as $row) { ?>
							<tr>
								<td><?= $row["id_transaksi"];?></td>
								<td><?= $row["nama"]; ?></td>
								<td><?= $row["nim"]; ?></td>
								<td><?= $row["id_line"]; ?></td>
								<td><?= $row["status"]; ?></td>
								<td> <a href="upPayment.php?id_form=<?= $row["id_transaksi"];?>">Update Payment</a></td>
							<tr>
						<?php } ?>
						
					</table>
						<div class="pagination">
							<?php if($halamanAktif > 1): ?>
							<a href="?page=<?= $halamanAktif-1?>">&laquo;</a>
							<?php endif; ?>

								<?php for($i = 1; $i <= $jumlahHalaman; $i++ ) : ?>
									<?php if($i==$halamanAktif): ?>
										<a href="?page=<?=$i;?>" class="active"><?=$i; ?></a>
									<?php else: ?>
										<a href="?page=<?=$i;?>"><?=$i; ?></a>
									<?php endif; ?>
								<?php endfor; ?>
							<?php if($halamanAktif < $jumlahHalaman): ?>
								<a href="?page=<?= $halamanAktif+1?>">&raquo;</a>
							<?php endif; ?>
						</div>
				</div>
			</div>
		</main>
		<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
	</body>
</html>