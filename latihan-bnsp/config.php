<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pendaftaran_siswa";

    $koneksi = new mysqli($servername, $username, $password, $dbname);
    if ($koneksi->connect_error) {
        die("Gagal terkoneksi: " . $koneksi->connect_error);
    }
?>