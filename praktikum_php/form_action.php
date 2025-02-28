<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION["nama"] = htmlspecialchars($_POST["nama"]);
    $_SESSION["email"] = htmlspecialchars($_POST["email"]);

    // Redirect ke file_write.php setelah submit
    header("Location: file_write.php");
    exit;
}
?>
