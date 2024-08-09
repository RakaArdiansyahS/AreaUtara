<?php
session_start();
require "session.php";
require "../koneksi.php";

$id = $_GET['p'];

$query = mysqli_query($con, "SELECT * FROM kategori WHERE id='$id'");
$data = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kategori</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 0.5rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #212529;
            color: #fff;
            font-size: 1.25rem;
            border-bottom: 1px solid #dee2e6;
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

        .alert-warning {
            background-color: #fff3cd;
            color: #856404;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <?php require "navbar.php"; ?>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3>Detail Kategori</h3>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="mb-3">  
                        <label for="kategori" class="form-label">Kategori</label>
                        <input type="text" name="kategori" id="kategori" class="form-control" value="<?php echo htmlspecialchars($data['nama']); ?>" required>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <button type="submit" class="btn btn-primary" name="editBtn">Edit</button>
                        <button type="submit" class="btn btn-danger" name="deleteBtn">Delete</button>
                    </div>
                </form>

                <?php
                if (isset($_POST['editBtn'])) {
                    $kategori = htmlspecialchars($_POST['kategori']);

                    if ($data['nama'] == $kategori) {
                        echo '<meta http-equiv="refresh" content="0; url=kategori.php" />';
                    } else {
                        $query = mysqli_query($con, "SELECT * FROM kategori WHERE nama='$kategori'");
                        $jumlahData = mysqli_num_rows($query);

                        if ($jumlahData > 0) {
                            echo '<div class="alert alert-warning mt-3" role="alert">Kategori Sudah Ada Di Database!</div>';
                        } else {
                            $querySimpan = mysqli_query($con, "UPDATE kategori SET nama='$kategori' WHERE id='$id'");
                            if ($querySimpan) {
                                echo '<div class="alert alert-success mt-3" role="alert">Kategori Berhasil Di Update!</div>';
                                echo '<meta http-equiv="refresh" content="3; url=kategori.php" />';
                            } else {
                                echo '<div class="alert alert-danger mt-3" role="alert">Gagal Mengupdate Kategori: ' . mysqli_error($con) . '</div>';
                            }
                        }
                    }
                }

                if (isset($_POST['deleteBtn'])) {
                    $queryCheck = mysqli_query($con, "SELECT id FROM produk WHERE kategori_id='$id'");
                    $dataCount = mysqli_num_rows($queryCheck);

                    if ($dataCount > 0) {
                        echo '<div class="alert alert-warning mt-3" role="alert">Kategori Tidak Bisa Dihapus, Karena Sudah Ada Produk Dengan Kategori Tersebut!</div>';
                        die();
                    }

                    $queryDelete = mysqli_query($con, "DELETE FROM kategori WHERE id='$id'");

                    if ($queryDelete) {
                        echo '<div class="alert alert-success mt-3" role="alert">Kategori Berhasil Di Hapus!</div>';
                        echo '<meta http-equiv="refresh" content="3; url=kategori.php" />';
                    } else {
                        echo '<div class="alert alert-danger mt-3" role="alert">Gagal Menghapus Kategori: ' . mysqli_error($con) . '</div>';
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
