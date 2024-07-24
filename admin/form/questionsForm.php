<?php include "../../connect/connect.php"; ?>
<?php 
$soru = $_POST["soruAdd"];
$quizId = $_POST["soruQ"];
$A = $_POST["A"];
$B = $_POST["B"];
$C = $_POST["C"];
$D = $_POST["D"];
$durum = $_POST["durum"];

$sorgu = $conn->prepare("INSERT INTO sorular(text, quiz_id) VALUES(?, ?)");
$sorgu->bindParam(1, $soru, PDO::PARAM_STR);
$sorgu->bindParam(2, $quizId, PDO::PARAM_INT);
if($sorgu->execute()){
    $soruId = $conn->lastInsertId();

    $cevaplar = [
        'A' => $A,
        'B' => $B,
        'C' => $C,
        'D' => $D
    ];

    foreach($cevaplar as $key => $cevap) {
        $durumS = ($key == $durum) ? 1 : 0;
        $sorgu = $conn->prepare("INSERT INTO cevaplar(soru_id, text, durum) VALUES(?, ?, ?)");
        $sorgu->bindParam(1, $soruId, PDO::PARAM_INT);
        $sorgu->bindParam(2, $cevap, PDO::PARAM_STR);
        $sorgu->bindParam(3, $durumS, PDO::PARAM_INT);
        $sorgu->execute();
    }
    
    header("Location:../index/add.php?type=question");
}
?>
