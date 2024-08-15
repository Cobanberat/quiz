<?php
session_start();
include "../../connect/connect.php";
$id = $_GET["id"];

if ($id) {
    $delete = $conn->prepare("DELETE FROM kategoriler WHERE id = :id");
    $delete->bindParam(":id", $id, PDO::PARAM_INT);
    if ($delete->execute()) {
        $quizler = $conn->query("SELECT * FROM quizler WHERE kategori_id = $id")->fetchAll(PDO::FETCH_ASSOC);
        if ($quizler) {
            foreach ($quizler as $quiz) {
                $quizId = $quiz["id"];

                $sorular = $conn->query("SELECT * FROM sorular WHERE quiz_id = $quizId")->fetchAll(PDO::FETCH_ASSOC);

                foreach ($sorular as $soru) {
                    $soruId = $soru["id"];

                    $cevaplar = $conn->query("SELECT * FROM cevaplar WHERE soru_id = $soruId")->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($cevaplar as $cevap) {
                        $cevapId = $cevap["id"];
                        $delete = $conn->prepare("DELETE FROM cevaplar WHERE id = :id");
                        $delete->bindParam(":id", $cevapId, PDO::PARAM_INT);
                        $delete->execute();
                    }

                    $delete = $conn->prepare("DELETE FROM sorular WHERE id = :id");
                    $delete->bindParam(":id", $soruId, PDO::PARAM_INT);
                    $delete->execute();
                }

                $delete = $conn->prepare("DELETE FROM quizler WHERE id = :id");
                $delete->bindParam(":id", $quizId, PDO::PARAM_INT);
                $delete->execute();
            }
            header("location:../index/kategoriler.php");
            $_SESSION["message"] = [
                "durum" => true
            ];

        } else {
            header("Location: ../index/kategoriler.php");
        }

        header("location:../index/kategoriler.php");
        $_SESSION["message"] = [
            "durum" => true
        ];
    } else {
        header("location:../index/kategoriler.php");
        $_SESSION["message"] = [
            "durum" => false
        ];
    }
} else {
    header("location:../index/kategoriler.php");
    $_SESSION["message"] = [
        "durum" => false
    ];
}
