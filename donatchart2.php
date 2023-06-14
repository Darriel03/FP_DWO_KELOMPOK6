<html>
<head>
    <script src="https://code.highcharts.com/highcharts.js"></script>
</head>
<body>
    <?php
    $mysqli = mysqli_connect("localhost", "root", "", "wh_aw");
    $result = mysqli_query($mysqli, "SELECT COUNT(fp.Location_ID) as total, l.Location_Name as locationname FROM fakta_produksi fp JOIN location l ON l.Location_ID = fp.Location_ID GROUP BY locationname");
    $data = array();

    while ($row = mysqli_fetch_array($result)) {
        $data[] = array(
            "locationname" => $row['locationname'],
            "Total" => $row['total']
        );
    }
    ?>
    <div class="collapse show" id="collapseCardExample">
        <div class="card-body">
            <div id="donutChart" style="min-height: 250px; max-width: 100%; display: block;"></div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Highcharts.chart('donutChart', {
                chart: {
                    type: 'pie'
                },
                title: {
                    text: 'Total Produksi setiap Lokasi'
                },
                plotOptions: {
                    pie: {
                        innerSize: '60%',
                        depth: 45
                    }
                },
                series: [{
                    name: 'Total',
                    data: [
                        <?php
                        foreach ($data as $item) {
                            echo "['" . $item['locationname'] . "', " . $item['Total'] . "],";
                        }
                        ?>
                    ]
                }]
            });
        });
    </script>
</body>
</html>
