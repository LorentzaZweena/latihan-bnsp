<?php
    session_start();
    include "config.php";
    if(!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
        header('location: index.php');
        exit;
    }

    if(!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
        echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
        exit;
    }

    if(isset($_POST['id']) && isset($_POST['status'])) {
        $id = mysqli_real_escape_string($koneksi, $_POST['id']);
        $status = mysqli_real_escape_string($koneksi, $_POST['status']);
        
        $validStatuses = ['Diterima', 'Cadangan', 'Tidak Diterima'];
        if(!in_array($status, $validStatuses)) {
            echo json_encode(['success' => false, 'message' => 'Invalid status value']);
            exit;
        }
        
        $sql = "UPDATE pendaftaran_siswa SET status_pendaftaran = ? WHERE id = ?";
        $stmt = mysqli_prepare($koneksi, $sql);
        mysqli_stmt_bind_param($stmt, "si", $status, $id);
        
        if(mysqli_stmt_execute($stmt)) {
            echo json_encode(['success' => true, 'status' => $status]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Database error: ' . mysqli_error($koneksi)]);
        }
        
        mysqli_stmt_close($stmt);
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard admin | Pendaftaran siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1>Selamat datang, admin : <?= $_SESSION['username']?></h1>
        <div class="d-flex gap-3 mb-4 mt-2">
            <!-- <a href="" class="btn btn-primary">📝 Halaman admin</a> -->
            <a href="logout.php" class="btn btn-danger">🔓 Logout</a>
        </div>
    </div>
    <div class="container mt-5">
        <div id="statusUpdateAlert" class="alert alert-success" style="display: none;">
            Status berhasil diperbarui menjadi: <span id="updatedStatus"></span>
        </div>
        <div id="statusUpdateErrorAlert" class="alert alert-danger" style="display: none;">
            Gagal memperbarui status!
        </div>
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
        $sql = "SELECT * FROM pendaftaran_siswa";
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
            echo "<td>";
            echo "<select class='form-select status-dropdown text-center' data-id='".$data['id']."' data-name='".$data['nama_lengkap']."'>";
            $statuses = ['Diterima', 'Cadangan', 'Tidak Diterima'];
            foreach($statuses as $status) {
                $selected = ($data['status_pendaftaran'] == $status) ? 'selected' : '';
                echo "<option value='$status' $selected>$status</option>";
            }
            echo "</select>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
    </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.status-dropdown').change(function() {
                const studentId = $(this).data('id');
                const studentName = $(this).data('name');
                const newStatus = $(this).val();
                const dropdown = $(this);
                
                $.ajax({
                    type: 'POST',
                    url: 'dashboard-admin.php',
                    data: {
                        id: studentId,
                        status: newStatus
                    },
                    success: function(response) {
                        try {
                            const result = JSON.parse(response);
                            if(result.success) {
                                $('#updatedStatus').text(result.status);
                                $('#statusUpdateAlert')
                                    .html(`Status <strong>${studentName}</strong> berhasil diperbarui menjadi: <strong>${result.status}</strong>`)
                                    .fadeIn()
                                    .delay(3000)
                                    .fadeOut();
                                
                                dropdown.closest('tr').addClass('table-success');
                                setTimeout(function() {
                                    dropdown.closest('tr').removeClass('table-success');
                                }, 3000);
                            } else {
                                $('#statusUpdateErrorAlert')
                                    .html(`Gagal memperbarui status: ${result.message}`)
                                    .fadeIn()
                                    .delay(3000)
                                    .fadeOut();
                            }
                        } catch (e) {
                            $('#statusUpdateErrorAlert')
                                .html('Terjadi kesalahan saat memproses respons server')
                                .fadeIn()
                                .delay(3000)
                                .fadeOut();
                        }
                    },
                    error: function() {
                        $('#statusUpdateErrorAlert')
                            .html('Terjadi kesalahan saat menghubungi server')
                            .fadeIn()
                            .delay(3000)
                            .fadeOut();
                    }
                });
            });
        });
    </script>
</body>
</html>
