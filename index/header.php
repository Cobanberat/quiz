<?php if (isset($_SESSION["user_id"])) { ?>
    <div id="header">
        <div class="sol" id="sol">
            <a href=""><span>Ana Sayfa</span></a>
            <a href=""><span>Quizler</span></a>
            <a href=""><span>Anketler</span></a>
        </div>
        <div class="sag">
            <div class="svgİ" id="svgİ">
                <svg class="iconM" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                </svg>
            </div>
        </div>
        <?php include "dropdawn.php"; ?>
    </div>
<?php } else { ?>
    <br>
    <div class="header">
        <div class="logo"><span>QUİZ</span></div>
        <div id="sol"></div>
        <div id="sag">
            <a href="../login/login.php"><button class="cssbuttons-io"><span>Giriş Yap</span></button></a>
            <a href="../login/Login.php"><button class="cssbuttons-io"><span>Kayıt Ol</span></button></a>
        </div>
    </div>
<?php } ?>