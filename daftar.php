﻿<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Tugas</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    * {
      box-sizing: border-box;
    }
    
    body {
      width: 70%;
      margin: auto;
      font-family: Arial, sans-serif;
      background-color: #f4f4f9;
    }
    
    h1.title, h3.desc {
      text-align: center;
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
      font-family: sans-serif;
      text-align: center;
    }
    
    li {
      display: inline;
      padding: 14px 16px;
    }
    
    li a {
      text-decoration: none;
      color: black;
    }
    
    li a:hover {
      background-color: rgb(148, 148, 148);
    }
    
    .container {
      text-align: center;
    }
    
    .content-list {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
    }
    
    .content-item {
      background: #ffffff;
      border: 1px solid #ddd;
      padding: 10px;
      border-radius: 8px;
      width: 250px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .content-item:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }
    
    .thumbnail {
      width: 100%;
      height: auto;
      border-radius: 8px;
      cursor: pointer;
    }
    
    .link-button {
      display: inline-block;
      margin-top: 10px;
      padding: 8px 16px;
      font-size: 1em;
      color: #ffffff;
      background-color: #007bff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      text-decoration: none;
      transition: background-color 0.3s ease;
    }
    
    .link-button:hover {
      background-color: #0056b3;
    }
    
    footer {
      text-align: center;
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <header>
    <h1 class="title">Daftar Tugas</h1>
  </header>
  <div class="container">
    <div class="content-list">
      <div class="content-item">
        <img src="image/tes.png" alt="Gambar 1" class="thumbnail" onclick="showPopup('image/tes.png', 'Tampilan Tes Email dan username', 'Berisi form yang akan berlanjut')">
        <button class="link-button" onclick="window.open('praktikum_php/index.php', '_blank')">Percobaan Form</button>
      </div>
      <div class="content-item">
        <img src="image/form.png" alt="Gambar 2" class="thumbnail" onclick="showPopup('image/form.png', 'Tampilan Form', 'Berisi Form sebagai penugasan')">
        <button class="link-button" onclick="window.open('Form.php', '_blank')">Form</button>
      </div>
    </div>
  </div>
  <p>Gambar bisa di klik untuk pop up</p>



  <script>
    function showPopup(imageSrc, title, description) {
      Swal.fire({
        title: title,
        text: description,
        imageUrl: imageSrc,
        imageWidth: 400,
        imageHeight: 300,
        imageAlt: title,
        confirmButtonText: 'Tutup',
      });
    }
  </script>
</body>
</html>
