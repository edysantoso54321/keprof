<?php 
    require 'function.php';

    $id = $_GET["id_barang"];

    if(hapusDis($id) > 0 ){
        echo "
            <script>
            alert('data berhasil dihapus');
            document.location.href = 'harga.php';
            </script>
        ";
    }else{
        echo "
            <script>
            alert('Data Gagal Dihapus');
            document.location.href = 'harga.php';
            </script>
        ";
    }
?>
