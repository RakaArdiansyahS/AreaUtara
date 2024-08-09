<?php
session_start();
require "koneksi.php";

// Ambil produk
$queryProduk = mysqli_query($con, "SELECT id, nama, harga, foto, detail FROM produk LIMIT 6");

// Ambil produk untuk rekomendasi secara acak
$recommendedProducts = [];
if (isset($_SESSION['username'])) {
    // Mengambil 6 produk secara acak dari tabel produk
    $recommendedQuery = "SELECT id, nama, harga, foto, detail FROM produk ORDER BY RAND() LIMIT 6";
    $recommendedResult = mysqli_query($con, $recommendedQuery);
    while ($row = mysqli_fetch_assoc($recommendedResult)) {
        $recommendedProducts[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AreaUtara | Home</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php require "navbar.php"; ?>

    <!-- banner -->
    <div class="container-fluid banner d-flex align-items-center">
        <div class="container text-center text-white">
            <h1>Selamat Datang di AreaUtara</h1>
            <h3>Mau Cari Produk Apa?</h3>
            <div class="col-md-8 offset-md-2">
                <form method="get" action="produk.php">
                    <div class="input-group input-group-lg my-4">
                        <input type="text" class="form-control" placeholder="Cari Nama Produk"
                        aria-label="Recipient's username" aria-describedby="basic-addon2" name="keyword">
                        <button type="submit" class="btn warna2 text-white">Cari</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- hightlight kategori -->
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Kategori Terlaris</h3>

            <div class="row mt-5">
                <div class="col-md-4 mb-3">
                    <div class="highlighted-kategori kategori-balaclava d-flex justify-content-center align-items-center">
                        <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=Balaclava">Balaclava</a></h4>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="highlighted-kategori kategori-hoodie d-flex justify-content-center align-items-center">
                        <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=Hoodie">Hoodie</a></h4>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="highlighted-kategori kategori-baju d-flex justify-content-center align-items-center">
                        <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=T-Shirt">T-Shirt</a></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--About Us-->
    <div class="container-fluid warna4 py-5">
        <div class="container text-center">
            <h3>About Us</h3>
            <p class="fs-5 mt-3">
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nulla esse ducimus consectetur minima enim. Corporis modi ducimus eligendi voluptates sequi reiciendis dolore vel, officiis voluptatum, harum quam atque error quae. Doloremque maiores, velit temporibus veniam illo quo, ex soluta provident excepturi eum consectetur incidunt? Voluptatum cum a tenetur, tempore ducimus aliquid vitae quam, temporibus quasi odit, iure id. Dolore sequi natus voluptatum blanditiis ipsam aut aspernatur, tenetur consequuntur dicta beatae quis doloremque, amet quam, nulla ad id architecto excepturi illum cupiditate est hic adipisci ullam! Maiores rem tenetur ipsa eius repellat quas consequuntur ipsam! Tempore magnam aliquid itaque asperiores dicta.
            </p>
        </div>
    </div>

    <!-- Produk-->
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Produk</h3>

            <div class="row mt-5">
                <?php while($data = mysqli_fetch_array($queryProduk)){ ?>
                <div class="col-sm-6 col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="image-box">
                            <img src="image/<?php echo $data['foto']; ?>" class="card-img-top" alt="..."> 
                        </div>
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $data['nama']; ?></h4>
                            <p class="card-text text-truncate"><?php echo $data['detail']; ?></p>
                            <p class="card-text text-harga">Rp <?php echo $data['harga']; ?></p>
                            <a href="produk-detail.php?p=<?php echo $data['nama']; ?>" class="btn warna2 text-white">Lihat Produk</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <a class="btn btn-outline-secondary warna3 mt-3 p-3 fs-3" href="produk.php">See More</a>
        </div>
    </div>

    <!-- Produk Rekomendasi -->
    <?php if (!empty($recommendedProducts)) { ?>
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Rekomendasi Produk untuk Anda</h3>

            <div class="row mt-5 ">
                <?php foreach ($recommendedProducts as $data) { ?>
                <div class="col-sm-6 col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="image-box">
                            <img src="image/<?php echo $data['foto']; ?>" class="card-img-top" alt="..."> 
                        </div>
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $data['nama']; ?></h4>
                            <p class="card-text text-truncate"><?php echo $data['detail']; ?></p>
                            <p class="card-text text-harga">Rp <?php echo $data['harga']; ?></p>
                            <a href="produk-detail.php?p=<?php echo $data['nama']; ?>" class="btn warna2 text-white">Lihat Produk</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php } ?>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <h5>Follow Us</h5>
            <div class="mt-3">
                <a href="https://www.instagram.com/areautara/" target="_blank" class="text-white mx-3">
                    <i class="fab fa-instagram fa-2x"></i>
                </a>
                <a href="https://www.facebook.com/areautaraultras/" target="_blank" class="text-white mx-3">
                    <i class="fab fa-facebook fa-2x"></i>
                </a>
                <a href="https://wa.me/+6285161242408" target="_blank" class="text-white mx-3">
                    <i class="fab fa-whatsapp fa-2x"></i>
                </a>
            </div>
            <p class="mt-3 mb-0">&copy; 2024 AreaUtara. All rights reserved.</p>
        </div>
    </footer>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const locationInfo = document.getElementById('location-info');

            function showPosition(position) {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;
                locationInfo.textContent = `Latitude: ${latitude}, Longitude: ${longitude}`;
            }

            function showError(error) {
                switch(error.code) {
                    case error.PERMISSION_DENIED:
                        locationInfo.textContent = "User denied the request for Geolocation.";
                        break;
                    case error.POSITION_UNAVAILABLE:
                        locationInfo.textContent = "Location information is unavailable.";
                        break;
                    case error.TIMEOUT:
                        locationInfo.textContent = "The request to get user location timed out.";
                        break;
                    case error.UNKNOWN_ERROR:
                        locationInfo.textContent = "An unknown error occurred.";
                        break;
                }
            }

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                locationInfo.textContent = "Geolocation is not supported by this browser.";
            }
        });
    </script>
</body>
</html>
