<?php
$dbHost = "localhost";
$dbDatabase = "wh_aw";
$dbUser = "root";
$dbPassword = "";

$mysqli = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbDatabase);

// Query untuk menampilkan nama produk yang paling banyak diproduksi
$sql = "SELECT p.Product_Name, COUNT(*) AS jumlah_muncul
        FROM fakta_produksi fp
        JOIN product p ON fp.Product_ID = p.Product_ID
        GROUP BY p.Product_Name
        ORDER BY jumlah_muncul DESC
        LIMIT 5";

$result = mysqli_query($mysqli, $sql);

// Menginisialisasi array untuk menyimpan data product_name dan jumlah_muncul
$categories = array();
$data = array();

while ($row = mysqli_fetch_assoc($result)) {
    $categories[] = $row['Product_Name'];
    $data[] = intval($row['jumlah_muncul']);
}

// Konversi array ke format JSON
$categories = json_encode($categories);
$data = json_encode($data);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Bar Chart</title>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <style>
    #container {
        width: 450px; /* Atur lebar konten sesuai kebutuhan Anda */
        height: 280px; /* Atur tinggi konten sesuai kebutuhan Anda */
    }
    </style>
</head>
<body>
        <figure class="highcharts-figure">
            <div id="container"></div>
            <p class="highcharts-description">
            
            </p>
        </figure>

    <script type="text/javascript">
        // Menggunakan data dari PHP untuk membuat chart
        var categories = <?php echo $categories; ?>;
        var data = <?php echo $data; ?>;

        Highcharts.chart('container', {
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Top 5 Product '
            },
            xAxis: {
                categories: categories,
                title: {
                    text: 'Product Name'
                }
            },
            yAxis: {
                title: {
                    text: 'Jumlah diProduksi'
                }
            },
            series: [{
                name: 'Jumlah Produksi',
                data: data
            }]
        });
    </script>
</body>
</html>
