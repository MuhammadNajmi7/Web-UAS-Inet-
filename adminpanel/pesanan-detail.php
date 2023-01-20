<?php
    require "session.php";
    require "../koneksi.php";

    $id = $_GET['p'];

    $query = mysqli_query($con, "SELECT * FROM pemesanan WHERE id='$id'");
    $data = mysqli_fetch_array($query);
    $barangId = $data['barang_id'];
    $barang=mysqli_query($con, "SELECT * FROM barang WHERE id = $barangId");
    $obj = mysqli_fetch_array($barang);
    $kategori = mysqli_query($con, "SELECT nama FROM kategori WHERE id = ".$obj["kategori_id"]);
    $cat = mysqli_fetch_array($kategori);
    $tanggal_baru = date("d-m-Y", strtotime($data['tgl_beli']));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>
<body>
    <?php require "navbar.php"; ?>

    <div class="container mt-5">
        <h2>Detail Pesanan</h2>

        <div class="col-12 col-md-6">
        <form action="" method="post">
            <div>
                <label>Nama Barang</label>
                <input type="text" class="form-control" 
                value="<?php echo $obj['nama']; ?>">
            </div>
            <div>
                <label>Kategori</label>
                <input type="text" class="form-control" 
                value="<?php echo $cat['nama']; ?>">
            </div>
            <div>
                <label>Harga</label>
                <input type="text" class="form-control" 
                value="<?php echo $obj['harga']; ?>">
            </div>
            <div>
                <label>Jumlah Pembelian</label>
                <input type="text" class="form-control" 
                value="<?php echo $data['jumlah']; ?>">
            </div>
            <div>
                <label>Tanggal Pembelian</label>
                <input type="text" class="form-control" 
                value="<?php echo $tanggal_baru; ?>">
            </div>
            <div>
                <label>Total Yang Harus Dibayar</label>
                <input type="text" class="form-control" 
                value="<?php echo $obj['harga']*$data['jumlah']; ?>">
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-danger" name="deleteBtn">Hapus</button>
            </div>
        </form>

        <?php 
            if(isset($_POST['deleteBtn'])){
                $queryDelete = mysqli_query($con, "DELETE FROM pemesanan WHERE id='$id'");
                
                if($queryDelete){
                ?>
                    <div class="alert alert-primary mt-3" role="alert">
                        Kategori Sudah Dihapus
                    </div>

                    <meta http-equiv="refresh" content="0; url=pesanan.php" />
                <?php
                }
                else{
                    echo mysqli_error($con);
                }
            }
        ?>
        </div>
    </div>

    <script src= "../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>