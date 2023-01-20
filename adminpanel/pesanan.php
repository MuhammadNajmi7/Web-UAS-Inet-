<?php
    require "session.php";
    require "../koneksi.php";

    $query = mysqli_query($con, "SELECT * FROM pemesanan");

    $queryKategori = mysqli_query($con, "SELECT * FROM kategori");

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
</head>

<style>
    .no-decoration{
        text-decoration: none;
    }
    form div{
        margin-bottom: 10px; 
    }
</style>

<body>
    <?php require "navbar.php" ?>
    <div class="container mt-4">
                
        <div class= "mt-3 mb-5">
            <h2>List Pesanan</h2>
            <form method="post">
                <table>
                    <tr>
                        <td>Dari Tanggal</td>
                        <td><input type="date" name="dari_tgl" id="" required></td>
                        <td>Sampai Tanggal</td>
                        <td><input type="date" name="sampai_tgl" id="" required></td>
                        <td><input type="submit" class="btn btn-primary" name="filter" value="filter"></td>
                    </tr>
                </table>
            </form>

            <div class= "table-responsive mt-4">
                <table class= "table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                            <th>Tanggal Beli</th>
                            <th>Action</th>
                        </tr>
                    </thead>                    
                    <tbody>
                        <?php
                            $jumlah=1;

                            if (isset($_POST['filter'])) {
                                $dari_tgl = mysqli_real_escape_string($con, $_POST['dari_tgl']);
                                $sampai_tgl = mysqli_real_escape_string($con, $_POST['sampai_tgl']);
                                $query = mysqli_query($con, "SELECT * FROM pemesanan WHERE tgl_beli BETWEEN
                            'dari_tgl' AND 'sampai_tgl'");
                            }
                            else{
                                $query = mysqli_query($con, "SELECT * FROM pemesanan");
                            }
                                while($data=mysqli_fetch_array($query)){
                                    $barangId = $data['barang_id'];
                                    
                                    $barang=mysqli_query($con, "SELECT * FROM barang WHERE id = $barangId");
                                    $obj = mysqli_fetch_array($barang);
                                    $kategori = mysqli_query($con, "SELECT nama FROM kategori WHERE id = ".$obj["kategori_id"]);
                                    $cat = mysqli_fetch_array($kategori);
                        ?>
                                <tr>
                                    <td><?php echo $jumlah; ?></td>
                                    <td><?php echo $obj['nama']; ?></td>
                                    <td><?php echo $cat['nama']; ?></td>
                                    <td><?php echo $obj['harga']; ?></td>
                                    <td><?php echo $data['jumlah']; ?></td>
                                    <td><?php echo $obj['harga']*$data['jumlah']; ?></td>
                                    <td><?php echo $data['tgl_beli']; ?></td>
                                    <td>
                                        <a href="pesanan-detail.php?p=<?php echo $data['id']; ?>" 
                                        class="btn btn-info"><i class="fas fa-search"></i></a>
                                    </td>
                                </tr>
                        <?php
                                $jumlah++;
                                }
                            
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src= "../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>
</html>