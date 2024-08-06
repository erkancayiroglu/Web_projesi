<?php 
    include 'baglan.php'; 
    session_start();

    if(!isset($_SESSION['kullanici_ad']) || !isset($_SESSION['kullanici_id'])){
        header('Location: login.php');
        exit; // Ensure script stops executing after redirect
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kitap Önerileri Sitesi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo"> Hoşgeldin <?php echo $_SESSION['kullanici_ad'];?></div>
        <nav>
            <div>                
                <a href="index.php">Ana Sayfa</a>
                <a href="onerilen_kitaplar.php">Önerilen Kitaplar</a>
                <a href="listem.php">Listem</a>
                <a href="etkileşim.php">Etkileşim</a>
                <a href="yorumlar.php">yorumlar</a>
            </div>
           <div class="user-actions">
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Çıkış Yap</a>
            </div>
        </nav>
    </header>