<?php
session_start();
 if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}else
{
	include"../../../config/koneksi.php";
	include"../../../config/fungsi_kode_otomatis.php";
	include"../../../config/library.php";
	
	$route=$_GET['route'];
	$act=$_GET['act'];
	$jam=date('G:i:s');
	$tgl=date('Y-m-d');

//Tambah Kunjungan
	if($route=='kunjungan' AND $act=='input')
	{

	//$ido=autonumber("orders","id_orders",4,"M");
		$jam=date('H:i:s');
		$outlet='';
		echo $_POST['jenis_kunjungan'];

		if ($_POST['jenis_kunjungan']=='lama')
		{
			$outlet=$_POST['kode'];
		}else
		{
			$outlet=$_POST['toko'];
		}
		//echo "<script>$_POST[toko]</script>";

	//kunjungan
		$ku=mysql_query("INSERT into kunjungan (employee_number ,
			tgl_kunjungan ,
			id_outlet ,
			order_po, 
			keterangan) 
			values ('$_SESSION[employee_number]',
			'$_POST[tgl_kunjungan]',
			'$outlet',
			'$_POST[order_po]',
			'$_POST[keterangan]') ");


		if($ku)
		{
			echo "<script>alert('ID Kunjungan berhasil di input');</script>";
			echo "<script>window.location='../../main.php?route=kunjungan&act'</script>";
		}
		else
		{
			echo "<script>alert('ID Kunjungan gagal di input');</script>";
			echo "<script>window.location='../../main.php?route=kunjungan&act'</script>";
		}

	}
//Tambah Kunjungan
	if($route=='kunjungan' AND $act=='edit')
	{

	//$ido=autonumber("orders","id_orders",4,"M");
		$jam=date('H:i:s');
		$outlet='';


		// if ($_POST['jenis_kunjungan']=='lama')
		// {
		// 	$outlet=$_POST['id_outlet'];
		// }else
		// {
		// 	$outlet=$_POST['toko'];
		// }

		//update kunjungan
		$ku=mysql_query("UPDATE kunjungan set tgl_kunjungan = '$_POST[tgl_kunjungan]' , jam_berangkat = '$_POST[jam_berangkat]', jam_pulang= '$_POST[jam_pulang]', id_outlet='$_POST[id_outlet]', order_po='$_POST[order_po]' ,keterangan='$_POST[ket]' where id_kunjungan = '$_POST[id_kunjungan]'");
		
	//kunjungan
		//$ku=mysql_query("INSERT into kunjungan (employee_number,tgl_kunjungan,id_outlet,keterangan) values ('$_SESSION[employee_number]','$_POST[tgl_kunjungan]','$outlet','$_POST[keterangan]') ");
		

		if($ku)
		{
			echo "<script>alert('ID Kunjungan berhasil di Update');</script>";
			echo "<script>window.location='../../main.php?route=kunjungan&act'</script>";
		}
		else
		{
			echo "<script>alert('ID Kunjungan gagal di Update');</script>";
			echo "<script>window.location='../../main.php?route=kunjungan&act'</script>";
		}
		
	}

//Cek kunjungna berangkat
	if($route=='kunjungan_berangkat' AND $act=='cek')
	{	
		//orders detail
		$cek=mysql_query("SELECT * from kunjungan where id_kunjungan='$_GET[id]' ");
		$h=mysql_fetch_array($cek);
		if($h['jam_berangkat']!='00:00:00')
			{
				echo "<script>alert('Maaf ! Jam Berangkat sudah berjalan');</script>";
				echo "<script>window.location='../../main.php?route=kunjungan&act'</script>";
			}else
			{
				//update start	
				$update = mysql_query("UPDATE kunjungan set jam_berangkat = '$jam' where id_kunjungan = '$_GET[id]'");
				echo "<script>window.location='../../main.php?route=kunjungan&act'</script>";
			}
		}

		//Cek kunjungna berangkat
		if($route=='kunjungan_pulang' AND $act=='cek')
		{	
		//orders detail
			$cek=mysql_query("SELECT * from kunjungan where id_kunjungan='$_GET[id]' ");
			$h=mysql_fetch_array($cek);
			if($h['jam_pulang']!='00:00:00')
				{
					echo "<script>alert('Maaf ! Jam Pulang sudah di Klik');</script>";
					echo "<script>window.location='../../main.php?route=kunjungan&act'</script>";
				}else
				{
				//update start	
					$update = mysql_query("UPDATE kunjungan set jam_pulang = '$jam' where id_kunjungan = '$_GET[id]'");
					echo "<script>window.location='../../main.php?route=kunjungan&act'</script>";
				}
		}
			

	}
?>
