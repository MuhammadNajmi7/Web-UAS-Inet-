<?php
    require "koneksi.php";
    $queryBarang = mysqli_query($con, "SELECT id, nama, harga, foto, detail, status_stok FROM barang LIMIT 6");
    if(@$_GET['berhasil']){
        echo "<script>alert('Pembelian Berhasil')</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Pemesanan Kayu | Home </title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php require "navbar.php"; ?>

    <!-- Banner -->
    <div class="container-fluid banner d-flex align-items-center">
        <div class="container text-center text-white">
            <h1>Toko Pemesanan Kayu</h1>
            <h3>Mau cari apa ?</h3>
            <div class="col-md-8 offset-md-2">
                <form method="get" action="barang.php">
                    <div class="input-group input-group-lg my-4 ">
                        <input type="text" class="form-control" placeholder="Nama Barang" 
                        aria-label="Recipient's username" aria-describedby="basic-addon2" name="keyword">
                        <button type="submit" class="btn warna2 text-white ">Telusuri</button>
                    </div> 
                </form>
            </div>
        </div>
    </div>

    <!-- Highlight Kategori -->
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Kategori Barang Yang Dijual</h3>

            <div class="row mt-5">
                <div class="col-md-4 mb-3">
                    <div class="highlighted-kategori kategori-atang-kubur d-flex justify-content-center align-items-center">
                        <h4 class="text-white"><a class="no-decoration" href="barang.php?kategori=Atang Kuburan">Atang Kuburan</a></h4>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="highlighted-kategori kategori-peti-mati d-flex justify-content-center align-items-center">
                        <h4 class="text-white"><a class="no-decoration" href="barang.php?kategori=Peti Mati">Peti Mati</a></h4>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="highlighted-kategori kategori-siring-kuburan d-flex justify-content-center align-items-center">
                        <h4 class="text-white"><a class="no-decoration" href="barang.php?kategori=Siring Kuburan">Siring Kuburan</a></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Highlight Kategori -->
    <div class="container-fluid warna3 py-5">
        <div class="container text-center">
            <h3>Tentang Kami</h3>
            <p class="fs-5 mt-3">
                Web ini adalah tempat pemesanan berbagai macam barang yang terbuat dari kayu ulin, barang yang
                kami jual disini diantaranya ialah Atang kuburan, peti Mati, dan Siring Kuburan. Terdapat berbagai
                macam varian dari kategori barang yang disebutkan diatas. 
            </p>
        </div>
    </div>

    <!-- Barang Dijual -->
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Barang Yang Dijual</h3>

            <div class="row mt-5">
                <?php while($data = mysqli_fetch_array($queryBarang)){ 
                    if($data['status_stok']=='tersedia'){
                ?>
                        <div class="col-sm-6 col-md-4 mb-3">
                            <div class="card h-100" style="width: 18rem;">
                                <div class="image-box">
                                    <img src="image/<?php echo $data['foto'] ?>" class="card-img-top" alt="...">
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title"><?php echo $data['nama'] ?></h4>
                                    <p class="card-text text-truncate"><?php echo $data['detail'] ?></p>
                                    <p class="card-text text-harga">Rp.<?php echo $data['harga'] ?></p>
                                    <a href="barang-detail.php?nama=<?php echo $data['nama']?>" class="btn warna2 text-white">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                ?>
                <?php } ?>
            </div>
            <a href="barang.php" class="btn btn-outline-warning mt-3 p-1 fs-3">See More</a>
        </div>
    </div>

    <!-- footer -->
    <?php require "footer.php"; ?>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>
</html>