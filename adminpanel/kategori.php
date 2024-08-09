<?php
session_start();
require "session.php";
require "../koneksi.php";

$queryKategori = mysqli_query($con, "SELECT * FROM kategori");
$jumlahKategori = mysqli_num_rows($queryKategori);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <style>
        .no-decoration {
            text-decoration: none;
        }

        .breadcrumb-item a {
            color: #212529;
        }

        .breadcrumb-item a:hover {
            color: #343a40;
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

        .table thead th {
            background-color: #212529;
            color: #fff;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .btn-info {
            background-color: #17a2b8;
            border: none;
        }

        .btn-info:hover {
            background-color: #138496;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <?php require "navbar.php"; ?>
    
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="../adminpanel" class="no-decoration text-muted">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Kategori</li>
            </ol>
        </nav>

        <div class="card mb-4">
            <div class="card-header">
                <h3 class="mb-0">Tambah Kategori</h3>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <input type="text" id="kategori" name="kategori" placeholder="Input nama kategori" class="form-control" required>
                    </div>
                    <button class="btn btn-primary" type="submit" name="simpan_kategori">Simpan</button>
                </form>

                <?php
                if (isset($_POST['simpan_kategori'])) {
                    $kategori = htmlspecialchars($_POST['kategori']);

                    $queryExist = mysqli_query($con, "SELECT nama FROM kategori WHERE nama='$kategori'");
                    $jumlahDataKategoriBaru = mysqli_num_rows($queryExist);

                    if ($jumlahDataKategoriBaru > 0) {
                        echo '<div class="alert alert-warning mt-3" role="alert">Kategori Sudah Ada Di Database!</div>';
                    } else {
                        $querySimpan = mysqli_query($con, "INSERT INTO kategori (nama) VALUES ('$kategori')");
                        if ($querySimpan) {
                            echo '<div class="alert alert-success mt-3" role="alert">Kategori Berhasil Ditambahkan!</div>';
                            echo '<meta http-equiv="refresh" content="3; url=kategori.php" />';
                        } else {
                            echo '<div class="alert alert-danger mt-3" role="alert">Gagal Menambahkan Kategori: ' . mysqli_error($con) . '</div>';
                        }
                    }
                }
                ?>
            </div>
        </div>

        <div>
            <h2>List Kategori</h2>

            <div class="table-responsive mt-3">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($jumlahKategori == 0) {
                            echo '<tr><td colspan="3" class="text-center">Data Kategori Tidak Tersedia!</td></tr>';
                        } else {
                            $jumlah = 1;
                            while ($data = mysqli_fetch_array($queryKategori)) {
                                echo '<tr>';
                                echo '<td>' . $jumlah . '</td>';
                                echo '<td>' . $data['nama'] . '</td>';
                                echo '<td><a href="kategori-detail.php?p=' . $data['id'] . '" class="btn btn-info"><i class="fas fa-search"></i></a></td>';
                                echo '</tr>';
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
</body>
</html>
