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

//Hapus Barang
if($route=='produk' AND $act=='hapus')
{
	mysql_query("delete from gudang_kecil where id_produk_k = '$_GET[id]'");
	header('location:../../main.php?route='.$route);
}

//Update Barang
elseif($route=='produk' AND $act=='edit')
{
	$rs=mysql_query("update gudang_kecil set id_supp='$_POST[ids]',
									   nama_produk_k='$_POST[nama]',
									   id_cat_produk='$_POST[idc]',
									   isiperctn_k='$_POST[isictn]',
									   satuan_k='$_POST[satuan]',
									   ukuran_k='$_POST[ukuran]',
									   ukuran_isi_k='$_POST[ukuran_isi]',
									   total_stok_k='$_POST[stok]',
									   stok_min_k='$_POST[stok_min]',
									   stok_max_k='$_POST[stok_max]',
									   hrg_tradisional_k='$_POST[harga_trad]',
									   hrg_modern_k='$_POST[harga_mod]',
									   hrg_beli_k='$_POST[hpp]',
									   expired_k='$_POST[tgl_ekspired]',
									   jenis_k='$_POST[jenis]' where id_produk_k = '".$_POST['idp']."'") or die(mysql_error());
	header('location:../../main.php?route='.$route);
}

//Tambah Barang
elseif($route=='produk' AND $act=='input')
{
	$idp=autonumber("gudang_kecil","id_produk_k",4,"BRG");
	$rs=mysql_query("Insert into gudang_kecil (id_produk_k,id_supp,nama_produk_k,id_cat_produk,isiperctn_k,satuan_k,ukuran_k,ukuran_isi_k,total_stok_k,stok_min_k,stok_max_k,hrg_tradisional_k,hrg_modern_k,hrg_beli_k,expired_k,jenis_k) values ('".$idp."','".$_POST['ids']."','".$_POST['nama']."','".$_POST['idc']."','".$_POST['isictn']."','".$_POST['satuan']."','".$_POST['ukuran']."','".$_POST['ukuran_isi']."','".$_POST['stok']."','".$_POST['stok_min']."','".$_POST['stok_max']."','".$_POST['harga_trad']."','".$_POST['harga_mod']."','".$_POST['hpp']."','".$_POST['tgl_ekspired']."','".$_POST['jenis']."')") or die(mysql_error());
	header('location:../../main.php?route='.$route);
}

elseif($route=='produk-kantor' AND $act=='hapus')
{
	mysql_query("delete from produk where id_produk = '$_GET[id]'");
	header('location:../../main.php?route='.$route);
}

//Update Barang
elseif($route=='produk-kantor' AND $act=='edit')
{
	$rs=mysql_query("update produk set id_supp = '$_POST[ids]',
									   nama_produk = '$_POST[nama]',
									   id_cat_produk = '$_POST[idc]',
									   isiperctn = '$_POST[isictn]',
									   satuan = '$_POST[satuan]',
									   ukuran = '$_POST[ukuran]',
									   ukuran_isi = '$_POST[ukuran_isi]',
									   stok_gudang = '$_POST[stok_gudang]',
									   stok_kantor = '$_POST[stok_kantor]',
									   stok_min = '$_POST[stok_min]',
									   stok_max = '$_POST[stok_max]',
									   hrg_tradisional = '$_POST[harga_trad]',
									   hrg_modern = '$_POST[harga_mod]',
									   hrg_beli = '$_POST[hpp]',
									   expired = '$_POST[tgl_ekspired]',
									   jenis = '$_POST[jenis]' where id_produk = '".$_POST['idp']."'") or die(mysql_error());
	header('location:../../main.php?route='.$route);
}

//Tambah Barang
elseif($route=='produk-kantor' AND $act=='input')
{
	$idp=autonumber("produk","id_produk",4,"BRG");
	$rs=mysql_query("Insert into produk (id_produk,id_supp,nama_produk,id_cat_produk,isiperctn,satuan,ukuran,ukuran_isi,total_stok,stok_min,stok_max,hrg_tradisional,hrg_modern,hrg_beli,expired,jenis) values ('".$idp."','".$_POST['ids']."','".$_POST['nama']."','".$_POST['idc']."','".$_POST['isictn']."','".$_POST['satuan']."','".$_POST['ukuran']."','".$_POST['ukuran_isi']."','".$_POST['stok']."','".$_POST['stok_min']."','".$_POST['stok_max']."','".$_POST['harga_trad']."','".$_POST['harga_mod']."','".$_POST['hpp']."','".$_POST['tgl_ekspired']."','".$_POST['jenis']."')") or die(mysql_error());
	header('location:../../main.php?route='.$route);
}
}
?>
