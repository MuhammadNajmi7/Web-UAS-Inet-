<?php 
    require "koneksi.php";

    $nama = htmlspecialchars($_GET['nama']);
    if(isset($_POST['beli'])){
        $barangid = $_POST['id'];
        $jml = $_POST['jml'];
        if($jml>0){
        $insert = mysqli_query($con, "INSERT INTO `pemesanan` (`barang_id`, `jumlah`) VALUES ($barangid, $jml)");
        header("Location: https://api.whatsapp.com/send?phone=6289691690087&text=Saya+ingin+membeli+$nama+dengan+jumlah+$jml");
        }
        else{
            echo "<script>alert('Jumlah Harus Ada')</script>";
        }
        
    }

    $queryBarang = mysqli_query($con, "SELECT * FROM barang WHERE nama='$nama'");
    
    $barang = mysqli_fetch_array($queryBarang);
    
    $queryBarangTerkait = mysqli_query($con, "SELECT * FROM barang WHERE kategori_id='$barang[kategori_id]
    ' AND id!=$barang[id] LIMIT 4");

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Pemesanan Kayu | Detail Barang</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php 
        require "navbar.php";
    ?>
    <!-- detail barang -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 mb-5">
                    <img src="image/<?php echo $barang['foto']?>" class="w-100" alt="">
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <h1><?php echo $barang['nama']?></h1>
                    <p class="fs-5">
                    <?php echo $barang['detail']?>
                    </p>
                    <p class="text-harga">
                        Rp.<?php echo $barang['harga']?>
                    </p>
                    <p class="fs-5">
                        Status Ketersediaan : <strong><?php echo $barang['status_stok']?></strong>
                    </p>
                    <p class="fs-5">
                        <strong>Paket Antar-jemput :</strong><br>
                        Terdapat paket untuk antar jemput barang yang dibeli jika anda berminat.
                        Harga antar jemput bisa didiskusikan setelah anda menekan tombol beli dan diarahkan ke chat whatsapp
                        penjual. harga antar jemput tergantung dari jarak tempuh pengantaran barang dan 
                        jenis barang yang dibeli.
                    </p>
                    <p class="fs-5">
                        <form method="post">
                            <input type="hidden" name="id" value="<?php echo $barang['id']?>">
                            Masukkan jumlah beli :
                            <input type="number" name="jml" value="0"><br>
                            <input type="submit" name="beli" value="BELI" class="btn btn-primary">
                        </form>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- barang terkait -->
    <div class="container-fluid py-5 warna2">
        <div class="container">
            <h2 class="text-center text-white mb-5">Barang Terkait</h2>

            <div class="row">
                <?php while($data = mysqli_fetch_array($queryBarangTerkait)){ ?>
                <div class="col-md-6 col-lg-3 mb-3">
                    <a href="barang-detail.php?nama=<?php echo $data['nama']?>">
                    <img src="image/<?php echo $data['foto']?>" class="img-fluid img-thumbnail 
                    barang-terkait-image" alt="">
                    </a>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php 
        require "footer.php";
    ?>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>
</html>