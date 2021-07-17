<?php
$dir="../../../../";
include $dir."config/koneksi.php";
include $dir."config/library.php";
//employee
$employee=mysql_query("select employee_number,name_e from employee where employee_number = '$_GET[en]'");
$e = mysql_fetch_array($employee);
?>
<html>
<head>
  <title>Form Input OR</title>
  <!-- <link href="<?php echo $dir;?>bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" /> -->
  <link href="<?php echo $dir;?>dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
  
  <!-- <link href="<?php echo $dir;?>dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" /> -->
  <!-- Tambahkan jqueryUI disini -->
  <script type="text/javascript" src="<?php echo $dir;?>jquery-ui/js/jquery-1.10.2.js"></script>
  <script type="text/javascript" src="<?php echo $dir;?>jquery-ui/js/jquery-ui-1.10.4.custom.min.js"></script>
  <link type="text/css" rel="stylesheet" href="<?php echo $dir;?>jquery-ui/css/smoothness/jquery-ui-1.10.4.custom.min.css"/>

  <!-- style -->
  <link href="<?php echo $dir;?>dist/style.css" rel="stylesheet" type="text/css" />

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
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="list-gds wow slideInUp" data-wow-duration=".5s" data-wow-delay="1.1s">
            Order Request</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Beranda</a></li>
              <li class="breadcrumb-item active">Order Request</li>
              <li class="breadcrumb-item active">tambah</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card card-default">            
          <!-- /.card-header -->
          <div class="card-body">
            <!-- Main row -->
            <div class="row" >
              <!-- Left col -->
              <section class="col-lg-12 connectedSortable">
                <!-- Custom tabs (Charts with tabs)--> 
                <div class="box" style="background-color: #eee">

                  <div class="box-body" style="margin-top: -20px" >
                    <table class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">

                      <form method="post" action="aksi_or.php?route=or&act=input">
                        <table width="50%" border="0" align="center" class="table table-responsive" style="padding: 2px 2px!important;">
                         <tr>
                           <td colspan="3"><h6>A. Data Order Request</h6></td>
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
                           <td>:</td><td> <input type="text" id="datepicker" name="tgl_po" style="width:200px;" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask required/></td>
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
                         <tr>
                          <td colspan="3"><h6>B. Data Outlet / Toko</h6></td>
                        </tr>
                        <tr>
                         <td>Outlet</td>
                         <td>:</td><td> <input type="text" id="kode" name="kode" required/></td>
                       </tr>
                       <tr>
                         <td>Nama Outlet</td>
                         <td>:</td><td> <span id="nama-outlet">-</span></td>
                       </tr>        
                       <tr>
                        <td>Alamat Outlet</td>
                        <td>:</td><td> <span id="alamat-outlet">-</span></td>
                      </tr>
                      <tr>
                       <td colspan="3"><h6>C. Data Barang</h6></td>
                     </tr>
                     <tr>
                       <td>Nama Barang</td>
                       <td>:</td><td> <select name="produk" style="width:200px;">
                         <?php

                         $produk=mysql_query("select * from produk order by nama_produk asc");
                         while($pro=mysql_fetch_array($produk))
                         {
                           echo"<option value='$pro[id_produk]'>$pro[id_produk] - $pro[nama_produk] - $pro[stok_gudang] pcs</option>";
                         }
                         ?>
                       </select></td>
                     </tr>
                     <tr>
                       <td>Harga Barang Rp.</td>
                       <td>:</td><td> <input type="text" style="width:200px;" placeholder="Masukan harga produk ..." name="harga" required/></td>
                     </tr>
                     <tr>
                       <td>Jumlah Beli</td>
                       <td>:</td><td> <input type="text" style="width:200px;" placeholder="Masukan jumlah beli ..." name="jumbel" required/></td>
                     </tr>
                     <tr>
                       <td>Diskon 1</td>
                       <td>:</td><td> <input type="text" style="width:200px;" placeholder="Masukan diskon 1 ..." name="diskon1" /></td>
                     </tr>
                     <tr>
                       <td>Diskon 2</td>
                       <td>:</td><td> <input type="text" style="width:200px;" placeholder="Masukan diskon 2 ..." name="diskon2" /></td>
                     </tr>
                     <tr>
                       <td colspan="3"><input type="submit" class="btn btn-primary" value="Simpan" /></td>
                     </tr>
                   </table>
                 </form>
               </table>
             </table>
             </div>
           </div>
         </section>
       </div>
     </div>
   </div>
 </div>
</section>

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