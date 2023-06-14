<?php
    $dbHost = "localhost";
    $dbDatabase = "wh_aw";
    $dbUser = "root";
    $dbPasswrod = "";

    $mysqli = mysqli_connect($dbHost, $dbUser, $dbPasswrod, $dbDatabase);

     
    //PERSIAPAN DASHBOARD ATAS (KOTAK)
    //1. Total item produk yang diproduksi
    $sql2 = "SELECT count(distinct Product_ID) as jml_produk from fakta_produksi";
    $jml_p = mysqli_query($mysqli,$sql2);
    $jml_itm = mysqli_fetch_assoc($jml_p);

    //2. Jumlah lokasi Produksi
    $sql3 = "SELECT count(Location_ID) as lokasi from location";
    $tot2 = mysqli_query($mysqli,$sql3);
    $tot_lok = mysqli_fetch_assoc($tot2);

    //3. Rata-rata berat produk
    $sql4 = "SELECT AVG(weight) as tot_product from fakta_produksi";
    $tot3 = mysqli_query($mysqli,$sql4);
    $avg_brt= mysqli_fetch_assoc($tot3);

    //4. Total item yang diproduksi
    $sql3 = "SELECT SUM(ProductionQty) as totproduksi from fakta_produksi";
    $tot4 = mysqli_query($mysqli,$sql3);
    $tot_prd = mysqli_fetch_assoc($tot4);

     //5. Rata-rata harga produk
     $sql4 = "SELECT AVG(List_Price) as harga from fakta_produksi";
     $tot5 = mysqli_query($mysqli,$sql4);
     $avg_hrg = mysqli_fetch_assoc($tot5);

    //6. Jumlah actual cost yang dikeluarkan 
    $sql5 = "SELECT SUM(Actual_Cost) as cost from fakta_produksi";
    $tot6 = mysqli_query($mysqli,$sql5);
    $tot_cost = mysqli_fetch_assoc($tot6);
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kelompok 6| Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <link rel="stylesheet" href="/drilldown.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js">
        
    </script>
  <style>
    #contentDiv2 {
        height: 300px; /* Ubah nilai 400px sesuai dengan panjang yang diinginkan */
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        
      </li>

      <!-- Messages Dropdown Menu -->
     
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Adventure Works 2023</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Kelompok 6</a>
        </div>
      </div>

      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
              <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Summary Dashboard </p>
                </a>
              <li class="nav-item">
                <a href="./index2.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard Prurcashing </p>
                </a>

                <li class="nav-item">
                <a href="./index3.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard Production </p>
                </a>  
              
            </ul>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard Production</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-gradient-maroon">
                    <div class="inner">
                        <h2><?php echo $jml_itm['jml_produk']; ?></h2>
                        <p><h4>Jenis Product Produksi</h4></p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-gradient-purple">
                    <div class="inner">
                        <h2><?php echo $tot_lok['lokasi']; ?></h2>
                        <p><h4>Lokasi Produksi</h4></p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-gradient-pink">
                    <div class="inner">
                        <h2><?php echo  number_format($avg_brt['tot_product'], 2, ',', '.'); ?></h2>
                        <p><h4>Rata-Rata Barat Produk</h4></p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-gradient-info">
                    <div class="inner">
                        <h2><?php echo $tot_prd['totproduksi']; ?></h2>
                        <p><h4>Total Produksi Item</h4></p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                </div>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-gradient-teal">
                    <div class="inner">
                        <h2><?php echo number_format($avg_hrg['harga'], 2, ',','.'); ?></h2>
                        <p><h4>Rata-rata Harga Produk </h></p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-gradient-lightblue">
                    <div class="inner">
                        <h2><?php echo number_format($tot_cost['cost'],2,',','.'); ?></h2>
                        <p><h4>Total Cost Produksi</h4></p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                </div>
            </div>
        </div>
                    
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                <!-- Custom tabs (Charts with tabs)-->
                    <div class="row justify-content-center">
                        <div id="contentDiv" style="height: 308px;"></div>
                    </div>
                    <script>
                        $(document).ready(function() {
                            $.ajax({
                                url: 'drilldown2.php',
                                dataType: 'html',
                                success: function(response) {
                                    $('#contentDiv').html(response);
                                }
                            });
                        });
                    </script>
                </div>
            </div>

            <div class="col-lg-6">
                <!-- Collapsable Card Example -->
                <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                    <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-primary">Total Produksi di setiap Lokasi</h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse show" id="collapseCardExample">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                    </div>
                    <?php
                    include('donatchart2.php');
                    ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <!-- Dropdown Card Example -->
                <div class="card shadow mb-4" style="width: 470px;">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Biaya Produksi per Tahun</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body" style="height: 288px;">
                        <div class="chart-area" style="height: 250px;">
                            <canvas id="myAreaChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <!-- Default Card Example -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">5 Produk yang paling banyak diproduksi</h6>
                    </div>
                    <div class="card-body" style="height: 292px;">
                        <div class="chart-area" >
                            <div id="contentDiv2"></div>
                        </div>
                    </div>
                </div>
                <script>
                    $(document).ready(function() {
                        $.ajax({
                            url: 'barchart2.php',
                            dataType: 'html',
                            success: function(response) {
                                $('#contentDiv2').html(response);
                            }
                        });
                    });
                </script>
            </div>
        </div>


                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Rata-rata harga Produk pertahun</h6>
                    </div>
                    <div class="card-body" >
                        <div class="chart-area" >
                            <canvas id="myAreaChart2"></canvas>
                        </div>
                    </div>
                </div>

    </div>
