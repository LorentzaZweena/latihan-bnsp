<?php
    session_start();
    include "config.php";
    if(!isset($_SESSION['username']) || $_SESSION['role'] != 'calon siswa') {
        header('location: index.php');
        exit;
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
</body>
</html>