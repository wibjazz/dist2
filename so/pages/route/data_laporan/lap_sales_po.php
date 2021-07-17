<?php
$dir="../../landing/";
//session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser']))
{
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
  <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}else
{
  switch($_GET['act']){
	//Tampil Data Perwakilan
    default:
    ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="list-gds wow slideInUp" data-wow-duration=".5s" data-wow-delay="1.1s">
                Laporan PO
              </h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Laporan</li>
                <li class="breadcrumb-item active">PO</li>
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
              <div class="row">
                <!-- right column -->
                <div class="col-md-12">
                  <div class="box box-warning">
                    <div class="box-header">
                      <h5 class="box-title">*Isi Periode</h5>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                      <form role="form" action="main.php?route=lap-sales-po&act=view3" method="post">
                        <!-- text input --> 
                        <div class="form-group">
                          <label>Tanggal Awal:</label>
                          <div class="input-group date" id="reservationdate" data-target-input="nearest" style="width: 300px;">
                            <input type="text" name="bulan_awal" class="form-control datetimepicker-input" data-target="#reservationdate" data-inputmask-inputformat="mm/dd/yyyy" data-mask/>
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <label>Tanggal Akhir:</label>
                          <div class="input-group date" id="reservationdate2" data-target-input="nearest" style="width: 300px;">
                            <input type="text" name="bulan_akhir" class="form-control datetimepicker-input" data-target="#reservationdate2" data-inputmask-inputformat="mm/dd/yyyy" data-mask/>
                            <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <hr />
                          <input type="submit" class="btn btn-primary" value="Cari Data" />
                          <br/> <br/>
                          <a href="route/cetak/cetak_lap_sales_hariini.php">
                            <input type="button" class="btn btn-danger" value="Penjualan Hari Ini" />
                          </a>
                          <a href="route/cetak/cetak_lap_sales_bln.php">
                            <input type="button" class="btn btn-danger" value="Penjualan Bulan Ini" />
                          </a>
                        </div>

                      </form>
                    </div><!-- /.box-body -->
                  </div><!-- /.box -->
                </div>
              </div>
            </div>

          </div><!--/.col (right) -->
        </div>   <!-- /.row -->
      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->


    <?php
    break;

//Form Tambah Transaksi Umrah
    case "view":
    ?>

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          <small>View Report</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="main.php?route=home"><i class="fa fa-home"></i> Beranda</a></li>
          <li class="active">Laporan</li>
          <li class="active">Laporan Sales / Produk</li>
          <li class="active">View Detail</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="box">
              <div class="box-header">
                <?php
                if($_POST['bulan']=='01')
                {
                 $bulan='Januari';
               }
               elseif($_POST['bulan']=='02')
               {
                 $bulan='Februari';
               }
               elseif($_POST['bulan']=='03')
               {
                 $bulan='Maret';
               }
               elseif($_POST['bulan']=='04')
               {
                 $bulan='April';
               }
               elseif($_POST['bulan']=='05')
               {
                 $bulan='Mei';
               }
               elseif($_POST['bulan']=='06')
               {
                 $bulan='Juni';
               }
               elseif($_POST['bulan']=='07')
               {
                 $bulan='Juli';
               }
               elseif($_POST['bulan']=='08')
               {
                 $bulan='Agustus';
               }
               elseif($_POST['bulan']=='09')
               {
                 $bulan='September';
               }
               elseif($_POST['bulan']=='10')
               {
                 $bulan='Oktober';
               }
               elseif($_POST['bulan']=='11')
               {
                 $bulan='November';
               }
               else
               {
                 $bulan='Desember';
               }
               ?>
               <h3 class="box-title">Laporan Rincian Penjualan Sales Modern Periode : <?php echo $bulan; ?></h3><br />
               <button class="btn btn-primary" onclick="window.location='route/data_laporan/cetak-laporan.php?id=<?php echo $_POST['bulan']; ?>'"><i class="fa fa-print"></i> Export Excel</button> 
               <button class="btn btn-danger" onclick="window.location='route/data_laporan/cetak-laporan-print.php?id=<?php echo $_POST['bulan']; ?>'"><i class="fa fa-print"></i> Print</button> 
             </div><!-- /.box-header -->
             <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead style="background-color: #d2d6de; font-size: 110%">
                  <tr>
                    <th>No.</th>
                    <th>No. PO</th>
                    <th>Tgl. PO</th>
                    <th>Outlet</th>
                    <th>Sales</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                  </tr>
                </thead>
                <tbody>
                 <?php
					//orders
                 $orders_detail=mysql_query("select * from orders_detail order by id_orders asc");
                 $no=1;
                 while($p=mysql_fetch_array($orders_detail))
                 {
						//orders
                  $orders=mysql_query("select * from orders where id_orders='$p[id_orders]' and month(tgl_order)='$_POST[bulan]' and year(tgl_order)='2015'");
                  $or=mysql_fetch_array($orders);
                  $ketemu=mysql_num_rows($orders);
						//produk
                  $produk=mysql_query("select * from produk where id_produk='$p[id_produk]'");
                  $pro=mysql_fetch_array($produk);
						//outlet
                  $outlet=mysql_query("select * from outlet where id_outlet='$or[id_outlet]'");
                  $out=mysql_fetch_array($outlet);
						//employee
                  $employee=mysql_query("select * from employee where employee_number='$or[employee_number]'");
                  $e=mysql_fetch_array($employee);
						//cek data
                  if($ketemu > 0)
                  {
                    ?>
                    <tr align="left">
                      <td><?php echo $no; ?></td>
                      <td><?php echo $or['id_orders']; ?></td>
                      <td><?php echo tgl_indo($or['tgl_order']); ?></td>
                      <td><?php echo $out['nama_outlet']; ?></td>
                      <td><?php echo $e['name_e']; ?></td>
                      <td><?php echo $p['id_produk']; ?></td>
                      <td><?php echo $pro['nama_produk']; ?></td>
                      <td><?php echo $p['jumlah']; ?></td>                       
                    </tr>
                    <?php
                    $no++;
                  }
                  else
                  {

                  }
                }
                ?>
              </tbody>
            </table>
            <br />
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </section><!-- /.Left col -->
    </div><!-- /.row (main row) -->

  </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<!-- page script -->
<script type="text/javascript">
  $(function () {
    $("#example1").dataTable();
    $('#example2').dataTable({
      "bPaginate": true,
      "bLengthChange": false,
      "bFilter": false,
      "bSort": true,
      "bInfo": true,
      "bAutoWidth": false
    });
  });
</script>
<?php
break;

//Form View Periode
case "view2":
?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1 class="list-gds wow slideInUp" data-wow-duration=".5s" data-wow-delay="1.1s">
      <b>LAPORAN PO - </b><?php echo $naper1.'<small>'.$naper2.' '.$ver;?></small>   
    </h1>
    <ol class="breadcrumb">
      <li><a href="main.php?route=home"><i class="fa fa-home"></i> Beranda</a></li>
      <li class="active">Laporan</li>
      <li class="active">Penjualan</li>
      <li class="active">View Detail</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <section class="col-lg-12 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->
        <div class="box">
          <div class="box-header">

            <h3 class="box-title">Laporan Detail Penjualan Sales Periode : <?php echo tgl_indo($_POST['bulan_awal']); ?> - <?php echo tgl_indo($_POST['bulan_akhir']); ?></h3><br />
            <button class="btn btn-primary" onclick="window.location='<?php echo $dir ;?>modul/cetak/cetak_lap_sales_periode.php?awal=<?php echo $_POST['bulan_awal']; ?>&akhir=<?php echo $_POST['bulan_akhir']; ?>'"><i class="fa fa-print"></i> Export Excel</button> 
            <button class="btn btn-danger" onclick="window.location='<?php echo $dir ;?>modul/cetak/cetak_lap_sales_periode_print.php?awal=<?php echo $_POST['bulan_awal']; ?>&akhir=<?php echo $_POST['bulan_akhir']; ?>'"><i class="fa fa-print"></i> Print</button> 
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="table table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead style="background-color: #d2d6de; font-size: 100%">
                  <tr>
                    <th>No.</th>
                    <th>No. PO</th>
                    <th>Tgl. PO</th>
                    <th>Outlet</th>
                    <th>Sales</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Harga Rp.</th>
                    <th>Jumlah</th>
                    <th>Diskon 1</th>
                    <th>Diskon 2</th>
                    <th>Diskon 3</th>
                    <th>Sub Total Rp.</th>
                  </tr>
                </thead>
                <tbody>
                 <?php
					//orders
                 $orders_detail=mysql_query("select * from orders_detail order by id_orders asc");
                 $no=1;
                 $total=0;
                 $grantotal=0;
                 while($p=mysql_fetch_array($orders_detail))
                 {
						//orders
                  $orders=mysql_query("select * from orders where id_orders='$p[id_orders]' and tgl_order BETWEEN '$_POST[bulan_awal]' and '$_POST[bulan_akhir]'");
                  $or=mysql_fetch_array($orders);
                  $ketemu=mysql_num_rows($orders);
						//produk
                  $produk=mysql_query("select * from produk where id_produk='$p[id_produk]'");
                  $pro=mysql_fetch_array($produk);
						//outlet
                  $outlet=mysql_query("select * from outlet where id_outlet='$or[id_outlet]'");
                  $out=mysql_fetch_array($outlet);
						//employee
                  $employee=mysql_query("select * from employee where employee_number='$or[employee_number]'");
                  $e=mysql_fetch_array($employee);
						//cek data
                  if($ketemu > 0)
                  {
                  //hitung
                   $subtotal = $p['harga'] * $p['jumlah'];
                   $disc1 = $subtotal * $p['diskon1'];
                   $hasil_disc1 = $subtotal - $disc1;

                   $disc2 = $hasil_disc1 * $p['diskon2'];
                   $hasil_disc2 = $hasil_disc1 - $disc2;

                   $disc3 = $hasil_disc2 * $p['diskon3'];
                   $hasil_disc3 = $hasil_disc2 - $disc3;

                   $total=$total+$hasil_disc3;
                 //$grantotal=$grantotal+$hasil_disc3;
                   ?>
                   <tr align="left">
                    <td><?php echo $no; ?></td>
                    <td><?php echo $or['id_orders']; ?></td>
                    <td><?php echo tgl_indo_short($or['tgl_order']); ?></td>
                    <td><?php echo $out['nama_outlet']; ?></td>
                    <td><?php echo $e['name_e']; ?></td>
                    <td><?php echo $p['id_produk']; ?></td>
                    <td><?php echo $pro['nama_produk']; ?></td>
                    <td align="right"><?php echo format_rupiah($p['harga']); ?></td>
                    <td><?php echo $p['jumlah']; ?></td>
                    <td><?php echo $p['diskon1']; ?></td>
                    <td><?php echo $p['diskon2']; ?></td>
                    <td><?php echo $p['diskon3']; ?></td>
                    <td align="right"><?php echo format_rupiah($hasil_disc3); ?></td>                       
                  </tr>
                  <?php
                  $no++;
                }
                else
                {

                }
              }
              ?>
            </tbody>
          </table>
        </div>
        <br />
        <h4>Total Nilai Penjualan : Rp. <?php echo format_rupiah($total); ?></h4>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </section><!-- /.Left col -->
</div><!-- /.row (main row) -->

</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<!-- page script -->
<script type="text/javascript">
  $(function () {
    $("#example1").dataTable();
    $('#example2').dataTable({
      "bPaginate": true,
      "bLengthChange": false,
      "bFilter": false,
      "bSort": true,
      "bInfo": true,
      "bAutoWidth": false
    });
  });
</script>
<?php
break;

//Form View Periode
case "view3":

$awal=$_POST['bulan_awal'];
$akhir=$_POST['bulan_akhir'];

$aw=tgl_mysql($_POST['bulan_awal']);
$ak=tgl_mysql($_POST['bulan_akhir']);
echo $_POST['bulan_awal'];

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="list-gds wow slideInUp" data-wow-duration=".5s" data-wow-delay="1.1s">
            Laporan PO
          </h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Laporan</li>
            <li class="breadcrumb-item active">PO</li>
            <li class="breadcrumb-item active">Per Periode</li>
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
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">
              <!-- Custom tabs (Charts with tabs)-->
              <div class="box">
                <div class="box-header">
                  <h5 class="box-title">Laporan PO Periode : <?php echo $awal; ?> - <?php echo $akhir; ?></h5>
                </div><!-- /.box-header -->
                <div class="box-body">          
                  <button class="btn btn-danger btn-sm" onclick="window.location='route/cetak/cetak_lap_print_periode_PO.php?awal=<?php echo $_POST['bulan_awal']; ?>&akhir=<?php echo $_POST['bulan_akhir']; ?>&en=<?php echo $en;?>'"><i class="fa fa-print"></i> Print</button>

                  <table id="example1" class="table table-bordered table-striped">
                    <thead style="background-color: maroon;color: white; ">
                      <tr>
                        <th>No.</th>
                        <th>No. PO</th>
                        <th>Tgl. PO</th>
                        <th>Outlet</th>
                        <th>Sales</th>
                        <th>Nilai PO Rp.</th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php

                     $orders=mysql_query("SELECT * from orders where tgl_order BETWEEN '$aw' and '$ak' and employee_number='$en' ");
                     $no=1;
                     $total=0;
                     $totppn=0;

                     while($p=mysql_fetch_array($orders))
                     {

                      $orders_detail=mysql_query("SELECT * from orders_detail where id_orders='$p[id_orders]' ");
                      $grantotal=0;
                      $granppn=0;

                      while ($od=mysql_fetch_array($orders_detail)) 
                      {
                  //hitung
                        $subtotal = $od['harga'] * $od['jumlah'];
                        $disc1 = $subtotal * $od['diskon1'];
                        $hasil_disc1 = $subtotal - $disc1;
                        $disc2 = $hasil_disc1 * $od['diskon2'];
                        $hasil_disc2 = $hasil_disc1 - $disc2;
                        $disc3 = $hasil_disc2 * $od['diskon3'];
                        $hasil_disc3 = $hasil_disc2 - $disc3;
                        $grantotal=$grantotal+$hasil_disc3;
                      }
                      $granppn= $grantotal * $p['ppn'];
						//outlet
                      $outlet=mysql_query("SELECT * from outlet where id_outlet='$p[id_outlet]'");
                      $out=mysql_fetch_array($outlet);

                      $employee=mysql_query("SELECT * from employee where employee_number='$p[employee_number]'");
                      $e=mysql_fetch_array($employee);
                      ?>
                      <tr align="left">
                        <td><?php echo $no; ?></td>
                        <td><?php echo $p['id_orders']; ?></td>
                        <td><?php echo tgl_indo($p['tgl_order']); ?></td>
                        <td><?php echo $out['nama_outlet']; ?></td>
                        <td><?php echo $e['name_e']; ?></td>
                        <td align="right">Rp. <?php echo format_rupiah($grantotal); ?></td>                       
                      </tr>
                      <?php
                      $total = $total + $grantotal;
                      $totppn = $totppn + $granppn;
                      $no++;
                    }
                    ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td align="right" colspan="5">Total Penjualan :</td>
                      <td align="right"><stong>Rp. <?php echo format_rupiah($total); ?></stong></td>
                    </tr>
                    <tr>
                      <td align="right" colspan="5">Total Ppn :</td>
                      <td align="right">Rp. <?php echo format_rupiah($totppn); ?></td>
                    </tr>
                    <tr>
                      <td align="right" colspan="5">Total Pembayaran :</td>
                      <td align="right"><strong>Rp. <?php echo format_rupiah($totppn+$total); ?></strong>
                      </td>
                    </tr>
                  </tfoot>
                </table>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </section><!-- /.Left col -->
        </div><!-- /.row (main row) -->
      </div>
    </div>
  </div>

</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<!-- page script -->
<script type="text/javascript">
  $(function () {
    $("#example1").dataTable();
    $('#example2').dataTable({
      "bPaginate": true,
      "bLengthChange": false,
      "bFilter": false,
      "bSort": true,
      "bInfo": true,
      "bAutoWidth": false
    });
  });
</script>
<?php
break;

//Form Tambah Transaksi Umrah
case "view4":
?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1 class="list-gds wow slideInUp" data-wow-duration=".5s" data-wow-delay="1.1s">
      <b><?php echo $perusahaan."</b> - ". $naper1.'<small>'.$naper2.' '.$ver;?></small>   
    </h1>
    <ol class="breadcrumb">
      <li><a href="main.php?route=home"><i class="fa fa-home"></i> Beranda</a></li>
      <li class="active">Laporan</li>
      <li class="active">Laporan Sales / Produk</li>
      <li class="active">View Detail</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <section class="col-lg-12 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->
        <div class="box">
          <div class="box-header">
            <?php
            if($_POST['bulan']=='01')
            {
             $bulan='Januari';
           }
           elseif($_POST['bulan']=='02')
           {
             $bulan='Februari';
           }
           elseif($_POST['bulan']=='03')
           {
             $bulan='Maret';
           }
           elseif($_POST['bulan']=='04')
           {
             $bulan='April';
           }
           elseif($_POST['bulan']=='05')
           {
             $bulan='Mei';
           }
           elseif($_POST['bulan']=='06')
           {
             $bulan='Juni';
           }
           elseif($_POST['bulan']=='07')
           {
             $bulan='Juli';
           }
           elseif($_POST['bulan']=='08')
           {
             $bulan='Agustus';
           }
           elseif($_POST['bulan']=='09')
           {
             $bulan='September';
           }
           elseif($_POST['bulan']=='10')
           {
             $bulan='Oktober';
           }
           elseif($_POST['bulan']=='11')
           {
             $bulan='November';
           }
           else
           {
             $bulan='Desember';
           }
           ?>
           <h3 class="box-title">Laporan Rincian Penjualan Sales Modern Periode : <?php echo $bulan; ?></h3><br />
           <button class="btn btn-primary" onclick="window.location='route/data_laporan/cetak-laporan.php?id=<?php echo $_POST['bulan']; ?>'"><i class="fa fa-print"></i> Export Excel</button> 
           <button class="btn btn-danger" onclick="window.location='route/data_laporan/cetak-laporan-print.php?id=<?php echo $_POST['bulan']; ?>'"><i class="fa fa-print"></i> Print</button> 
         </div><!-- /.box-header -->
         <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No.</th>
                <th>No. PO</th>
                <th>Tgl. PO</th>
                <th>Outlet</th>
                <th>Sales</th>
                <th>Nilai PO Rp.</th>
              </tr>
            </thead>
            <tbody>
             <?php
					//orders
             $orders_detail=mysql_query("select * from orders where month(tgl_order)='$_POST[bulan]' and year(tgl_order)='2015'");
             $no=1;
             while($p=mysql_fetch_array($orders_detail))
             {
						//outlet
              $outlet=mysql_query("select * from outlet where id_outlet='$p[id_outlet]'");
              $out=mysql_fetch_array($outlet);
						//employee
              $employee=mysql_query("select * from employee where employee_number='$out[employee_number]'");
              $e=mysql_fetch_array($employee);
              ?>
              <tr align="left">
                <td><?php echo $no; ?></td>
                <td><?php echo $p['id_orders']; ?></td>
                <td><?php echo tgl_indo($p['tgl_order']); ?></td>
                <td><?php echo $out['nama_outlet']; ?></td>
                <td><?php echo $e['name_e']; ?></td>
                <td>Rp. <?php echo format_rupiah($p['total_bayar']); ?></td>                       
              </tr>
              <?php
              $no++;
            }
            ?>
          </tbody>
        </table>
        <br />
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </section><!-- /.Left col -->
</div><!-- /.row (main row) -->

</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<!-- page script -->
<script type="text/javascript">
  $(function () {
    $("#example1").dataTable();
    $('#example2').dataTable({
      "bPaginate": true,
      "bLengthChange": false,
      "bFilter": false,
      "bSort": true,
      "bInfo": true,
      "bAutoWidth": false
    });
  });
</script>
<?php
break;
}
}
?>