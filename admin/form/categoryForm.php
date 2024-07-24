<?php include "../../connect/connect.php"; ?>
<?php $kategori = $conn->query("select * from kategoriler where id")->fetch(PDO::FETCH_ASSOC); ?>
<?php 
$name = $_POST["categoryAdd"];
$ustİd = $_POST["kategoriA"];

$sorgu = $conn->prepare("INSERT INTO kategoriler(name, ust_id) VALUES(?, ?)");
$sorgu->bindParam(1, $name, PDO::PARAM_STR);
$sorgu->bindParam(2, $ustİd, PDO::PARAM_STR);
$sorgu->execute();
header("location:../index/add.php?type=category");
?>