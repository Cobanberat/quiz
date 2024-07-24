<br><br><br><br><br><br>
<?php $quiz = $conn->query("select * from quizler where id")->fetchAll(PDO::FETCH_ASSOC); ?>
<div class="cards">
    <?php foreach( $quiz as $row ): ?>
    <div class="cardL">
        <div class="ust"><a href=""><i class="bi bi-pencil-square"></i></a></div>
        <div class="img">
            <img src="../../img/<?= $row["img"] ?>" alt="">
        </div>
        <div class="text">
            <span><?= $row["name"] ?></span>
        </div>
    </div>
    <?php endforeach; ?>
</div>