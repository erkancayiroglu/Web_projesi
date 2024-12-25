<?php
include 'baglan.php';
session_start(); 

if(isset($_POST['loggin'])) {
    $kullanici_ad = $_POST['kullanici_ad'];
    $kullanici_sifre = $_POST['kullanici_sifre'];

    $sorgu = $conn->prepare("SELECT * FROM adminler WHERE kullanici_ad = :kullanici_ad AND kullanici_sifre = :kullanici_sifre");
    $sorgu->bindParam(':kullanici_ad', $kullanici_ad);
    $sorgu->bindParam(':kullanici_sifre', $kullanici_sifre);
    $sorgu->execute();

    if ($sorgu->rowCount() > 0) {
        $user = $sorgu->fetch(PDO::FETCH_ASSOC);
        $_SESSION['kullanici_ad'] = $kullanici_ad;
        $_SESSION['kullanici_id'] = $user['kullanici_id'];
        header('Location: index.php');
        exit;
    } else {
        header('Location: login.php?login=no');
        exit;
    }
}

include 'baglan.php';

if(isset($_POST['kitapkaydet'])){
    // Kitap adı ve yazarı benzersiz olarak kabul edilmiştir
    $kontrol=$conn->prepare("SELECT * FROM listem WHERE kitap_ad = :kitap_ad AND kitap_yazar = :kitap_yazar");
    $kontrol->execute(array(
        'kitap_ad' => $_POST['kitap_ad'],
        'kitap_yazar' => $_POST['kitap_yazar']
    ));

    // Kitap zaten var mı kontrol et
    if($kontrol->rowCount() > 0){
        header('Location: kitap-ekle.php?durum1=exists');
    } else {
        // Kitap veritabanında yoksa ekle
        $kaydet=$conn->prepare("INSERT INTO listem (klnc_id, kitap_ad, kitap_yazar, kitap_yayin, kitap_turu, kitap_sayfa, kitap_okunma, kitap_puan, kitap_yorum) 
                                VALUES (:klnc_id, :kitap_ad, :kitap_yazar, :kitap_yayin, :kitap_turu, :kitap_sayfa, :kitap_okunma, :kitap_puan, :kitap_yorum)");
        $ekle=$kaydet->execute(array(
            'klnc_id' => $_POST['klnc_id'],
            'kitap_ad' => $_POST['kitap_ad'],
            'kitap_yazar' => $_POST['kitap_yazar'],
            'kitap_yayin' => $_POST['kitap_yayin'],
            'kitap_turu'  => $_POST['kitap_turu'],
            'kitap_sayfa' => $_POST['kitap_sayfa'],
            'kitap_okunma' => $_POST['kitap_okunma'],
            'kitap_puan' => $_POST['kitap_puan'],
            'kitap_yorum' => $_POST['kitap_yorum']
        ));

        if($ekle){
            header('Location: listem.php');
        } else {
            header('Location: kitap-ekle.php?durum=no');
        }
    }
}



if(isset($_POST['kitapguncelle'])) {
    $kitap_id = $_GET['kitap_id'];

    $kitapguncelle = $conn->prepare("UPDATE listem SET 
        klnc_id = :klnc_id,
        kitap_ad = :kitap_ad,
        kitap_yazar = :kitap_yazar,
        kitap_yayin = :kitap_yayin,
        kitap_turu = :kitap_turu,
        kitap_sayfa = :kitap_sayfa,
        kitap_puan = :kitap_puan,
        kitap_okunma = :kitap_okunma,
        kitap_yorum= :kitap_yorum
        WHERE kitap_id = :kitap_id");

    $kitapguncelle->bindParam(':klnc_id', $_POST['klnc_id']);
    $kitapguncelle->bindParam(':kitap_ad', $_POST['kitap_ad']);
    $kitapguncelle->bindParam(':kitap_yazar', $_POST['kitap_yazar']);
    $kitapguncelle->bindParam(':kitap_yayin', $_POST['kitap_yayin']);
    $kitapguncelle->bindParam(':kitap_turu', $_POST['kitap_turu']);
    $kitapguncelle->bindParam(':kitap_sayfa', $_POST['kitap_sayfa']);
    $kitapguncelle->bindParam(':kitap_puan', $_POST['kitap_puan']);
    $kitapguncelle->bindParam(':kitap_okunma', $_POST['kitap_okunma']);
    $kitapguncelle->bindParam(':kitap_yorum', $_POST['kitap_yorum']);
    $kitapguncelle->bindParam(':kitap_id', $kitap_id);

    if($kitapguncelle->execute()) {
        header("Location: listem.php");
    } else {
        header("Location: kitap-ekle.php?kitap_id=$kitap_id&durum=no");
    }
}


if($_GET['kitapsil']=='ok'){


    $kitapsil=$conn->prepare("delete from listem where kitap_id='".$_GET['kitap_id']."'");
    $kitapsil->execute();

    if($kitapsil->rowCount() > 0){
        header("Location:listem.php?durum=ok");
    }
    else{
        header("Location:listem.php?durum=no");

    }
}


if(isset($_POST['kayitol'])){
 
    $kullanici_ad = $_POST['kullanici_ad'];
    $kullanici_sifre = $_POST['kullanici_sifre'];

    
    if (strpos($kullanici_ad, ' ') !== false) {
       
        header('Location: kayit_ol.php?durum=no');
        exit;
    }

    // Veritabanına ekleme sorgusunu hazırlayın
    $kaydet = $conn->prepare("INSERT INTO adminler (kullanici_ad, kullanici_sifre) 
                              VALUES (:kullanici_ad, :kullanici_sifre)");
    
    // Sorguyu çalıştırın ve verileri ekleyin
    $ekle = $kaydet->execute(array(
        'kullanici_ad' => $kullanici_ad,
        'kullanici_sifre' => $kullanici_sifre
    ));

    if($ekle){
        header('Location: login.php?durum=yes');
    } else {
        header('Location: login.php?durum=no');
    }
}



include 'baglan.php';

if (!isset($_SESSION['kullanici_id'])) {
    // Kullanıcı oturumu yok, gerekli işlemi yapmayın
    // Belki bir hata mesajı göstermek veya kullanıcıyı yönlendirmek istersiniz
    // Örneğin:
    header('Location: login.php');
    exit(); // Kodun devam etmemesi için
}



// Eğer formdan veri gelmişse işlem yap
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['kitapkaydet2'])) {
    // Formdan gelen verileri alıyoruz
    $kitap_ad = $_POST['kitap_ad'];
    $kitap_yazar = $_POST['kitap_yazar'];
    $kitap_yayin = $_POST['kitap_yayin'];
    $kitap_turu = $_POST['kitap_turu'];
    $kitap_sayfa = $_POST['kitap_sayfa'];
  

   
    $kontrol_sorgusu = $conn->prepare("SELECT COUNT(*) FROM listem WHERE klnc_id = :klnc_id AND kitap_ad = :kitap_ad AND kitap_yazar = :kitap_yazar AND kitap_yayin = :kitap_yayin AND kitap_turu = :kitap_turu AND kitap_sayfa = :kitap_sayfa");
    $kontrol_sorgusu->bindParam(':klnc_id', $_SESSION['kullanici_id']);
    $kontrol_sorgusu->bindParam(':kitap_ad', $kitap_ad);
    $kontrol_sorgusu->bindParam(':kitap_yazar', $kitap_yazar);
    $kontrol_sorgusu->bindParam(':kitap_yayin', $kitap_yayin);
    $kontrol_sorgusu->bindParam(':kitap_turu', $kitap_turu);
    $kontrol_sorgusu->bindParam(':kitap_sayfa', $kitap_sayfa);
    $kontrol_sorgusu->execute();
    $kitap_varmi = $kontrol_sorgusu->fetchColumn();

    if ($kitap_varmi > 0) {
        // Kitap zaten eklenmiş, kullanıcıyı uyarabiliriz
        header('Location: onerilen_kitaplar.php?durum=exist');
    } else {
        // Veritabanına ekleme yapacak sorguyu hazırlıyoruz
        $ekleme_sorgusu = $conn->prepare("INSERT INTO listem (klnc_id, kitap_ad, kitap_yazar, kitap_yayin, kitap_turu, kitap_sayfa, kitap_okunma, kitap_puan) VALUES (:klnc_id, :kitap_ad, :kitap_yazar, :kitap_yayin, :kitap_turu, :kitap_sayfa, 'okunmadı', '-')");

        // Değişkenleri bağlıyoruz
        $ekleme_sorgusu->bindParam(':klnc_id', $_SESSION['kullanici_id']);
        $ekleme_sorgusu->bindParam(':kitap_ad', $kitap_ad);
        $ekleme_sorgusu->bindParam(':kitap_yazar', $kitap_yazar);
        $ekleme_sorgusu->bindParam(':kitap_yayin', $kitap_yayin);
        $ekleme_sorgusu->bindParam(':kitap_turu', $kitap_turu);
        $ekleme_sorgusu->bindParam(':kitap_sayfa', $kitap_sayfa);

        // Sorguyu çalıştırıyoruz
        $ekleme_sorgusu->execute();

        // Eğer eklem başarılıysa kullanıcıyı bir mesajla yönlendir
        if ($ekleme_sorgusu) {
            header('Location: listem.php?durum=yes');

            // İşlem tamamlandıktan sonra isteğe bağlı olarak başka bir sayfaya yönlendirebilirsiniz
        } else {
            header('Location: listem.php?durum=no');
        }
    }


}


// Eğer formdan veri gelmişse işlem yap
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['kitapkaydet3'])) {
    // Formdan gelen verileri alıyoruz
    $kitap_ad = $_POST['kitap_ad'];
    $kitap_yazar = $_POST['kitap_yazar'];
    $kitap_yayin = $_POST['kitap_yayin'];
    $kitap_turu = $_POST['kitap_turu'];
    $kitap_sayfa = $_POST['kitap_sayfa'];
  
   
    $kontrol_sorgusu = $conn->prepare("SELECT COUNT(*) FROM listem WHERE klnc_id = :klnc_id AND kitap_ad = :kitap_ad AND kitap_yazar = :kitap_yazar AND kitap_yayin = :kitap_yayin AND kitap_turu = :kitap_turu AND kitap_sayfa = :kitap_sayfa");
    $kontrol_sorgusu->bindParam(':klnc_id', $_SESSION['kullanici_id']);
    $kontrol_sorgusu->bindParam(':kitap_ad', $kitap_ad);
    $kontrol_sorgusu->bindParam(':kitap_yazar', $kitap_yazar);
    $kontrol_sorgusu->bindParam(':kitap_yayin', $kitap_yayin);
    $kontrol_sorgusu->bindParam(':kitap_turu', $kitap_turu);
    $kontrol_sorgusu->bindParam(':kitap_sayfa', $kitap_sayfa);
    $kontrol_sorgusu->execute();
    $kitap_varmi = $kontrol_sorgusu->fetchColumn();

    if ($kitap_varmi > 0) {
       
        header('Location: index.php?durum=exist');
    } else {
       
        $ekleme_sorgusu = $conn->prepare("INSERT INTO listem (klnc_id, kitap_ad, kitap_yazar, kitap_yayin, kitap_turu, kitap_sayfa, kitap_okunma, kitap_puan) VALUES (:klnc_id, :kitap_ad, :kitap_yazar, :kitap_yayin, :kitap_turu, :kitap_sayfa, 'okunmadı', '-')");

    
        $ekleme_sorgusu->bindParam(':klnc_id', $_SESSION['kullanici_id']);
        $ekleme_sorgusu->bindParam(':kitap_ad', $kitap_ad);
        $ekleme_sorgusu->bindParam(':kitap_yazar', $kitap_yazar);
        $ekleme_sorgusu->bindParam(':kitap_yayin', $kitap_yayin);
        $ekleme_sorgusu->bindParam(':kitap_turu', $kitap_turu);
        $ekleme_sorgusu->bindParam(':kitap_sayfa', $kitap_sayfa);

        // Sorguyu çalıştırıyoruz
        $ekleme_sorgusu->execute();

        // Eğer eklem başarılıysa kullanıcıyı bir mesajla yönlendir
        if ($ekleme_sorgusu) {
            header('Location: index.php?durum=yes');

            // İşlem tamamlandıktan sonra isteğe bağlı olarak başka bir sayfaya yönlendirebilirsiniz
        } else {
            header('Location: index.php?durum=no');
        }
    }


}






?>