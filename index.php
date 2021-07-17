<?php
//error_reporting(0);
$dir="config/";

include $dir."library.php"

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SalesOrder System</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Style tambahan -->
    <link rel="stylesheet" href="dist/style.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="embos"><?php echo $perusahaan;?></h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small Box (Stat card) -->
        <h5 class="mb-2 mt-4"> Menu Pilihan </h5>
        <div class="row">

          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <a href="so/index.php" class="inner" >
            <div class="small-box bg-maroon">
              <div class="inner">
                <h3>SO</h3>

                <p>Sales Order</p>
              </div>
              <div class="icon">
                <i class="fas fa-chart-pie"></i>
              </div>
            </div>
          </a>
          </div>

          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <a href="po/index.php" class="inner" >
            <div class="small-box bg-orange">
              <div class="inner">
                <h3>Admin</h3>
                <p>Admin PO</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-plus"></i>
              </div>
            </div>
          </a>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small card -->
            <a href="gudang/index.php" class="inner" >
            <div class="small-box bg-lightblue">
              <div class="inner">
                <h3>Gudang</h3>
                <p>Gudang/Inventory</p>
              </div>
              <div class="icon">
                <i class="fas fa-shopping-cart"></i>
              </div>
            </div>
          </a>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <a href="akunting/index.php" class="inner" >
            <div class="small-box bg-pink">
              <div class="inner">
                <h3>Akunting</h3>
                <p>Keuangan</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
          </a>
          </div>

          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <a href="manager/index.php" class="inner" >
            <div class="small-box bg-purple">
              <div class="inner">
                <h3>Manager</h3>
                <p>Manager/ Supervisor</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
          </a>
          </div>

          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <a href="purchase/index.php" class="inner" >
            <div class="small-box bg-teal">
              <div class="inner">
                <h3>Purchase</h3>

                <p>Purchasing</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
          </a>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->

        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
   
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.5
    </div>    
    <strong>Copyright &copy; 2020-<?php echo $thn_sekarang." ".$naper1."</strong><small> ".$naper2;?></small>.  by <a href="http://www.wibjazz.com">Wibjazz</a>. All rights
    reserved.
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
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
