<?php
    session_start();
    include "config.php";
    if(!isset($_SESSION['username']) || $_SESSION['role'] != 'calon siswa') {
        header('location: login.php');
        exit;
    }

    $username = $_SESSION['username'];
    $status = null;
    $hasDaftar = false;
    
    $query = mysqli_query($koneksi, "SELECT status_pendaftaran FROM pendaftaran_siswa WHERE username = '$username'");
    if($data = mysqli_fetch_assoc($query)) {
        $status = $data['status_pendaftaran'];
        $hasDaftar = true;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard calon siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1>Selamat datang, Calon siswa : <?= $_SESSION['username']?></h1>
        <div class="d-flex gap-3 mb-4 mt-2">
            <a href="siswa-formulir.php" class="btn btn-primary">📝 Pendaftaran siswa baru</a>
            <a href="logout.php" class="btn btn-danger">🔓 Logout</a>
        </div>
    </div>
    <div class="container mt-5">
       <div class="">
            <?php if($hasDaftar): ?>
                <div class="alert alert-warning" role="alert">
                    <h3>Status pendaftaran : <?= $status?></h3>
                </div>
            <?php else: ?>
                <div class="alert alert-danger" role="alert">
                    <h3>Anda belum daftar</h3>
                    <p>Silakan klik tombol "Pendaftaran siswa baru" untuk melakukan pendaftaran.</p>
                </div>
            <?php endif; ?>
       </div>
    </div>
    <div class="container">
    <table class="table border text-center">
    <thead>
        <tr>
        <th scope="col">No</th>
        <th scope="col">Nama lengkap</th>
        <th scope="col">NISN</th>
        <th scope="col">Jenis kelamin</th>
        <th scope="col">Alamat</th>
        <th scope="col">Asal sekolah</th>
        <th scope="col">Status pendaftaran</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM pendaftaran_siswa WHERE username = '$username'";
        $query = mysqli_query($koneksi, $sql);
        $no = 1;
        while($data = mysqli_fetch_array($query)){
            echo "<tr>";
            echo "<td>".$no++."</td>";
            echo "<td>".$data['nama_lengkap']."</td>";
            echo "<td>".$data['nisn']."</td>";
            echo "<td>".$data['jk']."</td>";
            echo "<td>".$data['alamat']."</td>";
            echo "<td>".$data['sekolah_asal']."</td>";
            echo "<td>".$data['status_pendaftaran']."</td>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
    </table>
    </div>
</body>
</html>
