<?php
//session_start();
 if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
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
            <h1 class="list-gds wow slideInUp" data-wow-duration=".5s" data-wow-delay="1.1s">
          Laporan Piutang
        </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Laporan</li>
              <li class="breadcrumb-item active">Piutang</li>
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
              <!-- general form elements disabled -->
              <div class="box box-warning">
                
                <div class="box-body">
                  <form role="form" action="route/data_laporan/cetak_piutang.php" method="post">
                    <!-- text input -->
                    <div class="form-group">
                      <label>Tanggal Awal:</label>
                      <div class="input-group date" id="reservationdate" data-target-input="nearest" style="width: 300px;" >
                        <input type="text" name="bulan_awal" class="form-control datetimepicker-input" data-target="#reservationdate" data-inputmask-inputformat="mm/dd/yyyy" data-mask placeholder="Masukan tgl awal..." />
                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Tanggal Akhir:</label>
                      <div class="input-group date" id="reservationdate2" data-target-input="nearest" style="width: 300px;">
                        <input type="text" name="bulan_akhir" class="form-control datetimepicker-input" data-target="#reservationdate2" data-inputmask-inputformat="mm/dd/yyyy" data-mask placeholder="Masukan tgl akhir..." />
                        <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                      </div>
                    </div>



                    <div class="form-group">
                      <hr />
                      
                      <input type="submit" class="btn btn-primary" value="Cari" />
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
}
}
?>