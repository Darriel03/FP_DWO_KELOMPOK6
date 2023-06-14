<?php
// Membuat koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$database = "wh_aw";

$conn = new mysqli($servername, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengambil data total Tax dari tabel fakta_pembelian tiap tahun
$query = "SELECT t.tahun, SUM(fp.Tax) AS TotalTax
          FROM fakta_pembelian fp
          JOIN time t ON t.time_id = fp.time_id
          GROUP BY t.tahun";
$result = $conn->query($query);

$years = [];
$totalTaxes = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $years[] = $row['tahun'];
        $totalTaxes[] = $row['TotalTax'];
    }
}

// Menutup koneksi database
$conn->close();

// Konversi data menjadi format JSON dengan opsi JSON_NUMERIC_CHECK
$years = json_encode($years);
$totalTaxes = json_encode($totalTaxes, JSON_NUMERIC_CHECK);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Area Chart - Total Tax Tiap Tahun</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        #areaChartContainer {
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div id="areaChartContainer">
        <canvas id="areaChart"></canvas>
    </div>

    <script>
    // Ambil data dari PHP
    var years = <?php echo $years; ?>;
    var totalTaxes = <?php echo $totalTaxes; ?>;

    // Membuat area chart menggunakan Chart.js
    var ctx = document.getElementById('areaChart').getContext('2d');
    var areaChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: years,
            datasets: [
                {
                    label: 'Total Tax',
                    data: totalTaxes,
                    fill: false,
                    borderColor: 'rgba(95, 158, 160, 5)',
                    lineTension: 0.5
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    </script>
</body>
</html>
