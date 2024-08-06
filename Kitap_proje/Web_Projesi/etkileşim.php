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

<div class="container1">
    <style>
        .container1 {
            padding-top: 140px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
       
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: black;
        }

        img {
            width: 100px; /* Resimlerin genişliği */
        }
        .search-container {
        text-align: center; /* Formu ve butonu merkezlemek için */
        margin-bottom: 20px; /* Tablo ile arasında boşluk bırakmak için */
        }

        .search-container form {
            display: inline-block; /* Formu yan yana getirmek için */
        }

        .search-container input[type="text"],
        .search-container button {
            padding: 10px; /* Alanları daha geniş yapmak için */
            font-size: 16px; /* Yazı boyutunu ayarlamak için */
        }

        .search-container button {
            background-color: #4CAF50; /* Butonun arka plan rengi */
            color: white; /* Buton yazı rengi */
            border: none; /* Buton kenarlık yok */
            cursor: pointer; /* Üzerine geldiğinde imlecin el şeklinde olması için */
            border-radius: 5px; /* Buton kenarlarını yuvarlamak için */
            margin-left: 5px; /* Buton ile input arasında boşluk bırakmak için */
        }


        
      
    </style>

 <div class="search-container">
        <form method="GET" action="">
        <input type="text" name="kitap_adi" placeholder="Kitap Adı" value="<?php echo $kitap_adi; ?>">
        <button type="submit">Getir</button>
    </form>
      </div>
    <table>
        <thead>
            <tr>
                <th>Kullanıcı Adı</th>
                <th>Kitap ID</th>
                <th>Kitap Adı</th>
                <th>Yazar</th>
                <th>Yayınevi</th>
                <th>Kitap Türü</th>
                <th>Sayfa Sayısı</th>
                <th>Okunma Durumu</th>
                <th>Puan</th>
                
                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listegetir as $liste) { ?>
                <tr>
                    <td><?php echo $liste['kullanici_ad']; ?></td>
                    <td><?php echo $liste['kitap_id']; ?></td>
                    <td><?php echo $liste['kitap_ad']; ?></td>
                    <td><?php echo $liste['kitap_yazar']; ?></td>
                    <td><?php echo $liste['kitap_yayin']; ?></td>
                    <td><?php echo $liste['kitap_turu']; ?></td>
                    <td><?php echo $liste['kitap_sayfa']; ?></td>
                    <td><?php echo $liste['kitap_okunma']; ?></td>
                    <td><?php echo $liste['kitap_puan']; ?></td>
                   
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
 <div style="height: 321px;"></div>
<?php include 'footer.php'; ?>
