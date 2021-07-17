<?php
//session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
//$aksi="modul/mod_kategori/aksi_kategori.php";
switch($_GET['act']){
	//Tampil Data Perwakilan
default:
?>
<!-- DATA TABLES -->
    <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            ERP Online System - Mitra Bersaudara
            <small>v.3 - Control Panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="main.php?route=home"><i class="fa fa-home"></i> Beranda</a></li>
            <li class="active">Penjualan</li>
            <li class="active">Retur</li>
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
                  <h3 class="box-title">Data Retur Penjualan Modern & Tradisional</h3><br />
                  <button class="btn btn-primary" onclick="window.location='main.php?route=retur&act=tambah'"><i class="fa fa-plus"></i> Tambah Data</button>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>ID Retur</th>
                        <th>No. PO</th>
                        <th>Outlet</th>
                        <th>Tgl Retur</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
					//jadwal
					$jadwal=mysql_query("select * from retur order by tgl_retur desc");
					$no=1;
					while($j=mysql_fetch_array($jadwal))
					{
						//outlet
						$outlet=mysql_query("select * from outlet where id_outlet='$j[id_outlet]'");
						$o=mysql_fetch_array($outlet);
						?>
                      <tr align="left">
                        <td><?php echo $no; ?></td>
                        <td><?php echo $j['id_retur']; ?></td>
                        <td><?php echo $j['id_orders']; ?></td>
                        <td><?php echo $o['nama_outlet']; ?></td>
						<td><?php echo tgl_indo($j['tgl_retur']); ?></td>
                        <td><a href="main.php?route=retur&act=add&id=<?php echo $j['id_retur']; ?>" title="Tambah Data Barang Retur"><button class="btn btn-primary"><i class="fa fa-plus"></i></button></a> <a href="main.php?route=retur&act=detail&id=<?php echo $j['id_retur']; ?>" title="Detail Retur"><button class="btn btn-danger"><i class="fa fa-search"></i></button></a></td>
                      </tr>
					 <?php
					 $no++;
					 }
					 ?>
                    </tbody>
                  </table>
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

//Form Tambah Retur
case "tambah":
?>
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Tambah Data Retur
            <small>Form Input</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="main.php?route=home"><i class="fa fa-home"></i> Beranda</a></li>
            <li class="active">Penjualan</li>
            <li class="active">Retur</li>
            <li class="active">Tambah Data Retur</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- right column -->
            <div class="col-md-12">
              <!-- general form elements disabled -->
              <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title">*Isi data dengan lengkap & jelas</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <form role="form" action="route/data_retur/aksi_retur.php?route=retur&act=input" method="post">
                    <!-- text input -->
                    <div class="form-group">
                      <label>No. PO <i>*gunakan huruf CAPITAL agar no. po dapat tersimpan</i></label>
                      <input type="text" name="no_po" class="form-control" placeholder="Masukan nama outlet ..." required="required"/>
                    </div>
                    <div class="form-group">
                      <label>Tipe PO</label>
                      <select name="tipe" class="form-control">
                      	<option value="Modern">Outlet Modern</option>
        				<option value="Tradisional">Outlet Tradisional</option>
                      </select>
                    </div>
                    <div class="form-group">
                    <label>Tgl Retur</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" name="tgl_retur" class="form-control" placeholder="Format tanggal : 2016-01-31" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask/>
                    </div><!-- /.input group -->
                    </div><!-- /.form group -->
                    <div class="form-group">
                      <label>Produk Retur</label>
                      <select name="produk" class="form-control">
                      <?php
					  //load data produk
					  $produk=mysql_query("select * from produk where jenis='Produk'");
					  while($p=mysql_fetch_array($produk))
					  {
					  ?>
                      	<option value="<?php echo $p['id_produk']; ?>"><?php echo $p['id_produk']; ?> - <?php echo $p['nama_produk']; ?></option>
                        <?php
					  }
					  ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Jumlah Retur (pcs)</label>
                      <input type="text" name="jumlah" class="form-control" placeholder="Masukan jumlah retur dalam pieces ..." required="required"/>
                    </div>
                    <div class="form-group">
                      <label>Alasan Retur</label>
                      <input type="text" name="alasan" class="form-control" placeholder="Masukan alasan retur ..." required="required"/>
                    </div>
                    <div class="form-group">
                      <label>Re-Stock</label>
                      <select name="restock" class="form-control">
                      	<option value="0">++ Restock ??? ++</option>
                        <option value="Ya">Ya, Jika kondisi barang masih bagus dan layak konsumsi</option>
        				<option value="Tidak">Tidak, Jika kondisi barang sudah rusak isi atau kemasan</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <hr />
                      <input type="submit" class="btn btn-primary" value="Simpan" />
                    </div>
                  </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!--/.col (right) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      
      <!-- Page script -->
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
<?php
break;

//Form Tambah Retur
case "add":
$edit=mysql_query("select * from retur where id_retur='$_GET[id]'");
$e=mysql_fetch_array($edit);
?>
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Tambah Data Retur
            <small>Form Input</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="main.php?route=home"><i class="fa fa-home"></i> Beranda</a></li>
            <li class="active">Penjualan</li>
            <li class="active">Retur</li>
            <li class="active">Tambah Data Retur</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- right column -->
            <div class="col-md-12">
              <!-- general form elements disabled -->
              <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title">*Isi data dengan lengkap & jelas</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <form role="form" action="route/data_retur/aksi_retur.php?route=retur&act=input-lagi" method="post">
                    <!-- text input -->
                    <div class="form-group">
                      <label>ID Retur</label>
                      <input type="text" name="id_retur" class="form-control" value="<?php echo $e['id_retur']; ?>" readonly="readonly"/>
                    </div>
                    <div class="form-group">
                      <label>No. PO <i>*gunakan huruf CAPITAL agar no. po dapat tersimpan</i></label>
                      <input type="text" name="no_po" class="form-control" value="<?php echo $e['id_orders']; ?>" readonly="readonly"/>
                    </div>
                    <div class="form-group">
                      <label>Tipe PO</label>
                      <select name="tipe" class="form-control">
                      	<?php 
						if($e['tipe']=='Modern')
						{
							echo"
                      	<option value='Modern' selected='selected'>Outlet Modern</option>
        				<option value='Tradisional'>Outlet Tradisional</option>";
						}
						else
						{
							echo"
                      	<option value='Modern'>Outlet Modern</option>
        				<option value='Tradisional' selected='selected'>Outlet Tradisional</option>";
						}
						?>
                      </select>
                    </div>
                    <div class="form-group">
                    <label>Tgl Retur</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" name="tgl_retur" class="form-control" value="<?php echo $e['tgl_retur']; ?>" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask/ readonly="readonly">
                    </div><!-- /.input group -->
                    </div><!-- /.form group -->
                    <div class="form-group">
                      <label>Produk Retur</label>
                      <select name="produk" class="form-control">
                      <?php
					  //load data produk
					  $produk=mysql_query("select * from produk where jenis='Produk'");
					  while($p=mysql_fetch_array($produk))
					  {
					  ?>
                      	<option value="<?php echo $p['id_produk']; ?>"><?php echo $p['id_produk']; ?> - <?php echo $p['nama_produk']; ?></option>
                        <?php
					  }
					  ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Jumlah Retur (pcs)</label>
                      <input type="text" name="jumlah" class="form-control" placeholder="Masukan jumlah retur dalam pieces ..." required="required"/>
                    </div>
                    <div class="form-group">
                      <label>Alasan Retur</label>
                      <input type="text" name="alasan" class="form-control" placeholder="Masukan alasan retur ..." required="required"/>
                    </div>
                    <div class="form-group">
                      <label>Re-Stock</label>
                      <select name="restock" class="form-control">
                      	<option value="0">++ Restock ??? ++</option>
                        <option value="Ya">Ya, Jika kondisi barang masih bagus dan layak konsumsi</option>
        				<option value="Tidak">Tidak, Jika kondisi barang sudah rusak isi atau kemasan</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <hr />
                      <input type="submit" class="btn btn-primary" value="Simpan" />
                    </div>
                  </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!--/.col (right) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      
      <!-- Page script -->
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
<?php
break;

case "detail":
?>
<!-- DATA TABLES -->
    <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            ERP Online System - Mitra Bersaudara
            <small>v.3 - Control Panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="main.php?route=home"><i class="fa fa-home"></i> Beranda</a></li>
            <li class="active">Penjualan</li>
            <li class="active">Retur</li>
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
                  <h3 class="box-title">Data Detail Retur Penjualan Modern & Tradisional</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>ID Retur</th>
                        <th>Kode Produk</th>
                        <th>Jumlah</th>
                        <th>Alasan</th>
                        <th>Re-stok</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
					//jadwal
					$jadwal=mysql_query("select * from retur_detail where id_retur = '$_GET[id]'");
					$no=1;
					while($j=mysql_fetch_array($jadwal))
					{
						?>
                      <tr align="left">
                        <td><?php echo $no; ?></td>
                        <td><?php echo $j['id_retur']; ?></td>
                        <td><?php echo $j['id_produk']; ?></td>
                        <td><?php echo $j['jumlah']; ?></td>
						<td><?php echo $j['alasan']; ?></td>
                        <td><?php echo $j['restock']; ?></td>
                        <td><a href="route/data_retur/aksi_retur.php?route=retur&act=hapus&id=<?php echo $j['id_retur']; ?>&idp=<?php echo $j['id_produk']; ?>" title="Hapus Detail"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a></td>
                      </tr>
					 <?php
					 $no++;
					 }
					 ?>
                    </tbody>
                  </table>
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