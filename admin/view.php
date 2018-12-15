<?php 
    require "function.php";
    $id = $_GET["id_barang"];
    $brg = query("SELECT * FROM barang WHERE id_barang = $id")[0];
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
				<li><a href="home.php">Home</a></li>
			</ul>
			
				
			
		</nav>
		<main>
			<div class="row">
				<aside class="col-20">
					<ul>
						<li  class="active"><a href="produk.php">Product</a></li>
						<li><a href="harga.php">Harga</a></li>
						<li><a href="order.php">Order</a></li>
						<li><a href="index.php">LogOut</a></li>
					</ul>
				</aside>
				<div id="content" class="col-80">
					<p><strong>Nama Barang : </strong> <?= $brg["nama"]; ?></p>
                    <p><strong>Harga Barang : </strong> <?= $brg["harga"]; ?></p>
                    <p><strong>Tipe Barang : </strong> <?= $brg["tipe"]; ?></p>
                    <p><strong>Stock Barang : </strong> <?= $brg["stok"]; ?></p>
                    <p><strong>Deskripsi : </strong> <?= $brg["deskripsi"]; ?></p>
                    <p><strong>Gambar Produk</strong></p>
                    <p><img src="upload/<?= $brg["gambar"]?>" alt=""></p>
                    
                    <a class="btn" href="hapus.php?id_barang=<?= $brg["id_barang"];?>" onclick="return confirm('Yakin Ingin Menghapus ?')">Hapus</a>
                    <a class="btn" href="edit.php?id_barang=<?= $brg["id_barang"];?>">Edit</a>
                                        
				</div>
			</div>
		</main>
		<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
	</body>
</html>