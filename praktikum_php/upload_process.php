<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

// Redirect ke halaman cookies.php setelah upload berhasil
header("Location: cookies.php");
exit;
?>
