<br><br><br><br><br>
<?php if (isset($_SESSION["user_id"])) { ?>
    <br><br><br>    
    <div class="body">
        <div class="slider">
            <div class="img1"><img style="width:800px; height:400px;" src="../img/images.png" alt=""></div>
        </div>
    </div>
<?php } else { ?>
    <div class="body">
        <div class="body_text">
            <div class="text_main">
                <span>Yüz Binlerce soru ve test Çözün kendinizi Geliştirmeye</span>
                <span>başlayın</span>
                <br>
                <a href="../login/login.php"><button id="bottone1"><strong>Hemen Başla</strong></button></a>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <div class="cards">

    </div>
<?php } ?>