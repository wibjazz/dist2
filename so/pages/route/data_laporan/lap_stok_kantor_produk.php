<?php
session_start();
// koneksi
include "../../../config/koneksi.php";
include "../../../config/fungsi_indotgl.php";
include "../../../config/fungsi_rupiah.php";
include "../../../config/library.php";
?>
<table width="100%" border="0" align="center">
  <tr>
    <td align="center"><img src="../../../images/logo.png" width="150px"></td>
  </tr>
</table>

<center><h3>Laporan Stok Kantor<br/>
<?php echo $perusahaan ;?></h3></center>
di cetak Tanggal : <?php echo tgl_indo(date('Y-m-d')); ?></p>
<h3>Beras</h3>
<table width="100%" border="1" cellspacing="0" cellpadding="2" class="list">
  <tr bgcolor="#CCCCCC">
    <td align="center"><b>No</b></td>
    <td align="center"><b>Kode Produk</b></td>   
    <td align="center"><b>Nama Produk</b></td>
    <td align="center"><b>Jenis</b></td>
    <td align="center"><b>Isi /Ctn</b></td>
    <td align="center"><b>Jumlah Stok (Bags)</b></td>
    <td align="center"><b>Jumlah Stok (Karung)</b></td>
    <td align="center"><b>Jumlah Stok (Kg)</b></td>
    <td align="center"><b>Jumlah Stok (Ton)</b></td>
  </tr>
  <?php
    $no = 1;
	$sql=mysql_query("select * from produk where id_cat_produk='1' and jenis='Produk' ");
  while($s=mysql_fetch_array($sql))
  {
	$prd=mysql_query("select * from kategori where id_cat_produk='$s[id_cat_produk]'");
	$t=mysql_fetch_array($prd);
	if($s['isiperctn']==0)
	{
		$isictn = 0;
		//echo "<script>window.location='../../media.php?module=home'
	}
	else
	{
		$isictn = $s['stok_kantor'] / $s['isiperctn'];
	}
	$limapuluh = 2000*0.5; //stok sisa 50% = 1000
	$dualima = 2000*0.1; //stok sisa 25% = 500
  ?>
  <tr bgcolor="#FFFFFF">
    <td align="center"><?php echo $no; ?></td>
    <td align="center"><?php echo $s['id_produk']; ?></td>
	<td align="center"><?php echo $s['nama_produk']; ?></td>
    <td align="center"><?php echo $t['nama_cat']; ?></td>
    <td align="center"><?php echo $s['isiperctn']; ?></td>
    <?php
  $nilai=number_format($s['stok_kantor']);
	if($s['stok_kantor'] <= $limapuluh and $s['stok_kantor'] >= $dualima)
	{
		echo"<td align='center' bgcolor='#FFFF00'>$s[stok_kantor]</td>"; //kuning
	}
	elseif($s['stok_kantor'] <= $dualima)
	{
		echo"<td align='center' bgcolor='#FF0000' style='color:#ffffff;'>$s[stok_kantor]</td>"; //merah
	}
	else
	{
		echo"<td align='center' bgcolor='#00FF00'><font color='#000'>$s[stok_kantor]</font></td>"; //ijo
	}
	?>
    <td align="center"><?php echo $isictn; ?></td>
    <?php
	$kg=$s['stok_kantor'] * 5;
	$ton=$kg / 1000;
	?>
    <td align="center"><?php echo $kg; ?></td>
    <td align="center"><?php echo $ton; ?></td>
  </tr>
  <?php
  $no++;
  }
  ?>
</table>

