<?php
$dir="../../landing/";
include $dir."config/koneksi.php";
include $dir."config/library.php";

?>
<html>
<head>
  <title>Form Input PR</title>
  <link href="<?php echo $dir;?>bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo $dir;?>dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo $dir;?>dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
  <!-- Tambahkan jqueryUI disini -->
  <script type="text/javascript" src="../../landing/jquery-ui/js/jquery-1.10.2.js"></script>
  <script type="text/javascript" src="<?php echo $dir;?>jquery-ui/js/jquery-ui-1.10.4.custom.min.js"></script>
  <link type="text/css" rel="stylesheet" href="<?php echo $dir;?>jquery-ui/css/smoothness/jquery-ui-1.10.4.custom.min.css"/>

  <!--animate-->
  <link href="<?php echo $dir;?>dist/css/animate.css" rel="stylesheet" type="text/css" media="all">
  <script src="<?php echo $dir;?>dist/js/wow.min.js"></script>
  <script>
   new WOW().init();
 </script>
 <!--//end-animate-->
    <style>
    .table, th, td {
      padding: 2px 2px!important;
      /*text-align: center;*/
      font-size: 12px;
    }
  </style>
</head>
<body>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1 class="list-gds wow slideInUp" data-wow-duration=".5s" data-wow-delay="1.1s">
          <b>LAPORAN PENJUALAN - </b><?php echo $naper1.'<small>'.$naper2.' '.$ver;?></small>   
        </h1>
        <ol class="breadcrumb">
          <li><a href="main.php?route=home"><i class="fa fa-home"></i> Beranda</a></li>
          <li class="active">Laporan</li>
          <li class="active">Sales</li>
        </ol>
      </section> 

        <!-- Main content -->
        <section class="content">
          <!-- Main row -->
          <div class="row" >
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">
              <!-- Custom tabs (Charts with tabs)-->
              <div class="box" style="background-color: #eee">
                <div class="box-header" style="margin-top: -20px">
                  <h3 class="box-title"><h3>FORM INPUT PR</h3></h3><br />

                </div><!-- /.box-header -->
                <div class="box-body" style="margin-top: -70px" >
                  <table id="example1" class="table-responsive">

                    <form method="post" action="aksi_pr.php?route=pr&act=input">
                      <table width="50%" border="0" align="center" class="table table-responsive" style="padding: 2px 2px!important;">
                       <tr>
                         <td colspan="3"><h4>A. Data Purchase Request</h4></td>
                       </tr>
                       <tr>
                         <td>Sales/Kasir</td>
                         <td>:</td><td> <input type="hidden" name="en" style="width:200px;" value="<?php echo $e['employee_number']; ?>" required/>
                          <input type="text" name="nama" style="min-width:200px;" value="<?php echo $e['name_e']; ?>" readonly/></td>
                        </tr>
                        <tr>
                         <td>No. E-Mail PO</td>
                         <td>:</td><td> <input type="text" name="nopo" style="width:200px;" placeholder="Masukan no. po yang tertera di surat pesanan / email ..." required/></td>
                       </tr>
                       <tr>
                         <td>Tgl Purchase Request</td>
                         <td>:</td><td> <input type="text" id="d6" name="tgl_po" style="width:200px;" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask required/></td>
                       </tr>
                       <tr>
                         <td>Tgl. Expired PO</td>
                         <td>:</td><td> <input type="text" id="datepicker2" name="tgl_expired" style="width:200px;" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask required/></td>
                       </tr>
                       <tr>
                         <td>Tgl. Jatuh Tempo</td>
                         <td>:</td><td> <input type="text" id="datepicker3" name="tgl_tempo" style="width:200px;" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask required/></td>
                       </tr>
                       <tr>
                         <td>Metode Pembayaran</td>
                         <td>:</td><td> <select name="payment" style="width:200px;">
                           <option value="Credit">Credit</option>
                           <option value="Cash">Cash</option>
                         </select></td>
                       </tr>
                       <tr>
                         <td>Manager Marketing</td>
                         <td>:</td><td> <input type="text" name="manager" style="width:200px;" placeholder="Masukan nama manager marketing terkait ..." required/></td>
                       </tr>
                       
                   </table>
                 </form>
               </table>
             </div>
           </div>
         </section>
       </div>
     </section>

   </div>
 </div>


 <center>copyright &copy; 2020- <?php echo $thn_sekarang;?> , By Wibjazz.</center>

 <script type="text/javascript">
  $(document).ready(function(){
    $("#kode").autocomplete({
      minLength:2,
      source:'get_product.php',
      select:function(event, ui){
        $('#nama-outlet').html(ui.item.nama);
        $('#alamat-outlet').html(ui.item.type);
      }
    });
  });
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