<?php
// session_start();
$dir="../../";
include $dir."config/koneksi.php";
include $dir."config/library.php";
include $dir."config/fungsi_combobox.php";
include $dir."config/class_paging.php";
include $dir."config/library.php";

$en = $_SESSION['employee_number'];

if ($_GET['route'] == 'home') {
	?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="list-gds wow slideInUp" data-wow-duration=".5s" data-wow-delay="1.1s">
							Beranda</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Beranda</a></li>
								<li class="breadcrumb-item active">Grafik-Summary</li>
							</ol>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">

					<div class="card card-default">
						<div class="card-header"  style="background-color: maroon;color: white;">
							<h3 class="card-title">Grafik PO</h3>

							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
								<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
							</div>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<!-- Main row -->
							<div class="row">
								<div class="col-md-12">
									<!-- Bar chart -->
									<div class="box box-primary">

										<div class="box-body">
											<div class="chart">
												<canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
											</div>
											<!-- <div id="bar-chart" style="height: 300px;"></div> -->
											<!-- <br /> -->
											<p><i>Keterangan Jumlah PO Tahun <?php echo $thn_sekarang; ?> :</i></p>
											<?php
              //Januari 
											$bar = mysql_query("SELECT * from orders where month(tgl_order)='01' and year(tgl_order)='$thn_sekarang' and employee_number='$en' ");
											$bulan01 = mysql_num_rows($bar);

              //Februari 
											$bar02 = mysql_query("SELECT * from orders where month(tgl_order)='02' and year(tgl_order)='$thn_sekarang' and employee_number='$en' ");
											$bulan02 = mysql_num_rows($bar02);

              //Maret 
											$bar03 = mysql_query("SELECT * from orders where month(tgl_order)='03' and year(tgl_order)='$thn_sekarang' and employee_number='$en'");
											$bulan03 = mysql_num_rows($bar03);

              //April 
											$bar04 = mysql_query("SELECT * from orders where month(tgl_order)='04' and year(tgl_order)='$thn_sekarang' and employee_number='$en'");
											$bulan04 = mysql_num_rows($bar04);

              //Mei 
											$bar05 = mysql_query("SELECT * from orders where month(tgl_order)='05' and year(tgl_order)='$thn_sekarang' and employee_number='$en'");
											$bulan05 = mysql_num_rows($bar05);

              //Juni
											$bar06 = mysql_query("SELECT * from orders where month(tgl_order)='06' and year(tgl_order)='$thn_sekarang' and employee_number='$en'");
											$bulan06 = mysql_num_rows($bar06);

              //Juli
											$bar07 = mysql_query("SELECT * from orders where month(tgl_order)='07' and year(tgl_order)='$thn_sekarang'");
											$bulan07 = mysql_num_rows($bar07);

              //Agustus
											$bar08 = mysql_query("SELECT * from orders where month(tgl_order)='08' and year(tgl_order)='$thn_sekarang' and employee_number='$en'");
											$bulan08 = mysql_num_rows($bar08);

              //September
											$bar09 = mysql_query("SELECT * from orders where month(tgl_order)='09' and year(tgl_order)='$thn_sekarang' and employee_number='$en'");
											$bulan09 = mysql_num_rows($bar09);

              //Oktober
											$bar10 = mysql_query("SELECT * from orders where month(tgl_order)='10' and year(tgl_order)='$thn_sekarang' and employee_number='$en'");
											$bulan10 = mysql_num_rows($bar10);

              //November
											$bar11 = mysql_query("SELECT * from orders where month(tgl_order)='11' and year(tgl_order)='$thn_sekarang' and employee_number='$en'");
											$bulan11 = mysql_num_rows($bar11);

              //Desember
											$bar12 = mysql_query("SELECT * from orders where month(tgl_order)='12' and year(tgl_order)='$thn_sekarang' and employee_number='$en'");
											$bulan12 = mysql_num_rows($bar12);

              //total po per sales
											$totum = mysql_query("SELECT * from orders where status_orders='Pending' and employee_number='$en'");
											$pending = mysql_num_rows($totum);

											$totum = mysql_query("SELECT * from orders where status_orders='Setuju' and employee_number='$en'");
											$setuju = mysql_num_rows($totum);

											$totum = mysql_query("SELECT * from orders where status_orders='Proses' and employee_number='$en'");
											$proses = mysql_num_rows($totum);

											$totum = mysql_query("SELECT * from orders where status_orders='Kirim' and employee_number='$en'");
											$kirim = mysql_num_rows($totum);

											$totum = mysql_query("SELECT * from orders where status_orders='diTerima' and employee_number='$en'");
											$diterima = mysql_num_rows($totum);

              //total outlet modern
											$totper = mysql_query("SELECT * from outlet where employee_number='$en'");
											$jumlah3 = mysql_num_rows($totper);

											?>
											<div class="table-responsive">
												<table class="table table-bordered table-striped">
													<thead>
														<tr>
															<th>Jan</th>
															<th>Feb</th>
															<th>Mar</th>
															<th>Apr</th>
															<th>Mei</th>
															<th>Jun</th>
															<th>Jul</th>
															<th>Agust</th>
															<th>Sept</th>
															<th>Okt</th>
															<th>Nov</th>
															<th>Des</th>
														</tr>
													</thead>
													<tbody>
														<tr align="center">
															<td><?php echo $bulan01; ?> PO</td>
															<td><?php echo $bulan02; ?> PO</td>
															<td><?php echo $bulan03; ?> PO</td>
															<td><?php echo $bulan04; ?> PO</td>
															<td><?php echo $bulan05; ?> PO</td>
															<td><?php echo $bulan06; ?> PO</td>
															<td><?php echo $bulan07; ?> PO</td>
															<td><?php echo $bulan08; ?> PO</td>
															<td><?php echo $bulan09; ?> PO</td>
															<td><?php echo $bulan10; ?> PO</td>
															<td><?php echo $bulan11; ?> PO</td>
															<td><?php echo $bulan12; ?> PO</td>
														</tr>
													</tbody>
												</table>
											</div>
										</div><!-- /.box-body-->
									</div><!-- /.box -->
								</div><!-- /.col -->
							</div>
						</div>
						<!-- div footer -->
						<div class="card-footer">
							Ask Admin for detail Grafik
						</div>

					</div> <!-- card-defaut) -->

					<div class="card card-default">
						<div class="card-header" style="background-color: maroon;color: white;">
							<h3 class="card-title">SO Summary</h3>

							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
								<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
							</div>
						</div><!-- /.row -->

					<!-- /.card-header -->
					<div class="card-body">
						<!-- Main row -->
						<div class="row">

							<div class="col-12 col-sm-6 col-md-3">
								<div class="info-box">
									<span class="info-box-icon bg-red elevation-1"><i class="fas fa-user-plus"></i></span>
									<div class="info-box-content">
										<span class="info-box-text">Pending</span>
										<span class="info-box-number">
											<h3><?php echo $pending; ?> PO</h3>
										</span>
									</div>
									<!-- /.info-box-content -->
								</div>
								<!-- /.info-box -->
							</div>
							<!-- /.col -->

							<div class="col-12 col-sm-6 col-md-3">
								<div class="info-box">
									<span class="info-box-icon bg-green elevation-1"><i class="fas fa-cog"></i></span>
									<div class="info-box-content">
										<span class="info-box-text">Setuju</span>
										<span class="info-box-number">
											<h3><?php echo $setuju; ?> PO</h3>
										</span>
									</div>
									<!-- /.info-box-content -->
								</div>
								<!-- /.info-box -->
							</div>
							<!-- /.col -->

							<div class="col-12 col-sm-6 col-md-3">
								<div class="info-box">
									<span class="info-box-icon bg-orange elevation-1"><i class="fas fa-star"></i></span>
									<div class="info-box-content">
										<span class="info-box-text">Proses</span>
										<span class="info-box-number">
											<h3><?php echo $proses; ?> PO</h3>
										</span>
									</div>
									<!-- /.info-box-content -->
								</div>
								<!-- /.info-box -->
							</div>
							<!-- /.col -->

							<div class="col-12 col-sm-6 col-md-3">
								<div class="info-box">
									<span class="info-box-icon bg-yellow elevation-1"><i class="fas fa-shopping-cart"></i></span>
									<div class="info-box-content">
										<span class="info-box-text">Kirim</span>
										<span class="info-box-number">
											<h3><?php echo $kirim; ?> PO</h3>
										</span>
									</div>
									<!-- /.info-box-content -->
								</div>
								<!-- /.info-box -->
							</div>
							<!-- /.col -->

							<div class="col-12 col-sm-6 col-md-3">
								<div class="info-box">
									<span class="info-box-icon bg-cyan elevation-1"><i class="fas fa-thumbs-up"></i></span>
									<div class="info-box-content">
										<span class="info-box-text">di Terima</span>
										<span class="info-box-number">
											<h3><?php echo $diterima; ?> PO</h3>
										</span>
									</div>
									<!-- /.info-box-content -->
								</div>
								<!-- /.info-box -->
							</div>
							<!-- /.col -->

							<div class="col-12 col-sm-6 col-md-3">
								<div class="info-box">
									<span class="info-box-icon bg-navy elevation-1"><i class="fas fa-users"></i></span>
									<div class="info-box-content">
										<span class="info-box-text">Outlet</span>
										<span class="info-box-number">
											<h3><?php echo $jumlah3; ?></h3>
										</span>
									</div>
									<!-- /.info-box-content -->
								</div>
								<!-- /.info-box -->
							</div>
							<!-- /.col -->					

						</div><!-- /.row -->
					</div>
						<!-- div footer -->
						<div class="card-footer">
							Detail PO and Table Inside system.
						</div>
					</div> <!-- card-defaut) -->

				</div>  <!-- Contaner -fluid -->
			</section><!-- /.content -->
		</div> <!--content-wrapper"> -->


		<?php
	}