<h3>Madu</h3>
<table width="100%" border="1" cellspacing="0" cellpadding="2" class="list">
  <tr bgcolor="#CCCCCC">
    <td align="center"><b>No</b></td>
    <td align="center"><b>Kode Produk</b></td>   
    <td align="center"><b>Nama Produk</b></td>
    <td align="center"><b>Jenis</b></td>
    <td align="center"><b>Isi /Ctn</b></td>
    <td width="100px" align="center"><b>Jumlah Stok(Pcs)</b></td>
    <td width="100px" align="center"><b>Stok Gudang</b></td>
  </tr>
  <?php
    $no = 1;
	$sql=mysql_query("select * from produk where id_cat_produk='2' and jenis='Produk' ");
  while($s=mysql_fetch_array($sql))
  {
	$prd=mysql_query("select * from kategori where id_cat_produk='$s[id_cat_produk]'");
	$t=mysql_fetch_array($prd);
	if($s['isiperctn']==0)
	{
		$isictn = 0;
		//echo "<script>window.location='../../media.php?module=home'
	}
	else
	{
		$isictn = $s['stok_kantor'] / $s['isiperctn'];
	}
	$limapuluh = 2000*0.5; //stok sisa 50% = 1000
	$dualima = 2000*0.1; //stok sisa 25% = 500
  ?>
  <tr bgcolor="#FFFFFF">
    <td align="center"><?php echo $no; ?></td>
    <td align="center"><?php echo $s['id_produk']; ?></td>
	<td align="center"><?php echo $s['nama_produk']; ?></td>
    <td align="center"><?php echo $t['nama_cat']; ?></td>
    <td align="center"><?php echo $s['isiperctn']; ?></td>
    <?php
  $nilai=number_format($s['stok_kantor']);
	if($s['stok_kantor'] <= $limapuluh and $s['stok_kantor'] >= $dualima)
	{
		echo"<td align='center' bgcolor='#E6E22D'>$nilai</td>"; //kuning
	}
	elseif($s['stok_kantor'] <= $dualima)
	{
		echo"<td align='center' bgcolor='#DD4B39' style='color:#ffffff;'>$nilai</td>"; //merah
	}
	else
	{
		echo"<td align='center' bgcolor='#58C493'><font color='#000'>$nilai</font></td>"; //ijo
	}
	?>
    <td align="center"><?php echo number_format($s['stok_gudang']); ?></td>
  </tr>
  <?php
  $no++;
  }
  ?>
</table>

<h3>Olive Oil (Accessur)</h3>
<table width="100%" border="1" cellspacing="0" cellpadding="2" class="list">
  <tr bgcolor="#CCCCCC">
    <td align="center"><b>No</b></td>
    <td align="center"><b>Kode Produk</b></td>   
    <td align="center"><b>Nama Produk</b></td>
    <td align="center"><b>Jenis</b></td>
    <td align="center"><b>Isi /Ctn</b></td>
    <td width="100px" align="center"><b>Jumlah Stok(Pcs)</b></td>
    <td width="100px" align="center"><b>Stok Gudang</b></td>
  </tr>
  <?php
    $no = 1;
	$sql=mysql_query("select * from produk where id_cat_produk='4' AND id_supp='SUP001'  and jenis='Produk' ");
  while($s=mysql_fetch_array($sql))
  {
	$prd=mysql_query("select * from kategori where id_cat_produk='$s[id_cat_produk]'");
	$t=mysql_fetch_array($prd);
	if($s['isiperctn']==0)
	{
		$isictn = 0;
		//echo "<script>window.location='../../media.php?module=home'
	}
	else
	{
		$isictn = $s['stok_kantor'] / $s['isiperctn'];
	}
	$limapuluh = 2000*0.5; //stok sisa 50% = 1000
	$dualima = 2000*0.1; //stok sisa 25% = 500
  ?>
  <tr bgcolor="#FFFFFF">
    <td align="center"><?php echo $no; ?></td>
    <td align="center"><?php echo $s['id_produk']; ?></td>
	<td align="center"><?php echo $s['nama_produk']; ?></td>
    <td align="center"><?php echo $t['nama_cat']; ?></td>
    <td align="center"><?php echo $s['isiperctn']; ?></td>
    <?php
  $nilai=number_format($s['stok_kantor']);
  if($s['stok_kantor'] <= $limapuluh and $s['stok_kantor'] >= $dualima)
  {
    echo"<td align='center' bgcolor='#E6E22D'>$nilai</td>"; //kuning
  }
  elseif($s['stok_kantor'] <= $dualima)
  {
    echo"<td align='center' bgcolor='#DD4B39' style='color:#ffffff;'>$nilai</td>"; //merah
  }
  else
  {
    echo"<td align='center' bgcolor='#58C493'><font color='#000'>$nilai</font></td>"; //ijo
  }
  ?>
    <td align="center"><?php echo number_format($s['stok_gudang']); ?></td>
  </tr>
  <?php
  $no++;
  }
  ?>
</table>

