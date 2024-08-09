<?php
session_start();
require "session.php";
require "../koneksi.php";

$query = mysqli_query($con, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id=b.id");
$jumlahProduk = mysqli_num_rows($query);

$queryKategori = mysqli_query($con, "SELECT * FROM kategori");

function generateRandomString($length = 10){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++){
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <style>
        .no-decoration {
            text-decoration: none;
        }

        .breadcrumb-item a {
            color: #007bff;
        }

        .breadcrumb-item a:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        .form-control, .btn-primary {
            border-radius: 0.5rem;
        }

        .alert {
            border-radius: 0.5rem;
        }

        .table th, .table td {
            vertical-align: middle;
        }

        .table-container {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .table-responsive {
            overflow-x: auto;
        }

        .btn-info {
            background-color: #17a2b8;
            border: none;
        }

        .btn-info:hover {
            background-color: #138496;
        }

        .card {
            border-radius: 0.5rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #212529;
            color: #fff;
        }

        .card-body {
            padding: 2rem;
        }
    </style>
</head>
<body>
    <?php require "navbar.php"; ?>

    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="../adminpanel" class="no-decoration text-muted">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Produk</li>
            </ol>
        </nav>

        <!-- Tambah Produk -->
        <div class="card my-5">
            <div class="card-header">
                <h3 class="mb-0">Tambah Produk</h3>
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" id="nama" name="nama" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select name="kategori" id="kategori" class="form-select" required>
                            <option value="">Pilih Kategori</option>
                            <?php while($data = mysqli_fetch_array($queryKategori)): ?>
                                <option value="<?php echo $data['id']; ?>"><?php echo $data['nama']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" id="harga" name="harga" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto Produk</label>
                        <input type="file" name="foto" id="foto" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="detail" class="form-label">Detail</label>
                        <textarea name="detail" id="detail" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="ketersediaan_stok" class="form-label">Ketersediaan Stok</label>
                        <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-select">
                            <option value="tersedia">Tersedia</option>
                            <option value="habis">Habis</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                </form>

                <?php
                if(isset($_POST['simpan'])){
                    $nama = htmlspecialchars($_POST['nama']);
                    $kategori = htmlspecialchars($_POST['kategori']);
                    $harga = htmlspecialchars($_POST['harga']);
                    $detail = htmlspecialchars($_POST['detail']);
                    $ketersediaan_stok = htmlspecialchars($_POST['ketersediaan_stok']);

                    // Check if product name already exists
                    $queryCheck = mysqli_query($con, "SELECT * FROM produk WHERE nama='$nama'");
                    if(mysqli_num_rows($queryCheck) > 0){
                        ?>
                        <div class="alert alert-warning mt-3" role="alert">
                            Nama produk sudah ada di database!
                        </div>
                        <?php
                    } else {
                        $target_dir = "../image/";
                        $nama_file = basename($_FILES["foto"]["name"]);
                        $target_file = $target_dir . $nama_file;
                        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                        $image_size = $_FILES["foto"]["size"];
                        $random_name = generateRandomString(20);
                        $new_name = $random_name . "." . $imageFileType;

                        if($nama == '' || $kategori == '' || $harga == ''){
                            ?>
                            <div class="alert alert-warning mt-3" role="alert">
                                Nama, Kategori dan Harga Wajib Diisi!
                            </div>
                            <?php
                        } else {
                            if($nama_file != ''){
                                if($image_size > 1000000){
                                    ?>
                                    <div class="alert alert-warning mt-3" role="alert">
                                        File Yang Di Upload Harus Kurang Dari 1MB!
                                    </div>
                                    <?php
                                } else {
                                    if($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'gif'){
                                        ?>
                                        <div class="alert alert-warning mt-3" role="alert">
                                            File Wajib Bertipe JPG/PNG/GIF!
                                        </div>
                                        <?php
                                    } else {
                                        move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $new_name);
                                    }
                                }
                            }

                            // Query insert to product table
                            $queryTambah = mysqli_query($con, "INSERT INTO produk (kategori_id, nama, harga, foto, detail, ketersediaan_stok) VALUES ('$kategori', '$nama', '$harga', '$new_name', '$detail', '$ketersediaan_stok')");

                            if($queryTambah){
                                ?>
                                <div class="alert alert-primary mt-3" role="alert">
                                    Produk Berhasil Ditambahkan!
                                </div>
                                <meta http-equiv="refresh" content="3; url=produk.php" />
                                <?php                
                            } else {
                                echo mysqli_error($con);
                            }
                        }
                    }
                }
                ?>
            </div>
        </div>

        <div class="table-container">
            <h2>Daftar Produk</h2>
            <div class="table-responsive mt-4">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stock Produk</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($jumlahProduk == 0){
                        ?>
                            <tr>
                                <td colspan="6" class="text-center">Data Produk Tidak Tersedia!</td>
                            </tr>
                        <?php
                        } else {
                            $jumlah = 1;
                            while($data = mysqli_fetch_array($query)){
                        ?>
                            <tr>
                                <td><?php echo $jumlah; ?></td>
                                <td><?php echo $data['nama']; ?></td>
                                <td><?php echo $data['nama_kategori']; ?></td>
                                <td><?php echo number_format($data['harga'], 0, ',', '.'); ?></td>
                                <td><?php echo ucfirst($data['ketersediaan_stok']); ?></td>
                                <td>
                                    <a href="produk-detail.php?p=<?php echo $data['id']; ?>" class="btn btn-info">
                                        <i class="fas fa-search"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php
                                $jumlah++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>
</html>
