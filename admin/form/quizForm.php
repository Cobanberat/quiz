<?php include "../../connect/connect.php"; ?>
<?php $quiz = $conn->query("select * from quizler where id")->fetch(PDO::FETCH_ASSOC); ?>
<?php 
$name = $_POST["quizAdd"];
$sure = $_POST["quizTime"];
$kategori = $_POST["kategoriA"];
$img = $_POST["img"];

$sorgu = $conn->prepare("INSERT INTO quizler(name, kategori_id, img, time) VALUES(?, ?, ?, ?)");
$sorgu->bindParam(1, $name, PDO::PARAM_STR);
$sorgu->bindParam(2, $kategori, PDO::PARAM_STR);
$sorgu->bindParam(3, $img, PDO::PARAM_STR);
$sorgu->bindParam(4, $sure, PDO::PARAM_STR);
$sorgu->execute();
header("location:../index/add.php?type=quiz");
?>
?>