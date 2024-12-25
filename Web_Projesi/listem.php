<?php 
include 'header.php';
include 'baglan.php';


if(!isset($_SESSION['kullanici_ad'])){
    header('Location:login.php');
    exit; 
}


$kullanici_id = $_SESSION['kullanici_id'];


$aramaKelimesi = isset($_GET['kitap_ad']) ? $_GET['kitap_ad'] : '';

// Arama sorgusu
$listegetir = $conn->prepare("SELECT * FROM listem WHERE klnc_id = :kullanici_id AND kitap_ad LIKE :kitap_ad");
$listegetir->bindParam(':kullanici_id', $kullanici_id);
$listegetir->bindValue(':kitap_ad', '%' . $aramaKelimesi . '%', PDO::PARAM_STR);
$listegetir->execute();
?>

<div class="container2">
    <style>
        .container2 {
    padding-top: 140px;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center; /* Yeni eklenen stil */
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

        button {
            padding: 8px 12px;
            margin-right: 5px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        button:last-child {
            margin-right: 0;
        }

        .add-button {
            margin-bottom: 20px;
        }
       .search-container1 {
    text-align: center;
    margin-bottom: 20px;
    display: flex; 
    justify-content: center; 
    align-items: center; 
}

        .search-container1 form {
            display: inline-block; 
        }

        .search-container1 input[type="text"],
        .search-container1 button {
            padding: 10px; 
            font-size: 16px; 
        }

        .search-container1 button {
            background-color: #4CAF50; 
            color: white; 
            border: none; 
            cursor: pointer; 
            border-radius: 5px; 
            margin-left: 5px; 
        }


    </style>

    <div class="search-container1">
        <form method="GET" action="">
            <input type="text" name="kitap_ad" id="kitapAdi" placeholder="Kitap adı girin..." value="<?php echo isset($_GET['kitap_ad']) ? $_GET['kitap_ad'] : ''; ?>">
            <button type="submit">Getir</button>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>Kullanıcı ID</th>
                <th>Kitap ID</th>
                <th>Kitap Adı</th>
                <th>Yazar</th>
                <th>Yayınevi</th>
                <th>Kitap Türü</th>
                <th>Sayfa Sayısı</th>
                <th>Okunma Durumu</th>
                <th>Puan</th>
                
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            <?php       
            foreach ($listegetir as $liste) {
            ?>
                <tr>
                    <td><?php echo $liste['klnc_id'];?></td>
                    <td><?php echo $liste['kitap_id']; ?></td>
                    <td><?php echo $liste['kitap_ad']; ?></td>
                    <td><?php echo $liste['kitap_yazar']; ?></td>
                    <td><?php echo $liste['kitap_yayin']; ?></td>
                    <td><?php echo $liste['kitap_turu'];?></td>
                    <td><?php echo $liste['kitap_sayfa']; ?></td>
                    <td><?php echo $liste['kitap_okunma']; ?></td>
                    <td><?php echo $liste['kitap_puan']; ?></td>
                   
                    <td>
                        <a href="kitap-duzenle.php?kitap_id=<?php echo $liste['kitap_id']?>"><button class="edit-button">Düzenle</button></a>
                        <a href="islem.php?kitap_id=<?php echo $liste['kitap_id'] ?>&kitapsil=ok"><button class="delete-button">Sil</button></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="kitap-ekle.php"><button class="add-button">Kitap Ekle</button></a>
</div>
 <div style="height: 321px;"></div>
<?php include 'footer.php'; ?>