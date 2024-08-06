<?php include 'baglan.php'; 

    if(!isset($_SESSION['kullanici_ad'])){
header('Location:login.php');
}
 if(!isset($_SESSION['kullanici_id'])){
header('Location:login.php');
}
?>
    <footer>
        <div class="footer-content">
            <div class="footer-logo">Kitap Önerileri</div>
            <div class="footer-links">
                <a href="#">Hakkımızda</a>
                <a href="#">İletişim</a>
                <a href="#">Gizlilik Politikası</a>
                <a href="#">Kullanım Koşulları</a>
            </div>
            <div class="footer-social">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; 2024 Kitap Önerileri. Tüm hakları saklıdır.
        </div>
    </footer>
</body>
</html>