<?php session_start(); ?>
<?php include "../connect/connect.php"; ?>
<?php $kategoriler = $conn->query("select * from kategoriler where id")->fetchAll(PDO::FETCH_ASSOC); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizler</title>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/index.css">
</head>

<body>
    <div class="container">
        <?php include "header.php"; ?>
        <br><br>
        <div class="container">
            <div class="select1">
                <select class="select" id="categorySelect" aria-label="Default select example">
                    <option value="all" selected>Tümü</option>
                    <?php foreach ($kategoriler as $row) { ?>
                        <option value="quiz<?= $row["id"] ?>"><?= $row["name"] ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="cards">
                <?php $quiz = $conn->query("select * from quizler where id")->fetchAll(PDO::FETCH_ASSOC); ?>
                <?php foreach ($quiz as $row) : ?>
                    <div id="cardC" class="quiz<?= $row['kategori_id'] ?>">
                        <div class="ust"></div>
                        <div id="img">
                            <img src="../img/<?= $row["img"] ?>">
                        </div>
                        <div class="text">
                            <span><?= $row["name"] ?></span>
                        </div>
                        <div class="alt">
                            <a href="solve.php?id=<?= $row["id"]; ?>"> <button class="buttonS">Çözmeye Başla</button></a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>

</html>
<script src="../js/index.js"></script>
<script>
</script>
<?php include "footer.php" ?>