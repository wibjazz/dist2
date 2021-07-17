<?php
           
$server = "localhost";
$username = "k4722283_root";
$password = "thej0ker";
$database = "k4722283_erp";
mysql_connect($server,$username,$password) or die("Koneksi gagal");
mysql_select_db($database) or die("Database tidak bisa dibuka");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Grafik Penjualan Modern Periode <?php echo $_POST['bulan_awal']; ?> - <?php echo $_POST['bulan_akhir']; ?></title>
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<script type="text/javascript">
	var chart1; // globally available
$(document).ready(function() {
      chart1 = new Highcharts.Chart({
         chart: {
            renderTo: 'container',
            type: 'column'
         },   
         title: {
            text: 'Data PO Per Modern Store'
         },
         xAxis: {
            categories: ['Outlet']
         },
         yAxis: {
            title: {
               text: 'Jumlah PO'
            }
         },
              series:             
            [
<?php 
$sql   = "SELECT id_outlet, COUNT( id_orders ) AS qty FROM orders where tgl_order between '$_POST[bulan_awal]' and '$_POST[bulan_akhir]'  GROUP BY id_outlet";
$query = mysql_query( $sql )  or die(mysql_error());         
while($ambil = mysql_fetch_array($query)){
	$provinsi=$ambil['id_outlet'];
	$jumlahx = $ambil['qty'];
		//outlet
		$outlet=mysql_query("select nama_outlet from outlet where id_outlet='$provinsi'");
		$o=mysql_fetch_array($outlet);       
	  ?>
	  {
		  name: '<?php echo $o['nama_outlet']; ?>',
		  data: [<?php echo $jumlahx; ?>]
	  },
	  <?php } ?>
]
});
});	
</script>
</head>
<body>
<div id="container" style="min-width: 2000px; height: 2500px; max-width: 2500px; margin: 0 auto"></div>

</body>
</html>
