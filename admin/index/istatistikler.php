<?php 
session_start();
include "../../connect/connect.php";

$cq = $conn->query("SELECT * FROM cozulenquiz")->fetchAll(PDO::FETCH_ASSOC);

$quiz_verileri = [];
$quiz_deneme_sayilari = [];
$toplam_dogru_cevap = 0;

foreach ($cq as $val) {
    $quiz_id = $val["quiz_id"];
    
    if (!isset($quiz_verileri[$quiz_id])) {
        $quizler = $conn->query("SELECT * FROM quizler WHERE id = $quiz_id ")->fetch(PDO::FETCH_ASSOC);
        
        $quiz_verileri[$quiz_id] = [
            'quiz_adi' => $quizler['name'],
            'dogru_sayisi' => 0
        ];
        
        $quiz_deneme_sayilari[$quiz_id] = [
            'quiz_adi' => $quizler['name'],
            'deneme_sayisi' => 0
        ];
    }

    $quiz_verileri[$quiz_id]['dogru_sayisi'] += $val["D"]; 
    $toplam_dogru_cevap += $val["D"];
    

    $quiz_deneme_sayilari[$quiz_id]['deneme_sayisi']++;
}

$quiz_verileri = array_filter($quiz_verileri, function($quiz) {
    return $quiz['dogru_sayisi'] > 0;
});

$toplam_quizler = count($quiz_verileri);
$ortalama_dogru_cevap = $toplam_dogru_cevap / ($toplam_quizler > 0 ? $toplam_quizler : 1);
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İstatistikler</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <div class="container">
        <?php include "header.php"; ?>
    </div>
    <br>
    <br>
    <div class="container">
        <span class="adminSpan">İstatistikler</span>
        <br><br>
        <div class="Ist">
            <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
            <canvas id="myChartDoughnut" style="width:100%;max-width:600px"></canvas>
        </div>
        <br>
        <div>
            <span>Toplam Doğru Cevapların Ortalaması: <?php echo round($ortalama_dogru_cevap, 2); ?></span>
        </div>
    </div>

</body>

</html>
<script type="text/javascript" src="../js/admin.js"></script>

<script type="text/javascript">
    const quizAdlari = <?php echo json_encode(array_column($quiz_verileri, 'quiz_adi')); ?>;
    const dogruSayilari = <?php echo json_encode(array_column($quiz_verileri, 'dogru_sayisi')); ?>;
    const barRenkleri = ["red", "green", "blue", "orange", "brown"];

    new Chart("myChart", {
        type: "bar",
        data: {
            labels: quizAdlari,
            datasets: [{
                backgroundColor: barRenkleri,
                data: dogruSayilari
            }]
        },
        options: {
            legend: {
                display: false
            },
            title: {
                display: true,
                text: "En Çok Doğru cevap seçilen quizler"
            }
        }
    });

    const quizAdlariDoughnut = <?php echo json_encode(array_column($quiz_deneme_sayilari, 'quiz_adi')); ?>;
    const denemeSayilari = <?php echo json_encode(array_column($quiz_deneme_sayilari, 'deneme_sayisi')); ?>;
    const barRenkleriDoughnut = ["red", "green", "blue", "orange", "brown"];

    new Chart("myChartDoughnut", {
        type: "doughnut",
        data: {
            labels: quizAdlariDoughnut,
            datasets: [{
                backgroundColor: barRenkleriDoughnut,
                data: denemeSayilari
            }]
        },
        options: {
            legend: {
                display: true
            },
            title: {
                display: true,
                text: "En Çok Çözülen Dersler"
            }
        }
    });
</script>