</section>
</div>
</div>
</div>
</div>
</div>
<!-- /.container-fluid -->
</div>
</div>
</div>
<!-- End of Main Content -->
 

  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>
  
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>

<!-- script biaya produksi tiap tahun -->

<script type="text/javascript">
                    // Set new default font family and font color to mimic Bootstrap's default styling
                    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                    Chart.defaults.global.defaultFontColor = '#858796';

                    function number_format(number, decimals, dec_point, thousands_sep) {
                    // *     example: number_format(1234.56, 2, ',', ' ');
                    // *     return: '1 234,56'
                    number = (number + '').replace(',', '').replace(' ', '');
                    var n = !isFinite(+number) ? 0 : +number,
                        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                        s = '',
                        toFixedFix = function(n, prec) {
                        var k = Math.pow(10, prec);
                        return '' + Math.round(n * k) / k;
                        };
                    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
                    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
                    if (s[0].length > 3) {
                        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
                    }
                    if ((s[1] || '').length < prec) {
                        s[1] = s[1] || '';
                        s[1] += new Array(prec - s[1].length + 1).join('0');
                    }
                    return s.join(dec);
                    }

                    // Area Chart Example
                    <?php
                    $host= "localhost";
                    $user= "root";
                    $password= "";
                    $database= "wh_aw";
                    $conn= mysqli_connect($host, $user, $password, $database);
                    $year = "SELECT DISTINCT(t.tahun) as year FROM fakta_produksi fp JOIN time t on t.time_id = fp.Time_ID";
                    $biaya = "SELECT SUM(fp.Actual_Cost) as biaya FROM fakta_produksi fp JOIN time t on t.time_id = fp.Time_ID GROUP BY t.tahun";
                    $i=1;
                    $query_year=mysqli_query($conn, $year);
                    $jumlah_year = mysqli_num_rows($query_year);
                    $chart_year="";
                    while($row=mysqli_fetch_array($query_year)){
                    if ($i<$jumlah_year) {
                        $chart_year.='"';
                        $chart_year.=$row['year'];
                        $chart_year.='",';
                        $i++;
                    }else{
                        $chart_year.='"';
                        $chart_year.=$row['year'];
                        $chart_year.='"';
                    }
                    }
                    $a=1;
                    $query_biaya = mysqli_query($conn, $biaya);
                    $jumlah_biaya = mysqli_num_rows($query_biaya);
                    $chart_biaya="";
                    while ($row1=mysqli_fetch_array($query_biaya)) {
                        if ($a<$jumlah_biaya) {
                            $chart_biaya.=$row1['biaya'];
                            $chart_biaya.=',';
                            $a++;
                        }else{
                            $chart_biaya.=$row1['biaya'];
                        }
                    }
                    ?>
                    var ctx = document.getElementById("myAreaChart");
                    var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: [<?php echo $chart_year; ?>],
                        datasets: [{
                        label: "Total cost",
                        lineTension: 0.3,
                        backgroundColor: "rgba(225, 160, 122, 0.7)",
                        borderColor: "rgba(225, 160, 122, 1)",
                        pointRadius: 3,
                        pointBackgroundColor: "rgba(225, 160, 122, 1)",
                        pointBorderColor: "rgba(225, 160, 122, 1)",
                        pointHoverRadius: 3,
                        pointHoverBackgroundColor: "rgba(225, 160, 122, 1)",
                        pointHoverBorderColor: "rgba(225, 160, 122, 1)",
                        pointHitRadius: 10,
                        pointBorderWidth: 2,
                        data: [<?php echo $chart_biaya;?>],
                        }],
                    },
                    options: {
                        maintainAspectRatio: false,
                        layout: {
                        padding: {
                            left: 10,
                            right: 25,
                            top: 25,
                            bottom: 0
                        }
                        },
                        scales: {
                        xAxes: [{
                            time: {
                            unit: 'date'
                            },
                            gridLines: {
                            display: false,
                            drawBorder: false
                            },
                            ticks: {
                            maxTicksLimit: 7
                            }
                        }],
                        yAxes: [{
                            ticks: {
                            maxTicksLimit: 5,
                            padding: 10,
                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                return number_format(value);
                            }
                            },
                            gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                            }
                        }],
                        },
                        legend: {
                        display: false
                        },
                        tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        titleMarginBottom: 10,
                        titleFontColor: '#6e707e',
                        titleFontSize: 14,
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        intersect: false,
                        mode: 'index',
                        caretPadding: 10,
                        callbacks: {
                            label: function(tooltipItem, chart) {
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
                            }
                        }
                        }
                    }
                    });
