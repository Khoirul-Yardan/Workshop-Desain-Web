<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage DATA ENTRY</title>
    <style>
        header h1.title,
        header h3.desc {
            text-align: center;
        }
        body {
            width: 70%;
            margin: auto;
            font-family: Arial, sans-serif;
        }
        a:link {
            color: rgb(240, 32, 32);
        }
        a:visited {
            color: rgb(119, 0, 255);
        }
        a:hover {
            color: rgb(249, 250, 182);
        }
        a:active {
            color: teal;
        }
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: rgb(252, 247, 0);
        }
        li {
            float: left;
        }
        li a {
            display: block;
            color: black;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }
        li a:hover {
            background-color: rgb(148, 148, 148);
            color: white;
        }
        .container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }
        form, .output {
            width: 48%;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        input, select, textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .radio-group, .checkbox-group {
            display: flex;
            gap: 15px;
            margin-top: 5px;
        }
        button {
            width: 48%;
            padding: 10px;
            margin-top: 10px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            background-color: teal;
            color: white;
            font-size: 16px;
        }
        button:hover {
            background-color: darkcyan;
        }
        footer {
            text-align: center;
            margin-top: 20px;
        }
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                align-items: center;
            }
            form, .output {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1 class="title">Homepage DATA ENTRY</h1>
        <h3 class="desc">Silakan masukkan data Anda</h3>
    </header>
    
    <div class="container">
        <form method="POST">
            <label>Nama:</label>
            <input type="text" name="nama" required>

            <label>NRP:</label>
            <input type="text" name="nrp" required>

            <label>Kelas:</label>
            <input type="text" name="kelas" required>

            <label>Jenis Kelamin:</label>
            <div class="radio-group">
                <input type="radio" name="gender" value="Pria" required> Pria
                <input type="radio" name="gender" value="Wanita" required> Wanita
            </div>

            <label>Agama:</label>
            <select name="agama">
                <option value="Islam">Islam</option>
                <option value="Kristen">Kristen</option>
                <option value="Hindu">Hindu</option>
                <option value="Budha">Budha</option>
            </select>

            <label>Tempat/Tanggal Lahir:</label>
            <input type="text" name="ttl" required>

            <label>Alamat:</label>
            <textarea name="alamat" rows="3" required></textarea>

            <label>Riwayat Pendidikan:</label>
            <label>SD:</label>
            <input type="text" name="sd" required>
            <label>SMP:</label>
            <input type="text" name="smp" required>
            <label>SMA:</label>
            <input type="text" name="sma" required>

            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Homepage:</label>
            <input type="text" name="homepage">

            <label>Hobby:</label>
            <textarea name="hobby" rows="2" required></textarea>

            <label>Interest:</label>
            <div class="checkbox-group">
                <input type="checkbox" name="interest[]" value="Komputer"> Komputer
                <input type="checkbox" name="interest[]" value="Sport"> Sport
                <input type="checkbox" name="interest[]" value="Travelling"> Travelling
                <input type="checkbox" name="interest[]" value="Writing"> Writing
                <input type="checkbox" name="interest[]" value="Reading"> Reading
            </div>

            <br><br>
            <button type="submit" name="simpan">Simpan</button>
            <button type="reset">Reset</button>
        </form>

        <div class="output">
            <h3>Data yang Dimasukkan:</h3>
            <?php
            if (isset($_POST['simpan'])) {
                echo "<p><strong>Nama:</strong> " . htmlspecialchars($_POST['nama']) . "</p>";
                echo "<p><strong>NRP:</strong> " . htmlspecialchars($_POST['nrp']) . "</p>";
                echo "<p><strong>Kelas:</strong> " . htmlspecialchars($_POST['kelas']) . "</p>";
                echo "<p><strong>Jenis Kelamin:</strong> " . htmlspecialchars($_POST['gender']) . "</p>";
                echo "<p><strong>Agama:</strong> " . htmlspecialchars($_POST['agama']) . "</p>";
                echo "<p><strong>Tempat/Tanggal Lahir:</strong> " . htmlspecialchars($_POST['ttl']) . "</p>";
                echo "<p><strong>Alamat:</strong> " . nl2br(htmlspecialchars($_POST['alamat'])) . "</p>";
                echo "<p><strong>Hobby:</strong> " . nl2br(htmlspecialchars($_POST['hobby'])) . "</p>";
                if (!empty($_POST['interest'])) {
                    echo "<p><strong>Interest:</strong> " . implode(", ", $_POST['interest']) . "</p>";
                }
            }
            ?>
        </div>
    </div>
    
    <footer>
        <p>&copy; 2025 Khoirul Yardan</p>
    </footer>
</body>
</html>
