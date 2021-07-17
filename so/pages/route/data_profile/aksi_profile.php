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
	
	$route=$_GET['route'];
	$act=$_GET['act'];
	// echo $_POST['telpon'];
	// echo $_POST['ids'];


	//Update Profile
	if($route=='profile' AND $act=='edit')
	{
		$pass = md5($_POST['password']);
		if(empty($_POST['password']))
		{
			$simpan = mysql_query("UPDATE employee SET telpon_e = '$_POST[telpon]' WHERE employee_number='$_POST[ids]'");
			if($simpan)
			{
				echo "<script>alert('Data profile user berhasil diperbaharui');</script>";
				echo "<script>window.location='../../main.php?route=profile'</script>";
			}
			else
			{
				echo "<script>alert('Data profile user gagal diperbaharui');</script>";
				echo "<script>window.location='../../main.php?route=profile'</script>";
			}
		}
		else
		{
			$simpan = mysql_query("UPDATE employee SET telpon_e = '$_POST[telpon]' WHERE employee_number = '$_POST[ids]'");
			$simpans = mysql_query("UPDATE user_login SET password = '$pass' WHERE employee_number = '$_POST[ids]'");
			if($simpans)
			{
				echo "<script>alert('Data profile user berhasil diperbaharui');</script>";
				echo "<script>window.location='../../main.php?route=profile'</script>";
			}
			else
			{
				echo "<script>alert('Data profile user gagal diperbaharui');</script>";
				echo "<script>window.location='../../main.php?route=profile'</script>";
			}
		}
	}
}
?>
