<?php
include 'header.php';
include 'baglan.php';


if(!isset($_SESSION['kullanici_ad'])){
    header('Location: login.php');
    exit; 
}



$kitap_adi = $_GET['kitap_adi'] ?? '';


$sql = "SELECT listem.*, adminler.kullanici_ad FROM listem INNER JOIN adminler ON listem.klnc_id = adminler.kullanici_id WHERE kitap_ad LIKE '%$kitap_adi%'";


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
            width: 100px; 
        }
        .search-container {
        text-align: center; 
        margin-bottom: 20px; 
        }

        .search-container form {
            display: inline-block;
        }

        .search-container input[type="text"],
        .search-container button {
            padding: 10px; 
            font-size: 16px; 
        }

        .search-container button {
            background-color: #4CAF50;
            color: white; 
            border: none; 
            cursor: pointer; 
            border-radius: 5px; 
            margin-left: 5px;
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
