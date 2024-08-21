<?php
include "../../connect/connect.php";
session_start();

$id = $_GET["id"];

if ($id) {
$quizler = $conn->query("select * from quizler where id = $id")->fetchALl(PDO::FETCH_ASSOC);
    if ($quizler) {
        foreach ($quizler as $quiz) {
            $quizId = $quiz["id"];
            $cq = $conn->query("select * from cozulenquiz where quiz_id = $quizId")->fetchAll(PDO::FETCH_ASSOC);
            if($cq){
                foreach($cq as $value){
                    $sorgu = $conn->prepare("DELETE FROM cozulenquiz where id = :id");
                    $sorgu->bindParam(':id', $value["id"], PDO::PARAM_INT);
                    $sorgu->execute();
                }
            }
        }
    }
    $sorgu = $conn->prepare("DELETE FROM quizler WHERE id = :id");
    $sorgu->bindParam(':id', $id, PDO::PARAM_INT);
    if ($sorgu->execute()) {
        $sorular = $conn->query("select * from sorular where quiz_id = '$id'")->fetchAll(PDO::FETCH_ASSOC);
        if ($sorular) {
            foreach ($sorular as $soru) {
                $sorgu = $conn->prepare("DELETE FROM sorular where quiz_id = :id ");
                $sorgu->bindParam(':id', $id, PDO::PARAM_INT);
                if ($sorgu->execute()) {
                    $cevaplar = $conn->query("select * from cevaplar where soru_id = '" . $soru["id"] . "'")->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($cevaplar as $cevap) {
                        $sorgu = $conn->prepare("DELETE FROM cevaplar where id = :id");
                        $sorgu->bindParam(':id', $cevap["id"], PDO::PARAM_INT);
                        if ($sorgu->execute()) {
                            header("location:../index/quizler.php");
                            $_SESSION["message"] = [
                                "durum" => true
                            ];
                        } else 
                        header("location:../index/quizler.php");
                            $_SESSION["message"] = [
                                "durum" => true
                            ];
                        }
                    
                } else {
                    header("location:../index/quizler.php");
                    $_SESSION["message"] = [
                        "durum" => true
                    ];
                }
            }
        } else {
            header("location:../index/quizler.php");
            $_SESSION["message"] = [
                "durum" => true
            ];
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
