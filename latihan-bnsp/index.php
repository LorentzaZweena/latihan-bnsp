<?php
    include "config.php";
    session_start();
    
    // if (isset($_POST['username']) && isset($_POST['password'])) {
    //     $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    //     $password = $_POST['password'];
        
    //     $sql = "SELECT * FROM `users` WHERE `username` = ?";
    //     $stmt = mysqli_prepare($koneksi, $sql);
    //     mysqli_stmt_bind_param($stmt, "s", $username);
    //     mysqli_stmt_execute($stmt);
    //     $result = mysqli_stmt_get_result($stmt);
        
    //     if ($data = mysqli_fetch_assoc($result)) {
    //         if ($data['password'] === $password) {
    //             $_SESSION['status'] = $data['login'];
    //             $_SESSION['id'] = $data['id'];
    //             $_SESSION['nama'] = $data['nama'];
    //             $_SESSION['username'] = $data['username'];
    //             $_SESSION['login'] = true;
    //             header('location: dashboard.php');
    //             exit;
    //         } else {
    //             $error = "Password salah!";
    //         }
    //     } else {
    //         $error = "Username tidak ditemukan!";
    //     }
    // }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

        $result = $koneksi->query($query);
        if($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            if($user['role'] == 'admin') {
                header('location: admin/dashboard.php');
                exit;
            } else {
                header('location: dashboard.php');
                exit;
            }
        }
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Pendaftaran siswa BNSP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>
  <body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-4 mt-5">
                <div class="card mt-5">
                    <h5 class="card-header fs-2 p-4 text-center bg-dark text-light">Login</h5>
                    <div class="card-body">
                    <?php if(isset($error)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>
                    <form method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label fw-semibold">Username</label>
                                <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" placeholder="Masukkan username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold">Password</label>
                                <input type="password" class="form-control" id="password" name="password" aria-describedby="emailHelp" placeholder="Masukkan password" required>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-dark w-100" id="submit" name="submit">Login</button>
                            </div>
                            <div class="mb-3">
                                <p class="text-center">Tidak punya akun? <a href="register.php">Daftar sebagai calon siswa</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
