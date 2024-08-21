<?php 
session_start();
include "../connect/connect.php";

$kullanici_id = $_SESSION['user_id']; 
$kullanicilar = $conn->query("select * from kullanicilar where id = $kullanici_id")->fetch(PDO::FETCH_ASSOC);

$cq = $conn->query("SELECT * FROM cozulenquiz WHERE user_id = $kullanici_id")->fetchAll(PDO::FETCH_ASSOC);

$quiz_verileri = [];
$quiz_isimleri = [];

foreach ($cq as $val) {
    $quiz_id = $val["quiz_id"];
    
    if (!isset($quiz_verileri[$quiz_id])) {
        $quiz = $conn->query("SELECT * FROM quizler WHERE id = $quiz_id")->fetch(PDO::FETCH_ASSOC);
        $quiz_isimleri[$quiz_id] = $quiz['name'];

        $quiz_verileri[$quiz_id] = [
            'dogru' => 0,
            'yanlis' => 0,
            'bos' => 0
        ];
    }

    $quiz_verileri[$quiz_id]['dogru'] += $val["D"];
    $quiz_verileri[$quiz_id]['yanlis'] += $val["Y"];
    $quiz_verileri[$quiz_id]['bos'] += $val["B"];
}

$quiz_isimleri_js = json_encode(array_values($quiz_isimleri));
$dogru_sayilari_js = json_encode(array_column($quiz_verileri, 'dogru'));
$yanlis_sayilari_js = json_encode(array_column($quiz_verileri, 'yanlis'));
$bos_sayilari_js = json_encode(array_column($quiz_verileri, 'bos'));
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Profil</title>
    <link rel="stylesheet" href="../css/index.css">
</head>

<body>
    <div class="container">
        <?php include "header.php"; ?>
    </div>
    <div class="profile-container">
        <div class="profile-card">
            <div class="profile-img">
            </div>
            <div class="profile-info">
                <h2><?= $kullanicilar["isim"] ?></h2>
                <p><?= $kullanicilar["mail"] ?></p>
            </div>
        </div>

        <span class="MainSpan"> İstatistikler</span>
        <div class="chart-container">
            <canvas id="myChart"></canvas>
        </div>
    </div>

    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var quizIsimleri = <?php echo $quiz_isimleri_js; ?>;
        var dogruSayilari = <?php echo $dogru_sayilari_js; ?>;
        var yanlisSayilari = <?php echo $yanlis_sayilari_js; ?>;
        var bosSayilari = <?php echo $bos_sayilari_js; ?>;
        
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: quizIsimleri, 
                datasets: [
                    {
                        label: 'Doğru Sayısı',
                        data: dogruSayilari,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Yanlış Sayısı',
                        data: yanlisSayilari,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Boş Sayısı',
                        data: bosSayilari,
                        backgroundColor: 'rgba(255, 206, 86, 0.2)',
                        borderColor: 'rgba(255, 206, 86, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true 
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: "white", 
                        }
                    }
                }
            }
        });
    </script>
    <script src="../js/index.js"></script>
</body>

</html>
