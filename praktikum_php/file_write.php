<?php
session_start();
$file = fopen("data.txt", "w");
fwrite($file, "Nama: " . $_SESSION["nama"] . "\nEmail: " . $_SESSION["email"]);
fclose($file);
?>
<!DOCTYPE html>
<html>
<head>
    <title>File Write</title>
</head>
<body>
    <h2>Data telah ditulis ke file.</h2>
    <a href="file_read.php">Lanjut ke File Read</a>
</body>
</html>
