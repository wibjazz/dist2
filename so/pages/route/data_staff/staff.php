<?php
$dir="../../";
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
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="list-gds wow slideInUp" data-wow-duration=".5s" data-wow-delay="1.1s">Staff
        </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Master</a></li>
              <li class="breadcrumb-item active">Stok</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          
          <!-- /.card-header -->
          <div class="card-body">
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">
              <!-- Custom tabs (Charts with tabs)-->
              <div class="box">
                <div class="box-body table-responsive">
                  <button class="btn btn-primary" onclick="window.location='main.php?route=staff&act=tambah'"><i class="fa fa-plus"></i> Tambah Data</button>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>ID Staff</th>
                        <th>Nama Staff</th>
                        <th>Jabatan</th>
                        <th>Telepon</th>
						            <th>Email</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
					//jamaah
					$jamaah=mysql_query("select * from employee order by employee_number asc");
					$no=1;
					while($j=mysql_fetch_array($jamaah))
					{
						//jabatan
						$jabatan=mysql_query("select * from jabatan where id_jabatan='$j[id_jabatan]'");
						$k=mysql_fetch_array($jabatan);
						?>
                      <tr align="left">
                        <td><?php echo $no; ?></td>
                        <td><?php echo $j['employee_number']; ?></td>
                        <td><?php echo $j['name_e']; ?></td>
                        <td><?php echo $k['nama_jabatan']; ?></td>
                        <td><?php echo $j['telpon_e']; ?></td>
						            <td><?php echo $j['email_e']; ?></td>
                        <td><a href="main.php?route=staff&act=edit&ide=<?php echo $j['employee_number']; ?>&asal=<?php echo $_GET['asal'] ?>" title="Edit Data"><button class="btn btn-primary"><i class="fa fa-pencil-square-o"></i></button></a> <a href="route/data_staff/aksi_staff.php?route=staff&act=hapus&ide=<?php echo $j['employee_number']; ?>" title="Hapus Data"><button class="btn btn-danger"><i class="fa fa-trash-o"></i></button></a></td>
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
	  
<?php
break;

//Form Edit employee
case "edit2":
//edit
$ubah = mysql_query("select * from employee where employee_number = '$_GET[ide]'");
$u = mysql_fetch_array($ubah);
?>
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Edit Staff 
            <small>Form Edit</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="main.php?route=home"><i class="fa fa-home"></i> Beranda</a></li>
            <li class="active">Data Master</li>
            <li class="active">Staff</li>
            <li class="active">Edit Staff</li>
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
                  <h3 class="box-title">*Isi data dengan lengkap & jelas <?php echo $_GET['ide']; ?> - <?php echo $u['employee_number']; ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <form role="form" action="route/data_staff/aksi_staff.php?route=staff&act=edit" method="post">
                    <!-- text input -->
                    <div class="form-group">
                      <label>ID Staff</label>
                      <input type="text" name="ids" class="form-control" value="<?php echo $e['employee_number']; ?>"  />
                    </div>
                    <div class="form-group">
                      <label>Nama Staff</label>
                      <input type="text" name="nama" class="form-control" value="<?php echo $r['name_e']; ?>" />
                    </div>
                    
                    <div class="form-group">
                      <label>Tempat Lahir</label>
                      <input type="text" name="tempat" class="form-control" value="<?php echo $r['birth_place']; ?>" />
                    </div>
                    <div class="form-group">
                      <label>Tanggal Lahir</label>
                      <input type="text" name="tgl_lahir" class="form-control" value="<?php echo $r['birth_date']; ?>" />
                    </div>
                    <div class="form-group">
                      <label>Alamat</label>
                      <input type="text" name="alamat" class="form-control" value="<?php echo $r['alamat_e']; ?>" />
                    </div>
                    <div class="form-group">
                      <label>Alamat Lain</label>
                      <input type="text" name="alamat_lain" class="form-control" value="<?php echo $r['alamat2_e']; ?>" />
                    </div>
                    <div class="form-group">
                      <label>Kota</label>
                      <input type="text" name="kota" class="form-control" value="<?php echo $r['city_e']; ?>" />
                    </div>
                    <div class="form-group">
                      <label>Kode Pos</label>
                      <input type="text" name="kode_pos" class="form-control" value="<?php echo $r['zipcode_e']; ?>" />
                    </div>
                    <div class="form-group">
                      <label>Telepon Rumah</label>
                      <input type="text" name="telpon" class="form-control" value="<?php echo $r['telpon_e']; ?>" />
                    </div>
                    <div class="form-group">
                      <label>Mobile</label>
                      <input type="email" name="hp" class="form-control" value="<?php echo $r['hp_e']; ?>" />
                    </div>
                    <div class="form-group">
                      <label>Email</label>
                      <input type="text" name="email" class="form-control" value="<?php echo $r['email_e']; ?>" />
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

      
<?php
break;

//Form Tambah Perwakilan
case "tambah":
?>
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Tambah Staff Alhijaz Indowisata
            <small>Biodata</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="main.php?route=home"><i class="fa fa-home"></i> Beranda</a></li>
            <li class="active">Data Master</li>
            <li class="active">Data Staff</li>
            <li class="active">Tambah Data Staff</li>
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
                  <form role="form" action="route/data_staff/aksi_staff.php?route=staff&act=input" method="post">
                    <!-- text input -->
                    <div class="form-group">
                      <label>Nama Staff</label>
                      <input type="text" name="nama" class="form-control" placeholder="Masukan nama karyawan ..." required="required"/>
                    </div>
                    <div class="form-group">
                      <label>Jabatan</label>
                      <select class="form-control" name="jabatan">
                      <?php
					  //load data
					  $x=mysql_query("select * from jabatan");
					  while($y=mysql_fetch_array($x))
					  {
						  echo"<option value='$y[id_jabatan]'>$y[nama_jabatan]</option>";
					  }
					  ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Tempat Lahir</label>
                      <input type="text" name="tempat" class="form-control" placeholder="Masukan tempat lahir ..." required="required"/>
                    </div>
                    <div class="form-group">
                      <label>Tanggal Lahir</label>
                      <input type="text" name="tgl_lahir" class="form-control" placeholder="Masukan masykan tanggal lahir : yyyy-mm-dd ..." required="required"/>
                    </div>
                    <div class="form-group">
                      <label>Alamat</label>
                      <input type="text" name="alamat" class="form-control" placeholder="Masukan alamat ..." required="required"/>
                    </div>
                    <div class="form-group">
                      <label>Alamat Lain</label>
                      <input type="text" name="alamat_lain" class="form-control" placeholder="Masukan alamat lain ..." required="required"/>
                    </div>
                    <div class="form-group">
                      <label>Kota</label>
                      <input type="text" name="kota" class="form-control" placeholder="Masukan asal kota ..." required="required"/>
                    </div>
                    <div class="form-group">
                      <label>Kode Pos</label>
                      <input type="text" name="kode_pos" class="form-control" placeholder="Masukan kode pos ..." required="required"/>
                    </div>
                    <div class="form-group">
                      <label>Telepon Rumah</label>
                      <input type="text" name="telpon" class="form-control" placeholder="Masukan telepon karyawan ..." required="required"/>
                    </div>
                    <div class="form-group">
                      <label>Mobile</label>
                      <input type="text" name="hp" class="form-control" placeholder="Masukan nomor pribadi karyawan ..." required="required"/>
                    </div>
                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" name="email" class="form-control" placeholder="Masukan email karyawan ..." />
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

//Form Edit 
case "edit":

//edit
$ubah = mysql_query("select * from employee where employee_number = '$_GET[ide]'");
$u = mysql_fetch_array($ubah);
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="list-gds wow slideInUp" data-wow-duration=".5s" data-wow-delay="1.1s">
          User <small>update</small>
                  </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Master</a></li>
              <li class="breadcrumb-item active">Edit User</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          
          <!-- /.card-header -->
          <div class="card-body">
          <div class="row">
            <!-- right column -->
            <div class="col-md-12">
              <!-- general form elements disabled -->
              <div class="box box-warning">
                <div class="box-body">
                  <form role="form" action="<?php echo $dir ; ?>modul/data_staff/aksi_staff.php?route=staff&act=edit&asal=<?php echo $_GET['asal'];?>" method="post"  enctype="multipart/form-data">
                    <!-- text input -->
                    <div class="form-group">
                      <label>ID Staff</label>
                      <input type="text" name="ids" class="form-control" value="<?php echo $u['employee_number']; ?>" readonly="readonly"/>
                    </div>
                    <div class="form-group">
                      <label>Nama Staff</label>
                      <input type="text" name="nama" class="form-control" value="<?php echo $u['name_e']; ?>" required="required"/>
                    </div>
                    
                    <div class="form-group">
                      <label>Tempat Lahir</label>
                      <input type="text" name="tempat" class="form-control" value="<?php echo $u['birth_place']; ?>" />
                    </div>
                    <div class="form-group">
                      <label>Tanggal Lahir</label>
                      <input type="text" name="tgl_lahir" class="form-control" value="<?php echo $u['birth_date']; ?>" />
                    </div>
                    <div class="form-group">
                      <label>Alamat</label>
                      <input type="text" name="alamat" class="form-control" value="<?php echo $u['alamat_e']; ?>" />
                    </div>
                    <div class="form-group">
                      <label>Alamat Lain</label>
                      <input type="text" name="alamat_lain" class="form-control" value="<?php echo $u['alamat2_e']; ?>"  />
                    </div>
                    <div class="form-group">
                      <label>Kota</label>
                      <input type="text" name="kota" class="form-control" value="<?php echo $u['city_e']; ?>" />
                    </div>
                    <div class="form-group">
                      <label>Kode Pos</label>
                      <input type="text" name="kode_pos" class="form-control" value="<?php echo $u['zipcode_e']; ?>" />
                    </div>
                    <div class="form-group">
                      <label>Telepon Rumah</label>
                      <input type="text" name="telpon" class="form-control" value="<?php echo $u['telpon_e']; ?>" />
                    </div>
                    <div class="form-group">
                      <label>Mobile</label>
                      <input type="text" name="hp" class="form-control" value="<?php echo $u['hp_e']; ?>" />
                    </div>
                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" name="email" class="form-control" value="<?php echo $u['email_e']; ?>" />
                    </div>
                    <!-- <div class="form-group"> -->
                      <label>Foto </label> <small>( nama file sesuai nama User )</small>
                      <input type="file" name="file" class="form-control"  />
                    <!-- </div> -->
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