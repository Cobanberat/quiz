<?php
session_start();
include "../../connect/connect.php";

$name = $_POST["quizAdd"];
$sure = $_POST["quizTime"];
$kategori = $_POST["kategoriA"];
$img = $_FILES['img']['name'];
if ($name && $sure && $kategori && $img) {
    $sorgu = $conn->prepare("INSERT INTO quizler(name, kategori_id, img, time) VALUES(?, ?, ?, ?)");
    $sorgu->bindParam(1, $name, PDO::PARAM_STR);
    $sorgu->bindParam(2, $kategori, PDO::PARAM_INT);
    $sorgu->bindParam(3, $img, PDO::PARAM_STR);
    $sorgu->bindParam(4, $sure, PDO::PARAM_INT);

    if ($sorgu->execute()) {
        $_SESSION["message"] = [
            "durum" => true
        ];
        header("location:../index/add.php?type=quiz");
    } else {
        $_SESSION["message"] = [
            "durum" => false
        ];
        header("location:../index/add.php?type=quiz");
    }
} else {
    $_SESSION["message"] = [
        "durum" => false
    ];
    header("location:../index/add.php?type=quiz");
}
