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

//Tambah retur
if($route=='retur' AND $act=='input')
{
	$idr=autonumber("retur","id_retur",4,"RET");
	$tgl=date('Y-m-d');

	if($_POST['tipe']=='Modern')
	{
		//orders
		$orders=mysql_query("select id_orders,id_outlet from orders where id_orders='$_POST[no_po]'");
		$o=mysql_fetch_array($orders);
		
		//simpan ke tabel retur
		$rs=mysql_query("Insert into retur (id_retur,id_orders,tgl_retur,id_outlet,tipe) values ('".$idr."','".$_POST['no_po']."','".$_POST['tgl_retur']."','".$o['id_outlet']."','".$_POST['tipe']."')") or die(mysql_error());
	}
	elseif($_POST['tipe']=='Tradisional')
	{
		//orders trad
		$orders=mysql_query("select id_orders_t,id_outlet from orders_t where id_orders_t='$_POST[no_po]'");
		$o=mysql_fetch_array($orders);
		
		//simpan ke tabel retur
		$rs=mysql_query("Insert into retur (id_retur,id_orders,tgl_retur,id_outlet,tipe) values ('".$idr."','".$_POST['no_po']."','".$_POST['tgl_retur']."','".$o['id_outlet']."','".$_POST['tipe']."')") or die(mysql_error());
	}
	
	//simpan ke tabel retur detail
	$rt=mysql_query("Insert into retur_detail (id_retur,id_produk,jumlah,alasan,restock) values ('".$idr."','".$_POST['produk']."','".$_POST['jumlah']."','".$_POST['alasan']."','".$_POST['restock']."')") or die(mysql_error());
	
	//restok
	if($_POST['restock']=='Ya')
	{
		//load data produk
		$produk=mysql_query("select id_produk,total_stok from produk where id_produk='$_POST[produk]'");
		$p=mysql_fetch_array($produk);
		$hitung=$p['total_stok'] + $_POST['jumlah'];
		//kembalikan ke stock
		$update=mysql_query("update produk set total_stok = '$hitung' where id_produk='$_POST[produk]'");
	}
	
	header('location:../../main.php?route='.$route);
}

//Tambah Retur Lagi
elseif($route=='retur' AND $act=='input-lagi')
{
	$idr=$_POST['id_retur'];
	$tgl=date('Y-m-d');
	
	//simpan ke tabel retur detail
	$rt=mysql_query("Insert into retur_detail (id_retur,id_produk,jumlah,alasan,restock) values ('".$idr."','".$_POST['produk']."','".$_POST['jumlah']."','".$_POST['alasan']."','".$_POST['restock']."')") or die(mysql_error());
	
	//restok
	if($_POST['restock']=='Ya')
	{
		//load data produk
		$produk=mysql_query("select id_produk,total_stok from produk where id_produk='$_POST[produk]'");
		$p=mysql_fetch_array($produk);
		$hitung=$p['total_stok'] + $_POST['jumlah'];
		//kembalikan ke stock
		$update=mysql_query("update produk set total_stok = '$hitung' where id_produk='$_POST[produk]'");
	}
	
	header('location:../../main.php?route='.$route);
}

//Hapus Retur
elseif($route=='retur' AND $act=='hapus')
{
	$hapus=mysql_query("select * from retur_detail where id_retur='$_GET[id]' AND id_produk='$_GET[idp]'");
	$h=mysql_fetch_array($hapus);
	mysql_query("delete from retur_detail where id_retur='$h[id_retur]' AND id_produk='$h[id_produk]'");
	// search
	 $cek=mysql_query("select * from retur_detail where id_retur='$h[id_retur]'");
	 $ketemu=mysql_num_rows($cek);
	 if($ketemu > 0)
	 {
		 //update stok
		$produk=mysql_query("select * from produk where id_produk='$h[id_produk]'");
  		$p=mysql_fetch_array($produk);
  		$habis=$p['total_stok']-$h['jumlah'];
		if($h['restock']=='Ya')
		{
	  		$update=mysql_query("update produk set total_stok='$habis' where id_produk='$p[id_produk]'");
	  		if($update)
			{
				echo "<script>alert('Data detail retur berhasil di hapus');</script>";
				echo "<script>window.location='../../main.php?route=retur&act=detail&id=$h[id_retur]';</script>";
			}
			else
			{
				echo "<script>alert('Data bongkar gagal di hapus');</script>";
				echo "<script>window.location='../../main.php?route=bongkarmuat';</script>";
			}
		}
		else
		{
				echo "<script>alert('Data detail retur berhasil di hapus');</script>";
				echo "<script>window.location='../../main.php?route=retur&act=detail&id=$h[id_retur]';</script>";
		}
	 }
	 else
	 {
		 mysql_query("delete from retur where id_retur='$h[id_retur]'");
		 //update stok
		$produk=mysql_query("select * from produk where id_produk='$h[id_produk]'");
  		$p=mysql_fetch_array($produk);
  		
  		$habis=$p['total_stok']-$h['jumlah'];
	  		if($h['restock']=='Ya')
		    {
	  			$update=mysql_query("update produk set total_stok='$habis' where id_produk='$p[id_produk]'");
	  			if($update)
				{
					echo "<script>alert('Data detail retur berhasil di hapus seluruhnya');</script>";
					echo "<script>window.location='../../main.php?route=retur';</script>";
				}
				else
				{
					echo "<script>alert('Data bongkar gagal di hapus');</script>";
					echo "<script>window.location='../../main.php?route=retur';</script>";
				}
			}
			else
			{
				echo "<script>alert('Data detail retur berhasil di hapus');</script>";
				echo "<script>window.location='../../main.php?route=retur';</script>";
			}
		 
	 }
}
}
?>
