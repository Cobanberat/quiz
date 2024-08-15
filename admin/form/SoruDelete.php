<?php
session_start();
include "../../connect/connect.php";

$id = $_GET["id"];

if ($id) {
    $sorgu = $conn->prepare("DELETE FROM sorular WHERE id = :id");
    $sorgu->bindParam(':id', $id, PDO::PARAM_INT);
    if ($sorgu->execute()) {
        $cevaplar = $conn->query("select * from cevaplar where soru_id = '$id'")->fetchAll(PDO::FETCH_ASSOC);
        foreach ($cevaplar as $cevap) {
            $sorgu = $conn->prepare("DELETE FROM cevaplar where soru_id = :id ");
            $sorgu->bindParam(':id', $id, PDO::PARAM_INT);
            if ($sorgu->execute()) {
                $_SESSION["message"] = [
                    "durum" => true
                ];
                header("location:../index/quizler.php");
            }
        }
    } else {
        header("location:../index/quizler.php");
        $_SESSION["message"] = [
            "durum" => false
        ];
    }
} else {
    header("location:../index/quizler.php");
    $_SESSION["message"] = [
        "durum" => false
    ];
}

