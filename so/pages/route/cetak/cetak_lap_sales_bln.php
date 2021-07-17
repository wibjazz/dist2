  <?php
  session_start();
  $dir="../../../../";
  date_default_timezone_set('Asia/Jakarta');
  include $dir."config/koneksi.php";
  include $dir."config/library.php";
  include $dir."config/fungsi_indotgl.php";
  include $dir."config/fungsi_rupiah.php";
  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="<?php echo $dir ;?>bootstrap/css/bootstrap.min.css">

  <title>Cetak Laporan Rincian Penjualan Bulan ini</title>

  <style>
    .table1 {
      font-family: sans-serif;
      color: #444;
      border-collapse: collapse;
      width: 100%;
      border: 1px solid #f2f5f7;
    }

    .table1 tr th{
      background: maroon;
      color: #fff;
      font-size: 14px;
    }

    .table1, th, td {
      padding: 8px 20px;
      text-align: center;
      font-size: 12px;
    }

    .table1 tr:hover {
      background-color: #f5f5f5;
    }

    .table1 tr:nth-child(even) {
      background-color: #f2f2f2;
    }

  </style>
</head>

<body>
  <?php
  $awal = date('Y-m-d');
  $bln=date('m');
//echo $bln;
  $year=date('Y');  
//echo $year;

  $en=$_SESSION['employee_number'];
  ?>
  <p align="center"><img src="../../../../images/logo.png" width="100px"></p>
  <p align="center" style="font-size:12px; font-family:Arial, Helvetica, sans-serif;"><b>LAPORAN PENJUALAN BULAN</b></p>
  <p align="center" style="font-size:12px; font-family:Arial, Helvetica, sans-serif;"><b>PERIODE Bulan <?php echo $bln.' - '.$year ; ?></b></p>
  <div class="table-responsive">
    <table width="100%" class="table1">
      <thead>
        <tr>
          <th>No.</th>
          <th>No. PO</th>
          <th>Tgl. PO</th>
          <th>Outlet</th>
          <th>Sales</th>  
          <th>Payment</th>
          <th>Tgl Jatuh Tempo</th>
          <th>Total</th>              
        </tr>
      </thead>
      <tbody>
       <?php
					//orders

       $orders=mysql_query("SELECT * from orders where month(tgl_order) = '$bln' and year(tgl_order)= '$year' and employee_number='$en' order by tgl_order asc");
       
       $no=1;
       $total=0;
       while($or=mysql_fetch_array($orders))
       {
        
						//produk
						//$produk=mysql_query("select * from produk where id_produk='$or[id_produk]'");
						//$pro=mysql_fetch_array($produk);
						//outlet
        $outlet=mysql_query("select * from outlet where id_outlet='$or[id_outlet]'");
        $out=mysql_fetch_array($outlet);
						//employee
        $employee=mysql_query("select * from employee where employee_number='$or[employee_number]'");
        $e=mysql_fetch_array($employee);
        
						//hitung
        
        $total = $total + $or['total_bayar'];
        
        
        ?>
        <tr align="left">
          <td><?php echo $no; ?></td>
          <td><?php echo $or['id_orders']; ?></td>
          <td><?php echo tgl_indo($or['tgl_order']); ?></td>
          <td style="text-align: left"><?php echo $out['nama_outlet']; ?></td>
          <td><?php echo $e['name_e']; ?></td>
          <td><?php echo $or['payment']; ?></td>
          <td><?php echo tgl_indo($or['tgl_jth_tempo']); ?></td>  
          <td align="right">Rp. <?php echo format_rupiah($or['total_bayar']); ?></td>              
        </tr>
        <?php
        $no++;
      }
      ?>
      <tr align="left">
        <td colspan="7" style="text-align:right;"><b>Grand Total Penjualan = Rp.</b></td>
        <td><b><?php echo format_rupiah($total); ?></b></td>                 
      </tr>
    </tbody>
  </table>
</div>
<br />

<p align="center">copyright &copy; 2020-<?php echo $thn_sekarang." ".$naper1." ".$naper2;?> </p>
<!-- Bootstrap 3.3.5 -->
<script src="<?php echo $dir ;?>bootstrap/js/bootstrap.min.js"></script>
</body>
</html>