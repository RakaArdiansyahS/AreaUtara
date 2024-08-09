<?php
session_start();
require "session.php";
require "../koneksi.php";

$id = $_GET['p'];

$query = mysqli_query($con, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id=b.id WHERE a.id='$id'");
$data = mysqli_fetch_array($query);

$queryKategori = mysqli_query($con, "SELECT * FROM kategori WHERE id!='$data[kategori_id]'");

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
    <title>Produk Detail</title>
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

        .form-control, .btn-primary, .btn-danger {
            border-radius: 0.5rem;
        }

        .alert {
            border-radius: 0.5rem;
        }

        .btn-info {
            background-color: #17a2b8;
            border: none;
        }

        .btn-info:hover {
            background-color: #138496;
        }

        .form-control-img {
            max-width: 150px;
        }
    </style>
</head>
<body>
    <?php require "navbar.php"; ?>

    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="../adminpanel" class="no-decoration">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="produk.php" class="no-decoration">Produk</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Detail Produk</li>
            </ol>
        </nav>

        <!-- Form Edit Produk -->
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0">Detail Produk</h3>
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" id="nama" name="nama" value="<?php echo $data['nama']; ?>" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select name="kategori" id="kategori" class="form-select" required>
                            <option value="<?php echo $data['kategori_id']; ?>"><?php echo $data['nama_kategori']; ?></option>
                            <?php while($dataKategori = mysqli_fetch_array($queryKategori)): ?>
                                <option value="<?php echo $dataKategori['id']; ?>"><?php echo $dataKategori['nama']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" id="harga" name="harga" value="<?php echo $data['harga']; ?>" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="currentFoto" class="form-label">Foto Produk Sekarang</label>
                        <img src="../image/<?php echo $data['foto']; ?>" alt="Foto Produk" class="form-control-img mb-3">
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Upload Foto Produk Baru</label>
                        <input type="file" name="foto" id="foto" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="detail" class="form-label">Detail</label>
                        <textarea name="detail" id="detail" cols="30" rows="5" class="form-control"><?php echo $data['detail']; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="ketersediaan_stok" class="form-label">Ketersediaan Stok</label>
                        <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-select">
                            <option value="<?php echo $data['ketersediaan_stok']; ?>"><?php echo ucfirst($data['ketersediaan_stok']); ?></option>
                            <?php if ($data['ketersediaan_stok'] == 'tersedia'): ?>
                                <option value="habis">Habis</option>
                            <?php else: ?>
                                <option value="tersedia">Tersedia</option>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                        <button type="submit" class="btn btn-danger" name="hapus">Hapus</button>
                    </div>
                </form>

                <?php
                if (isset($_POST['simpan'])) {
                    $nama = htmlspecialchars($_POST['nama']);
                    $kategori = htmlspecialchars($_POST['kategori']);
                    $harga = htmlspecialchars($_POST['harga']);
                    $detail = htmlspecialchars($_POST['detail']);
                    $ketersediaan_stok = htmlspecialchars($_POST['ketersediaan_stok']);

                    $target_dir = "../image/";
                    $nama_file = basename($_FILES["foto"]["name"]);
                    $target_file = $target_dir . $nama_file;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    $image_size = $_FILES["foto"]["size"];
                    $random_name = generateRandomString(20);
                    $new_name = $random_name . "." . $imageFileType;

                    if ($nama == '' || $kategori == '' || $harga == '') {
                        echo '<div class="alert alert-warning mt-3" role="alert">Nama, Kategori, dan Harga Wajib Diisi!</div>';
                    } else {
                        $queryUpdate = mysqli_query($con, "UPDATE produk SET kategori_id='$kategori', nama='$nama', harga='$harga', detail='$detail', ketersediaan_stok='$ketersediaan_stok' WHERE id='$id'");

                        if ($nama_file != '') {
                            if ($image_size > 1000000) {
                                echo '<div class="alert alert-warning mt-3" role="alert">File Yang Di Upload Harus Kurang Dari 1MB!</div>';
                            } else {
                                if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'gif') {
                                    echo '<div class="alert alert-warning mt-3" role="alert">File Wajib Bertipe JPG/PNG/GIF!</div>';
                                } else {
                                    move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $new_name);
                                    $queryUpdate = mysqli_query($con, "UPDATE produk SET foto='$new_name' WHERE id='$id'");
                                    if ($queryUpdate) {
                                        echo '<div class="alert alert-success mt-3" role="alert">Produk Berhasil Di Update!</div>';
                                        echo '<meta http-equiv="refresh" content="3; url=produk.php" />';
                                    } else {
                                        echo mysqli_error($con);
                                    }
                                }
                            }
                        }
                    }
                }

                if (isset($_POST['hapus'])) {
                    $queryHapus = mysqli_query($con, "DELETE FROM produk WHERE id='$id'");
                    if ($queryHapus) {
                        echo '<div class="alert alert-success mt-3" role="alert">Produk Berhasil Di Hapus!</div>';
                        echo '<meta http-equiv="refresh" content="3; url=produk.php" />';
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>
</html>
