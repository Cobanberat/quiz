<br><br><br>
<div class="container">
    <span class="adminSpan">Hızlı Düzenleme</span>
    <br><br><br>
    <?php $quiz = $conn->query("select * from quizler where id limit 8")->fetchAll(PDO::FETCH_ASSOC); ?>
    <div class="cards">
        <?php foreach ($quiz as $row) : ?>
            <div id="cardC" class="quiz<?= $row['kategori_id'] ?>">
                <div class="ust"><a href="edit.php?id=<?= $row["id"] ?>"><i class="bi bi-pencil-square"></i></a></div>
                <div id="img">
                    <img src="../../img/<?= $row["img"] ?>" alt="">
                </div>
                <div class="text">
                    <span><?= $row["name"] ?></span>
                </div>
                <div class="alt">
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>