<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser']))
{
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 	<center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else
{
	include"../../../config/koneksi.php";
	include"../../../config/fungsi_kode_otomatis.php";
	
	$route=$_GET['route'];
	$act=$_GET['act'];

	//Hapus Staff
	if($route=='staff' AND $act=='hapus')
	{
		//habpus staff di tebel employee
		mysql_query("DELETE from employee where employee_number='$_GET[ids]'");
		//hapus user di tabel user
		mysql_query("DELETE from user_login where employee_number='$_GET[ids]'");
		header('location:../../main.php?route='.$route);
	}

	//Update Staff
	elseif($route=='staff' AND $act=='edit')
	{
		$simpan=mysql_query("UPDATE employee set   
									name_e = '$_POST[nama]',
									birth_place = '$_POST[tempat]',
									birth_date = '$_POST[tgl_lahir]',
									alamat_e = '$_POST[alamat]',
									alamat2_e = '$_POST[alamat_lain]',
									city_e = '$_POST[kota]',
									zipcode_e = '$_POST[kode_pos]',
									telpon_e = '$_POST[telpon]',
									hp_e = '$_POST[hp]',
									email_e = '$_POST[email]' 
							WHERE employee_number = '$_POST[ids]'");

		header('location:../../main.php?route='.$route);
	}

	//Tambah Staff
	elseif($route=='staff' AND $act=='input')
	{

		$ids=autonumber("employee","employee_number",4,"MTR");
		$simpan=mysql_query("INSERT into employee 
									(employee_number,
									name_e,
									id_jabatan,
									birth_place,
									birth_date,
									alamat_e,
									alamat2_e,
									city_e,
									zipcode_e,
									telpon_e,
									hp_e,
									email_e) 
								values 
									('$ids',
									'$_POST[nama]',
									'$_POST[jabatan]',
									'$_POST[tempat]',
									'$_POST[tgl_lahir]',
									'$_POST[alamat]',
									'$_POST[alamat_lain]',
									'$_POST[kota]',
									'$_POST[kode_pos]',
									'$_POST[telpon]',
									'$_POST[hp]',
									'$_POST[email]')");

		// $simpan=mysql_query("INSERT INTO staff 
		// 							(nama_staff,jabatan,telp,email) 
		// 		values ('$_POST[nama]','$_POST[jabatan]','$_POST[telpon]','$_POST[email]')");

		header('location:../../main.php?route='.$route);
	}
}
?>
