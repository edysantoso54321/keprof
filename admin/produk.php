<?php 
	require 'function.php';
	
	if(isset($_POST["submit"])){
		if(tambah($_POST) > 0 ){
            echo "
                <script>
                alert('data berhasil Ditambah');
                document.location.href = 'produk.php';
                </script>
            ";
        }else{
            echo "
                <script>
                alert('Data Gagal Ditambah');
                document.location.href = 'produk.php';
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
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	
	<body>
		<?php 
			$jumlahDataPerhalaman = 10;
			$jumlahData = count(query("SELECT * FROM barang"));
			$jumlahHalaman = ceil($jumlahData/$jumlahDataPerhalaman);

			if(isset($_GET["halaman"])){
				$halamanAktif = $_GET["halaman"];
			}else{
				$halamanAktif =1;
			}

			$awalData = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;
			

			$brg = query("SELECT * FROM barang LIMIT $awalData, $jumlahDataPerhalaman");

			if(isset($_POST["cari"])){
				$brg = cari($_POST["keyword"]);
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
						<li class="active">Product</li>
						<li><a href="harga.php">Harga</a></li>
						<li><a href="order.php">Order</a></li>
					</ul>
				</aside>
				<div id="content" class="col-80">
					
				<button id="myBtn" class="btn">Tambah Produk</button>
				<br><br>
				<form action="" method="post">
					<input type="text" placeholder="Masukkan Keyword Pencarian" style="width: 30%;" name="keyword" autofocus autocomplete="off">
					<button class="btn" style="height: 40px;" type="submit" name="cari">Search</button>
				</form>
				


					<div id="myModal" class="modal">
						<div class="modal-content">
							<span class="close">&times;</span>
							<form action="" method="post" enctype="multipart/form-data">

								<label for="fname">Nama Barang</label>
								<input type="text" id="fname" name="namaBarang" placeholder="Nama Barang">

								<label for="lname">Harga</label>
								<input type="text" id="lname" name="harga" placeholder="Masukkan Harga Dalam Rupiah">
								
								<label for="tipe">Tipe</label>
									<select id="tipe" name="tipeBarang">
										<option value="sewa">Sewa</option>
										<option value="jual">Jual</option>
									</select>
								
								<label for="gbr">Foto Barang</label>
								<input type="file" id="gbr" name="gbr">
								<br>
								
								<input type="text" id="lname" name="stok" placeholder="Masukkan Stok yang tersisa">

								<label for="gbr">Deskripsi Barang</label>
								<textarea name="desc" cols="30" rows="10" placeholder="Tambahkan Deskripsi Barang"></textarea>
					
								<input type="submit" value="Submit" name="submit" id="ins">
							</form>					
						</div>
					</div>
					<br><br>
					<table class="table">
					<tr>
						<th>Nama Barang</th>
						<th>Harga</th>
						<th>Tipe Transaksi</th>
						<th>Stok</th>
						<th>Action</th>
					</tr>
					<?php foreach ($brg as $key) { ?>
						<tr>
							<td><?= $key['nama']; ?></td>
							<td><?= $key['harga']; ?></td>
							<td><?= $key['tipe']; ?></td>
							<td><?= $key['stok']; ?></td>
							<td><a href="hapus.php?id_barang=<?= $key["id_barang"];?>" onclick="return confirm('Yakin Ingin Menghapus ?')">Hapus</a> | <a href="edit.php?id_barang=<?= $key["id_barang"];?>">Edit</a> | <a href="view.php?id_barang=<?= $key["id_barang"];?>">View</a></td>
						</tr>
					<?php } ?>
					
				</table>
				<div class="pagination">
					<?php if($halamanAktif > 1): ?>
					<a href="?halaman=<?= $halamanAktif-1?>">&laquo;</a>
					<?php endif; ?>

						<?php for($i = 1; $i <= $jumlahHalaman; $i++ ) : ?>
							<?php if($i==$halamanAktif): ?>
								<a href="?halaman=<?=$i;?>" class="active"><?=$i; ?></a>
							<?php else: ?>
								<a href="?halaman=<?=$i;?>"><?=$i; ?></a>
							<?php endif; ?>
						<?php endfor; ?>
					<?php if($halamanAktif < $jumlahHalaman): ?>
						<a href="?halaman=<?= $halamanAktif+1?>">&raquo;</a>
					<?php endif; ?>
				</div>
			</div>
		</main>
		<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
	</body>
</html>