<?php
session_start();
include "../connect/connect.php";

$id = $_GET["id"];
$sorular = $conn->query("SELECT * FROM sorular WHERE quiz_id = '$id'")->fetchAll(PDO::FETCH_ASSOC);
$quizler = $conn->query("SELECT * FROM quizler WHERE id = '$id'")->fetch(PDO::FETCH_ASSOC);
$soruSayi = count($sorular);
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Çöz</title>
    <link rel="stylesheet" href="../css/index.css">
    <script type="text/javascript">
        var quizTime = <?= $quizler["time"] * 60 ?>;
    </script>
</head>

<body>
    <div class="container">
        <?php include "header.php"; ?>
        <br><br><br><br><br>
        <div class="body" style="background-color:#34078d">
            <div id="text" class="text">
                <span><?= $quizler["name"] ?></span>
                <br>
                <span>Quiz <?= $soruSayi ?> sorudan oluşuyor, süreniz <?= $quizler["time"]; ?> dk</span>
            </div>
            <button class="buttonL btn btn-primary" id="startQuiz">Testi Başlat</button>
            <div class="quizs">
                <div id="cardL" class="card" style="display:none;">
                    <form id="quizForm" action="sonuc.php" method="POST">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <input type="hidden" id="KalanSüre" name="KalanSüre" value="<?= $quizler["time"] * 60 ?>">
                        <div id="timer" class="timer">Kalan Süre: <span id="time"></span></div>
                        <?php foreach ($sorular as $index => $soru) : ?>
                            <?php $cevaplar = $conn->query("SELECT * FROM cevaplar WHERE soru_id = '" . $soru['id'] . "'")->fetchAll(PDO::FETCH_ASSOC); ?>
                            <div class="quizC" id="soru-<?= $index ?>" style="display:none;">
                                <div class="card-body">
                                    <h5 class="card-title">Soru <?= $index + 1 ?></h5>
                                    <p class="card-text"><?= $soru['text'] ?></p>
                                    <?php foreach ($cevaplar as $cevap) : ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="cevap[<?= $soru['id'] ?>][<?= $index ?>]" id="cevap-<?= $cevap['id'] ?>" value="<?= $cevap['id'] ?>">
                                            <label class="form-check-label" for="cevap-<?= $cevap['id'] ?>">
                                                <?= $cevap['text'] ?>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="card-footer">
                            <div>
                                <button type="submit" class="buttonA">Sınavı Bitir</button>
                            </div>
                            <div>
                                <button class="btn btn-secondary" id="prevBtn" type="button" style="display:none;">Önceki</button>
                                <button class="btn btn-secondary" id="nextBtn" type="button">Sonraki</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/index.js"></script>
</body>

</html>
<?php include "footer.php"; ?>