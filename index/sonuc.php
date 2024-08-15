<?php
session_start();
include "../connect/connect.php";
$quizId = $_POST["id"];

$dogru_cevap = 0;
$yanlisC = 0;
$bosCevap = 0;

if (isset($_POST['cevap'])) {
    foreach ($_POST['cevap'] as $soru_id => $cevap_data) {
        $soru = $conn->query("SELECT * FROM sorular WHERE id = '" . $soru_id . "'")->fetch(PDO::FETCH_ASSOC);
        $quiz = $conn->query("SELECT * FROM quizler WHERE id = '" . $soru["quiz_id"] . "'")->fetch(PDO::FETCH_ASSOC);
        $dogru_cevaplar = $conn->query("SELECT * FROM cevaplar WHERE durum = 1 AND soru_id = $soru_id")->fetchAll(PDO::FETCH_ASSOC);
        
        $dogruSayisi = 0;
        foreach ($cevap_data as $cevap_id) {
            if (in_array($cevap_id, array_column($dogru_cevaplar, 'id'))) {
                $dogruSayisi++;
            }
        }

        if ($dogruSayisi == count($dogru_cevaplar)) {
            $dogru_cevap++;
        } else {
            $yanlisC++;
        }
    }
    $cevaplananSoruSayisi = count($_POST["cevap"]);
} else {
    $cevaplananSoruSayisi = 0;
}

$sorular = $conn->query("SELECT * FROM sorular WHERE quiz_id = '" . $quizId . "'")->fetchAll(PDO::FETCH_ASSOC);
$soru_sayi = count($sorular);
$bosCevap = $soru_sayi - $cevaplananSoruSayisi;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="../css/index.css">
    <title>Sonuçlar</title>
</head>

<body>
    <?php include "header.php"; ?>
    <div class="container">
        <div class="row">
            <div class="cardL" id="quizEndCard">
                <div class="ust">quiz sonuçları</div>
                <div class="ort">
                    <span>Toplam Soru Sayısı: <?= $soru_sayi ?></span>
                    <span>Doğru Cevap: <?= $dogru_cevap ?> </span>
                    <span>Yanlış Cevap: <?= $yanlisC ?></span>
                    <span>Boş Sayısı: <?= $bosCevap ?> </span>
                </div>
                <div id="sonucAlt">
                    <div>
                        <a href="index.php"><button type="button" class="btn btn-danger">Çık</button></a>
                        <a href="solve.php?id=<?= $quizId ?>"><button type="button" class="btn btn-secondary">Tekrar Çöz</button></a>
                    </div>
                    <div>
                        <form action="../formlar/saveForm.php" method="POST">
                            <input type="hidden" name="D" value="<?= $dogru_cevap ?>">
                            <input type="hidden" name="Y" value="<?= $yanlisC ?>">
                            <input type="hidden" name="B" value="<?= $bosCevap ?>">
                            <input type="hidden" name="user_id" value="<?= $_SESSION["user_id"] ?>">
                            <input type="hidden" name="quiz_id" value="<?= $quizId ?>">
                            <button type="submit" class="btn btn-primary">Sonuçları Kaydet</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script src="../js/index.js"></script>