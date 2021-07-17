<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
	include"../../../config/koneksi.php";
	include"../../../config/fungsi_kode_otomatis.php";
	
$route=$_GET['route'];
$act=$_GET['act'];

//Hapus Outlet
if($route=='outlet-trad' AND $act=='hapus')
{
	mysql_query("delete from outlet where id_outlet = '$_GET[id]'");
	header('location:../../main.php?route='.$route.'&act');
}

//Update Outlet
elseif($route=='outlet-trad' AND $act=='update')
{
	$date=date('Y-m-d');
	$rs=mysql_query("update outlet set category_id='$_POST[kategori]',
									   outlet_type='$_POST[tipe]',
									   nama_outlet='$_POST[nama]',
									   npwp='$_POST[npwp]',
									   kontak_outlet='$_POST[kontak]',
									   alamat_outlet='$_POST[alamat_ho]',
									   alamat2_outlet='$_POST[alamat_kirim]',
									   negara_outlet='$_POST[negara]',
									   kota_outlet='$_POST[kota]',
									   kodepos_outlet='$_POST[kode_pos]',
									   email_outlet='$_POST[email]',
									   telp_outlet='$_POST[telpon]',
									   hp_outlet='$_POST[hp]',
									   fax_outlet='$_POST[fax]',
									   website_outlet='$_POST[website]',
									   desc_outlet='Outlet Tradisional',
									   jenis_outlet='$_POST[jenis]',
									   diskon='$_POST[diskon]' where id_outlet = '".$_POST['ido']."'") or die(mysql_error());
	header('location:../../main.php?route='.$route.'&act');
}

//Tambah outlet tradisional
elseif($route=='outlet-trad' AND $act=='input')
{
	$ido=autonumber("outlet","id_outlet",4,"PLG");
	$tgl=date('Y-m-d');
	$rs=mysql_query("Insert into outlet (id_outlet,category_id,outlet_type,nama_outlet,npwp,kontak_outlet,alamat_outlet,alamat2_outlet,negara_outlet,kota_outlet,kodepos_outlet,email_outlet,telp_outlet,hp_outlet,fax_outlet,website_outlet,desc_outlet,jenis_outlet,employee_number,diskon,tgl_gabung) values ('".$ido."','".$_POST['kategori']."','".$_POST['tipe']."','".$_POST['nama']."','".$_POST['npwp']."','".$_POST['kontak']."','".$_POST['alamat_ho']."','".$_POST['alamat_kirim']."','".$_POST['negara']."','".$_POST['kota']."','".$_POST['kode_pos']."','".$_POST['email']."','".$_POST['telpon']."','".$_POST['hp']."','".$_POST['fax']."','".$_POST['website']."','Outlet Tradisional','".$_POST['jenis']."','".$_POST['sales']."','".$_POST['diskon']."','$tgl')") or die(mysql_error());
	header('location:../../main.php?route='.$route.'&act');
}

//Tambah outlet modern
elseif($route=='outlet-mod' AND $act=='input')
{
	$ido=autonumber("outlet","id_outlet",4,"PLG");
	$tgl=date('Y-m-d');
	$rs=mysql_query("Insert into outlet (id_outlet,category_id,outlet_type,nama_outlet,npwp,kontak_outlet,alamat_outlet,alamat2_outlet,negara_outlet,kota_outlet,kodepos_outlet,email_outlet,telp_outlet,hp_outlet,fax_outlet,website_outlet,desc_outlet,jenis_outlet,employee_number,diskon,tgl_gabung) values ('".$ido."','".$_POST['kategori']."','".$_POST['tipe']."','".$_POST['nama']."','".$_POST['npwp']."','".$_POST['kontak']."','".$_POST['alamat_ho']."','".$_POST['alamat_kirim']."','".$_POST['negara']."','".$_POST['kota']."','".$_POST['kode_pos']."','".$_POST['email']."','".$_POST['telpon']."','".$_POST['hp']."','".$_POST['fax']."','".$_POST['website']."','Outlet Modern','".$_POST['jenis']."','".$_POST['sales']."','".$_POST['diskon']."','$tgl')") or die(mysql_error());
	header('location:../../main.php?route='.$route.'&act');
}

//Update Outlet
elseif($route=='outlet-mod' AND $act=='update')
{
	$date=date('Y-m-d');
	$rs=mysql_query("update outlet set category_id='$_POST[kategori]',
									   outlet_type='$_POST[tipe]',
									   nama_outlet='$_POST[nama]',
									   npwp='$_POST[npwp]',
									   kontak_outlet='$_POST[kontak]',
									   alamat_outlet='$_POST[alamat_ho]',
									   alamat2_outlet='$_POST[alamat_kirim]',
									   negara_outlet='$_POST[negara]',
									   kota_outlet='$_POST[kota]',
									   kodepos_outlet='$_POST[kode_pos]',
									   email_outlet='$_POST[email]',
									   telp_outlet='$_POST[telpon]',
									   hp_outlet='$_POST[hp]',
									   fax_outlet='$_POST[fax]',
									   website_outlet='$_POST[website]',
									   desc_outlet='Outlet Tradisional',
									   jenis_outlet='$_POST[jenis]',
									   employee_number='$_POST[sales]',
									   diskon='$_POST[diskon]' where id_outlet = '".$_POST['ido']."'") or die(mysql_error());
	header('location:../../main.php?route='.$route.'&act');
}

//Hapus Outlet
elseif($route=='outlet-mod' AND $act=='hapus')
{
	mysql_query("delete from outlet where id_outlet = '$_GET[id]'");
	header('location:../../main.php?route='.$route.'&act');
}

//Tambah outlet horeka
elseif($route=='outlet-horeka' AND $act=='input')
{
	$ido=autonumber("outlet","id_outlet",4,"PLG");
	$tgl=date('Y-m-d');
	$rs=mysql_query("Insert into outlet (id_outlet,category_id,outlet_type,nama_outlet,npwp,kontak_outlet,alamat_outlet,alamat2_outlet,negara_outlet,kota_outlet,kodepos_outlet,email_outlet,telp_outlet,hp_outlet,fax_outlet,website_outlet,desc_outlet,jenis_outlet,employee_number,diskon,tgl_gabung) values ('".$ido."','".$_POST['kategori']."','".$_POST['tipe']."','".$_POST['nama']."','".$_POST['npwp']."','".$_POST['kontak']."','".$_POST['alamat_ho']."','".$_POST['alamat_kirim']."','".$_POST['negara']."','".$_POST['kota']."','".$_POST['kode_pos']."','".$_POST['email']."','".$_POST['telpon']."','".$_POST['hp']."','".$_POST['fax']."','".$_POST['website']."','Outlet Horeka','".$_POST['jenis']."','".$_POST['sales']."','".$_POST['diskon']."','$tgl')") or die(mysql_error());
	header('location:../../main.php?route='.$route.'&act');
}

//Update Outlet
elseif($route=='outlet-horeka' AND $act=='update')
{
	$date=date('Y-m-d');
	$rs=mysql_query("update outlet set category_id='$_POST[kategori]',
									   outlet_type='$_POST[tipe]',
									   nama_outlet='$_POST[nama]',
									   npwp='$_POST[npwp]',
									   kontak_outlet='$_POST[kontak]',
									   alamat_outlet='$_POST[alamat_ho]',
									   alamat2_outlet='$_POST[alamat_kirim]',
									   negara_outlet='$_POST[negara]',
									   kota_outlet='$_POST[kota]',
									   kodepos_outlet='$_POST[kode_pos]',
									   email_outlet='$_POST[email]',
									   telp_outlet='$_POST[telpon]',
									   hp_outlet='$_POST[hp]',
									   fax_outlet='$_POST[fax]',
									   website_outlet='$_POST[website]',
									   desc_outlet='Outlet Tradisional',
									   jenis_outlet='$_POST[jenis]',
									   employee_number='$_POST[sales]',
									   diskon='$_POST[diskon]' where id_outlet = '".$_POST['ido']."'") or die(mysql_error());
	header('location:../../main.php?route='.$route.'&act');
}

//Hapus Outlet
elseif($route=='outlet-horeka' AND $act=='hapus')
{
	mysql_query("delete from outlet where id_outlet = '$_GET[id]'");
	header('location:../../main.php?route='.$route.'&act');
}

//Tambah outlet kantor
elseif($route=='outlet-kantor' AND $act=='input')
{
	$ido=autonumber("outlet","id_outlet",4,"PLG");
	$tgl=date('Y-m-d');
	$rs=mysql_query("Insert into outlet (id_outlet,category_id,outlet_type,nama_outlet,npwp,kontak_outlet,alamat_outlet,alamat2_outlet,negara_outlet,kota_outlet,kodepos_outlet,email_outlet,telp_outlet,hp_outlet,fax_outlet,website_outlet,desc_outlet,jenis_outlet,employee_number,diskon,tgl_gabung) values ('".$ido."','".$_POST['kategori']."','".$_POST['tipe']."','".$_POST['nama']."','".$_POST['npwp']."','".$_POST['kontak']."','".$_POST['alamat_ho']."','".$_POST['alamat_kirim']."','".$_POST['negara']."','".$_POST['kota']."','".$_POST['kode_pos']."','".$_POST['email']."','".$_POST['telpon']."','".$_POST['hp']."','".$_POST['fax']."','".$_POST['website']."','Outlet Horeka','".$_POST['jenis']."','".$_POST['sales']."','".$_POST['diskon']."','$tgl')") or die(mysql_error());
	header('location:../../main.php?route='.$route.'&act');
}

//Update Outlet
elseif($route=='outlet-kantor' AND $act=='update')
{
	$date=date('Y-m-d');
	$rs=mysql_query("update outlet set category_id='$_POST[kategori]',
									   outlet_type='$_POST[tipe]',
									   nama_outlet='$_POST[nama]',
									   npwp='$_POST[npwp]',
									   kontak_outlet='$_POST[kontak]',
									   alamat_outlet='$_POST[alamat_ho]',
									   alamat2_outlet='$_POST[alamat_kirim]',
									   negara_outlet='$_POST[negara]',
									   kota_outlet='$_POST[kota]',
									   kodepos_outlet='$_POST[kode_pos]',
									   email_outlet='$_POST[email]',
									   telp_outlet='$_POST[telpon]',
									   hp_outlet='$_POST[hp]',
									   fax_outlet='$_POST[fax]',
									   website_outlet='$_POST[website]',
									   desc_outlet='Outlet Tradisional',
									   jenis_outlet='$_POST[jenis]',
									   employee_number='$_POST[sales]',
									   diskon='$_POST[diskon]' where id_outlet = '".$_POST['ido']."'") or die(mysql_error());
	header('location:../../main.php?route='.$route.'&act');
}

//Hapus Outlet
elseif($route=='outlet-kantor' AND $act=='hapus')
{
	mysql_query("delete from outlet where id_outlet = '$_GET[id]'");
	header('location:../../main.php?route='.$route.'&act');
}
}
?>
