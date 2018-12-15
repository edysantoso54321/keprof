<?php 
    require 'function.php';
    $id = $_GET["id_form"];
    $pay = query("SELECT * FROM formulir WHERE id_transaksi = '$id'")[0];
    
   
    if(isset($_POST["submit"])){
        if(ubahPayment($_POST) > 0 ){
            echo "
                <script>
                alert('data berhasil diubah');
                document.location.href = 'order.php';
                </script>
            ";
        }else{
            echo "
                <script>
                alert('Data Gagal Diubah');
                document.location.href = 'order.php';
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
						<li ><a href="harga.php">Harga</a></li>
						<li class="active"><a href="order.php">Order</a></li>
					</ul>
				</aside>
				<div id="content" class="col-80">
                
               
                
                
                    <label for="fname">Id Formulir</label>
                    <input type="text" id="fname" name="id_transaksi" placeholder="Nama Barang" value="<?= $pay["id_transaksi"]?>" disabled>

                     <label for="fname">Nama</label>
                    <input type="text" id="fname" name="namaBarang" placeholder="Nama Barang" value="<?= $pay["nama"]?>" disabled>
                    <label for="fname">Nim</label>
                    <input type="text" id="fname" name="namaBarang" placeholder="Nama Barang" value="<?= $pay["nim"]?>" disabled>
                    <label for="fname">Id Line</label>
                    <input type="text" id="fname" name="namaBarang" placeholder="Nama Barang" value="<?= $pay["id_line"]?>" disabled>
                    

                    <form action="" method="post" enctype="multipart/form-data">
                        <label for="fname">Status</label>
                        <input type="text" id="fname" name="stat" placeholder="Nama Barang" value="<?= $pay["status"]?>">
                        <input type="hidden" value="<?= $pay["id_transaksi"]?>" name="id_form">
                        <input type="submit" value="Edit Data" name="submit" id="ins">
                    </form>			
				</div>
			</div>
		</main>
		<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
	</body>
</html>