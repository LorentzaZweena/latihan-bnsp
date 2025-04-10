<?php
    include "config.php";
    
    $alert_message = '';
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $nama_lengkap = $_POST['nama_lengkap'];
        $role = "calon siswa";

        if(strlen($password) < 6) {
            $alert_message = "password_short";
        } else {
            $query = "INSERT INTO users (username, password, nama_lengkap, role) VALUES ('$username', '$password', '$nama_lengkap', '$role')";
            $result = mysqli_query($koneksi, $query);
            if($result){
                $alert_message = "success";
            } else {
                $alert_message = "error";
            }
        }
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar | Pendaftaran siswa BNSP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>
  <body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-4 mt-5">
                <div class="card mt-5">
                    <h5 class="card-header fs-2 p-4 text-center bg-dark text-light">Register</h5>
                    <div class="card-body">
                    <form method="post">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label fw-semibold">Username</label>
                                <input type="text" class="form-control" id="nama" name="username" aria-describedby="emailHelp" placeholder="Masukkan username" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label fw-semibold">Password</label>
                                <input type="password" class="form-control" id="password" name="password" aria-describedby="emailHelp" placeholder="Masukkan password" required>
                                <!-- <small class="text-muted">Password harus minimal 6 karakter</small> -->
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label fw-semibold">Nama lengkap</label>
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" aria-describedby="emailHelp" placeholder="Masukkan nama lengkap" required>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-dark w-100" id="submit" name="submit">Register</button>
                            </div>
                            <div class="mb-3">
                                <p class="text-center">Sudah punya akun? <a href="index.php">Login sebagai calon siswa</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <?php if($alert_message === 'success'): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'Berhasil mendaftar',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'index.php';
            }
        });
    </script>
    <?php elseif($alert_message === 'error'): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Gagal mendaftar',
        });
    </script>
    <?php elseif($alert_message === 'password_short'): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Password Terlalu Pendek',
            text: 'Password harus minimal 6 karakter',
        });
    </script>
    <?php endif; ?>
  </body>
</html>
