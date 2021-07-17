<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Cetak Purchase Request</title>
  <?php
  $dir="../../../../";
  include $dir."config/koneksi.php";
  include $dir."config/library.php";
  include $dir."config/fungsi_indotgl.php";
  include $dir."config/fungsi_rupiah.php";
  
	//orders trad
  $cetak=mysql_query("SELECT * from orders where id_orders='$_GET[ido]'");
  $r=mysql_fetch_array($cetak);
//outlet
  $cetak2=mysql_query("SELECT * from outlet where id_outlet='$r[id_outlet]'");
  $s=mysql_fetch_array($cetak2);
//sales
  $jadwal=mysql_query("SELECT * from employee where employee_number='$r[employee_number]'");
  $j=mysql_fetch_array($jadwal);

  ?>
  <style>
    table {
      border-collapse: collapse;
      font-family:Arial, Helvetica, sans-serif;
      font-size:11px;
    }


  </style>
</head>

<body>
  <p align="center"><img src="../../../../images/logo.png" width="100px"/></p>
  <p align="center" style="font-size:12px; font-family:Arial, Helvetica, sans-serif;"><b></b><h3 align="center" style="font-family:Arial, Helvetica, sans-serif;">Order Request</h3></p>
  <fieldset>
    <legend><b>Data Order Request | <?php echo $r['id_orders']; ?></b></legend>
    <table width="100%" border="0">
      <tr>
        <td width="200px">No. Surat PO</td>
        <td>: <b><i><?php echo $r['keterangan_o']; ?></i></b></td>
      </tr>
      <tr>
        <td width="200px">Tgl Order</td>
        <td>: <?php echo tgl_indo($r['tgl_order']); ?></td>
      </tr>
      <tr>
        <td width="200px">Tgl Expired Order</td>
        <td>: <?php echo tgl_indo($r['tgl_expired_po']); ?></td>
      </tr>
      <tr>
        <td width="200px">Tgl Jatuh Tempo Pembayaran</td>
        <td>: <?php echo tgl_indo($r['tgl_jth_tempo']); ?></td>
      </tr>
      <tr>
        <td>Outlet</td>
        <td>: <?php echo $r['id_outlet']; ?>, <?php echo $s['nama_outlet']; ?></td>
      </tr>
      <tr>
        <td>Alamat Outlet</td>
        <td>: <?php echo $s['alamat_outlet']; ?></td>
      </tr>
      <tr>
        <td>No. Telp / Hp</td>
        <td>: <?php echo $s['telp_outlet']; ?> / <?php echo $s['hp_outlet']; ?></td>
      </tr>
      <tr>
        <td>Sales</td>
        <td>: <?php echo $j['name_e']; ?></td>
      </tr>
      <tr>
        <td>Pembayaran</td>
        <td>: <?php echo $r['payment']; ?></td>
      </tr>
    </table>
  </fieldset>
  <br />
  <legend><b>Data Order</b></legend>
  <table width="100%" border="1px">
    <tr bgcolor="#FFFF00">
      <td align="center"><b>No</b></td>
      <td align="center"><b>Kode Barang</b></td>
      <td align="center"><b>Nama Barang</b></td>
      <td align="center"><b>Jml (Ctn)</b></td>
      <td align="center"><b>Jml (Pcs)</b></td>
      <td align="center"><b>Harga</b></td>       
      <td align="center"><b>Diskon</b></td>
      <td align="center"><b>Sub Diskon</b></td>
      <td align="center"><b>Sub Total</b></td>
    </tr>
    <?php
    $no = 1;
    $sql=mysql_query("select * from orders_detail where id_orders='$_GET[ido]'");
    $total=0;
    $diskon=0;
    while($s=mysql_fetch_array($sql))
    {
     $prd=mysql_query("select * from produk where id_produk='$s[id_produk]'");
     $t=mysql_fetch_array($prd);
     
     $subtotal    = $s['harga'] * $s['jumlah']; 
     $total_rp    = format_rupiah($total); 
     $subtotal_rp = format_rupiah($subtotal); 
     $diskon1     = $subtotal * $s['diskon1'];
     $hasil_disc1 = $subtotal - $diskon1;
     $diskon2     = $hasil_disc1 * $s['diskon2'];
     $hasil_disc2 = $hasil_disc1 - $diskon2;
     $subdiskon   = $diskon1 + $diskon2;
     $total       = $total + $hasil_disc2;
     $diskon      = $diskon + $subdiskon;
     
	//karton
     $karton = $s['jumlah'] / $t['isiperctn'];
     ?>
     <tr bgcolor="#FFFFFF">
      <td align="center"><?php echo $no; echo "<input type='hidden' name='id[$no]' value='$s[id_orders]'"; ?></td>
      <td align="center"><?php echo $t['id_produk']; ?></td>
      <td align="center"><?php echo $t['nama_produk']; ?></td>
      <td align="center"><?php echo $karton; ?></td>
      <td align="center"><?php echo $s['jumlah']; ?></td>
      <td align="center">Rp. <?php echo format_rupiah($s['harga']); ?></td>
      <td align="center"><?php echo $s['diskon1']; ?> %</td>
      <td align="center">Rp. <?php echo format_rupiah($subdiskon); ?></td>
      <td align="center">Rp. <?php echo format_rupiah($hasil_disc2); ?></td>
    </tr>
    <?php
    $no++;
    $prd2=mysql_query("select * from orders where id_orders='$s[id_orders]'");
    $q=mysql_fetch_array($prd2);
  }
  ?>
  <?php
  $ppn = $total * $r['ppn'];
  ?>
  <?php
  $x=mysql_query("select * from orders where id_orders='$_GET[ido]'");
  $y=mysql_fetch_array($x);
  ?>
</table>
<br /><hr />
<table width="25%" align="right" border="0">
  <tr>
    <td align="right" colspan="8"> <b>PPN 10% :</b></td>
    <td align="center">Rp. <?php echo format_rupiah($ppn); ?></td>
  </tr>
  <tr>
    <td align="right" colspan="8"> <b>Grand Total :</b></td>
    <td align="center">Rp. <?php echo format_rupiah($q['total_bayar']); ?></td>
  </tr>
</table>
<br />
<br />
<hr />
<table width="75%" align="center" border="1px">
  <tr align="center">
    <td style="width:25%">Manager Marketing</td>
    <td style="width:25%">Sales</td>
  </tr>
  <tr>
  	<td><br /><br /><br /><br /></td>
    <td><br /><br /><br /><br /></td>
  </tr>
  <tr align="center">
  	<td style="width:25%">( <?php echo $r['manager']; ?> )</td>
    <td style="width:25%">( <?php echo $j['name_e']; ?> )</td>
  </tr>
</table>
<p align="center" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;">Tgl cetak : <?php echo tgl_indo(date('Y-m-d')); ?>, Jam : <?php echo date('H:i:s'); ?> WIB</p>
</body>
</html>