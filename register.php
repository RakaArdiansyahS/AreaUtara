<?php
require "koneksi.php";

// Variabel untuk pesan
$registerMessage = '';

// Fungsi untuk memeriksa apakah string adalah email
function isEmail($string) {
    return filter_var($string, FILTER_VALIDATE_EMAIL) !== false;
}

// Proses pendaftaran
if (isset($_POST['register'])) {
    $newUsername = mysqli_real_escape_string($con, $_POST['register_username']);
    $newPassword = mysqli_real_escape_string($con, $_POST['register_password']);

    // Validasi panjang username
    if (strlen($newUsername) > 50) {
        $registerMessage = 'Username terlalu panjang! Maksimal 50 karakter.';
    } elseif (isEmail($newUsername)) {
        $registerMessage = 'Username tidak boleh berupa email!';
    } else {
        // Periksa apakah username sudah ada
        $checkQuery = "SELECT * FROM users WHERE username='$newUsername'";
        $checkResult = mysqli_query($con, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            $registerMessage = 'Username sudah terdaftar!';
        } else {
            $insertQuery = "INSERT INTO users (username, password) VALUES ('$newUsername', MD5('$newPassword'))";
            if (mysqli_query($con, $insertQuery)) {
                $registerMessage = 'Pendaftaran berhasil! Silakan login.';
            } else {
                $registerMessage = 'Terjadi kesalahan saat pendaftaran.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php require "navbar.php"; ?>

    <div class="container py-5">
        <div class="row">
            <!-- Register Form -->
            <div class="col-md-6 offset-md-3">
                <h2 class="mb-4 text-center">Daftar</h2>
                <?php if ($registerMessage) { ?>
                    <div class="alert alert-info"><?php echo htmlspecialchars($registerMessage); ?></div>
                <?php } ?>
                <form action="register.php" method="POST">
                    <div class="mb-3">
                        <label for="register_username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="register_username" name="register_username" required>
                    </div>
                    <div class="mb-3">
                        <label for="register_password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="register_password" name="register_password" required>
                    </div>
                    <button type="submit" name="register" class="btn btn-primary">Daftar</button>
                </form>
            </div>
        </div>
    </div>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>
</html>

<?php mysqli_close($con); ?>
