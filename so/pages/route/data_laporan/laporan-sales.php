<?php
//session_start();
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser']))
{
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
  <center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=../../index.php><b>LOGIN</b></a></center>";
  }else
  {
  //$aksi="modul/mod_kategori/aksi_kategori.php";
    switch($_GET['act']){
	//Tampil Data Perwakilan
      default:
      ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Laporan Penjualan Sales Per PO
            <small>Pencarian</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="main.php?route=home"><i class="fa fa-home"></i> Beranda</a></li>
            <li class="active">Laporan</li>
            <li class="active">Laporan Sales per PO</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- right column -->
            <div class="col-md-12">
              <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title">*Laporan Penjualan per PO</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <form role="form" action="main.php?route=laporan-sales&act=view3" method="post">
                    <!-- text input -->
                    <div class="form-group">
                      <label>Periode Bulan</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name="bulan_awal" class="form-control" placeholder="Masukan tgl awal..." data-inputmask="'alias': 'yyyy-mm-dd'" data-mask/>
                      </div><!-- /.input group -->
                    </div><!-- /.form group -->
                    <div class="form-group">
                      <label>Sampai Periode Bulan</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name="bulan_akhir" class="form-control" placeholder="Masukan tgl akhir..." data-inputmask="'alias': 'yyyy-mm-dd'" data-mask/>
                      </div><!-- /.input group -->
                    </div><!-- /.form group -->
                    <div class="form-group">
                      <hr />
                      <input type="submit" class="btn btn-primary" value="Cari Data" />
                    </div>
                  </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              <section class="content-header">
                <h1>
                  Laporan Penjualan Sales Per Produk
                  <small>Pencarian</small>
                </h1>
                <ol class="breadcrumb">
                  <li><a href="main.php?route=home"><i class="fa fa-home"></i> Beranda</a></li>
                  <li class="active">Laporan</li>
                  <li class="active">Laporan Sales per PRODUK</li>
                </ol>
              </section>
              <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title">*Laporan Detail Penjualan per Produk</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <form role="form" action="main.php?route=laporan-sales&act=view2" method="post">
                    <!-- text input -->
                    <div class="form-group">
                      <label>Periode Bulan</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name="bulan_awal" class="form-control" placeholder="Masukan tgl awal..." data-inputmask="'alias': 'yyyy-mm-dd'" data-mask/>
                      </div><!-- /.input group -->
                    </div><!-- /.form group -->
                    <div class="form-group">
                      <label>Sampai Periode Bulan</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name="bulan_akhir" class="form-control" placeholder="Masukan tgl akhir..." data-inputmask="'alias': 'yyyy-mm-dd'" data-mask/>
                      </div><!-- /.input group -->
                    </div><!-- /.form group -->
                    <div class="form-group">
                      <hr />
                      <input type="submit" class="btn btn-primary" value="Cari Data" />
                    </div>
                  </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!--/.col (right) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      
      <!-- Page script -->
      <script type="text/javascript">
        $(function () {
        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        //Money Euro
        $("[data-mask]").inputmask();

        //Date range picker
        $('#reservation').daterangepicker();
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
        //Date range as a button
        $('#daterange-btn').daterangepicker(
        {
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
            'Last 7 Days': [moment().subtract('days', 6), moment()],
            'Last 30 Days': [moment().subtract('days', 29), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
          },
          startDate: moment().subtract('days', 29),
          endDate: moment()
        },
        function (start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        );

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });

        //Colorpicker
        $(".my-colorpicker1").colorpicker();
        //color picker with addon
        $(".my-colorpicker2").colorpicker();

        //Timepicker
        $(".timepicker").timepicker({
          showInputs: false
        });
      });
    </script>
    
    <script>
      $(function() {	
       var dt='';
       $('#d1').datepicker();	


       $('#d2').datepicker({ 
        changeMonth:true,
        dateFormat: 'yy-mm-dd',
        changeYear:true,
      });

       $('#d3').datepicker({ 
        changeMonth:true,
        dateFormat: 'yy-mm-dd',
        changeYear:true,
        onClose: function (date) {
        	dt=date;
        	$( "#d4" ).datepicker("destroy");
        	showdate();

        }
      });

       $('#d5').datepicker({
        changeYear:true,
      });

       $( "#d6" ).datepicker();
       $( "#hFormat" ).change(function() {
        $( "#d6" ).datepicker( "option", "dateFormat", $( this ).val() );
      });



       function showdate()
       {
         $('#d4').datepicker({ 
          changeMonth:true,
          dateFormat: 'yy-mm-dd',
          changeYear:true,
          minDate: new Date(dt),
          hideIfNoPrevNext: true 
        });
       }

     });    
   </script>
   <?php
   break;

//Form Tambah Transaksi Umrah
   case "view":
   ?>
   <!-- DATA TABLES -->
   <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <!--<img src="../images/logo3.jpg" />--> Aplikasi ERP v.1 System CDC
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
             <h3 class="box-title">Laporan Rincian Penjualan Sales Periode : <?php echo $bulan; ?></h3><br />
             <button class="btn btn-primary" onclick="window.location='route/data_laporan/cetak-laporan.php?id=<?php echo $_POST['bulan']; ?>'"><i class="fa fa-print"></i> Export Excel</button> 
              <button class="btn btn-primary" onclick="window.location='route/data_laporan/cetak-laporan-periode-a.php?awal=<?php echo $_POST['bulan_awal']; ?>&akhir=<?php echo $_POST['bulan_akhir']; ?>'"><i class="fa fa-print"></i> Export Excel A</button>  
             <button class="btn btn-danger" onclick="window.location='route/data_laporan/cetak-laporan-print.php?id=<?php echo $_POST['bulan']; ?>'"><i class="fa fa-print"></i> Print</button> 
           </div><!-- /.box-header -->
           <div class="box-body">
            <div class="table table-responsive">
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
          </div>
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
<!-- DATA TABLES -->
<link rel="stylesheet" type="text/css" href="../config./style.css">
<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <!--<img src="../images/logo3.jpg" />--> Aplikasi ERP v.2 Mitra Bersaudara
      <small>View Report</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="main.php?route=home"><i class="fa fa-home"></i> Beranda</a></li>
      <li class="active">Laporan</li>
      <li class="active">Laporan Sales </li>
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

            <h3 class="box-title">Laporan Detail Penjualan Sales Periode : <b><?php echo tgl_indo($_POST['bulan_awal']); ?> - <?php echo tgl_indo($_POST['bulan_akhir']); ?></b></h3><br />
            <button class="btn btn-primary" onclick="window.location='route/data_laporan/cetak-laporan-periode.php?awal=<?php echo $_POST['bulan_awal']; ?>&akhir=<?php echo $_POST['bulan_akhir']; ?>'"><i class="fa fa-print"></i> Export Excel</button> 
            <button class="btn btn-danger" onclick="window.location='route/data_laporan/cetak-laporan-print-periode.php?awal=<?php echo $_POST['bulan_awal']; ?>&akhir=<?php echo $_POST['bulan_akhir']; ?>'"><i class="fa fa-print"></i> Print</button> 
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
                  <!-- <th>Kode Barang</th> -->
                  <th>Kode/Nama Barang</th>
                  <th>Harga Rp.</th>
                  <th>Jumlah</th>
                  <th>Disc 1</th>
                  <th>Disc 2</th>
                  <th>Disc 3</th>
                  <th>Total Rp.</th>
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
                  <!-- <td><?php echo $p['id_produk']; ?></td> -->
                  <td><?php echo '<small>'.$p['id_produk'].'</small> - '.$pro['nama_produk']; ?></td>
                  <td align="right"><?php echo format_rupiah($p['harga']); ?></td>
                  <td align="center"><?php echo $p['jumlah']; ?></td>
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
        <h4>Total Nilai Penjualan : Rp. <b><?php echo format_rupiah($total); ?></b></h4>
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
?>
<!-- DATA TABLES -->
<link rel="stylesheet" type="text/css" href="../config/style.css">
<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
        <h1 class="list-gds wow slideInUp" data-wow-duration=".5s" data-wow-delay="1.1s">
          <b>SO</b><small>- Control Panel</small> | <?php echo $naper1.'<small>'.$naper2.' '.$ver;?></small>   
        </h1>
    <ol class="breadcrumb">
      <li><a href="main.php?route=home"><i class="fa fa-home"></i> Beranda</a></li>
      <li class="active">Laporan</li>
      <li class="active">Laporan Sales </li>
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

            <h3 class="box-title">Laporan Penjualan Sales Per PO Periode : <b><?php echo tgl_indo($_POST['bulan_awal']); ?> - <?php echo tgl_indo($_POST['bulan_akhir']); ?></b></h3><br />
            <button class="btn btn-primary" onclick="window.location='route/data_laporan/cetak-laporan-periode-po.php?awal=<?php echo $_POST['bulan_awal']; ?>&akhir=<?php echo $_POST['bulan_akhir']; ?>'"><i class="fa fa-print"></i> Export Excel</button> 
            <button class="btn btn-danger" onclick="window.location='route/data_laporan/cetak-laporan-print-periode-PO.php?awal=<?php echo $_POST['bulan_awal']; ?>&akhir=<?php echo $_POST['bulan_akhir']; ?>'"><i class="fa fa-print"></i> Print</button> 
          </div><!-- /.box-header -->
          <div class="box-body">
          <div class="table table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead style="background-color: #d2d6de; font-size: 110%">
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
               $orders=mysql_query("SELECT * from orders where tgl_order BETWEEN '$_POST[bulan_awal]' and '$_POST[bulan_akhir]'");
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
						//employee
						//$employee=mysql_query("select * from employee where employee_number='$out[employee_number]'");
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
              <tr>
                <td align="right" colspan="5">Total Penjualan :</td>
                <td align="right"><stong>Rp. <?php echo format_rupiah($total); ?></stong></td>
                </tr>
                <tr>
                <td align="right" colspan="5">Total Ppn :</td>
                <td align="right">Rp. <?php echo format_rupiah($totppn); ?></td>
                </tr>
                <td align="right" colspan="5">Total Pembayaran :</td>
                <td align="right"><strong>Rp. <?php echo format_rupiah($totppn+$total); ?></strong>
                </td>
          </table>
          </div>
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

//Form Tambah Transaksi Umrah
case "view4":
?>
<!-- DATA TABLES -->
<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <!--<img src="../images/logo3.jpg" />--> Aplikasi ERP v.1 System CDC
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
           <h3 class="box-title">Laporan Rincian Penjualan Sales Periode : <?php echo $bulan; ?></h3><br />
           <button class="btn btn-primary" onclick="window.location='route/data_laporan/cetak-laporan.php?id=<?php echo $_POST['bulan']; ?>'"><i class="fa fa-print"></i> Export Excel</button> 
           <button class="btn btn-danger" onclick="window.location='route/data_laporan/cetak-laporan-print.php?id=<?php echo $_POST['bulan']; ?>'"><i class="fa fa-print"></i> Print</button> 
         </div><!-- /.box-header -->
         <div class="box-body">
         <div class="table table-responsive">
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
        </div>
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