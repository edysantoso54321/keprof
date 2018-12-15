<?php 
	require "function.php";
	$tes = query("SELECT id_barang,nama
	from barang
	where id_barang not in (select id_barang from discount)");
	if(isset($_POST["submit"])){
		if(tambahDisc($_POST) > 0 ){
            echo "
                <script>
                alert('data berhasil Ditambah');
                document.location.href = 'harga.php';
                </script>
            ";
        }else{
            echo "
                <script>
                alert('Data Gagal Ditambah');
                document.location.href = 'harga.php';
                </script>
            ";
		}
		
	}

	

	
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
			$jumlahData = count(query("SELECT * FROM barang JOIN discount USING(id_barang)"));
			$jumlahHalaman = ceil($jumlahData/$jumlahDataPerhalaman);

			if(isset($_GET["page"])){
				$halamanAktif = $_GET["page"];
			}else{
				$halamanAktif =1;
			}

			$awalData = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;
			

			$brg = query("SELECT * FROM barang JOIN discount USING(id_barang) LIMIT $awalData, $jumlahDataPerhalaman");
			if(isset($_POST["cari"])){
				$brg = cariDisc($_POST["keyword"]);
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
						<li class="active"><a href="harga.php">Harga</a></li>
						<li><a href="order.php">Order</a></li>
					</ul>
				</aside>
				<div id="content" class="col-80">
					<form action="" method="post">
					
						<select id="brg" name="barang">
						<?php foreach ($tes as $key) { ?>
							<option value="<?=$key['id_barang']?>"><?=$key["nama"]?></option>
						<?php } ?>
						</select>
						
						<input type="text" name="disc" placeholder="Masukkan persen diskon">

						<input class="disc" type="submit" value="Tambahkan Discount" name="submit">
					</form>
					
					<br><br>
					<h3>Daftar Barang yang sudah di Discount</h3>
					<form action="" method="post">
						<input type="text" placeholder="Masukkan Keyword Pencarian" style="width: 30%;" name="keyword" autofocus autocomplete="off">
						<button class="btn" style="height: 40px;" type="submit" name="cari">Search</button>
					</form>
					<table class="table">
						<tr>
							<th>Nama Barang</th>
							<th>Diskon</th>
							<th>Action</th>
						</tr>
						
						<?php foreach ($brg as $row) { ?>
							<tr>
								<td><?= $row["nama"]; ?></td>
								<td><?= $row["persen_disc"]; ?></td>
								<td><a href="hapusDis.php?id_barang=<?= $row["id_barang"];?>" onclick="return confirm('Yakin Ingin Menghapus ?')">Hapus</a> | <a href="editDis.php?id_barang=<?= $row["id_barang"];?>">Edit</a></td>
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
			</div>
		</main>
		<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
	</body>
</html>