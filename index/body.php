<?php if (isset($_SESSION["user_id"])) { ?>
    <?php $AnS = $conn->query("select * from anasayfabilgi where id = 1")->fetch(PDO::FETCH_ASSOC); ?>
    <?php $AnS2 = $conn->query("select * from anasayfabilgi where id = 2")->fetch(PDO::FETCH_ASSOC); ?>
    <br><br><br>
    <div class="container">
        <div class="body">
            <div class="logoText">
                <div class="textY">𝓺𝓾𝓲𝔃𝔃𝓮𝓼𝓼</div>
                <div class="textC"><?= $AnS2["metin"] ?>.</div>
            </div>
            <div class="slider">
                <div class="img1"><img src="../img/<?= $AnS["img"] ?>" alt=""></div>
            </div>
        </div>

        <div class="spanA">
            <span class="MainSpan">
                Örnek Quizler
            </span>
        </div>
        <?php $quiz = $conn->query("select * from quizler where id limit 8")->fetchAll(PDO::FETCH_ASSOC); ?>
        <div class="cards">
            <?php $quiz = $conn->query("select * from quizler where id")->fetchAll(PDO::FETCH_ASSOC); ?>
            <?php foreach ($quiz as $row) : ?>
                <div id="cardC" class="quiz<?= $row['kategori_id'] ?>">
                    <div class="ust"></div>
                    <div id="img">
                        <img src="../img/<?= $row["img"] ?>" alt="">
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
        <br>
    <?php } else { ?>
        <br><br>
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
            <?php $quiz = $conn->query("select * from quizler where id limit 8")->fetchAll(PDO::FETCH_ASSOC); ?>
            <?php foreach ($quiz as $row) : ?>
                <div id="cardC" class="quiz<?= $row['kategori_id'] ?>">
                    <div class="ust"></div>
                    <div id="img">
                        <img src="../img/<?= $row["img"] ?>" alt="">
                    </div>
                    <div class="text">
                        <span><?= $row["name"] ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php } ?>
    </div>