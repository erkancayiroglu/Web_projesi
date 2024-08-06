<?php include 'header.php'; ?>
<?php include 'baglan.php'; ?>
<div class="container2">
    <h2>Kitap Düzenle</h2>
<?php
    if(isset($_GET['kitap_id'])){
      $kitap_id=$_GET['kitap_id'];
      $kitapsor = $conn->query("select * from listem where kitap_id='$kitap_id'");
      $kitapcek = $kitapsor->fetch(PDO::FETCH_ASSOC);
    }



    if(!isset($_SESSION['kullanici_ad'])){
header('Location:login.php');
}
 if(!isset($_SESSION['kullanici_id'])){
header('Location:login.php');
}

    ?>

    <form method="POST" action="islem.php?kitap_id=<?php echo $kitap_id ?>">

         <input type="hidden" name="klnc_id" value="<?php echo $_SESSION['kullanici_id'];?>"> 
        <br>
        <label for="book-name">Kitap Adı:</label>
       <input type="text" id="book-name" name="kitap_ad" value="<?php  echo $kitapcek['kitap_ad']; ?>">
        <br>
        <label for="author">Yazar:</label>
       <input type="text" id="author" name="kitap_yazar" value="<?php echo $kitapcek['kitap_yazar']; ?>">
        <br>
        <label for="author">Yayınevi:</label>
       <input type="text" id="yayin" name="kitap_yayin" value="<?php echo $kitapcek['kitap_yayin']; ?>">
        <br>


          <label for="author">Kitap Türü:</label>
          <input type="text" id="book" name="kitap_turu" value="<?php echo $kitapcek['kitap_turu']; ?>">
          <br>

        <label for="sayfa">Sayfa Sayısı:</label>
        <input type="text" id="author" name="kitap_sayfa" value="<?php echo $kitapcek['kitap_sayfa']; ?>">
        
        
        <br>
       <label for="status">Puan:</label>
        <select id="comment" name="kitap_puan" >
             <option value="-" <?php if($kitapcek['kitap_puan'] == "-") echo "selected"; ?>>-</option>
         <option value="0" <?php if($kitapcek['kitap_puan'] == "0") echo "selected"; ?>>0</option>
        <option value="1" <?php if($kitapcek['kitap_puan'] == "1") echo "selected"; ?>>1</option>
        <option value="2" <?php if($kitapcek['kitap_puan'] == "2") echo "selected"; ?>>2</option>
        <option value="3" <?php if($kitapcek['kitap_puan'] == "3") echo "selected"; ?>>3</option>
        <option value="4" <?php if($kitapcek['kitap_puan'] == "4") echo "selected"; ?>>4</option>
        <option value="5" <?php if($kitapcek['kitap_puan'] == "5") echo "selected"; ?>>5</option>
             </select>
        <br>
        <label for="status">Okunma Durumu:</label>
        <select id="status" name="kitap_okunma" value="<?php echo $kitapcek['kitap_okunma']?>">
        <option value="okunmadi" <?php if($kitapcek['kitap_okunma'] == "okunmadi") echo "selected"; ?>>Okunmadı</option>
        <option value="okunuyor" <?php if($kitapcek['kitap_okunma'] == "okunuyor") echo "selected"; ?>>Okunuyor</option>
        <option value="okundu" <?php if($kitapcek['kitap_okunma'] == "okundu") echo "selected"; ?>>Okundu</option>
        </select>
        <br>
        <label for="book-yorum">Kitap Yorum:</label>
       <input type="text" id="book-yorum" name="kitap_yorum" value="<?php  echo $kitapcek['kitap_yorum']; ?>">
        <br>
        <button type="submit" name="kitapguncelle">Kaydet</button>
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
