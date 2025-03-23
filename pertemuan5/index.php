<?php
session_start();

// Konfigurasi database dengan PDO
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "market";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}

// Proses Registrasi
if (isset($_POST["register"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Cek apakah email sudah terdaftar
    $stmt = $conn->prepare("SELECT email FROM users WHERE email = :email");
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $_SESSION["error"] = "Email sudah terdaftar!";
    } else {
        $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $password);

        if ($stmt->execute()) {
            $_SESSION["success"] = "Registrasi berhasil! Silakan login.";
        } else {
            $_SESSION["error"] = "Gagal mendaftar!";
        }
    }
}

// Proses Login
if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["user_id"];
            $_SESSION["username"] = $user["username"];
            header("Location: registration.php");
            exit();
        } else {
            $_SESSION["error"] = "Password salah!";
        }
    } else {
        $_SESSION["error"] = "Email tidak terdaftar!";
    }
}

// Logout
if (isset($_GET["logout"])) {
    session_destroy();
    header("Location: index.php");
    exit();
}
?>



<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Registrasi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow-lg" style="width: 350px;">
            <?php if (isset($_SESSION["user_id"])) { ?>
                <h3 class="text-center">Dashboard</h3>
                <p class="text-center">Selamat Datang, <b><?php echo $_SESSION["username"]; ?></b>!</p>
                <a href="index.php?logout=true" class="btn btn-danger w-100">Logout</a>
            <?php } else { ?>
                <ul class="nav nav-tabs mb-3">
                    <li class="nav-item"><a class="nav-link active" id="login-tab" href="#">Login</a></li>
                    <li class="nav-item"><a class="nav-link" id="register-tab" href="#">Registrasi</a></li>
                </ul>

                <!-- Form Login -->
                <form method="POST" id="login-form">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
                </form>

                <!-- Form Registrasi -->
                <form method="POST" id="register-form" style="display: none;">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" name="register" class="btn btn-success w-100">Daftar</button>
                </form>
            <?php } ?>
        </div>
    </div>

    <script>
        document.getElementById("login-tab").addEventListener("click", function () {
            document.getElementById("login-form").style.display = "block";
            document.getElementById("register-form").style.display = "none";
            this.classList.add("active");
            document.getElementById("register-tab").classList.remove("active");
        });

        document.getElementById("register-tab").addEventListener("click", function () {
            document.getElementById("login-form").style.display = "none";
            document.getElementById("register-form").style.display = "block";
            this.classList.add("active");
            document.getElementById("login-tab").classList.remove("active");
        });

        <?php if (isset($_SESSION["error"])) { ?>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '<?php echo $_SESSION["error"]; ?>',
            });
        <?php unset($_SESSION["error"]); } ?>

        <?php if (isset($_SESSION["success"])) { ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '<?php echo $_SESSION["success"]; ?>',
            });
        <?php unset($_SESSION["success"]); } ?>
    </script>
</body>
</html>
