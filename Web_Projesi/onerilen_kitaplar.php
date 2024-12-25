<?php 
include 'header.php';
include 'baglan.php';

if(!isset($_SESSION['kullanici_ad'])){
    header('Location:login.php');
}


?>



<style>
.card-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.book-card {
    width: calc(33.33% - 20px);
    margin-bottom: 20px;
    border: 1px solid #ccc;
    padding: 10px;
}

.info {
    text-align: center;
}

h3 {
    text-decoration: underline;
}

.card-title {
    font-size: 20px;
    font-weight: bold;
    text-decoration: underline;
}

.card-text {
    font-size: 16px;
    text-decoration: underline;
}

.book-card .actions {
    margin-top: 20px;
    text-align: center;
}

.book-card .actions button {
    color: #fff;
    text-decoration: none;
    padding: 8px 30px;
    border-radius: 5px;
    background-color: #e50914;
    margin-right: 20px;
    transition: background-color 0.3s;
    margin-left: 60px;
}

.book-card .actions button:hover {
    background-color: #b2070f;
}
</style>


<div class="container">
    <?php 
// Kullanıcı kaydedildi mesajı
if (isset($_GET['durum']) && $_GET['durum'] == "exist") {
    echo "Kitapı Daha önce Listene Ekledin ...";
} 
?>
    <div class="row card-container">
       <?php
        // Kullanıcının okuduğu türleri ve sayfa sayısını al
        $okunan_kitaplar = $conn->prepare("SELECT DISTINCT kitap_turu, kitap_sayfa FROM listem WHERE klnc_id = :kullanici_id");
        $okunan_kitaplar->bindParam(':kullanici_id', $_SESSION['kullanici_id']);
        $okunan_kitaplar->execute();
        $okunan_kitaplar = $okunan_kitaplar->fetchAll(PDO::FETCH_ASSOC);

        // Türlere ve sayfa sayısına göre öneriler yap
        foreach ($okunan_kitaplar as $kitap) {
            $kitap_turu = $kitap['kitap_turu'];
            $kitap_sayfa = $kitap['kitap_sayfa'];

            $benzer_kitaplar = $conn->prepare("SELECT * FROM kitaplar WHERE Kitap_Turu = :kitap_turu AND Sayfa_Sayısı <= :kitap_sayfa ORDER BY RAND() LIMIT 3");
            $benzer_kitaplar->bindParam(':kitap_turu', $kitap_turu);
            $benzer_kitaplar->bindParam(':kitap_sayfa', $kitap_sayfa);
            $benzer_kitaplar->execute();

            foreach ($benzer_kitaplar as $benzer_kitap) {
        ?>
            <div class="book-card">
               
                <form action="islem.php" method="POST">
                    <!-- Gizli alanlar, formun içinde kitap bilgilerini göndermek için -->
                    <input type="hidden" name="kitap_ad" value="<?php echo $benzer_kitap['Kitap_Adı']; ?>">
                    <input type="hidden" name="kitap_yazar" value="<?php echo $benzer_kitap['Yazar_Adı']; ?>">
                    <input type="hidden" name="kitap_yayin" value="<?php echo $benzer_kitap['Yayınevi']; ?>">
                    <input type="hidden" name="kitap_turu" value="<?php echo $benzer_kitap['Kitap_Turu']; ?>">
                    <input type="hidden" name="kitap_sayfa" value="<?php echo $benzer_kitap['Sayfa_Sayısı']; ?>">

                    <div class="info">
                           
                       
                        <h3>Kitap Adı</h3>
                        <h2><?php echo $benzer_kitap['Kitap_Adı']; ?></h2>
                        <h3>Yazar Adı</h3>
                        <h2><?php echo $benzer_kitap['Yazar_Adı']; ?></h2>
                        <h3>Yayınevi Adı</h3>
                        <h2><?php echo $benzer_kitap['Yayınevi']; ?></h2>
                        <h3>Kitap Türü</h3>
                        <h2><?php echo $benzer_kitap['Kitap_Turu']; ?></h2>
                        <div class="description">
                            <h3>Sayfa Sayısı</h3>
                            <h2><?php echo $benzer_kitap['Sayfa_Sayısı']; ?></h2>
                        </div>
                    
                        <div class="actions">
                            <button type="submit" name="kitapkaydet2">Listeme Ekle</button>
                        </div>
                    </div>
                </form>
            </div>
        <?php
            }
        }
        ?>
    </div>
</div>



<?php include 'footer.php'; ?>