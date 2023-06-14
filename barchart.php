<!DOCTYPE html>
<html>
<head>
    <title>Grafik Bar Chart - 2 Data yang Dikelompokkan Berdasarkan Waktu</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        canvas {
            max-width: 500px;
            max-height: 500px;
            margin: 20px auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>

</head>
<body>
    <canvas id="myChart"></canvas>

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

    // Mengambil data dari tabel fakta pembelian yang dikelompokkan berdasarkan waktu
    $query = "SELECT DISTINCT(t.tahun) as year, AVG(fp.OrderQty) AS OrderQty, AVG(fp.ReceivedQty) AS ReceivedQty, AVG(fp.RejectQty) AS RejectQty
              FROM fakta_pembelian fp JOIN time t on t.time_id = fp.time_ID
              GROUP BY tahun";
    $result = $conn->query($query);

    $labels = [];
    $data1 = [];
    $data2 = [];
    $data3 = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $labels[] = $row['year'];
            $data1[] = $row['OrderQty'];
            $data2[] = $row['ReceivedQty'];
            $data3[] = $row['RejectQty'];
        }
    }

    // Menutup koneksi database
    $conn->close();

    // Konversi data menjadi format JSON dengan opsi JSON_NUMERIC_CHECK
    $labels = json_encode($labels);
    $data1 = json_encode($data1, JSON_NUMERIC_CHECK);
    $data2 = json_encode($data2, JSON_NUMERIC_CHECK);
    $data3 = json_encode($data3, JSON_NUMERIC_CHECK);
    ?>

    <script>
    // Ambil data dari PHP
    var labels = <?php echo $labels; ?>;
    var data1 = <?php echo $data1; ?>;
    var data2 = <?php echo $data2; ?>;
    var data3 = <?php echo $data3; ?>;

    // Membuat grafik menggunakan Chart.js
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'OrderQty',
                    data: data1,
                    backgroundColor: 'rgba(30, 124, 255, 0.8)', // Warna latar belakang
                    borderColor: 'rgba(30, 124, 255, 1)', // Warna batas
                    borderWidth: 1 // Ketebalan batas
                },
                {
                    label: 'ReceivedQty',
                    data: data2,
                    backgroundColor: 'rgba(65, 105, 225, 0.8)', // Warna latar belakang
                    borderColor: 'rgba(65, 105, 225, 1)', // Warna batas
                    borderWidth: 1 // Ketebalan batas
                },
                {
                    label: 'RejectQty',
                    data: data3,
                    backgroundColor: 'rgba(100, 149, 237, 0.6)', // Warna latar belakang
                    borderColor: 'rgba(100, 149, 237, 1)', // Warna batas
                    borderWidth: 1 // Ketebalan batas
                }
            ]
        },
        options: {
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
