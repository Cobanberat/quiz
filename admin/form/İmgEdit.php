<?php include "../../connect/connect.php"; ?>
<?php session_start(); ?>
<?php
if ($_POST["img"]) {
   $img = $_POST["img"];



   if ($img) {
      $sorgu = $conn->prepare("UPDATE anasayfabilgi SET img = :img where id = 1");
      $sorgu->bindParam(":img", $img, PDO::PARAM_STR);
      if ($sorgu->execute()) {
         header("location:../index/AnaSayfaMain");
         $_SESSION["message"] = [
            "durum" => true
         ];
      } else {
         header("location:../index/AnaSayfaMain");
         $_SESSION["message"] = [
            "durum" => false
         ];
      }
   } else {
      header("location:../index/AnaSayfaMain");
      $_SESSION["message"] = [
         "durum" => false
      ];
      exit;
   }
} else if ($_POST["email"] || $_POST["email"]) {
   $email = $_POST["email"];
   $metin = $_POST["metin"];
   if ($email || $metin) {
      $sorgu = $conn->prepare("UPDATE anasayfabilgi SET metin = :metin, email = :email where id = 2");
      $sorgu->bindParam(":metin", $metin, PDO::PARAM_STR);
      $sorgu->bindParam(":email", $email, PDO::PARAM_STR);
      if ($sorgu->execute()) {
         header("location:../index/AnaSayfaMain.php");
         $_SESSION["message"] = [
            "durum" => true
         ];
      } else {
         header("location:../index/AnaSayfaMain.php");
         $_SESSION["message"] = [
            "durum" => false
         ];
      }
   } else {
      header("location:../index/AnaSayfaMain.php");
      $_SESSION["message"] = [
         "durum" => false
      ];
      exit;
   }
}
