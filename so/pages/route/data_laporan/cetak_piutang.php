<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Cetak Laporan Piutang PO</title>
  <?php
  $dir="../../../../";

  session_start();
  include $dir."config/koneksi.php";
  include $dir."config/library.php";
  include $dir."config/fungsi_indotgl.php";
  include $dir."config/fungsi_rupiah.php";
  
  $awal=$_POST['bulan_awal'];
  $akhir=$_POST['bulan_akhir'];

  $aw=tgl_mysql($_POST['bulan_awal']);
  $ak=tgl_mysql($_POST['bulan_akhir']);
  ?>
  <style>
    table {
      border-collapse: collapse;
      font-family:Arial, Helvetica, sans-serif;
      font-size:11px;
    }

    td {
     font-size:11px;
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
    background: #35A9DB;
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
  $produksi = mysql_query("SELECT * from payment where tgl_order between '$aw' AND '$ak' AND employee_number='$_SESSION[employee_number]' and status_payment!='Lunas' ");
//$pp = mysql_fetch_array($produksi);
  ?>
  <p align="center"><img src="<?php echo $dir;?>images/logo1.png" width="100px"></p>
  <p align="center" style="font-size:12px; font-family:Arial, Helvetica, sans-serif;"><b>LAPORAN RINCIAN PIUTANG PO</b><br/><b><u>BELUM LUNAS</u></b></p>
  <a>di cetak : <?php echo date('d-M-Y');?></a>
  <?php
  while($p3 = mysql_fetch_array($produksi))
  {
	//marketing
   $employee = mysql_query("SELECT employee_number,name_e from employee where employee_number = '$p3[employee_number]'");
   $e = mysql_fetch_array($employee);
   $outlet=mysql_query("SELECT * from outlet where id_outlet='$p3[id_outlet]' ");
   $o=mysql_fetch_array($outlet);
   ?>
   <fieldset>
     <table width="100%" border="0" class="table1">
      <tbody>
        <tr align="left" style="background: #35A9DB;color: #fff;" >
          <th >ID Piutang/No Invoice</th>
          <td>: <?php echo $p3['id_payment'].'/'.$p3['id_orders']; ?></td>
          <th >ID/Nama Outlet</th>
          <td colspan="3">: <?php echo $p3['id_outlet'].' - '.$o['nama_outlet']; ?></td>
        </tr>
        <tr align="left">
          <th>Marketing</th>
          <td>: <?php echo $e['name_e']; ?></td>
          <th>Tgl Order</th>
          <td>: <?php echo tgl_indo($p3['tgl_order']); ?></td>
          <th >Tgl Jatuh Tempo</th>
          <td>: <?php echo tgl_indo($p3['tgl_jth_tempo']); ?></td>
        </tr>            
        <tr align="left">
          <th>Total Piutang</th>
          <td>: Rp. <?php echo format_rupiah($p3['total_bayar']); ?></td>
          <th>Sisa Piutang</th>
          <td>: Rp. <?php echo format_rupiah($p3['sisa_bayar']); ?></td>
          <th>Status</th>
          <?php
          if($p3['status_payment']=='Belum Bayar')
          {
           echo "<td bgcolor='#FF0000' style='color:#FFF;'>:  $p3[status_payment]</td>";
         }
         elseif($p3['status_payment']=='Cicilan')
         {
           echo "<td bgcolor='#FFFF00' style='color:#000;'>: $p3[status_payment]";
         }
         else
         {
           echo " <td bgcolor='#00FF00' style='color:#000;'>: $p3[status_payment]</td>";
         }
         ?>

       </td>
     </tr>
   </tbody>
 </table>
 <table width="50%" border="1" align="right">
  <thead>
    <tr bgcolor="#FFFF00">
      <th>No.</th>
      <!-- <th>ID Piutang</th>
        <th>No. Invoice</th> -->
        <th>Tgl Bayar</th>
        <th>Jumlah Bayar</th>
        <th>Akun</th>
      </tr>
    </thead>
    <tbody>
     <?php
					//jadwal
     $jadwal=mysql_query("SELECT * from payment_detail where id_payment = '$p3[id_payment]'");
     $no=1;
     $tgl=date('Y-m-d');
     while($j=mysql_fetch_array($jadwal))
     {
      ?>
      <tr align="center">
        <td><?php echo $no; ?></td>
      <!-- <td><?php echo $j['id_payment']; ?></td>
        <td><?php echo $j['id_orders']; ?></td> -->
        <td><?php echo tgl_indo($j['tgl_setor']); ?></td>
        <td>Rp. <?php echo format_rupiah($j['jml_bayar']); ?></td>
        <td><?php echo $j['akun']; ?></td>
      </tr>
      <?php
      $no++;

    }
    ?>
  </tbody>
</table>
</fieldset>
<br>

<?php
}
?>
<p align="center">copyright &copy; 2020-<?php echo $thn_sekarang." ".$naper1." ".$naper2;?> </p>
</body>
</html>