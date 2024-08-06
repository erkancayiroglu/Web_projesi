<?php include 'header.php'; ?>
<?php include 'baglan.php';
session_start();




    if(!isset($_SESSION['kullanici_ad'])){
header('Location:login.php');
}
 if(!isset($_SESSION['kullanici_id'])){
header('Location:login.php');
}
 ?>

<div class="container2">
    <h2>Kitap Ekle</h2>
    <?php 
// Kullanıcı kaydedildi mesajı
if (isset($_GET['durum1']) && $_GET['durum1'] == "exists") {
    echo "Kitapı Daha önce Listene Ekledin ...";
} 
?>
    <form action="islem.php" method="POST">
      <input type="hidden" name="klnc_id" value="<?php echo $_SESSION['kullanici_id'];?>"> 
        
        <br>
        <label for="book-name">Kitap Adı:</label>
        <input type="text" id="book-name" name="kitap_ad">
        <br>
        <label for="author">Yazar:</label>
        <input type="text" id="author" name="kitap_yazar">
        <br>
        <label for="yayin">Yayınevi:</label>
        <input type="text" id="author" name="kitap_yayin">
        <br>

        <label for="comment">Kitap türü:</label>
        <input type="text" name="kitap_turu">
        
        <br>
        <label for="sayfa">Sayfa Sayısı:</label>
        <input type="text" id="author" name="kitap_sayfa">
        <br>
        <label for="status">Okunma Durumu:</label>
        <select id="status" name="kitap_okunma">
            <option value="okunmadi">Okunmadı</option>
            <option value="okunuyor">Okunuyor</option>
            <option value="okundu">Okundu</option>
        </select>
        <br>
        
        <label for="comment">Puan:</label>
        <select id="comment" name="kitap_puan">
             <option value="-">-</option>
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <br>
        <label for="book-yorum">Kitap Yorum :</label>
        <input type="text" id="book-yorum" name="kitap_yorum">
        <br>
        <button type="submit" name="kitapkaydet">Ekle</button>
        <button type="button" onclick="cancelEdit()">İptal</button>
    </form>
</div>

<style>
    /* Güncellenmiş CSS */
    .container2 {
        padding-top: 140px;
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 30px;
    }
    form {
        width: 400px;
        margin-top: 20px;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
    }
    input[type="text"],
    textarea,
    select {
        width: calc(100% - 22px); /* Kenar boşluklarını düşünerek genişliği ayarla */
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }
    select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-image: url('https://cdn-icons-png.flaticon.com/512/32/32195.png');
        background-repeat: no-repeat;
        background-position: right center;
        background-size: 18px;
        padding-right: 30px;
    }
    button {
        width: calc(50% - 5px); /* Düğme genişliğini ayarla */
        padding: 10px;
        border: none;
        border-radius: 5px;
        background-color: #007bff;
        color: #fff;
        cursor: pointer;
    }
    button:hover {
        background-color: #0056b3;
    }
</style>

<script>
    function cancelEdit() {
        document.querySelector('.container').style.display = 'none';
    }
</script>

<?php include 'footer.php'; ?>
