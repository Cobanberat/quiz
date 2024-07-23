<?php $user = $_SESSION["user_id"];  ?>
<?php $kullanicilar = $conn->query("SELECT * FROM kullanicilar WHERE id = '$user'")->fetch(PDO::FETCH_ASSOC);  ?>
<div class="dropdawn" id="dropdawn">
    <div class="hesap">
        <span><?= $kullanicilar["isim"] ?></span>
    </div>
    <div class="row">
        <a href=""><span id="dropdawnSpan"><i class="bi bi-house"></i>Ana Sayfa</span></a>
        <a href=""><span id="dropdawnSpan"><i class="bi bi-telephone"></i>İletişim</span></a>
        <a href=""><span id="dropdawnSpan"><i class="bi bi-newspaper"></i></i> Anketler</span></a>
        <a href=""><span id="dropdawnSpan"><i class="bi bi-person-raised-hand"></i> Quizler</span></a>
        <?php if ($kullanicilar["durum"] == 1) { ?>
        <a href="../admin/index/admin.php"><span id="dropdawnSpan"><i class="bi bi-lock"></i>Admin</span></a>
        <?php } ?>
        <a href="delete.php"><span id="exit">Çıkış Yap</span></a>
    </div>
</div>
</div>