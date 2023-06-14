<html>
<head>
    <script src="https://code.highcharts.com/highcharts.js"></script>
</head>
<body>
    <?php
    $mysqli = mysqli_connect("localhost", "root", "", "wh_aw");
    $result = mysqli_query($mysqli, "SELECT COUNT(fp.ShippingMethod_ID) as total, sm.ShippingMethod_Name as ShippingMethod FROM fakta_pembelian fp JOIN shipping_method sm ON sm.ShippingMethod_ID = fp.ShippingMethod_ID GROUP BY ShippingMethod");
    $data = array();

    while ($row = mysqli_fetch_array($result)) {
        $data[] = array(
            "ShippingMethod" => $row['ShippingMethod'],
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
                    text: 'Shipping Method Distribution'
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
                            echo "['" . $item['ShippingMethod'] . "', " . $item['Total'] . "],";
                        }
                        ?>
                    ]
                }]
            });
        });
    </script>
</body>
</html>