</script>
<!-- rata-rata list_price produk hasil produksi tiap tahun -->
<script type="text/javascript">
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    function number_format(number, decimals, dec_point, thousands_sep) {
        // *     example: number_format(1234.56, 2, ',', ' ');
        // *     return: '1 234,56'
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }

    // Area Chart Example
    <?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "wh_aw";
    $conn = mysqli_connect($host, $user, $password, $database);
    $tahun = "SELECT DISTINCT(t.tahun) as year FROM  fakta_produksi fp  JOIN time t on t.time_id = fp.time_ID";
    $price = "SELECT AVG(fp.List_Price) as price FROM fakta_produksi fp JOIN time t ON fp.time_ID = t.time_id GROUP BY t.tahun";
    $i = 1;
    $query_tahun = mysqli_query($conn, $tahun);
    $jumlah_tahun = mysqli_num_rows($query_tahun);
    $chart_tahun = "";
    while ($row = mysqli_fetch_array($query_tahun)) {
        if ($i < $jumlah_tahun) {
            $chart_tahun .= '"';
            $chart_tahun .= $row['year'];
            $chart_tahun .= '",';
            $i++;
        } else {
            $chart_tahun .= '"';
            $chart_tahun .= $row['year'];
            $chart_tahun .= '"';
        }
    }
    $a = 1;
    $query_price = mysqli_query($conn, $price);
    $jumlah_price = mysqli_num_rows($query_price);
    $chart_price = "";
    while ($row1 = mysqli_fetch_array($query_price)) {
        if ($a < $jumlah_price) {
            $chart_price .= $row1['price'];
            $chart_price .= ',';
            $a++;
        } else {
            $chart_price .= $row1['price'];
        }
    }
    ?>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById("myAreaChart2");
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [<?php echo $chart_tahun; ?>],
                datasets: [{
                    label: "Average Price Product",
                    lineTension: 0.3,
                    backgroundColor: "rgba(95, 158, 160, 0.5)",
                    borderColor: "rgba(95, 158, 160, 1)",
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(95, 158, 160, 1)",
                    pointBorderColor: "rgba(95, 158, 160, 1)",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(95, 158, 160, 5)",
                    pointHoverBorderColor: "rgba(95, 158, 160, 5)",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    data: [<?php echo $chart_price; ?>],
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 7
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            maxTicksLimit: 5,
                            padding: 10,
                            // Include a dollar sign in the ticks
                            callback: function (value, index, values) {
                                return '$' + number_format(value);
                            }
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    intersect: false,
                    mode: 'index',
                    caretPadding: 10,
                    callbacks: {
                        label: function (tooltipItem, chart) {
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
                        }
                    }
                }
            }
        });
    });
</script>

</body>
</html>
