  <?php
  $dir="../../../../";
  include $dir."config/koneksi.php";
  include $dir."config/library.php";
  include $dir."config/fungsi_indotgl.php";
  include $dir."config/fungsi_rupiah.php";
  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Cetak Laporan Penjualan</title>
    <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="<?php echo $dir ;?>bootstrap/css/bootstrap.min.css">

  <style>
    table {
      border-collapse: collapse;
      font-family:Arial, Helvetica, sans-serif;
      font-size:13px;
    }

    td {
     font-size:12px;
   }

   table, td, th {
    border: 1px solid black;
  }
</style>

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
      /*text-align: center;*/
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
  $awal=$_GET['awal'];
  $akhir=$_GET['akhir'];

  $aw=tgl_mysql($_GET['awal']);
  $ak=tgl_mysql($_GET['akhir']);
  $en=$_GET['en'];	


  $employee=mysql_query("SELECT * from employee where employee_number='$en' ");
  $em=mysql_fetch_array($employee);

  ?>

  <a><center><img src="../../../../images/logo.png" width="100px"></center></a>
  <p align="center" style="font-size:12px; font-family:Arial, Helvetica, sans-serif;"><b>LAPORAN PENJUALAN <?php echo $em['name_e'] ;?> PERIODE : <strong><?php echo tgl_indo($awal); ?> - <?php echo tgl_indo($akhir); ?></strong></b></p>
  <table width="100%" cellpadding="3" class="table1">
    <thead>
      <tr bgcolor="#FFCC00">
        <th>No.</th>
        <th>No. PO</th>
        <th>Tgl. PO</th>
        <th>Outlet</th>
        <th>Nilai PO Rp.</th>
      </tr>
    </thead>
    <tbody>
     <?php
					//orders
     $orders=mysql_query("SELECT * from orders where tgl_order BETWEEN '$aw' and '$ak' and employee_number='$en' ");
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

      $outlet=mysql_query("SELECT * from outlet where id_outlet='$p[id_outlet]'  ");
      $out=mysql_fetch_array($outlet);

      ?>
      <tr >
        <td><?php echo $no; ?></td>
        <td><?php echo $p['id_orders']; ?></td>
        <td><?php echo tgl_indo_short($p['tgl_order']); ?></td>
        <td align="left"><?php echo '<small>'.$out['id_outlet'].'</small> - '.$out['nama_outlet']; ?></td>
        <td align="right"><?php echo format_rupiah($grantotal); ?></td>                      
      </tr>
      <?php
      $total = $total + $grantotal;
      $totppn = $totppn + $granppn;
      $no++;
    }
    ?>

  <tfoot style="font-weight: 800; font-size: 120%; text-align: right;">
        <tr align="right">
      <td colspan="4" align="right">Total Penjualan : <?php echo tgl_indo($awal); ?> - <?php echo tgl_indo($akhir); ?> Rp. </td>
      <td><?php echo format_rupiah($total); ?></td>                      
    </tr>
    <tr align="right">
      <td colspan="4" align="right">Total Ppn : Rp. </td>
      <td><?php echo format_rupiah($totppn); ?></td>
    </tr>
    <tr align="right">
    <td colspan="4" align="right">Total : Rp. </td>
      <td><?php echo format_rupiah($total+$totppn); ?></td>                      
    </tr>
  </tfoot>
</table>

<input type="button" name="kembali" class="btn btn-primary" value="Kembali ..." onclick="location.href = '../../main.php?route=laporan-sales-po&act';" style="cursor:pointer;" />
<p align="center"><strong>Copyright &copy; 2020-<?php echo $thn_sekarang." ".$naper1." ".$naper2;?> </strong> by <i>Wibjazz.</i></p>
<!-- Bootstrap 3.3.5 -->
<script src="<?php echo $dir ;?>bootstrap/js/bootstrap.min.js"></script>
</body>
</html>