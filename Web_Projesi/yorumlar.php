<?php
include 'header.php';
include 'baglan.php';

// Oturum kontrolü yapın
if(!isset($_SESSION['kullanici_ad'])){
    header('Location: login.php');
    exit; 
}

$kitap_adi = $_GET['kitap_adi'] ?? '';


$sql = "SELECT listem.*, adminler.kullanici_ad FROM listem INNER JOIN adminler ON listem.klnc_id = adminler.kullanici_id WHERE kitap_ad LIKE '%$kitap_adi%'";


$listegetir = $conn->query($sql);
?>
?>

<div class="container1">
    <style>
        .container1 {
            padding-top: 140px;
            display: flex;
            flex-direction: column; 
            align-items: center; 
            text-align: center; 
        }

        .kartlar {
            display: flex; 
            flex-wrap: wrap; 
            justify-content: center;
            margin-top: 20px; 
        }

        .kart {
            width: 300px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin: 10px;
            padding: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .kart:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .kitap-ad {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .yorumlar {
            margin-top: 10px;
            max-height: 100px; 
            overflow: auto; 
        }

        .yorum-daha-fazla {
            color: blue; 
            cursor: pointer; 
        }
        .search-container {
            margin-bottom: 20px; 
            text-align: center; 
        }

        .search-container form {
            margin: 0 auto; 
        }

        .search-container input[type="text"],
        .search-container button {
            padding: 10px; 
            font-size: 16px; 
            margin: 0 5px; 
        }

        .search-container button {
            background-color: #4CAF50; 
            color: white; 
            border: none; 
            cursor: pointer;
            border-radius: 5px; 
        }
    </style>
    <div class="search-container">
        <form method="GET" action="">
            <input type="text" name="kitap_adi" placeholder="Kitap Adı">
            <button type="submit">Getir</button>
        </form>
    </div>

   <div class="kartlar">
        <?php foreach ($listegetir as $liste) { ?>
            <div class="kart">
                <div class="kitap-ad"><?php echo $liste['kitap_ad']; ?></div>
                <div>Kullanıcı: <?php echo $liste['kullanici_ad']; ?></div>
                <div class="yorumlar">
                    <strong>Yorum:</strong><br>
                    
                    <span class="yorum-daha-fazla" onclick="alert('<?php echo $liste['kitap_yorum']; ?>')">Daha fazla</span> 
                </div>
            </div>
        <?php } ?>
    </div>
</div>
 <div style="height: 321px;"></div>
<?php include 'footer.php'; ?>
