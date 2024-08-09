<?php
session_start(); // Start the session

    require "koneksi.php";

    $queryKategori = mysqli_query($con, "SELECT * FROM kategori");

    // Cek apakah ada parameter keyword untuk pencarian produk
    if (isset($_GET['keyword'])) {
        $keyword = mysqli_real_escape_string($con, $_GET['keyword']);
        $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE nama LIKE '%$keyword%'");
        $kategoriNama = 'Pencarian: ' . htmlspecialchars($keyword);
    }
    // Cek apakah ada parameter kategori untuk menampilkan produk berdasarkan kategori
    else if (isset($_GET['kategori'])) {
        $kategori = mysqli_real_escape_string($con, $_GET['kategori']);
        $queryGetKategoriId = mysqli_query($con, "SELECT id, nama FROM kategori WHERE nama='$kategori'");
        $kategoriData = mysqli_fetch_array($queryGetKategoriId);

        if ($kategoriData) {
            $kategoriId = $kategoriData['id'];
            $kategoriNama = htmlspecialchars($kategoriData['nama']);
            $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE kategori_id='$kategoriId'");
        } else {
            // Jika kategori tidak ditemukan, tampilkan semua produk
            $queryProduk = mysqli_query($con, "SELECT * FROM produk");
            $kategoriNama = 'Semua Produk';
        }
    }
    // Default: ambil semua produk
    else {
        $queryProduk = mysqli_query($con, "SELECT * FROM produk");
        $kategoriNama = 'Semua Produk';
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AreaUtara | Produk</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php require "navbar.php"; ?>

    <!-- banner -->
    <div class="container-fluid banner-produk d-flex align-items-center">
        <div class="container">
            <h1 class="text-white text-center">Produk</h1>
        </div>
    </div>

    <!-- body -->
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-3 mb-5">
                <h3>Kategori</h3>
                <ul class="list-group">
                    <?php while ($kategori = mysqli_fetch_array($queryKategori)) { ?>
                    <li class="list-group-item">
                        <a class="text-decoration-none"
                            href="produk.php?kategori=<?php echo urlencode($kategori['nama']); ?>">
                            <?php echo htmlspecialchars($kategori['nama']); ?>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-lg-9">
                <h3 class="text-center mb-3">Produk <?php if (isset($kategoriNama)) echo ' - ' . $kategoriNama; ?></h3>
                <div class="row">
                    <?php
                    if (mysqli_num_rows($queryProduk) > 0) {
                        while ($produk = mysqli_fetch_array($queryProduk)) { ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="image-box">
                                <img src="image/<?php echo htmlspecialchars($produk['foto']); ?>" class="card-img-top"
                                    alt="<?php echo htmlspecialchars($produk['nama']); ?>">
                            </div>
                            <div class="card-body">
                                <h4 class="card-title"><?php echo htmlspecialchars($produk['nama']); ?></h4>
                                <p class="card-text text-truncate"><?php echo htmlspecialchars($produk['detail']); ?>
                                </p>
                                <p class="card-text text-harga">Rp
                                    <?php echo number_format($produk['harga'], 0, ',', '.'); ?></p>
                                <a href="produk-detail.php?p=<?php echo urlencode($produk['id']); ?>"
                                    class="btn warna2 text-white">Lihat Produk</a>
                            </div>
                        </div>
                    </div>
                    <?php }
                    } else {
                        echo '<div class="col-12"><p class="text-center">Kategori ' . $kategoriNama . ' Produk Kosong</p></div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php require "footer.php"; ?>
</body>

</html>