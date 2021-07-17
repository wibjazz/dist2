<?php
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=Laporan-Penjualan-Modern-PO.xls");//ganti nama sesuai keperluan
		header("Pragma: no-cache");
		header("Expires: 0");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cetak Laporan Penjualan Modern</title>
<?php
	include"../../../../config/koneksi.php";
	include "../../../config/library.php";
	include "../../../config/fungsi_indotgl.php";
	include "../../../config/fungsi_rupiah.php";
?>
<style>
table {
    border-collapse: collapse;
	font-family:Arial, Helvetica, sans-serif;
	font-size:14px;
}

td {
	font-size:12px;
}

table, td, th {
    border: 1px solid black;
}
</style>
</head>

<body>
<?php
$awal=$_GET['awal'];
$akhir=$_GET['akhir'];				
?>
<p align="center" style="font-size:12px; font-family:Arial, Helvetica, sans-serif;"><b>PT. MITRA BERSAUDARA</b><br /><b>GRAHA ALHIJAZ Lt.4 Jl. DEWI SARTIKA NO. 239A CAWANG JAKARTA TIMUR - 13630 TLP : 021-8013333 FAX : 021-8001616</b><br /><b>LAPORAN PENJUALAN SALES MODERN PERIODE : <?php echo tgl_indo($awal); ?> - <?php echo tgl_indo($akhir); ?></b></p>
<table width="100%">
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
					$orders_detail=mysql_query("select * from orders where tgl_order BETWEEN '$awal' and '$akhir'");
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
                      <tr align="center">
                        <td><?php echo $no; ?></td>
                        <td><?php echo $p['id_orders']; ?></td>
                        <td><?php echo tgl_indo($p['tgl_order']); ?></td>
                        <td><?php echo $out['nama_outlet']; ?></td>
                        <td><?php echo $e['name_e']; ?></td>
                        <td><?php echo round($p['total_bayar']); ?></td>                      
                      </tr>
					 <?php
					 $no++;
					}
					 ?>
                    </tbody>
                  </table>
</body>
</html>