<h3>Olive Oil (Kucukbay)</h3>
<table width="100%" border="1" cellspacing="0" cellpadding="2" class="list">
  <tr bgcolor="#CCCCCC">
    <td align="center"><b>No</b></td>
    <td align="center"><b>Kode Produk</b></td>   
    <td align="center"><b>Nama Produk</b></td>
    <td align="center"><b>Jenis</b></td>
    <td align="center"><b>Isi /Ctn</b></td>
    <td width="100px" align="center"><b>Jumlah Stok(Pcs)</b></td>
    <td width="100px" align="center"><b>Stok Gudang</b></td>
  </tr>
  <?php
    $no = 1;
	$sql=mysql_query("select * from produk where id_cat_produk='4' AND id_supp='SUP002'  and jenis='Produk' ");
  while($s=mysql_fetch_array($sql))
  {
	$prd=mysql_query("select * from kategori where id_cat_produk='$s[id_cat_produk]'");
	$t=mysql_fetch_array($prd);
	if($s['isiperctn']==0)
	{
		$isictn = 0;
		//echo "<script>window.location='../../media.php?module=home'
	}
	else
	{
		$isictn = $s['stok_kantor'] / $s['isiperctn'];
	}
	$limapuluh = 2000*0.5; //stok sisa 50% = 1000
	$dualima = 2000*0.1; //stok sisa 25% = 500
  ?>
  <tr bgcolor="#FFFFFF">
    <td align="center"><?php echo $no; ?></td>
    <td align="center"><?php echo $s['id_produk']; ?></td>
	<td align="center"><?php echo $s['nama_produk']; ?></td>
    <td align="center"><?php echo $t['nama_cat']; ?></td>
    <td align="center"><?php echo $s['isiperctn']; ?></td>
    <?php
  $nilai=number_format($s['stok_kantor']);
  if($s['stok_kantor'] <= $limapuluh and $s['stok_kantor'] >= $dualima)
  {
    echo"<td align='center' bgcolor='#E6E22D'>$nilai</td>"; //kuning
  }
  elseif($s['stok_kantor'] <= $dualima)
  {
    echo"<td align='center' bgcolor='#DD4B39' style='color:#ffffff;'>$nilai</td>"; //merah
  }
  else
  {
    echo"<td align='center' bgcolor='#58C493'><font color='#000'>$nilai</font></td>"; //ijo
  }
  ?>
    <td align="center"><?php echo number_format($s['stok_gudang']); ?></td>
  </tr>
  <?php
  $no++;
  }
  ?>
</table>

<h3>Olive Oil (CV. Dua Putra)</h3>
<table width="100%" border="1" cellspacing="0" cellpadding="2" class="list">
  <tr bgcolor="#CCCCCC">
    <td align="center"><b>No</b></td>
    <td align="center"><b>Kode Produk</b></td>   
    <td align="center"><b>Nama Produk</b></td>
    <td align="center"><b>Jenis</b></td>
    <td align="center"><b>Isi /Ctn</b></td>
    <td width="100px" align="center"><b>Jumlah Stok(Pcs)</b></td>
    <td width="100px" align="center"><b>Stok Gudang</b></td>
  </tr>
  <?php
    $no = 1;
	$sql=mysql_query("select * from produk where id_cat_produk='4' AND id_supp='SUP003'  and jenis='Produk' ");
  while($s=mysql_fetch_array($sql))
  {
	$prd=mysql_query("select * from kategori where id_cat_produk='$s[id_cat_produk]'");
	$t=mysql_fetch_array($prd);
	if($s['isiperctn']==0)
	{
		$isictn = 0;
		//echo "<script>window.location='../../media.php?module=home'
	}
	else
	{
		$isictn = $s['stok_kantor'] / $s['isiperctn'];
	}
	$limapuluh = 2000*0.5; //stok sisa 50% = 1000
	$dualima = 2000*0.1; //stok sisa 25% = 500
  ?>
  <tr bgcolor="#FFFFFF">
    <td align="center"><?php echo $no; ?></td>
    <td align="center"><?php echo $s['id_produk']; ?></td>
	<td align="center"><?php echo $s['nama_produk']; ?></td>
    <td align="center"><?php echo $t['nama_cat']; ?></td>
    <td align="center"><?php echo $s['isiperctn']; ?></td>
    <?php
  $nilai=number_format($s['stok_kantor']);
  if($s['stok_kantor'] <= $limapuluh and $s['stok_kantor'] >= $dualima)
  {
    echo"<td align='center' bgcolor='#E6E22D'>$nilai</td>"; //kuning
  }
  elseif($s['stok_kantor'] <= $dualima)
  {
    echo"<td align='center' bgcolor='#DD4B39' style='color:#ffffff;'>$nilai</td>"; //merah
  }
  else
  {
    echo"<td align='center' bgcolor='#58C493'><font color='#000'>$nilai</font></td>"; //ijo
  }
  ?>
    <td align="center"><?php echo number_format($s['stok_gudang']); ?></td>
  </tr>
  <?php
  $no++;
  }
  ?>
