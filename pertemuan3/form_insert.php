<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nama'], $_POST['nim'], $_POST['jurusan'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $nim = mysqli_real_escape_string($conn, $_POST['nim']);
    $jurusan = mysqli_real_escape_string($conn, $_POST['jurusan']);

    // Cek duplikasi NIM 
    $cekNim = "SELECT * FROM mahasiswa WHERE BINARY nim='$nim'";
    $resultNim = mysqli_query($conn, $cekNim);

    // Cek duplikasi Nama 
    $cekNama = "SELECT * FROM mahasiswa WHERE LOWER(nama) = LOWER('$nama')";
    $resultNama = mysqli_query($conn, $cekNama);

    if (mysqli_num_rows($resultNim) > 0) {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Data dengan NIM tersebut sudah ada!'
                    });
                });
              </script>";
    } elseif (mysqli_num_rows($resultNama) > 0) {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Data dengan Nama tersebut sudah ada!'
                    });
                });
              </script>";
    } else {
        $sql = "INSERT INTO mahasiswa (nama, nim, jurusan) VALUES ('$nama', '$nim', '$jurusan')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Data berhasil ditambahkan!'
                        }).then(() => { window.location.href = ''; });
                    });
                  </script>";
        } else {
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Terjadi Kesalahan!'
                        });
                    });
                  </script>";
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['hapus_id'])) {
    $id = mysqli_real_escape_string($conn, $_POST['hapus_id']);
    $sql = "DELETE FROM mahasiswa WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data berhasil dihapus!'
                    }).then(() => { window.location.href = ''; });
                });
              </script>";
    } else {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Gagal menghapus data!'
                    });
                });
              </script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            width: 80%;
            margin: auto;
            background-color: #f4f4f4;
            padding: 20px;
        }
        header {
            text-align: center;
            margin-bottom: 20px;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px 0px #0000001a;
        }
        input, button {
            margin: 5px 0;
            padding: 10px;
            width: 100%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #ffcc00;
        }
        .delete-btn {
            background: red;
            color: white;
            border: none;
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 4px;
        }
        .delete-btn:hover {
            background: darkred;
        }
    </style>
</head>
<body>
<header>
    <h1 class="title">Data Mahasiswa</h1>
</header>
<div class="container">
    <h3 class="desc">Form Tambah Data Mahasiswa</h3>
    <form method="POST" action="">
        <input type="text" name="nama" placeholder="Nama" required>
        <input type="text" name="nim" placeholder="NIM" required>
        <input type="text" name="jurusan" placeholder="Jurusan" required>
        <button type="submit">Simpan</button>
    </form>
</div>
<div class="container">
    <h3>Data Mahasiswa</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Jurusan</th>
            <th>Aksi</th>
        </tr>
        <?php
        $sql = "SELECT * FROM mahasiswa";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['nama']}</td>
                        <td>{$row['nim']}</td>
                        <td>{$row['jurusan']}</td>
                        <td>
                            <button class='delete-btn' onclick='confirmDelete({$row['id']})'>Hapus</button>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
        }
        ?>
    </table>
</div>

<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: 'Data yang dihapus tidak bisa dikembalikan!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = '';
            let input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'hapus_id';
            input.value = id;
            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        }
    });
}
</script>

</body>
</html>
