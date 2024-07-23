<?php
session_start();
include "../connect/connect.php";

$kullanicilar = $conn->query("SELECT * FROM kullanicilar")->fetchAll(PDO::FETCH_ASSOC);

$user = $_POST["user"];
$pass = $_POST["pass"];
$gmail = $_POST["gmail"];

function KayitKontrol($array, $key, $value) {
    foreach ($array as $item) {
        if ($item[$key] == $value) {
            return true;
        }
    }
    return false;
};

function generatePass($sifre) {
    $YeniKey = sha1(md5(crc32(sha1(md5(crc32($sifre))))));
    return $YeniKey;
}
$sifre = generatePass($pass);

if (KayitKontrol($kullanicilar, "mail", $gmail)) {
    $_SESSION["registerKayit"] = [
        "message" => "mailH",
    ];
}
else if (KayitKontrol($kullanicilar, "isim", $user)) {
    $_SESSION["registerKayit"] = [
        "message" => "isimH",
    ];
}
else if (KayitKontrol($kullanicilar, "sifre", $pass)) {
    $_SESSION["registerKayit"] = [
        "message" => "sifreH",
    ];
}
else {
    $sorgu = $conn->prepare("INSERT INTO kullanicilar(isim, sifre, mail) VALUES(?, ?, ?)");
    $sorgu->bindParam(1, $user, PDO::PARAM_STR);
    $sorgu->bindParam(2, $sifre, PDO::PARAM_STR);
    $sorgu->bindParam(3, $gmail, PDO::PARAM_STR);
    $sorgu->execute();
    $_SESSION["registerKayit"] = [
        "message" => "succes",
    ];
}
header("location:../login/login.php");

