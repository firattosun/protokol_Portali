<?php
include("inc/db.php");


$id=$_GET['id'];
$sorgu = $baglanti->prepare("SELECT * from protokol where id=:id");
$sorgu->execute(['id' => $id]);
$sonuc = $sorgu->fetch();

if ($_POST) {
    $aktif = 0;
    if (isset($_POST["aktif"])) $aktif = 1;

    $hata = '';
    $pexcel='';

    if ($_POST["pbaslik"]!='' && $_POST["picerik"] != '' && $_FILES["pexcel"]['name'] != '') {
        if ($_FILES["pexcel"]['error'] != 0) {
            $hata .= "Dosya Yüklenirken Hata gerçekleşti.";
        } else if ($_FILES['pexcel']['size'] > (1024 * 1024 * 3)) {
            $hata .= "3 MB'dan büyük dosya boyutu yüklenemez.";
        } else {
            copy($_FILES['pexcel']['tmp_name'], 'excel/' . strtolower($_FILES["pexcel"]['name']));
            unlink('excel/'.$sonuc['pexcel']);
            $pexcel=strtolower($_FILES["pexcel"]['name']);

        }
        if ($hata!=''){
            echo $hata;
        }
    }
    else{
        $pexcel=$sonuc['pexcel'];
    }
    if($_POST["pbaslik"]!='' && $_POST["picerik"] != '' && $hata==''){
        $Sorgu = $baglanti->prepare('UPDATE protokol SET pexcel=:pexcel,pbaslik=:pbaslik,picerik=:picerik,sira=:sira,aktif=:aktif WHERE id=:id');
        $guncelle = $Sorgu->execute([
            'pexcel' => $foto,
            'pbaslik' => $_POST['pbaslik'],
            'picerik' => $_POST['picerik'],
            'sira' => $_POST['sira'],
            'aktif' => $aktif,
            'id'=>$id

        ]);
        if ($guncelle){
            header("Location:protokol.php");
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="shortcut icon" href="image/dedasLogo.png">
    <title>Protokol Düzenle| Dedaş</title>

</head>

<body>
<div class="side-menu"><br>
    <div class="brand-name">
        <a href="protokol.php"><img style="height: %75; height: %75;" src="image/dedasLogo.png"></a>
    </div>
    <br>
    <ul>
        <a href="anasayfa">
            <li class="selected"><img src="image/pt.png" style="width: 25px; height: 25px;color:#cc7a00" alt="">&nbsp;
                Protokoller
            </li>
        </a>
        <a href="ekle">
            <li class="selected"><img src="image/ekle.png" style="width: 25px; height: 25px;color:#cc7a00" alt="">&nbsp;
                Ekle
            </li>
        </a>
        <a href="anasayfa">
            <li class="selected"><img src="image/sil.png" style="width: 25px; height: 25px;color:#cc7a00" alt="">&nbsp;
                Sil
            </li>
        </a>
        <a href="anasayfa">
            <li class="selected"><img src="image/Düzenle.png" style="width: 25px; height: 25px;color:#cc7a00" alt="">&nbsp;
                Düzenle
            </li>
        </a>

    </ul>
</div>
<div class="container">
    <div class="header">
        <div class="nav">
            <div class="search">
                <input type="text" placeholder="Ara..">
                <button type="submit"><img src="image/search.png" alt="arama butonu"></button>
            </div>
            <div class="user">
                <img class="right-logout" src="image/user.png" alt="Çıkış Yap">
                <div class="img-case">
                    <a href="logout.php"><img src="image/turn-off.png" alt="Admin-İmage"></a>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="cards">
            <div class="card">
                <div class="box"><br>

                    <h3 style="color:#990000; text-align: center;">Protokol Düzenleme Sayfası</h3>
                    <form class="demo-form1" action="" method="post"  enctype="multipart/form-data">

                        <div class="input-wrap">
                            <label class="f-title">Mevcut protokolün ismi : <?= $sonuc['pexcel'] ?></label>
                            <label class="f-title" for="name">Excel Dosyasını değiştir:</label>
                            <input type="file" name="pexcel"  class="form-control-file">
                        </div>

                        <div class="input-wrap">
                            <label class="f-title" for="name">Protokol Adı</label>
                            <input type="text" name="pbaslik" required class="input" value="<?= $sonuc["pbaslik"]?>" >
                        </div>

                        <div class="input-wrap"><label class="f-title" for="name">Protokol İçeriği</label>
                            <input type="text" name="picerik" required class="input" value="<?=$sonuc["picerik"]?>">
                        </div>

                        <div class="input-wrap"><label class="f-title" for="name">Sıra</label>
                            <input type="text" name="sira" required class="input" value="<?=$sonuc["sira"]?>">
                        </div>

                        <div class="input-wrap">
                            <label>
                                <input type="checkbox" name="aktif" <?= $sonuc['aktif']==1?'chechked':''?>>
                                Aktif Mi?</label>
                        </div>

                        <div class="input-wrap">
                            <input type="submit"  value="Güncelle">
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
</html>
<script src="ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('icerik');
</script>