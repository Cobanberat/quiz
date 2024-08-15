<?php session_start(); ?>
<?php include "../../connect/connect.php"; ?>
<?php
$text = $_POST["text"];
$id = $_POST["id"];

if ($text && $id) {
    $sorgu = $conn->prepare("UPDATE cevaplar SET text = :text where id = :id");
    $sorgu->bindParam(":text", $text, PDO::PARAM_STR);
    $sorgu->bindParam(":id", $id, PDO::PARAM_STR);

    if ($sorgu->execute()) {
        header("location:../index/CevapEdit.php?id=$id");
        $_SESSION["message"] = [
            "durum" => true
        ];
    } else {
        header("location:../index/CevapEdit.php?id=$id");
        $_SESSION["message"] = [
            "durum" => false
        ];
    }
} else {
    header("location:../index/CevapEdit.php?id=$id");
    $_SESSION["message"] = [
        "durum" => false
    ];
}


?>