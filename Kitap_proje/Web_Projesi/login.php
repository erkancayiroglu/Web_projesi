<?php include 'baglan.php' ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('kitap.png');
            background-size: cover;
            background-position: center;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .register-link {
            margin-top: 20px;
            font-size: 14px;
            color: #007bff;
            text-decoration: none;
        }
        .register-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
     <div class="container">
        <h2>Giriş Yap</h2>
        <?php
        if(isset($_GET['login']) && $_GET['login'] === "no") {
            echo "<p style='color: red;'>Kullanıcı Bulunamadı...</p>";
        }
        ?>
        <form action="islem.php" method="post">
            <input type="text" name="kullanici_ad" placeholder="Kullanıcı Adı" required>
            <br>
            <input type="password" name="kullanici_sifre" placeholder="Şifre" required>
            <br>
            <input type="submit" name="loggin" value="Giriş Yap">
        </form>
        <a href="kayit_ol.php" class="register-link">Henüz hesabınız yok mu? Kayıt olun</a>
    </div>
</body>
</html>