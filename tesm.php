<?php
require 'vendor/autoload.php';  // Autoload Composer dependencies

// Menghubungkan ke MongoDB
$client = new MongoDB\Client("mongodb://127.0.0.1:27017");  // Ganti dengan connection string yang sesuai
$database = $client->mahasiswa;  // Nama database 'mahasiswa'
$collection = $database->users;  // Nama collection 'users'
// Menyisipkan data jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $document = [
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'age' => $_POST['age'],
        'gender' => $_POST['gender']
    ];

    // Menyisipkan data ke MongoDB
    $result = $collection->insertOne($document);
    echo "<div class='alert success'>Data berhasil dimasukkan dengan ID: " . $result->getInsertedId() . "</div>";
}

// Mengambil semua data dari collection
$cursor = $collection->find();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MongoDB Input dan Output</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        header {
            background-color: #333;
            color: white;
            padding: 10px 0;
            text-align: center;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 20px auto;
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input[type="text"], input[type="email"], input[type="number"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .alert {
            padding: 10px;
            color: #fff;
            margin-top: 20px;
            text-align: center;
        }
        .success {
            background-color: #4CAF50;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #333;
            color: white;
        }
        @media (max-width: 768px) {
            table {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

<header>
    <h1>Output MongoDB</h1>
</header>


    <!-- Tabel Menampilkan Data -->
    <h2>Data Pengguna yang Terdaftar</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Age</th>
            <th>Gender</th>
        </tr>
        <?php
        // Menampilkan data dari MongoDB
        foreach ($cursor as $document) {
            echo "<tr>";
            echo "<td>" . $document['_id'] . "</td>";
            echo "<td>" . $document['name'] . "</td>";
            echo "<td>" . $document['email'] . "</td>";
            echo "<td>" . $document['age'] . "</td>";
            echo "<td>" . $document['gender'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>

</body>
</html>
