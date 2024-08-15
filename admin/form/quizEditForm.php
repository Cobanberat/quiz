<?php 
session_start(); 
include "../../connect/connect.php"; 

$name = $_POST["name"];
$img = $_POST["img"];
$time = $_POST["quizTime"];
$id = $_POST["id"];

if($name && $img && $time && $id){
    $sorgu = $conn->prepare("UPDATE quizler SET name = :name, img = :img, time = :quizTime WHERE id = :id");
    $sorgu->bindParam(':name', $name);
    $sorgu->bindParam(':img', $img);
    $sorgu->bindParam(':quizTime', $time);
    $sorgu->bindParam(':id', $id);
    if($sorgu->execute()){
        header("location:../index/edit.php?id=$id");
        $_SESSION["message"] = [
            "durum" => true
        ];
    }else{
        header("location:../index/edit.php?id=$id");
        $_SESSION["message"] = [
            "durum" => false
        ];
    }
}else{
    header("location:../index/edit.php?id=$id");
    $_SESSION["message"] = [
        "durum" => false
    ];
}
