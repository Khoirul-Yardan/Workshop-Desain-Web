<?php
setcookie("user", "John Doe", time() + (86400 * 30), "/");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cookies</title>
</head>
<body>
    <h2>Cookie telah diset.</h2>
    <a href="session.php">Lanjut ke Session</a>
</body>
</html>
