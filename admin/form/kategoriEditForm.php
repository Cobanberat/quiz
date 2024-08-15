<?php session_start(); ?>
<?php include "../../connect/connect.php" ?>
<?php
$id = $_POST["id"];
$name = $_POST["name"];
$kategori = $_POST["kategori"];

if ($name && $id) {
    $sorgu = $conn->prepare("UPDATE kategoriler SET name = :name, ust_id = :kategori where id = :id");
    $sorgu->bindParam(":name", $name, PDO::PARAM_STR);
    $sorgu->bindParam(":kategori", $kategori, PDO::PARAM_STR);
    $sorgu->bindParam(":id", $id, PDO::PARAM_STR);

    if ($sorgu->execute()) {
        header("location:../index/kategoriEdit.php?id=$id");
        $_SESSION["message"] = [
            "durum" => true
        ];
    } else {
        $_SESSION["message"] = [
            "durum" => false
        ];
        header("location:../index/kategoriEdit.php?id=$id");
    }
} else {
    $_SESSION["message"] = [
        "durum" => false
    ];
    header("location:../index/kategoriEdit.php?id=$id");
}

?>