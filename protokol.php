<?php
include("inc/db.php");



$sorgu = $baglanti->prepare("SELECT * FROM protokol");
$sorgu->execute();
$sonuc = $sorgu->fetch();


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="shortcut icon" href="image/dedasLogo.png">

    <title>Protokol Portali| Dedaş</title>
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

                    <h3 style="color:#990000; text-align: center;">Modem Protokolleri</h3>


                    <table style="margin: auto" id="dataTable">
                        <a href="ekle.php" target="_blank">
                            <img style="margin-left: 788px; width: 40px; height: 40px; " src="image/ekle2.png"alt="Ekle">

                        </a>
                        <thead>
                        <tr>
                            <th style="border: 1px solid">İd</th>
                            <th style="border: 1px solid">Excel</th>
                            <th style="border: 1px solid">Adı</th>
                            <th style="border: 1px solid">İçeriği</th>
                            <th style="border: 1px solid">Aktif</th>
                            <th style="border: 1px solid">Güncelle</th>
                            <th style="border: 1px solid">Sil</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php
                        $sorgu = $baglanti->prepare("SELECT * from protokol");
                        $sorgu->execute();
                        while ($sonuc = $sorgu->fetch()) {
                            ?>
                            <tr>
                            <td style="border: 1px solid"><?= $sonuc["id"] ?></td>
                            <td style="border: 1px solid"><a href="excel/<?php echo $sonuc["pexcel"] ?>" download><img
                                            style="width:24px; height: 24px; display: block; margin: auto;"
                                            src="image/excel2.png"/></a></td>
                            <td style="border: 1px solid"><?= $sonuc["pbaslik"] ?></td>
                            <td style="border: 1px solid"><?= $sonuc["picerik"] ?></td>
                            <td style="border: 1px solid"><?= $sonuc["aktif"] ?></td>
                            <td style="border: 1px solid">
                                <a href="referansguncelle.php?id=<?= $sonuc["id"] ?>">
                                    <img src="image/Düzenle.png"
                                         style="width: 25px; height: 25px; display: block; margin: auto;" alt="">
                                </a>
                            </td>
                            <td style="border: 1px solid">
                                <a href="sil.php?id=<?= $sonuc["id"] ?>&tablo=referans">
                                    <img src="image/sil.png"
                                         style="width: 25px; height: 25px; display: block; margin: auto; " alt="">
                                </a>


                            </td>

                            </tr><?php } ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>