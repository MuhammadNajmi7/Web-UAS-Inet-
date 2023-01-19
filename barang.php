<?php
    require "koneksi.php";
    $queryKategori = mysqli_query($con, "SELECT * FROM kategori");
    
    // get barang by nama produk/keyword
    if(isset($_GET['keyword'])){
        $queryBarang = mysqli_query($con, "SELECT * FROM barang WHERE nama LIKE '%$_GET[keyword]%'");
    }
    // get barang by kategori
    elseif(isset($_GET['kategori'])){
        $queryGetKategoriId = mysqli_query($con, "SELECT id FROM kategori WHERE nama='$_GET[kategori]'");
        $kategoriId= mysqli_fetch_array($queryGetKategoriId);
        
        $queryBarang = mysqli_query($con, "SELECT * FROM barang WHERE kategori_id='$kategoriId[id]'");
    }
    // get barang by default
    else{
        $queryBarang = mysqli_query($con, "SELECT * FROM barang");
    }

    $countData = mysqli_num_rows($queryBarang);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Pemesanan Kayu | Barang</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php require "navbar.php"; ?>
    
    <!-- banner -->
    <div class="container-fluid banner2 d-flex align-items-center">
        <div class="container">
            <h1 class="text-white text-center">Barang</h1>
        </div>
    </div>

    <!-- body -->
    <div class="container-fluid py-5">
        <div class="row">
            <div class="col-lg-3 mb-5">
            <h3>Kategori</h3>
                <ul class="list-group">
                    <?php while($kategori = mysqli_fetch_array($queryKategori)){ ?>
                    <a href="barang.php?kategori=<?php echo $kategori['nama']; ?>">
                        <li class="list-group-item"><?php echo $kategori['nama']; ?></li>
                    </a>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-lg-9">
                <h3 class="text-center mb-3">Barang</h3>
                    <div class="row">
                        <?php 
                            if($countData<1){
                        ?>
                            <h4 class="text-center my-4">Barang yang anda cari tidak tersedia</h4>
                        <?php 
                            }
                        ?>

                        <?php while($barang = mysqli_fetch_array($queryBarang)){ 
                            if($barang['status_stok']=='tersedia'){
                        ?>
                                <div class="col-md-4 mb-4">
                                    <div class="card h-100">
                                        <div class="image-box">
                                            <img src="image/<?php echo $barang['foto']?>" class="card-img-top" alt="...">
                                        </div>
                                        <div class="card-body">
                                            <h4 class="card-title"><?php echo $barang['nama']?></h4>
                                            <p class="card-text text-truncate"><?php echo htmlspecialchars_decode($barang['detail'])?></p>
                                            <p class="card-text text-harga">Rp.<?php echo $barang['harga']?></p>
                                            <a href="barang-detail.php?nama=<?php echo $barang['nama']?>" class="btn warna2 
                                            text-white">Lihat Detail</a>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        ?>
                        <?php } ?>
                    </div>
                </div>
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