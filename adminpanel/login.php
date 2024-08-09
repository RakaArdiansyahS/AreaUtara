<?php
session_start();
require "../koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <style>
        .main {
            height: 100vh; /* Menggunakan seluruh tinggi viewport */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            width: 500px;
            height: 300px;
            border: solid 1px #ccc;
            box-sizing: border-box;
            border-radius: 10px;
            padding: 20px; /* Tambahkan padding jika diperlukan */
            background-color: #fff; /* Warna latar belakang untuk box */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Tambahkan bayangan untuk efek visual */
        }
    </style>
</head>
<body>
    <div class="main d-flex flex-column">
        <div class="login-box p-5">
            <form action="" method="post">
                <div>
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username" required>
                </div>

                <div>
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>

                <div>
                    <button class="btn btn-success form-control mt-3" type="submit" name="loginbtn">Login</button>
                </div>
            </form>
        </div>
        <div>
            <div class="mt-3" style="width: 500px">
            <?php
                if(isset($_POST['loginbtn'])){
                    $username = htmlspecialchars($_POST['username']);
                    $password = htmlspecialchars($_POST['password']);

                    // Hanya username "admin" yang diperbolehkan
                    if($username === "admin"){
                        $query = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
                        $countdata = mysqli_num_rows($query);
                        $data = mysqli_fetch_array($query);
                        
                        if($countdata > 0){
                            if (password_verify($password, $data['password'])){
                                $_SESSION['username'] = $data['username'];
                                $_SESSION['login'] = true;
                                header('location: ../adminpanel');
                                exit(); // Pastikan tidak ada kode yang dijalankan setelah redirect
                            }
                            else{
                                ?>
                                <div class="alert alert-warning" role="alert">
                                    Password Salah!
                                </div>
                                <?php
                            }
                        }
                        else{
                            ?>
                            <div class="alert alert-warning" role="alert">
                                Akun Tidak Tersedia!
                            </div>
                            <?php
                        }
                    }
                    else{
                        ?>
                        <div class="alert alert-warning" role="alert">
                            Silahkan login di halaman user!
                        </div>
                        <?php
                    }
                }
            ?>
            </div>
        </div>
    </div>
</body>
</html>
