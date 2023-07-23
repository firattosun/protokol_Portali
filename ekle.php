<?php
include("inc/db.php");

if ($_POST) {
    $aktif = 0;
    if (isset($_POST["aktif"])) $aktif = 1;

    $hata = '';

    if ($_POST["pbaslik"]!='' && $_POST["picerik"] != '' && $_FILES["pexcel"]['name'] != '') {
        if ($_FILES["pexcel"]['error'] != 0) {
            $hata .= "Dosya Yüklenirken Hata gerçekleşti.";
        } else if ($_FILES['pexcel']['size'] > (1024 * 1024 * 3)) {
            $hata .= "3 MB'dan büyük dosya boyutu yüklenemez.";
        } else {
            copy($_FILES['pexcel']['tmp_name'], 'excel/' . strtolower($_FILES["pexcel"]['name']));
            $ekleSorgu = $baglanti->prepare('INSERT INTO protokol SET pexcel=:pexcel,pbaslik=:pbaslik,picerik=:picerik,sira=:sira,aktif=:aktif');
            $ekle = $ekleSorgu->execute([
                'pexcel' => strtolower($_FILES["pexcel"]['name']),
                'pbaslik' => $_POST['pbaslik'],
                'picerik' => $_POST['picerik'],
                'sira' => $_POST['sira'],
                'aktif' => $aktif
            ]);
            if ($ekle){
                header("Location:protokol.php");
            }
        }
        if ($hata!=''){
            echo $hata;
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
    <title>Protokol Ekle| Dedaş</title>
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
                    <?php
                    $sorgu=$baglanti->prepare("SELECT * FROM protokol");
                    $sorgu->execute();
                    $sonuc= $sorgu->fetch();
                    ?>
                    <h3 style="color:#990000; text-align: center;">Protokol Ekleme Sayfası</h3>
                    <form class="demo-form1" action="" method="post"  enctype="multipart/form-data">
                        <div class="input-wrap">
                                <label class="f-title" for="name">Excel Dosyası ekle:</label>
                                <input type="file" name="pexcel" required class="form-control-file">
                        </div>
                        <div class="input-wrap">
                            <label class="f-title" for="name">Protokol Adı</label>
                            <input type="text" name="pbaslik" required class="input" value="<?= @$_POST["pbaslik"]?>" >
                        </div>
                        <div class="input-wrap"><label class="f-title" for="name">Protokol İçeriği</label>
                                <input type="text" name="picerik" required class="input" value="<?=@$_POST["picerik"]?>">
                        </div>
                        <div class="input-wrap"><label class="f-title" for="name">Sıra</label>
                            <input type="text" name="sira" required class="input" value="<?=@$_POST["sira"]?>">
                        </div>
                        <div class="input-wrap">
                            <label><input type="checkbox" name="aktif">
                            Aktif Mi?</label>
                        </div>
                        <div class="input-wrap">
                        <input type="submit"  value="Ekle">
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