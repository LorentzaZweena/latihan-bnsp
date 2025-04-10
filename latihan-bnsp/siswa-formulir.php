<?php
    include "config.php";
    session_start();

    $alert_message = "";

    if (isset($_POST['submit'])) {  
        $username = $_SESSION['username'];
        $nama_lengkap = $_POST['nama_lengkap'];
        $nisn = $_POST['nisn'];
        $jk = $_POST['jenis_kelamin'];
        $alamat = $_POST['alamat'];
        $asal_sekolah = $_POST['asal_sekolah'];

        $sql = "INSERT INTO pendaftaran_siswa (username, nama_lengkap, nisn, jk, alamat, sekolah_asal) VALUES ('$username', '$nama_lengkap', '$nisn', '$jk', '$alamat', '$asal_sekolah')";

        $result = mysqli_query($koneksi, $sql);

        if ($result) {
            $alert_message = "success";
        } else {
            $alert_message = "error";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
      <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <h5 class="card-header fs-2 p-4 text-center bg-dark text-light">Form pendaftaran</h5>
                    <div class="card-body">
                    <form method="POST" action="" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label fw-semibold">Nama lengkap siswa</label>
                                <input type="text" class="form-control" id="nama" aria-describedby="emailHelp" placeholder="Masukkan nama lengkap" name="nama_lengkap" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label fw-semibold">Nomor induk siswa nasional</label>
                                <input type="number" class="form-control" id="no_identitas" aria-describedby="emailHelp" placeholder="Masukkan NISN" name="nisn" oninput="validateNumber(this)" required>
                                <div id="numberError" class="text-danger" style="display: none;">Harus diisi dengan angka</div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label fw-semibold">Jenis kelamin</label>
                                <div class="d-flex flex-row mb-3">
                                    <div class="p-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki_laki" value="Laki-laki" checked>
                                            <label class="form-check-label" for="laki_laki">
                                                Laki laki
                                            </label>
                                        </div>
                                    </div>
                                    <div class="p-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="Perempuan">
                                            <label class="form-check-label" for="perempuan">
                                                Perempuan
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label fw-semibold">Alamat</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="alamat" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label fw-semibold">Asal sekolah</label>
                                <input type="text" class="form-control" id="sekolah_asal" aria-describedby="emailHelp" placeholder="Masukkan asal sekolah" name="asal_sekolah" required>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-dark w-100" id="submit" name="submit">Daftar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if($alert_message === 'success'): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'Berhasil terdaftar',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'dashboard.php';
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
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        function validateNumber(input) {
        const value = input.value;
        const errorDiv = document.getElementById('numberError');
        
        if (isNaN(value) || value === '') {
            errorDiv.style.display = 'block';
            input.setCustomValidity('Harus diisi dengan angka');
        } else {
            errorDiv.style.display = 'none';
            input.setCustomValidity('');
        }
    }
    </script>
</body>
</html>
