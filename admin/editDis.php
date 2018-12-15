<?php 
    require 'function.php';
    $id = $_GET["id_barang"];
    $brg = query("SELECT * FROM discount WHERE id_barang = $id")[0];
    $query = query("SELECT * FROM barang JOIN discount USING(id_barang) WHERE id_barang=$id")[0];

    if(isset($_POST["submit"])){
        if(ubahDis($_POST) > 0 ){
            echo "
                <script>
                alert('data berhasil diubah');
                document.location.href = 'harga.php';
                </script>
            ";
        }else{
            echo "
                <script>
                alert('Data Gagal Diubah');
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
		<nav>
			<a class="logo" href="index.php"><img src="img/alfath2.png"></a>
			<div class="nav-mobile"><a id="nav-toggle" href="#!"><span></span></a></div>
			<ul>
				<li><a href="index.php">Home</a></li>
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
                
               
                <label for="fname">Nama Barang</label>
                <input type="text" id="fname" name="namaBarang" placeholder="Nama Barang" value="<?= $query["nama"]?>" disabled>
                <form action="" method="post" enctype="multipart/form-data">
                     <label for="fname">Persen Dicount</label>
                     <input type="text" name="disc" placeholder="Masukkan persen diskon" value="<?= $brg["persen_disc"]?>">
                    <input type="hidden" name="id_barang" value="<?=$brg["id_barang"]?>">
                    <input type="submit" value="Edit Data" name="submit" id="ins">
                    </form>			
				</div>
			</div>
		</main>
		<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
	</body>
</html>