// modul ganti password
	elseif ($_GET['route'] == 'profile') {
		include "route/data_profile/profile.php";
	}
// modul produk

	elseif ($_GET['route'] == 'data-stok') {
		include "route/data_produk/data_stok.php";
	}
 
// modul staff
	elseif ($_GET['route'] == 'staff') {
		include "route/data_staff/staff.php";
	}

//modul order request
	elseif ($_GET['route'] == 'order-request') {
		include "route/data_order/or.php";
	}
//modul autocomplete
	elseif ($_GET['route'] == 'autocomplete') {
		include "route/data_order/autocomplete.php";
	}

// modul laporan sales 
	elseif ($_GET['route'] == 'lap-sales-po') {
		include "route/data_laporan/lap_sales_po.php";
	}

// modul tanda piutang modern
	elseif ($_GET['route'] == 'laporan-piutang') {
		include "route/data_laporan/lap_piutang.php";
	}

// modul kunjungan
	elseif ($_GET['route'] == 'kunjungan') {
		include "route/data_kunjungan/ku-mod.php";
	}

	//------------------ SO View
// modul so 
	elseif ($_GET['route'] == 'or-sales-view') {
		include "route/data_order/or_sales_view.php";
	}
// modul so 
	elseif ($_GET['route'] == 'outlet-sales-view') {
		include "route/data_outlet/outlet_sales_view.php";
	}

	else {
		echo "<script>alert('Modul Tidak Ditemukann !');</script>";
		echo "<script>window.location='main.php?route=home'</script>";
	}
	?>


	<!-- jQuery -->
	<script src="../../plugins/jquery/jquery.min.js"></script>
	<!-- ChartJS -->
	<script src="../../plugins/chart.js/Chart.min.js"></script>

	<script>
  $(function () {

    var areaChartData = {
      labels  : ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 
      'Jul','Agust','Sept','Okt','Nov','Des'],
      datasets: [
        {
          label               : 'PO',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [
          <?php echo $bulan01; ?>,
          <?php echo $bulan02; ?>,
          <?php echo $bulan03; ?>,
          <?php echo $bulan04; ?>,
          <?php echo $bulan05; ?>,
          <?php echo $bulan06; ?>,
          <?php echo $bulan07; ?>,
          <?php echo $bulan08; ?>,
          <?php echo $bulan09; ?>,
          <?php echo $bulan10; ?>,
          <?php echo $bulan11; ?>,
          <?php echo $bulan12; ?>,]
        },
        
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }


    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = jQuery.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    barChartData.datasets[0] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    var barChart = new Chart(barChartCanvas, {
      type: 'bar', 
      data: barChartData,
      options: barChartOptions
    })


  })
</script>