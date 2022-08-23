
<?php

    include ("vt.php");

?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Veritabanı İşlemleri</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Sayfama Hoşgeldiniz</h1>
    <div class="col-md-6">
        <form action="" method="post">
    
            <table class="table">
        
                <tr>
                    <td class="tdfixbaslik">BAŞLIK</td>
                    <td><input type="text" name="baslik" class="form-controlbaslik" ></td>
                </tr>

                <tr>
                    <td class="tdfixicerik">İÇERİK</td>
                    <td><textarea name="icerik" class="form-controlicerik" ></textarea></td>
                </tr>

                <tr>
                    <td></td>
                    <td><input class="btn btn-info"  type="submit" value="EKLE"></td>
                </tr>

            </table>

</form>

<!-- Öncelikle HTML düzenimizi oluşturuyoruz. Daha sonra girdiğimiz verileri veritabanına eklemesi için PHP kodlarına geçiyoruz. -->

<?php 

if ($_POST) { // Sayfada post olup olmadığını kontrol ediyoruz.

    // Sayfa yenilendikten sonra post edilen değerleri değişkenlere atıyoruz
    $baslik = $_POST['baslik']; 
    $icerik = $_POST['icerik'];

    if ($baslik<>"" && $icerik<>"") { 
    // Veri alanlarının boş olmadığını kontrol ettiriyoruz. Başka kontrollerde yapabilirsiniz.
        
         // Veri ekleme sorgumuzu yazıyoruz.
        if ($baglanti->query("INSERT INTO makale (baslik, icerik) VALUES ('$baslik','$icerik')")) 
        {
            echo "VERİ EKLENDİ"; // Eğer veri eklendiyse eklendi yazmasını sağlıyoruz.
        }
        else
        {
            echo "Hata oluştu";
        }

    }

}

?>
</div>
<!-- ############################################################## -->

<!-- Veritabanına eklenmiş verileri sıralamak için önce üst kısmı hazırlayalım. -->
<div class="col-md-7">
<table class="table">
    
    <tr>
        <th>No</th>
        <th>Başlık</th>
        <th>İçerik</th>
        <th></th>
        <th></th>
    </tr>

<!-- Şimdi ise verileri sıralayarak çekmek için PHP kodlamamıza geçiyoruz. -->

<?php 

$sorgu = $baglanti->query("SELECT * FROM makale"); // Makale tablosundaki tüm verileri çekiyoruz.

while ($sonuc = $sorgu->fetch_assoc()) { 

$id = $sonuc['id']; // Veritabanından çektiğimiz id satırını $id olarak tanımlıyoruz.
$baslik = $sonuc['baslik'];
$icerik = $sonuc['icerik'];

// While döngüsü ile verileri sıralayacağız. Burada PHP tagını kapatarak tırnaklarla uğraşmadan tekrarlatabiliriz. 
?>
    
    <tr>
        <td><?php echo $id; // Yukarıda tanıttığımız gibi alanları dolduruyoruz. ?></td>
        <td><?php echo $baslik; ?></td>
        <td><?php echo $icerik; ?></td>
        <td><a href="duzenle.php?id=<?php echo $id; ?>" class="btn btn-danger">DÜZENLE</a></td>
        <td><a href="sil.php?id=<?php echo $id; ?>" class="btn btn-danger">SİL</a></td>
    </tr>

<?php 
} 
// Tekrarlanacak kısım bittikten sonra PHP tagının içinde while döngüsünü süslü parantezi kapatarak sonlandırıyoruz. 
?>

</table>
</div>
</div>
</body>
</html>