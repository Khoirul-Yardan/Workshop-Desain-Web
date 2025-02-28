<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workshop Pemrograman Web - Start</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">
        <h1>Workshop Pemrograman Web</h1>
        <p>Selamat datang di praktikum pemrograman web menggunakan PHP.</p>

        <button id="startBtn">Mulai Workshop</button>

        <div id="menu" class="hidden">
            <h2>Pilih Modul:</h2>
            <ul>
                <li><a href="form.php">📝 Form Handling</a></li>
                <li><a href="file_write.php">📄 File Write</a></li>
                <li><a href="file_read.php">📖 File Read</a></li>
                <li><a href="upload.php">📤 File Upload</a></li>
                <li><a href="cookies.php">🍪 Cookies</a></li>
                <li><a href="session.php">🔑 Session</a></li>
                <li><a href="json.php">📊 JSON Handling</a></li>
            </ul>
        </div>
    </div>

    <script>
        document.getElementById("startBtn").addEventListener("click", function() {
            document.getElementById("menu").classList.toggle("hidden");
            this.style.display = "none"; // Sembunyikan tombol setelah diklik
        });
    </script>

</body>
</html>
