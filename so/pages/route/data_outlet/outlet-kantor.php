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
            <li class="active">Data Master</li>
            <li class="active">Outlet Kantor</li>
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
                  <h3 class="box-title">Data Outlet / Toko Kantor</h3><br />
                  <button class="btn btn-primary" onclick="window.location='main.php?route=outlet-kantor&act=tambah'"><i class="fa fa-plus"></i> Tambah Data</button>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Kode Outlet</th>
                        <th>Nama Outlet</th>
                        <th>Alamat</th>
                        <th>Telepon / HP</th>
                        <th>Sales</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
					//jadwal
					$jadwal=mysql_query("select * from outlet where jenis_outlet='kantor' order by id_outlet asc");
					$no=1;
					while($j=mysql_fetch_array($jadwal))
					{
						?>
                      <tr align="left">
                        <td><?php echo $no; ?></td>
                        <td><?php echo $j['id_outlet']; ?></td>
                        <td><?php echo $j['nama_outlet']; ?></td>
                        <td><?php echo $j['alamat_outlet']; ?></td>
						<td><?php echo $j['telp_outlet']; ?> / <?php echo $j['hp_outlet']; ?></td>
                        <?php
                        //sales
					$sales=mysql_query("select * from employee where employee_number='$j[employee_number]'");
					$s=mysql_fetch_array($sales);
                    ?>
                        <td><?php echo $s['name_e']; ?></td>
                        <td><a href="main.php?route=outlet-kantor&act=edit&id=<?php echo $j['id_outlet']; ?>" title="Edit"><button class="btn btn-primary"><i class="fa fa-pencil-square-o"></i></button></a> <a href="route/data_outlet/aksi_outlet.php?route=outlet-kantor&act=hapus&id=<?php echo $j['id_outlet']; ?>" title="Hapus"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a></td>
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

//Form Tambah Outlet
case "tambah":
?>
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Tambah Data Outlet
            <small>Biodata</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="main.php?route=home"><i class="fa fa-home"></i> Beranda</a></li>
            <li class="active">Data Master</li>
            <li class="active">Outlet Kantor</li>
            <li class="active">Tambah Data Outlet</li>
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
                  <form role="form" action="route/data_outlet/aksi_outlet.php?route=outlet-kantor&act=input" method="post">
                    <!-- text input -->
                    <div class="form-group">
                      <label>Kategori Outlet</label>
                      <select name="kategori" class="form-control">
                      	<option value="Agen">Agen / Distributor</option>
                        <option value="Pelanggan">Pelanggan Umum</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Tipe Outlet</label>
                      <select name="tipe" class="form-control">
                      	<option value="Badan Usaha">Badan Usaha</option>
                        <option value="Perorangan">Perorangan</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Nama Outlet</label>
                      <input type="text" name="nama" class="form-control" placeholder="Masukan nama outlet ..." required="required"/>
                    </div>
                    <div class="form-group">
                      <label>NPWP Outlet</label>
                      <input type="text" name="npwp" class="form-control" placeholder="Masukan npwp outlet ..." required="required"/>
                    </div>
                    <div class="form-group">
                      <label>Kontak Person</label>
                      <input type="text" name="kontak" class="form-control" placeholder="Masukan nama kontak outlet ..." required="required"/>
                    </div>
                    <div class="form-group">
                      <label>Alamat HO</label>
                      <input type="text" name="alamat_ho" class="form-control" placeholder="Masukan nama alamat HO ..." required="required"/>
                    </div>
                    <div class="form-group">
                      <label>Alamat Kirim</label>
                      <input type="text" name="alamat_kirim" class="form-control" placeholder="Masukan nama alamat kirim ..." required="required"/> <input type="hidden" name="negara" value="Indonesia" />
                    </div>
                    <div class="form-group">
                      <label>Kota</label>
                      <input type="text" name="kota" class="form-control" placeholder="Masukan nama kota ..." required="required"/>
                    </div>
                    <div class="form-group">
                      <label>Kode POS</label>
                      <input type="text" name="kode_pos" class="form-control" placeholder="Masukan kode pos ..." required="required"/>
                    </div>
                    <div class="form-group">
                      <label>No. Telp</label>
                      <input type="text" name="telpon" class="form-control" placeholder="Masukan nomor telepon ..." required="required"/>
                    </div>
                    <div class="form-group">
                      <label>Fax</label>
                      <input type="text" name="fax" class="form-control" placeholder="Masukan nomor fax ..." required="required"/>
                    </div>
                    <div class="form-group">
                      <label>Handphone / Mobile</label>
                      <input type="text" name="hp" class="form-control" placeholder="Masukan nomor hp ..." required="required"/>
                    </div>
                    <div class="form-group">
                      <label>Email Outlet</label>
                      <input type="text" name="email" class="form-control" placeholder="Masukan nama email outlet ..." required="required"/> <input type="hidden" name="website" value="mitrabersaudara.com" /> 
                      <input type="hidden" name="diskon" value="0" />
                    </div>
                    <div class="form-group">
                      <label>Jenis Outlet</label>
                      <select name="jenis" class="form-control">
                      	<option value="0">++ Pilih Jenis Outlet ++</option>
                        <option value="tradisional">Tradisional</option>
        				<option value="modern">Modern</option>
                        <option value="horeka">Horeka</option>
        				<option value="kantor" selected="selected">Kantor</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Nama Sales</label>
                      <select name="sales">
      <?php
	  $sales=mysql_query("select * from employee order by employee_number asc");
	  while($s=mysql_fetch_array($sales))
	  {
		  echo"<option value='$s[employee_number]'>$s[name_e]</option>";
	  }
	  ?>
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

//Form Edit Outlet
case "edit":
$edit=mysql_query("select * from outlet where id_outlet='$_GET[id]'");
$e=mysql_fetch_array($edit);
?>
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Edit Data Outlet
            <small>Biodata</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="main.php?route=home"><i class="fa fa-home"></i> Beranda</a></li>
            <li class="active">Data Master</li>
            <li class="active">Outlet Kantor</li>
            <li class="active">Edit Data Outlet</li>
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
                  <form role="form" action="route/data_outlet/aksi_outlet.php?route=outlet-kantor&act=update" method="post">
                    <!-- text input -->
                    <div class="form-group">
                      <label>Kode Outlet</label>
                      <input type="text" name="ido" class="form-control" value="<?php echo $e['id_outlet']; ?>" readonly="readonly"/>
                    </div>
                    <div class="form-group">
                      <label>Kategori Outlet</label>
                      <select name="kategori" class="form-control">
                      	<?php
						if($e['category_id']=='Agen')
						{
							echo'
                      	<option value="Agen" selected="selected">Agen / Distributor</option>
                        <option value="Pelanggan">Pelanggan Umum</option>';
						}
						else
						{
							echo'
                      	<option value="Agen">Agen / Distributor</option>
                        <option value="Pelanggan" selected="selected">Pelanggan Umum</option>';
						}
						?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Tipe Outlet</label>
                      <select name="tipe" class="form-control">
                      	<?php
						if($e['outlet_type']=='Badan Usaha')
						{
							echo '
                      	<option value="Badan Usaha" selected="selected">Badan Usaha</option>
                        <option value="Perorangan">Perorangan</option>';
						}
						else
						{
							echo '
                      	<option value="Badan Usaha">Badan Usaha</option>
                        <option value="Perorangan"  selected="selected">Perorangan</option>';
						}
						?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Nama Outlet</label>
                      <input type="text" name="nama" class="form-control" value="<?php echo $e['nama_outlet']; ?>" required="required"/>
                    </div>
                    <div class="form-group">
                      <label>NPWP Outlet</label>
                      <input type="text" name="npwp" class="form-control" value="<?php echo $e['npwp']; ?>" required="required"/>
                    </div>
                    <div class="form-group">
                      <label>Kontak Person</label>
                      <input type="text" name="kontak" class="form-control" value="<?php echo $e['kontak_outlet']; ?>" required="required"/>
                    </div>
                    <div class="form-group">
                      <label>Alamat HO</label>
                      <input type="text" name="alamat_ho" class="form-control" value="<?php echo $e['alamat_outlet']; ?>" required="required"/>
                    </div>
                    <div class="form-group">
                      <label>Alamat Kirim</label>
                      <input type="text" name="alamat_kirim" class="form-control" value="<?php echo $e['alamat2_outlet']; ?>" required="required"/> <input type="hidden" name="negara" value="Indonesia" />
                    </div>
                    <div class="form-group">
                      <label>Kota</label>
                      <input type="text" name="kota" class="form-control" value="<?php echo $e['kota_outlet']; ?>" required="required"/>
                    </div>
                    <div class="form-group">
                      <label>Kode POS</label>
                      <input type="text" name="kode_pos" class="form-control" value="<?php echo $e['kodepos_outlet']; ?>" required="required"/>
                    </div>
                    <div class="form-group">
                      <label>No. Telp</label>
                      <input type="text" name="telpon" class="form-control" value="<?php echo $e['telp_outlet']; ?>" required="required"/>
                    </div>
                    <div class="form-group">
                      <label>Fax</label>
                      <input type="text" name="fax" class="form-control" value="<?php echo $e['fax_outlet']; ?>" required="required"/>
                    </div>
                    <div class="form-group">
                      <label>Handphone / Mobile</label>
                      <input type="text" name="hp" class="form-control" value="<?php echo $e['hp_outlet']; ?>" required="required"/>
                    </div>
                    <div class="form-group">
                      <label>Email Outlet</label>
                      <input type="text" name="email" class="form-control" value="<?php echo $e['email_outlet']; ?>" required="required"/> <input type="hidden" name="website" value="mitrabersaudara.com" /> 
                      <input type="hidden" name="diskon" value="0" />
                    </div>
                    <div class="form-group">
                      <label>Jenis Outlet</label>
                      <select name="jenis" class="form-control">
                      	<option value="0">++ Pilih Jenis Outlet ++</option>
                        <?php
						if($e['jenis_outlet']=='tradisional')
						{
							echo'
                        <option value="tradisional" selected="selected">Tradisional</option>
        				<option value="modern">Modern</option>
						<option value="horeka">Horeka</option>
						<option value="kantor">Kantor</option>';
						}
						elseif($e['jenis_outlet']=='modern')
						{
							echo'
                        <option value="tradisional">Tradisional</option>
        				<option value="modern" selected="selected">Modern</option>
						<option value="horeka">Horeka</option>
						<option value="kantor">Kantor</option>';
						}
						elseif($e['jenis_outlet']=='horeka')
						{
							echo'
                        <option value="tradisional">Tradisional</option>
        				<option value="modern">Modern</option>
						<option value="horeka" selected="selected">Horeka</option>
						<option value="kantor">Kantor</option>';
						}
						else
						{
							echo'
                        <option value="tradisional">Tradisional</option>
        				<option value="modern">Modern</option>
						<option value="horeka">Horeka</option>
						<option value="kantor" selected="selected">Kantor</option>';
						}
						?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Nama Sales</label>
                      <select name="sales">
      <?php
	  $sales=mysql_query("select * from employee order by employee_number asc");
	  while($s=mysql_fetch_array($sales))
	  {
		  if($e['employee_number']==$s['employee_number'])
		  {
		  echo"<option value='$s[employee_number]' selected>$s[name_e]</option>";
		  }
		  else
		  {
		  echo"<option value='$s[employee_number]'>$s[name_e]</option>";
		  }
	  }
	  ?>
      </select>
                    </div>
                    <div class="form-group">
                      <hr />
                      <input type="submit" class="btn btn-primary" value="Update" />
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
}
}
?>