<?php
session_start(); // Start the session

require "koneksi.php";

// Ambil ID produk dari parameter GET
if (isset($_GET['p'])) {
    $produkId = mysqli_real_escape_string($con, $_GET['p']);

    // Ambil data produk berdasarkan ID
    $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE id='$produkId'");
    $produk = mysqli_fetch_array($queryProduk);

    // Jika produk tidak ditemukan
    if (!$produk) {
        echo '<div class="container py-5"><p class="text-center">Produk tidak ditemukan.</p></div>';
        exit;
    }

    // Ambil kategori ID produk saat ini
    $kategoriId = $produk['kategori_id'];

    // Ambil produk lain dengan kategori yang sama (3 produk)
    $queryRekomendasi = mysqli_query($con, "SELECT * FROM produk WHERE kategori_id='$kategoriId' AND id != '$produkId' LIMIT 3");
} else {
    echo '<div class="container py-5"><p class="text-center">ID produk tidak diberikan.</p></div>';
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AreaUtara | Produk Detail</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php require "navbar.php"; ?>

    <!-- Produk Detail -->
    <div class="container py-5">
        <div class="row">
            <div class="col-md-6">
                <img src="image/<?php echo htmlspecialchars($produk['foto']); ?>" class="img-fluid rounded" alt="<?php echo htmlspecialchars($produk['nama']); ?>">
            </div>
            <div class="col-md-6">
                <h2 class="mb-3"><?php echo htmlspecialchars($produk['nama']); ?></h2>
                <p class="text-harga mb-4">Rp <?php echo number_format($produk['harga'], 0, ',', '.'); ?></p>
                <p><?php echo nl2br(htmlspecialchars($produk['detail'])); ?></p>
                
                <!-- Status Ketersediaan -->
                <p class="mb-4">
                    <strong>Status:</strong>
                    <?php
                    if ($produk['ketersediaan_stok'] == 'tersedia') {
                        echo '<span class="text-success">Tersedia</span>';
                    } else {
                        echo '<span class="text-danger">Habis</span>';
                    }
                    ?>
                </p>

                <!-- Form Pembelian dan Keranjang -->
                <form action="add-to-cart.php" method="POST">
                    <input type="hidden" name="id_produk" value="<?php echo htmlspecialchars($produk['id']); ?>">
                    <input type="hidden" name="nama_produk" value="<?php echo htmlspecialchars($produk['nama']); ?>">
                    <input type="hidden" name="harga_produk" value="<?php echo htmlspecialchars($produk['harga']); ?>">
                    
                    <?php if ($produk['ketersediaan_stok'] == 'tersedia') { ?>
                        <!-- <button type="submit" name="action" value="beli" class="btn btn-primary">Beli Sekarang</button> -->
                        <button type="submit" name="action" value="keranjang" class="btn btn-secondary">Tambah ke Keranjang</button>
                    <?php } else { ?>
                        <button type="button" class="btn btn-secondary" disabled>Stok Habis</button>
                    <?php } ?>
                </form>
            </div>
        </div>

        <!-- Rekomendasi Produk -->
        <div class="container py-5">
            <h3 class="text-center mb-4">Produk Rekomendasi</h3>
            <div class="row">
                <?php
                if (mysqli_num_rows($queryRekomendasi) > 0) {
                    while ($rekomendasi = mysqli_fetch_array($queryRekomendasi)) { ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <img src="image/<?php echo htmlspecialchars($rekomendasi['foto']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($rekomendasi['nama']); ?>">
                                <div class="card-body">
                                    <h4 class="card-title"><?php echo htmlspecialchars($rekomendasi['nama']); ?></h4>
                                    <p class="card-text text-harga">Rp <?php echo number_format($rekomendasi['harga'], 0, ',', '.'); ?></p>
                                    <a href="produk-detail.php?p=<?php echo urlencode($rekomendasi['id']); ?>" class="btn warna2 text-white">Lihat Produk</a>
                                </div>
                            </div>
                        </div>
                    <?php }
                } else {
                    echo '<div class="col-12"><p class="text-center">Tidak ada produk rekomendasi untuk kategori ini.</p></div>';
                }
                ?>
            </div>
        </div>
    </div>

    <?php require "footer.php"; ?>
</body>
</html>
