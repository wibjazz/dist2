<?php
//error_reporting(0);
$dir="../../";
session_start();
 
if (empty($_SESSION['namauser']) and empty($_SESSION['passuser'])) {
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
  <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {
  include $dir."config/koneksi.php";
  include $dir."config/fungsi_kode_otomatis.php";
  include $dir."config/fungsi_rupiah.php";
  include $dir."config/fungsi_indotgl.php";
  include $dir."config/library.php";

  $en = $_SESSION['employee_number'];
  $foto = mysql_query("SELECT * from employee where employee_number='$_SESSION[employee_number]' ");
  $f_foto = mysql_fetch_array($foto);
  $filefoto = $f_foto['image'];
  if ($filefoto == 'profil.jpg') {
    $filefoto = 'member.jpg';
  }
  ?>
  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sales - SalesOrder system</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="../../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="../../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- tambahan DatePicker -->
    <link rel="stylesheet" href="../../dist/bootstrap-datepicker-1.9.0-dist/css/bootstrap-datepicker.min.css">
    <!-- Style tambahan -->
    <link rel="stylesheet" href="../../dist/style.css">

      <!-- Tambahkan jqueryUI disini -->
  <script type="text/javascript" src="<?php echo $dir;?>jquery-ui/js/jquery-1.10.2.js"></script>
  <script type="text/javascript" src="<?php echo $dir;?>jquery-ui/js/jquery-ui-1.10.4.custom.min.js"></script>
  <link type="text/css" rel="stylesheet" href="<?php echo $dir;?>jquery-ui/css/smoothness/jquery-ui-1.10.4.custom.min.css"/>

    <!--animate-->
    <link href="<?php echo $dir ;?>dist/css/animate.css" rel="stylesheet" type="text/css" media="all">
    <script src="<?php echo $dir ;?>dist/js/wow.min.js"></script>
    <script>
     new WOW().init();
   </script>
   <!--//end-animate-->
 </head>
 <body class="sidebar-mini text-sm accent-info" style="height: auto;">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark navbar-warning">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-sm-inline-block">
          <a href="#" class="nav-link embos"><?php echo $perusahaan."</b>";?></a>
        </li>
      </ul>

    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="main.php?route=home" class="brand-link navbar-danger">
        <img src="../../dist/img/AdminLTELogo.png"
        alt="sales Logo"
        class="brand-image img-circle elevation-3"
        style="opacity: .8">
        <span class="brand-text font-weight-light">SALES ORDER</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <a href="#" >
              <img src="<?php echo "../../staff/images/" . $filefoto; ?>" class="img-circle elevation-2" alt="User Image">
            </a>
          </div>
          <div class="info">
            <a href="#" class="d-block"><?php echo $_SESSION['namauser']; ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->

        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

           <li class="nav-item has-treeview">
            <a  href="main.php?route=home" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Beranda<i class="text"></i></p>
            </a>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Data Master
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="main.php?route=data-stok&act" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>STOK</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="main.php?route=staff&act=edit&ide=<?php echo $_SESSION['employee_number']; ?>&asal=so" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>USER</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="main.php?route=order-request&act" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Order Request
                <i class="text"></i>
              </p>
            </a>
          </li>          

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Laporan
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">4</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="main.php?route=lap-sales-po&act" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>PO</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="route/cetak/cetak_outlet_sales.php?id=<?php echo $_SESSION['employee_number']; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Outlet By Sales</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="route/cetak/cetak_stok_harga.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stok & Harga</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="main.php?route=laporan-piutang&act" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Piutang</p>
                </a>
              </li>              
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="../logout.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Log Out
                <i class="text"></i>
              </p>
            </a>
          </li>    
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="list-gds wow bounceInDown" data-wow-duration="1.5s" data-wow-delay="0s">
    <?php include "content.php"; ?>
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
<!-- <script src="../../plugins/jquery/jquery.min.js"></script> -->
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="../../plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="../../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="../../plugins/moment/moment.min.js"></script>
<script src="../../plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- date-range-picker -->
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- bootstrap color picker -->
<script src="../../plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="../../plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- ChartJS -->
<script src="../../plugins/chart.js/Chart.min.js"></script>
<!-- tambahan utk datepicer -->
<script src="../../dist/bootstrap-datepicker-1.9.0-dist/js/bootstrap-datepicker.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Page script -->
<script>
  $('#sandbox-container .input-group.date').datepicker({
    format: "dd-mm-yyyy",
    autoclose: true,
    todayHighlight: true
  });
</script>

<script>
  $('.datepicker').datepicker({
    format: "dd-mm-yyyy",
    autoclose: true,
    todayHighlight: true
  });
</script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker 1
    $('#reservationdate').datetimepicker({
      format: 'DD/MM/YYYY'
    });

    //Date range picker 2
    $('#reservationdate2').datetimepicker({
      format: 'DD/MM/YYYY'
    });
    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY'
      }
    })

    
    //Date range as a button
    $('#daterange-btn').daterangepicker(
    {
      ranges   : {
        'Today'       : [moment(), moment()],
        'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month'  : [moment().startOf('month'), moment().endOf('month')],
        'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: moment().subtract(29, 'days'),
      endDate  : moment()
    },
    function (start, end) {
      $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
    }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })
    
    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

  })
</script>

<script>
  $(function() {
   $("#datepicker").datepicker({
    changeMonth:true,
    changeYear:true,
    dateFormat:'yy-mm-dd',
    yearRange:'-45:+10'
  });
 });
</script>

<script>
  $(function() {
   $("#datepicker2").datepicker({
    changeMonth:true,
    changeYear:true,
    dateFormat:'yy-mm-dd',
    yearRange:'-45:+10'
  });
 });
</script>

<script>
  $(function() {
   $("#datepicker3").datepicker({
    changeMonth:true,
    changeYear:true,
    dateFormat:'yy-mm-dd',
    yearRange:'-45:+10'
  });
 });
</script>


</body>
</html>
<?php
}
?>