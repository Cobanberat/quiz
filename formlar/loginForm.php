<?php 
session_start();
include "../connect/connect.php";

$name = $_POST["user"];
$pass = $_POST["pass"];

    $stmt = $conn->query("SELECT * FROM kullanicilar");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $Giris = false;

    foreach ($users as $user) {
        if ($user['isim'] === $name && $user['sifre'] === sha1(md5(crc32(sha1(md5(crc32($pass))))))) {
            $_SESSION['user_id'] = $user['id'];
            $Giris = true;
        }
    }

    if ($Giris) {
        header("location:../index/index.php");
    } else { 
        $_SESSION["hata"] = "1";   
        header("location:../login/login.php");
    }



