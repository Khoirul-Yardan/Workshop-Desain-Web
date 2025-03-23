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

// Simulasi user login jika belum ada
if (!isset($_SESSION["user_id"])) {
    $_SESSION["user_id"] = rand(1, 1000);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit_form"])) {
    $user_id = $_SESSION["user_id"];
    $full_name = $_POST["full_name"];
    $address = $_POST["address"];
    $postal_code = $_POST["postal_code"];
    $phone = $_POST["phone"];
    $place_of_birth = $_POST["place_of_birth"];
    $date_of_birth = $_POST["date_of_birth"];
    $gender = $_POST["gender"];
    
    // Pastikan 'religion[]' tidak kosong sebelum implode()
    $religion = isset($_POST["religion"]) ? implode(", ", $_POST["religion"]) : "Not Specified";
    
    $attended_school = $_POST["attended_school"];

    // Query INSERT dengan PDO
    $sql = "INSERT INTO registrations (user_id, full_name, address, postal_code, phone, place_of_birth, date_of_birth, gender, religion, attended_school) 
            VALUES (:user_id, :full_name, :address, :postal_code, :phone, :place_of_birth, :date_of_birth, :gender, :religion, :attended_school)";
    
    $stmt = $conn->prepare($sql);
    
    $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
    $stmt->bindParam(":full_name", $full_name, PDO::PARAM_STR);
    $stmt->bindParam(":address", $address, PDO::PARAM_STR);
    $stmt->bindParam(":postal_code", $postal_code, PDO::PARAM_STR);
    $stmt->bindParam(":phone", $phone, PDO::PARAM_STR);
    $stmt->bindParam(":place_of_birth", $place_of_birth, PDO::PARAM_STR);
    $stmt->bindParam(":date_of_birth", $date_of_birth, PDO::PARAM_STR);
    $stmt->bindParam(":gender", $gender, PDO::PARAM_STR);
    $stmt->bindParam(":religion", $religion, PDO::PARAM_STR);
    $stmt->bindParam(":attended_school", $attended_school, PDO::PARAM_STR);
    
    if ($stmt->execute()) {
        $_SESSION["success"] = "Pendaftaran berhasil!";
    } else {
        $_SESSION["error"] = "Gagal mendaftar!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Registrasi Kursus</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h3 class="text-center">Form Registrasi Kursus</h3>
        <form method="POST" class="card p-4 shadow-lg">
            <input type="text" name="full_name" class="form-control mb-2" placeholder="Full Name" required>
            <input type="text" name="address" class="form-control mb-2" placeholder="Address" required>
            <input type="text" name="postal_code" class="form-control mb-2" placeholder="Postal Code">
            <input type="text" name="phone" class="form-control mb-2" placeholder="Telephone Number" required>
            <input type="text" name="place_of_birth" class="form-control mb-2" placeholder="Place of Birth" required>
            <input type="date" name="date_of_birth" class="form-control mb-2" required>
            <select name="gender" class="form-control mb-2" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
            <label>Religion:</label><br>
            <input type="checkbox" name="religion[]" value="Muslim"> Muslim
            <input type="checkbox" name="religion[]" value="Christian"> Christian
            <input type="checkbox" name="religion[]" value="Hinduism"> Hinduism
            <input type="checkbox" name="religion[]" value="Buddhism"> Buddhism
            <input type="checkbox" name="religion[]" value="Others"> Others
            <input type="text" name="attended_school" class="form-control mb-2 mt-2" placeholder="Attended School" required>
            <button type="submit" name="submit_form" class="btn btn-primary w-100">Submit</button>
        </form>

        <?php if (isset($_SESSION["success"])) { ?>
            <div class="alert alert-success mt-3"><?php echo $_SESSION["success"]; unset($_SESSION["success"]); ?></div>
        <?php } ?>
        <?php if (isset($_SESSION["error"])) { ?>
            <div class="alert alert-danger mt-3"><?php echo $_SESSION["error"]; unset($_SESSION["error"]); ?></div>
        <?php } ?>
        
        <h3 class="text-center mt-5">Hasil Pendaftaran</h3>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Full Name</th>
                    <th>Address</th>
                    <th>Postal Code</th>
                    <th>Phone</th>
                    <th>Birth</th>
                    <th>Gender</th>
                    <th>Religion</th>
                    <th>School</th>
                </tr>
            </thead>
            <tbody>
            <?php
$user_id = $_SESSION["user_id"];
$sql = "SELECT * FROM registrations WHERE user_id = :user_id";
$stmt = $conn->prepare($sql);

// Bind parameter menggunakan PDO
$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
$stmt->execute();

// Ambil hasil query
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$no = 1;

foreach ($result as $row) {
    echo "<tr>
            <td>{$no}</td>
            <td>{$row['full_name']}</td>
            <td>{$row['address']}</td>
            <td>{$row['postal_code']}</td>
            <td>{$row['phone']}</td>
            <td>{$row['place_of_birth']}, {$row['date_of_birth']}</td>
            <td>{$row['gender']}</td>
            <td>{$row['religion']}</td>
            <td>{$row['attended_school']}</td>
          </tr>";
    $no++;
}
?>

            </tbody>
        </table>
    </div>
</body>
</html>
