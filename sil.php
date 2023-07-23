<?php
include("inc/db.php");
if($_GET){
    $tablo=$_GET["tablo"];
    $id=(int)$_GET["id"];

    $sorgu=$baglanti->prepare("DELETE FROM protokol WHERE id=:id");
    $sonuc=$sorgu->execute(["id"=>$id]);
    if ($sonuc){
        header("Location:protokol.php");
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
    <title>Protokol Sil| Dedaş</title>
</head>

<body>
<div class="side-menu"><br>
    <div class="brand-name">
        <a href="protokol.php"><img style="height: %75; height: %75;" src="image/dedasLogo.png"></a>
    </div>
    <br>
    <ul>
        <a href="anasayfa"><li class="selected"><img src="image/pt.png" style="width: 25px; height: 25px;color:#cc7a00"alt="">&nbsp; Protokoller</li></a>
        <a href="ekle"><li class="selected"><img src="image/ekle.png" style="width: 25px; height: 25px;color:#cc7a00"alt="">&nbsp; Ekle</li></a>
        <a href="anasayfa"><li class="selected"><img src="image/sil.png" style="width: 25px; height: 25px;color:#cc7a00"alt="">&nbsp; Sil</li></a>
        <a href="anasayfa"><li class="selected"><img src="image/Düzenle.png" style="width: 25px; height: 25px;color:#cc7a00"alt="">&nbsp; Düzenle</li></a>


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


</div>
</body>
<script type="text/javascript" src="/js/sweetalert2.all.min.js"></script>
</html>
