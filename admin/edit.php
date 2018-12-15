<?php 
    require 'function.php';
    $id = $_GET["id_barang"];
    $brg = query("SELECT * FROM barang WHERE id_barang = $id")[0];

    if(isset($_POST["submit"])){
        if(ubah($_POST) > 0 ){
            echo "
                <script>
                alert('data berhasil diubah');
                document.location.href = 'produk.php';
                </script>
            ";
        }else{
            echo "
                <script>
                alert('Data Gagal Diubah');
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
						<li class="active"><a href="produk.php">Product</a></li>
						<li><a href="harga.php">Harga</a></li>
						<li><a href="order.php">Order</a></li>
					</ul>
				</aside>
				<div id="content" class="col-80">
                <h3>Edit Barang <?=$brg["nama"]?></h3>
                <form action="" method="post" enctype="multipart/form-data">
                <div class="line"></div>
                    <label for="fname">Nama Barang</label>
                    <input type="text" id="fname" name="namaBarang" placeholder="Nama Barang" value="<?= $brg["nama"]?>">

                    <label for="lname">Harga</label>
                    <input type="text" id="lname" name="harga" placeholder="Masukkan Harga Dalam Rupiah" value="<?= $brg["harga"]?>">

                    <label for="tipe">Tipe</label>
                        <select id="tipe" name="tipeBarang" required>
                            <option value="<?=$brg["tipe"]?>"> <?=$brg["tipe"]?> </option>
                            <option value="sewa">Sewa</option>
                            <option value="jual">Jual</option>
                        </select>

                    <label for="gbr">Foto Barang</label>
                    <img src="upload/<?=$brg['gambar']?>" width="70">
                    <input type="file" id="gbr" name="gbr">
                    <br>
                    <div class="line"></div>
                    <label for="lname">Stok</label>
                    <input type="text" id="lname" name="stok" placeholder="Masukkan Stok yang tersisa" value="<?= $brg["stok"]?>">
                    <input type="hidden" value="<?=$brg["id_barang"]?>" name="id_barang">
                    <input type="hidden" value="<?=$brg["gambar"]?>" name="gbr_lama">
                    <label for="gbr">Deskripsi Barang</label>
					<textarea name="desc" cols="30" rows="10" placeholder="Tambahkan Deskripsi Barang"><?=$brg["deskripsi"];?></textarea>

                    <input type="submit" value="Edit Data" name="submit" id="ins">
                    </form>			
				</div>
			</div>
		</main>
		<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
	</body>
</html>