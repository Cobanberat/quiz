<?php session_start(); ?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <title>login</title>
</head>

<body>
    <br>
    <div class="login-wrap">
        <div class="login-html">
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Giriş Yap</label>
            <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Kayıt Ol</label>
            <div class="login-form">
                <form action="../formlar/loginForm.php" method="post">
                    <div class="sign-in-htm">
                        <div class="group">
                            <label for="user" class="label">Kullanıcı Adı</label>
                            <input id="user" name="user" type="text" class="input" required>
                        </div>
                        <div class="group">
                            <label for="pass" class="label">Şifre</label>
                            <input id="pass" name="pass" type="password" class="input" data-type="password" required>
                        </div>
                        <div class="group">
                            <input id="check" type="checkbox" class="check" checked>
                            <label for="check"><span class="icon"></span> Oturumumu açık tut</label>
                        </div>
                        <div class="group">
                            <input type="submit" class="button" value="Giriş Yap">
                        </div>
                        <div class="hr"></div>
                        <div class="foot-lnk">
                            <a href="#forgot">Şifremi Unuttum?</a>
                        </div>
                    </div>
                </form>
                <form id="registerForm" action="../formlar/registerForm.php" method="post" onsubmit="return validateForm()">
                    <div class="sign-up-htm">
                        <div class="group">
                            <label for="regUser" class="label">Kullanıcı Adı</label>
                            <input id="regUser" name="user" type="text" class="input" required>
                        </div>
                        <div class="group">
                            <label for="regPass" class="label">Şifre</label>
                            <input id="regPass" name="pass" type="password" class="input" data-type="password" required>
                        </div>
                        <div class="group">
                            <label for="regTryPass" class="label">Şifreyi Tekrar Girin</label>
                            <input id="regTryPass" name="tryPass" type="password" class="input" data-type="password" required>
                        </div>
                        <div class="group">
                            <label for="regGmail" class="label">E-Posta Adresi</label>
                            <input id="regGmail" name="gmail" type="email" class="input" required>
                        </div>
                        <div class="group">
                            <input type="submit" class="button" value="Kayıt Ol">
                        </div>
                        <div class="hr"></div>
                        <div class="foot-lnk">
                            <label for="tab-1">Zaten Üye misiniz?</label>
                        </div>
                    </div>
                </form>
                <?php
                if (isset($_SESSION["hata"]) == "1") {
                    echo "<script>
                    Toastify({
                        text: 'kullanıcı adı veya şifre yanlış',
                        duration: 3000
                    }).showToast();
                </script>";
                }
                unset($_SESSION["hata"]);
                if (isset($_SESSION["registerKayit"]["message"])) {
                    $message = $_SESSION["registerKayit"]["message"];
                    $toastMessage = "";
                    switch ($message) {
                        case "mailH":
                            $toastMessage = "Bu e-posta adresi zaten kayıtlı.";
                            break;
                        case "isimH":
                            $toastMessage = "Bu kullanıcı adı zaten kayıtlı.";
                            break;
                        case "sifreH":
                            $toastMessage = "Bu şifre zaten kullanılıyor.";
                            break;
                        case "succes":
                            $toastMessage = "Başarıyla kayıt oldunuz.";
                            break;
                    }
                    echo "<script>
            Toastify({
                text: '$toastMessage',
                duration: 3000
            }).showToast();
        </script>";
                    unset($_SESSION["registerKayit"]);
                }
                ?>


            </div>
        </div>
    </div>
</body>

<script src="../js/login.js"></script>

</html>
<?php unset($_SESSION["registerKayit"]) ?>