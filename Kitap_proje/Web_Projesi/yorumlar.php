<?php
include 'header.php';
include 'baglan.php';

// Oturum kontrolü yapın
if(!isset($_SESSION['kullanici_ad'])){
    header('Location: login.php');
    exit; // Kodun daha fazla çalışmasını önlemek için çıkış yapın
}
// Arama formundan gelen kitap adını alın
$kitap_adi = $_GET['kitap_adi'] ?? '';

// SQL sorgusunu oluşturun ve sadece kitap adına göre filtreleyin
$sql = "SELECT listem.*, adminler.kullanici_ad FROM listem INNER JOIN adminler ON listem.klnc_id = adminler.kullanici_id WHERE kitap_ad LIKE '%$kitap_adi%'";

// SQL sorgusunu çalıştırın
$listegetir = $conn->query($sql);
?>
?>

<div class="container1">
    <style>
        .container1 {
            padding-top: 140px;
            display: flex;
            flex-direction: column; /* Kartları dikey olarak düzenlemek için */
            align-items: center; /* Kartları yatayda ortalamak için */
            text-align: center; /* Input alanını yatayda ortalamak için */
        }

        .kartlar {
            display: flex; /* Kartları yatayda dizmek için */
            flex-wrap: wrap; /* Kartların alt alta değil yan yana olmasını sağlar */
            justify-content: center; /* Kartları yatayda ortalar */
            margin-top: 20px; /* Input alanı ile kartlar arasında boşluk bırakmak için */
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
            max-height: 100px; /* Kart yüksekliğini sınırla */
            overflow: auto; /* Eğer yorumlar kartın boyutunu aşıyorsa, kaydırma çubuğu göster */
        }

        .yorum-daha-fazla {
            color: blue; /* Daha fazla yorumu temsil eden metnin rengi */
            cursor: pointer; /* Üzerine gelindiğinde el şeklinde imleç göster */
        }
        .search-container {
            margin-bottom: 20px; /* Input alanı ile kartlar arasında boşluk bırakmak için */
            text-align: center; /* Input alanını yatayda ortalamak için */
        }

        .search-container form {
            margin: 0 auto; /* Formu yatayda ortalar */
        }

        .search-container input[type="text"],
        .search-container button {
            padding: 10px; /* Alanları daha geniş yapmak için */
            font-size: 16px; /* Yazı boyutunu ayarlamak için */
            margin: 0 5px; /* Input alanı ve buton arasında boşluk bırakmak için */
        }

        .search-container button {
            background-color: #4CAF50; /* Butonun arka plan rengi */
            color: white; /* Buton yazı rengi */
            border: none; /* Buton kenarlık yok */
            cursor: pointer; /* Üzerine geldiğinde imlecin el şeklinde olması için */
            border-radius: 5px; /* Buton kenarlarını yuvarlamak için */
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
                    
                    <span class="yorum-daha-fazla" onclick="alert('<?php echo $liste['kitap_yorum']; ?>')">Daha fazla</span> <!-- Daha fazla yorumu göstermek için bir düğme -->
                </div>
            </div>
        <?php } ?>
    </div>
</div>
 <div style="height: 321px;"></div>
<?php include 'footer.php'; ?>
