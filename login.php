<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Giriş</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="css/loginstyle.css">
    <link rel="shortcut icon" href="image/dedasLogo.png">
</head>

<body>

<div class="login-dark"><!--<image src="image/a.png" href="firat.tosun.com">-->
    <?php
    session_start();
    include("inc/db.php");

    /*    if(isset($_SESSION["oturum"])&&$_SESSION["oturum"]=="6789"){
            header("location:protokol.php");
        }*/

    $kadi = "";
    if (@$_POST) {
        $kadi = $_POST["txtKadi"];
        $sifre = $_POST["txtParola"];


    }


    ?>
    <form method="post" action="login.php">
        <div class="illustration"><a href='#'> <img src="image/dedasLogo.png" alt="adminlogo"></a></div>
        <div class="form-group"><input style="color:#993300;" class="form-control" value="<?php echo $kadi ?>"
                                       name="txtKadi" type="text" name="email" placeholder="Kullanıcı Adınız " required>
        </div>
        <div class="form-group"><input style="color:#993300;" class="form-control" name="txtParola" type="password"
                                       name="password" placeholder="Şifreniz" required></div>
        <div class="form-group"><input class="btn btn-primary btn-block" value="Giriş" type="submit"></input></div>
        <a href="#" class="forgot">Şifrenizi mi Unuttunuz?</a>
    </form>
    <script type="text/javascript" src="js/sweetalert2.all.min.js"></script>
    <?php
    if ($_POST) {
        /*echo md5("21"."1376"."34");*//*Şifrenin md5 formatı aşağıdaki gibidir.*/
        $sorgu = $baglanti->prepare("select sifre,yetki from kullanici where kadi=:kadi and aktif=1");
        $sorgu->execute(['kadi' => htmlspecialchars($kadi)]);
        $sonuc = $sorgu->fetch();
        if (md5("21" . $sifre . "34") == $sonuc["sifre"]) {
            header("location:protokol.php");
            $_SESSION["oturum"] = "6789";
            $_SESSION["kadi"] = $kadi;
            $_SESSION["yetki"] = $sonuc["yetki"];


        } else {
            echo "<script> Swal.fire('Hata' , 'Kullanıcı adı veya şifre hatalı!' , 'error')</script>";
        }

    }
    ?>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>

</body>
</html>
