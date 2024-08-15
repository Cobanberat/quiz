<?php 
session_start(); 
include "../connect/connect.php"; 

if (isset($_POST["D"], $_POST["Y"], $_POST["B"], $_POST["quiz_id"], $_POST["user_id"])) {
    $D = $_POST["D"];
    $Y = $_POST["Y"];
    $B = $_POST["B"];
    $quizId = $_POST["quiz_id"];
    $user_id = $_POST["user_id"];

    $sorgu = $conn->prepare("SELECT * FROM cozulenquiz WHERE user_id = :user_id AND quiz_id = :quizId");
    $sorgu->bindParam(':user_id', $user_id);
    $sorgu->bindParam(':quizId', $quizId);
    $sorgu->execute();
    $sonuclar = $sorgu->fetch(PDO::FETCH_ASSOC);

    if($sonuclar) {
        $guncelle = $conn->prepare("UPDATE cozulenquiz SET D = :D, Y = :Y, B = :B WHERE user_id = :user_id AND quiz_id = :quizId");
        $guncelle->bindParam(':D', $D);
        $guncelle->bindParam(':Y', $Y);
        $guncelle->bindParam(':B', $B);
        $guncelle->bindParam(':user_id', $user_id);
        $guncelle->bindParam(':quizId', $quizId);
        $guncelle->execute();
        header("location:../index/index.php");
    } else {
        $ekle = $conn->prepare("INSERT INTO cozulenquiz (user_id, quiz_id, D, Y, B) VALUES (:user_id, :quizId, :D, :Y, :B)");
        $ekle->bindParam(':user_id', $user_id);
        $ekle->bindParam(':quizId', $quizId);
        $ekle->bindParam(':D', $D);
        $ekle->bindParam(':Y', $Y);
        $ekle->bindParam(':B', $B);
        $ekle->execute();
        header("location:../index/index.php");
    }
} else {
    header("location:../index/index.php");
}

