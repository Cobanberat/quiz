<?php 
session_start();
include "../../connect/connect.php";

$text = $_POST["text"];
$id = $_POST["id"];

if ($text && $id) {
    $sorgu = $conn->prepare("UPDATE sorular SET text = :text WHERE id = :id");
    $sorgu->bindParam(":text", $text, PDO::PARAM_STR);
    $sorgu->bindParam(":id", $id, PDO::PARAM_INT);
    
    if ($sorgu->execute()) {
        header("location: ../index/SoruEdit.php?id=$id");
        $_SESSION["message"] = [
            "durum" => true
        ];
    } else {
        header("location: ../index/SoruEdit.php?id=$id");
        $_SESSION["message"] = [
            "durum" => false
        ];      
    }
} else {
    header("location: ../index/SoruEdit.php?id=$id");
    $_SESSION["message"] = [
        "durum" => false
    ]; 
}
?>
