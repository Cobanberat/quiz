<?php 
session_start();
include "../../connect/connect.php";

$soru = $_POST["soruAdd"];
$quizId = $_POST["soruQ"];
$A = $_POST["A"];
$B = $_POST["B"];
$C = $_POST["C"];
$D = $_POST["D"];
$durum = $_POST["durum"];

if (isset($soru, $quizId, $A, $B, $C, $D, $durum) && !empty($soru) && !empty($quizId) && !empty($A) && !empty($B) && !empty($C) && !empty($D) && in_array($durum, ['A', 'B', 'C', 'D'])) {
    
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

        $_SESSION["message"] = [
            "durum" => true,
        ];
        header("Location:../index/add.php?type=question");
    } else {
        $_SESSION["message"] = [
            "durum" => false,
        ];
        header("Location:../index/add.php?type=question");
    }
} else {
    $_SESSION["message"] = [
        "durum" => false,
    ];
    header("Location:../index/add.php?type=question");
}
?>
