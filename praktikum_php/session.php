<?php
session_start();
$_SESSION["username"] = "JohnDoe";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Session</title>
</head>
<body>
    <h2>Session telah dibuat.</h2>
    <p>Username: <?php echo $_SESSION["username"]; ?></p>
    <a href="json.php">Lanjut ke JSON Handling</a>
</body>
</html>
