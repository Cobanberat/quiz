<?php
session_start();
include "../../connect/connect.php";
$quizler = $conn->query("SELECT * FROM quizler")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/admin.css">
    <title>Quizler</title>

</head>

<body>
    <div class="container">
        <?php include "header.php"; ?>
        <br>
        <br>

        <div class="bodys">
            <div class="container">
                <span class="adminSpan">
                    Quizler
                </span>
            </div>
            <br>
            <div class="quizList">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ad</th>
                                <th>Resim</th>
                                <th>Süre (DK)</th>
                                <th>İşlem</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($quizler as $quiz) : ?>
                                <tr>
                                    <td><?= $quiz['id']; ?></td>
                                    <td><?= $quiz['name']; ?></td>
                                    <td><img src="../../img/<?= $quiz['img']; ?>" alt="Quiz Image"></td>
                                    <td><?= $quiz['time']; ?></td>
                                    <td>
                                        <button class="btn btn-dark btn-sm" onclick="toggleQuestions(<?= $quiz['id']; ?>)">Soru <i id="icon-<?= $quiz['id']; ?>" class="bi bi-chevron-down btn-icon"></i></button>
                                        <a href="edit.php?id=<?= $quiz['id']; ?>" class="btn btn-warning btn-sm">Düzenle</a>
                                        <a href="../form/deleteQuizForm.php?id=<?= $quiz['id']; ?>" class="btn btn-danger btn-sm">Sil</a>
                                    </td>
                                </tr>
                                <tr id="questions-<?= $quiz['id']; ?>" class="questions-row">
                                    <td colspan="5">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Soru ID</th>
                                                        <th>Soru</th>
                                                        <th>İşlem</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sorular = $conn->query("SELECT * FROM sorular WHERE quiz_id = '" . $quiz['id'] . "'")->fetchAll(PDO::FETCH_ASSOC);
                                                    foreach ($sorular as $soru) : ?>
                                                        <tr>
                                                            <td><?= $soru['id']; ?></td>
                                                            <td><?= $soru['text']; ?></td>
                                                            <td>
                                                                <button class="btn btn-dark btn-sm" onclick="toggleAnswers(<?= $soru['id']; ?>)">Cevaplar <i id="icon-ans-<?= $soru['id']; ?>" class="bi bi-chevron-down btn-icon"></i></button>
                                                                <a href="SoruEdit.php?id=<?= $soru['id']; ?>" class="btn btn-warning btn-sm">Düzenle</a>
                                                                <a href="../form/SoruDelete.php?id=<?= $soru['id']; ?>" class="btn btn-danger btn-sm">Sil</a>
                                                            </td>
                                                        </tr>
                                                        <tr id="answers-<?= $soru['id']; ?>" class="answers-row">
                                                            <td colspan="3">
                                                                <div class="table-responsive">
                                                                    <table class="table table-bordered">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Cevap ID</th>
                                                                                <th>Cevap</th>
                                                                                <th>durum</th>
                                                                                <th>İşlem</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php
                                                                            $cevaplar = $conn->query("SELECT * FROM cevaplar WHERE soru_id = '" . $soru['id'] . "'")->fetchAll(PDO::FETCH_ASSOC);
                                                                            foreach ($cevaplar as $cevap) : ?>
                                                                                <tr>
                                                                                    <td><?= $cevap['id']; ?></td>
                                                                                    <td><?= $cevap['text']; ?></td>
                                                                                    <?php if($cevap["durum"] == 0) { ?>
                                                                                        <td>Yanlış</td>
                                                                                    <?php } else { ?>
                                                                                        <td>Doğru</td>
                                                                                    <?php } ?>
                                                                                        
                                                                                    <td>
                                                                                        <a href="CevapEdit.php?id=<?= $cevap['id']; ?>" class="btn btn-warning btn-sm">Düzenle</a>
                                                                                        </td>
                                                                                </tr>
                                                                            <?php endforeach; ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<style>
    .table-responsive {
        max-width: 1200px;
        margin: 0 auto;
    }

    table {
        width: 100%;
        table-layout: fixed;
    }

    th,
    td {
        text-align: center;
        word-wrap: break-word;
    }

    th {
        font-size: 1.2rem;
    }

    td {
        font-size: 1rem;
    }

    img {
        max-width: 70px;
        height: auto;
    }

    .questions-row,
    .answers-row {
        display: none;
    }

    .expanded {
        display: table-row;
    }

    .btn-icon {
        display: inline;
    }
</style>
<script src="../js/admin.js"></script>
<?php
if (isset($_SESSION["message"])) {
    if ($_SESSION["message"]["durum"] == 1) { ?>

        <script>
            showToast("silme İşlemi Başarılı Şekilde gerçekleştiridi.");

            function showToast(message) {
                const toast = document.createElement('div');
                toast.className = 'toast';
                toast.innerText = message;
                document.body.appendChild(toast);
                setTimeout(() => {
                    toast.classList.add('show');
                }, 100);

                setTimeout(() => {
                    toast.classList.remove('show');
                    setTimeout(() => {
                        document.body.removeChild(toast);
                    }, 300);
                }, 3000);
            }
        </script>
    <?php } else { ?>
        <script>
            showToast("Silme İşleminde hata oluştu. Lütfen daha sonra tekrar deneyiniz!");

            function showToast(message) {
                const toast = document.createElement('div');
                toast.className = 'toast';
                toast.innerText = message;
                document.body.appendChild(toast);
                setTimeout(() => {
                    toast.classList.add('show');
                }, 100);

                setTimeout(() => {
                    toast.classList.remove('show');
                    setTimeout(() => {
                        document.body.removeChild(toast);
                    }, 300);
                }, 3000);
            }
        </script>
<?php }
}
?>
<style>
    .toast {
        visibility: hidden;
        max-width: 50%;
        margin: 0 auto;
        background-color: #333;
        color: #fff;
        text-align: center;
        border-radius: 5px;
        padding: 10px;
        position: fixed;
        z-index: 1;
        left: 0;
        right: 0;
        top: 30px;
        font-size: 17px;
    }

    .toast.show {
        visibility: visible;
        -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
        animation: fadein 0.5s, fadeout 0.5s 2.5s;
    }

    @-webkit-keyframes fadein {
        from {
            top: 0;
            opacity: 0;
        }

        to {
            top: 30px;
            opacity: 1;
        }
    }

    @keyframes fadein {
        from {
            top: 0;
            opacity: 0;
        }

        to {
            top: 30px;
            opacity: 1;
        }
    }

    @-webkit-keyframes fadeout {
        from {
            top: 30px;
            opacity: 1;
        }

        to {
            top: 0;
            opacity: 0;
        }
    }

    @keyframes fadeout {
        from {
            top: 30px;
            opacity: 1;
        }

        to {
            top: 0;
            opacity: 0;
        }
    }
</style>
<?php unset($_SESSION["message"]); ?>
