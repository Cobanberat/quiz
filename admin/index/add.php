<?php include "../../connect/connect.php"; ?>
<?php $id = $_GET["type"]; ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link rel="stylesheet" href="../css/admin.css">

<body>
    <div class="container" id="container">
        <?php include "header.php"; ?>
        <br><br><br><br><br>
        <div class="cardA">
            <div class="cardAb">
                <?php if ($id == "quiz") {
                    include "../add/quizAdd.php";
                } elseif ($id == "survey") {
                    include "../add/anketAdd.php";
                } elseif ($id == "question") {
                    include "../add/soruAdd.php";
                } elseif ($id == "category") {
                    include "../add/kategoriAdd.php";
                } ?>
            </div>
        </div>
    </div>
</body>
<script src="../js/admin.js"></script>