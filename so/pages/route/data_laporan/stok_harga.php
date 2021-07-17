<?php
// session_start();
// koneksi
include "../../config/koneksi.php";
include "../../config/library.php";
?>

  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Cetak Laporan Outlet Sales</title>
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">

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
<table width="100%" border="0" align="center">
  <tr>
    <td align="center"><img src="../../images/logo.png" width="100px"></td>
  </tr>
</table>

<center><h3>Laporan STOK & HARGA</h3></center>
Tanggal Cetak: <?php echo tgl_indo(date('Y-m-d')); ?></p>

<table width="100%" border="1" cellspacing="0" cellpadding="4" class="list">
<table width="100%" border="1" cellspacing="0" cellpadding="4" class="" >
  <tr bgcolor="#FF0000" style="color: #FFF">
    <td width="50pt" align="center" rowspan="2"><b>No</b></td>
    <td width="150pt" align="center" rowspan="2"><b>Kode Produk</b></td>   
    <td width="450pt" align="center" rowspan="2"><b>Nama Produk</b></td>
    <td width="150pt" align="center" rowspan="2"><b>Isi /Ctn</b></td>
    <td width="100px" align="center" colspan="2"><b>Stok</b></td>
    <td width="100px" align="center" colspan="4"><b>Harga (Rp.)</b></td>
  </tr>
  <tr bgcolor="#FF0000" style="color: #FFF">
    <td width="100px" align="center"><b>Kantor</b></td>
    <td width="100px" align="center"><b>Gudang</b></td>
    <td width="100px" align="center"><b>Tradisional</b></td>
    <td width="100px" align="center"><b>Apotik</b></td>
    <td width="100px" align="center"><b>Supermarket</b></td>
    <td width="100px" align="center"><b>Hypermart</b></td>
  </tr>
  <?php
    $no = 1;
  	$sql=mysql_query("SELECT * from produk ");
    while($s=mysql_fetch_array($sql))
    {
  	$prd=mysql_query("SELECT * from kategori where id_cat_produk='$s[id_cat_produk]'");
  	$t=mysql_fetch_array($prd);

    $hb = mysql_fetch_array(mysql_query("SELECT * FROM harga WHERE id_produk='$s[id_produk]'  ORDER BY id_harga DESC"));

    $hb_ppn = $hb['harga_modern']*1.1;

  ?>
  <tr bgcolor="#FFFFFF">
    <td align="center"><?php echo $no; ?></td>
    <td align="center"  style="color: #23E436" ><?php echo $s['id_produk']; ?></td>
    <td align="left"> &nbsp&nbsp&nbsp<?php echo $s['nama_produk']; ?></td>
    <td align="center"><?php echo $s['isiperctn']; ?></td>
    <td align="center" bgcolor="#EAFEF0"><?php echo number_format($s['stok_kantor']); ?></td>
    <td align="center" bgcolor="#EBDEF0"><?php echo number_format($s['stok_gudang']); ?></td>
    <td align="right"  bgcolor="#F7DC6F" > <?php echo format_rupiah($hb['trad']); ?>&nbsp&nbsp&nbsp</td>
    <td align="right" bgcolor="#F8C471"> <?php echo format_rupiah($hb['apotik']); ?>&nbsp&nbsp&nbsp</td>
    <td align="right" bgcolor="#F9b484"> <?php echo format_rupiah($hb['supermarket']); ?>&nbsp&nbsp&nbsp</td>
    <td align="right" bgcolor="#Faa171"> <?php echo format_rupiah($hb['hypermart']); ?>&nbsp&nbsp&nbsp</td>

  </tr>
  <?php
    $no++;
    }
  ?>
</table>


<br>
<table width="60%" border="0" align="center">
  <tr>
    <td align="center" width="30%">Mengetahui</td>
    <td align="center" width="30%">Mengetahui</td>
  </tr>
  <tr>
    <td align="center"><br><br><br><br><br>( ............................. )</td>
    <td align="center"><br><br><br><br><br>( ............................. )</td>
  </tr>
  <tr>
    <td align="center">Direktur</td>
    <td align="center">Manager</td>
  </tr>
</table>

  <p align="center">copyright &copy; 2020-<?php echo $thn_sekarang." ".$naper1." ".$naper2;?> </p>
  <!-- Bootstrap 3.3.5 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>