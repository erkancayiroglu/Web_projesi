<?php include 'header.php'; ?>
  

<?php include 'baglan.php'; 
session_start();
?>
<div class="container">
<style>
    /* Stil tanımı */
    .message-container {
        margin: 10px auto; 
        padding: 10px;
       
        width: 80%; /* Genişlik */
        text-align: center; 
    }
</style>


<div 

<div cl


<div class="message-container">
    <?php 
        // Kullanıcı kaydedildi mesajı
        if (isset($_GET['durum']) && $_GET['durum'] == "exist") {
            echo "Kitabı Daha Önce Listene Ekledin ...";
        } 
    ?>
</div>

    
 

 




    <?php       
        $anasayfagetir = $conn->query("SELECT * FROM ana_sayfa");
        foreach ($anasayfagetir as $anasayfa) {
    

    if(!isset($_SESSION['kullanici_ad'])){
header('Location:login.php');
}
 if(!isset($_SESSION['kullanici_id'])){
header('Location:login.php');
}



 
?>
    <div 
    <div cl

 
class="book-card">
   <form action="islem.php" method="POST">
     <!-- Gizli alanlar, formun içinde kitap bilgilerini göndermek için -->
                    <input type="hidden" name="kitap_ad" value="<?php echo $anasayfa['akitap_ad']; ?>">
                    <input type="hidden" name="kitap_yazar" value="<?php echo $anasayfa['akitap_yazar']; ?>">
                    <input type="hidden" name="kitap_yayin" value="<?php echo $anasayfa['akitap_yayin']; ?>">
                    <input type="hidden" name="kitap_turu" value="<?php echo $anasayfa['akitap_turu']; ?>">
                    <input type="hidden" name="kitap_sayfa" value="<?php echo $anasayfa['akitap_sayfa']; ?>">
                
        <img src="<?php echo $anasayfa['akitap_resim'];?>">
        <div class="info">
            <h3><?php echo $anasayfa['akitap_ad'];?></h3>
            <p>Yazar: <?php echo $anasayfa['akitap_yazar'];?></p>
            <div class="description">
                <p>Yayınevi : <?php echo $anasayfa['akitap_yayin'];?></p>
                 <p>Konu : <?php echo $anasayfa['akitap_turu'];?></p>
                  <p>Sayfa Sayısı : <?php echo $anasayfa['akitap_sayfa'];?></p>
            </div>
            <div class="actions">
                  <button type="submit" name="kitapkaydet3">Listeme ekle</button>                                  
            </div>
        </div>
        </form>
    </div>
    <?php } ?>
</div>
<?php include 'footer.php'; ?>