</table>
<h3>Olive Oil (SOVENA)</h3>
<table width="100%" border="1" cellspacing="0" cellpadding="2" class="list">
  <tr bgcolor="#CCCCCC">
    <td align="center"><b>No</b></td>
    <td align="center"><b>Kode Produk</b></td>   
    <td align="center"><b>Nama Produk</b></td>
    <td align="center"><b>Jenis</b></td>
    <td align="center"><b>Isi /Ctn</b></td>
    <td width="100px" align="center"><b>Jumlah Stok(Pcs)</b></td>
    <td width="100px" align="center"><b>Stok Gudang</b></td>
  </tr>
  <?php
    $no = 1;
  $sql=mysql_query("select * from produk where id_cat_produk='4' AND id_supp='SUP005'  and jenis='Produk' ");
  while($s=mysql_fetch_array($sql))
  {
  $prd=mysql_query("select * from kategori where id_cat_produk='$s[id_cat_produk]'");
  $t=mysql_fetch_array($prd);
  if($s['isiperctn']==0)
  {
    $isictn = 0;
    //echo "<script>window.location='../../media.php?module=home'
  }
  else
  {
    $isictn = $s['stok_kantor'] / $s['isiperctn'];
  }
  $limapuluh = 2000*0.5; //stok sisa 50% = 1000
  $dualima = 2000*0.1; //stok sisa 25% = 500
  ?>
  <tr bgcolor="#FFFFFF">
    <td align="center"><?php echo $no; ?></td>
    <td align="center"><?php echo $s['id_produk']; ?></td>
  <td align="center"><?php echo $s['nama_produk']; ?></td>
    <td align="center"><?php echo $t['nama_cat']; ?></td>
    <td align="center"><?php echo $s['isiperctn']; ?></td>
    <?php
  $nilai=number_format($s['stok_kantor']);
  if($s['stok_kantor'] <= $limapuluh and $s['stok_kantor'] >= $dualima)
  {
    echo"<td align='center' bgcolor='#E6E22D'>$nilai</td>"; //kuning
  }
  elseif($s['stok_kantor'] <= $dualima)
  {
    echo"<td align='center' bgcolor='#DD4B39' style='color:#ffffff;'>$nilai</td>"; //merah
  }
  else
  {
    echo"<td align='center' bgcolor='#58C493'><font color='#000'>$nilai</font></td>"; //ijo
  }
  ?>
    <td align="center"><?php echo number_format($s['stok_gudang']); ?></td>
  </tr>
  <?php
  $no++;
  }
  ?>
</table>

<h3>Sari Kurma</h3>
<table width="100%" border="1" cellspacing="0" cellpadding="2" class="list">
  <tr bgcolor="#CCCCCC">
    <td align="center"><b>No</b></td>
    <td align="center"><b>Kode Produk</b></td>   
    <td align="center"><b>Nama Produk</b></td>
    <td align="center"><b>Jenis</b></td>
    <td align="center"><b>Isi /Ctn</b></td>
    <td width="100px" align="center"><b>Jumlah Stok(Pcs)</b></td>
    <td width="100px" align="center"><b>Stok Gudang</b></td>
  </tr>
  <?php
    $no = 1;
	$sql=mysql_query("select * from produk where id_cat_produk='5'  and jenis='Produk' ");
  while($s=mysql_fetch_array($sql))
  {
	$prd=mysql_query("select * from kategori where id_cat_produk='$s[id_cat_produk]'");
	$t=mysql_fetch_array($prd);
	if($s['isiperctn']==0)
	{
		$isictn = 0;
		//echo "<script>window.location='../../media.php?module=home'
	}
	else
	{
		$isictn = $s['stok_kantor'] / $s['isiperctn'];
	}
	$limapuluh = 2000*0.5; //stok sisa 50% = 1000
	$dualima = 2000*0.1; //stok sisa 25% = 500
  ?>
  <tr bgcolor="#FFFFFF">
    <td align="center"><?php echo $no; ?></td>
    <td align="center"><?php echo $s['id_produk']; ?></td>
	<td align="center"><?php echo $s['nama_produk']; ?></td>
    <td align="center"><?php echo $t['nama_cat']; ?></td>
    <td align="center"><?php echo $s['isiperctn']; ?></td>
    <?php
  $nilai=number_format($s['stok_kantor']);
  if($s['stok_kantor'] <= $limapuluh and $s['stok_kantor'] >= $dualima)
  {
    echo"<td align='center' bgcolor='#E6E22D'>$nilai</td>"; //kuning
  }
  elseif($s['stok_kantor'] <= $dualima)
  {
    echo"<td align='center' bgcolor='#DD4B39' style='color:#ffffff;'>$nilai</td>"; //merah
  }
  else
  {
    echo"<td align='center' bgcolor='#58C493'><font color='#000'>$nilai</font></td>"; //ijo
  }
  ?>
    <td align="center"><?php echo number_format($s['stok_gudang']); ?></td>
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
    <td align="center"><br><br><br><br><br>( ................................................. )</td>
    <td align="center"><br><br><br><br><br>( ................................................. )</td>
  </tr>
  <tr>
    <td align="center">Direktur</td>
    <td align="center">Kepala Gudang</td>
  </tr>
</table>