<?php include "../../connect/connect.php";
session_start(); ?>
<?php $kategori = $conn->query("select * from kategoriler where id")->fetch(PDO::FETCH_ASSOC); ?>
<?php
$name = $_POST["categoryAdd"];
$ustİd = $_POST["kategoriA"];
if ($name || $ustİd) {
    $sorgu = $conn->prepare("INSERT INTO kategoriler(name, ust_id) VALUES(?, ?)");
    $sorgu->bindParam(1, $name, PDO::PARAM_STR);
    $sorgu->bindParam(2, $ustİd, PDO::PARAM_STR);
    if ($sorgu->execute()) {
        $_SESSION["message"] = [
            "durum" => true
        ];
        header("location:../index/add.php?type=category");
    } else {
        $_SESSION["message"] = [
            "durum" => false
        ];
        header("location:../index/add.php?type=category");
    }
} else {
    $_SESSION["message"] = [
        "durum" => false
    ];
    header("location:../index/add.php?type=category");
}
?>