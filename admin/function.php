<?php 
    $conn = mysqli_connect("localhost","root","","store");

    function query($query){
		global $conn;

		$result = mysqli_query($conn, $query);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}

		return $rows;

    }
    function tambah($data){
        global $conn;
        $nama =  $data["namaBarang"];
		$harga = $data["harga"];
		$tipe = $data["tipeBarang"];
        $stok = $data["stok"];
        $des = $data["desc"];
        
        $gambar = upload();
        if(!$gambar){
            return false;
        }

        $query = "INSERT INTO barang(nama,gambar,harga,tipe,stok,deskripsi) VALUES ('$nama','$gambar','$harga','$tipe','$stok','$des')";

        
		mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
		
    }

    function upload(){
        $namaFile = $_FILES['gbr']['name'];
        $ukuranFile= $_FILES['gbr']['size'];
        $error = $_FILES['gbr']['error'];
        $tmpName = $_FILES['gbr']['tmp_name'];

        //cek gambar tidak diupload
        if($error ===4 ){
            echo "
                <script>
                alert('pilih gambar terlebih dahulu');
                </script>
            ";
            return false;
        }
        //Cek apakah yang diupload adalah gambar
        $ekstensiGambarValid = ['jpg','jpeg','png'];
        $ekstensiGambar = explode('.',$namaFile);
        $ekstensiGambar = strtolower(end($ekstensiGambar));

        if( !in_array($ekstensiGambar,$ekstensiGambarValid) ){
            echo "
                <script>
                alert('Yang anda upload bukan gambar');
                </script>
            ";
            return false;
        }
        //cek jika ukuran terlalu besar 10MB
        if($ukuranFile > 10000000){
            echo "
                <script>
                alert('Ukuran gambar harus dibawah 10MB');
                </script>
            ";
            return false;
        }

        //lolos seleksi

        //generate nama baru
        $namaFileBaru = uniqid();
        $namaFileBaru.= '.';
        $namaFileBaru.= $ekstensiGambar;

        move_uploaded_file($tmpName, 'upload/' .$namaFileBaru);
        return $namaFileBaru;
    }



    function hapus($id){
        global $conn;
        $tes = count(query("SELECT * FROM discount WHERE id_barang=$id"));
        mysqli_query($conn, "DELETE FROM barang WHERE id_barang =$id");
        
        if($tes==1){
            mysqli_query($conn, "DELETE FROM discount WHERE id_barang =$id");
        }
        
        return mysqli_affected_rows($conn);
    }

    function ubah($data){
        global $conn;

        $id = $data['id_barang'];
        $nama =  $data["namaBarang"];
		$gambarLama = $data['gbr_lama'];
		$harga = $data["harga"];
		$tipe = $data["tipeBarang"];
        $stok = $data["stok"];
        $des = $data["desc"];

        //cek apakah user pilih gambar baru atau tidak
        if($_FILES['gbr']['error']===4){
            $gambar = $gambarLama;
        }else{
            $gambar = upload();
        }


		$query = "UPDATE barang SET
         nama = '$nama',
         tipe = '$tipe',
         harga = $harga,
         gambar = '$gambar',
         stok = '$stok',
         deskripsi = '$des'
         WHERE id_barang = $id
         ";

		mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
		
    }
    function cari($keyword){

        $query = "SELECT * FROM barang
            WHERE 
            nama LIKE '%$keyword%' OR
            harga LIKE '%$keyword%' OR
            tipe LIKE '%$keyword%' OR
            stok LIKE '%$keyword%'
        ";
        return query($query);
    }

    function tambahDisc($data){
        global $conn;
        $nama =  $data["barang"];
		$diskon = $data["disc"];
        

        $query = "INSERT INTO discount(id_barang,persen_disc) VALUES ('$nama','$diskon')";
        // $queryDis = "UPDATE barang SET
        // harga = '$hrDis'
        // id_barang = '$nama'
        // ";
        mysqli_query($conn, $query);
        //mysqli_query($conn,$queryDis);
        return mysqli_affected_rows($conn);
		
    }
    function cariDisc($keyword){

        $query = "SELECT * FROM barang JOIN discount USING(id_barang)
            WHERE 
            nama LIKE '%$keyword%' OR
            persen_disc LIKE '%$keyword%'
        ";
        return query($query);
    }
    function hapusDis($id){
        global $conn;
        mysqli_query($conn, "DELETE FROM discount WHERE id_barang =$id");
        return mysqli_affected_rows($conn);
    }

    function ubahDis($data){
        global $conn;

        $id = $data['id_barang'];
		$diskon = $data["disc"];


		$query = "UPDATE discount SET
         id_barang = '$id',
         persen_disc = '$diskon'
         WHERE id_barang = $id
         ";

		mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
		
    }
    function cariOrder($keyword){

        $query = "SELECT * FROM formulir
            WHERE 
            id_form LIKE '%$keyword%' OR
            nama LIKE '%$keyword%' OR
            nim LIKE '%$keyword%' OR
            id_line LIKE '%$keyword%' OR
            cookie LIKE '%$keyword%'
        ";
        return query($query);
    }

    function ubahPayment($data){
        global $conn;

        $id = $data['id_form'];
		$stat = $data['stat'];


		$query = "UPDATE formulir SET
         `status` = '$stat'
         WHERE id_transaksi = '$id'
         ";

		mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
		
    }
    
?>