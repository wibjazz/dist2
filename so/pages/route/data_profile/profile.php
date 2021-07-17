<?php
//session_start();
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser']))
 {
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
    <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../../index.php><b>LOGIN</b></a></center>";
}
else{
	if(!empty($_GET["act"]))$act = $_GET["act"]; else $act="";
	switch($act){

	default:

$r = mysql_fetch_array(mysql_query("SELECT * from user_login where username = '$_SESSION[namauser]'"));
$dt = mysql_fetch_array(mysql_query("SELECT * from employee where employee_number = '$r[employee_number]'"));
// $dt = mysql_fetch_array(mysql_query("SELECT * from staff where id_staff = '$r[id_staff]'"));
?>
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            User Mitra Bersaudara
            <small>Profile</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="main.php?route=home"><i class="fa fa-home"></i> Beranda</a></li>
            <li class="active">Profile</li>
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
                  <form role="form" action="route/data_profile/aksi_profile.php?route=profile&act=edit" method="post">
                    <!-- text input -->
                    <fieldset>
                    <legend><b>Data Profile User</b></legend>
                    <div class="form-group">
                      <label>Username</label>
                      <input type="text" name="username" class="form-control" value="<?php echo $r['username']; ?>" readonly="readonly"/>
                    </div>
                    <div class="form-group">
                      <label>Password *)<i>kosongkan jika tidak ingin mengganti password lama</i></label>
                      <input type="password" name="password" class="form-control" placeholder="Masukan Password Baru ..." />
                    </div>
                    <div class="form-group">
                      <label>Telepon</label>
                      <input type="text" name="telpon" class="form-control" value="<?php echo $dt['telpon_e']; ?>" required="required"/>
                    </div>           
                    <div class="form-group">
                      <hr />
                      <input type="hidden" name="ids" value="<?php echo $dt['employee_number']; ?>" />
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