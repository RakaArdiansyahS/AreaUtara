<?php

// Hitung total item di keranjang
$cartCount = 0;
if (isset($_SESSION['cart'])) {
    $cartCount = array_sum($_SESSION['cart']);
}

// Periksa apakah pengguna sudah login
$isLoggedIn = isset($_SESSION['username']);
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item me-4">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item me-4">
          <a class="nav-link" href="produk.php">Produk</a>
        </li>
        <li class="nav-item me-4">
          <a class="nav-link" href="cart.php">
            Keranjang <span class="badge bg-secondary"><?php echo $cartCount; ?></span>
          </a>
        </li>
        <li class="nav-item me-4">
          <a class="nav-link" href="about-us.php">About Us</a>
        </li>
        <li class="nav-item-4">
            <a class="nav-link" href="faq.php">FAQ</a>
        </li>
        <?php if (isset($_SESSION['username'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Daftar</a>
                    </li>
                <?php } ?>
      </ul>
    </div>
  </div>
</nav>

