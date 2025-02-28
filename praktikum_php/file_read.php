<?php
$file = fopen("data.txt", "r");
$data = fread($file, filesize("data.txt"));
fclose($file);
?>
<!DOCTYPE html>
<html>
<head>
    <title>File Read</title>
</head>
<body>
    <h2>Hasil Baca File:</h2>
    <pre><?php echo $data; ?></pre>
    <a href="upload.php">Lanjut ke File Upload</a>
</body>
</html>
