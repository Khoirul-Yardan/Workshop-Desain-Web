<?php
$data = ["name" => "John", "age" => 30];
?>
<!DOCTYPE html>
<html>
<head>
    <title>JSON Handling</title>
</head>
<body>
    <h2>Data JSON:</h2>
    <pre><?php echo json_encode($data, JSON_PRETTY_PRINT); ?></pre>
    <a href="index.php">Kembali ke Halaman Utama</a>
</body>
</html>
