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


//Tambah Target
	if($route=='target' AND $act=='input')
	{

//target

		$target=mysql_query("SELECT * from target where bulantahun='$_POST[tgl_target]' ");
		$t=mysql_fetch_array($target);

		if ($t)
		{
			echo "<script>alert('Bulan Tahun tersebut sdh Ada');</script>";
			echo "<script>window.location='../../route/data_target/autocomplete.php'</script>";
		}else
		{
			$inserttarget=mysql_query("INSERT into target 
				(bulantahun,target,ket)
				values ('$_POST[tgl_target]' , '0','') ");

			echo "<script>alert('Bulan Tahun target baru berhasil di buat');</script>";
			echo "<script>window.location='../../main.php?route=target'</script>";
		}		
	}

//Tambah employee
	elseif($route=='target' AND $act=='input-lagi')
	{
		
		$keys = $_POST["en"];
		$idtarget=$_POST['id'];
		$bulantahun=$_POST["bt"];
		$target=$_POST["target"];

		$resultp = array();

		foreach ($keys as $id => $key) 
		{
			$resultp[$key] = array(
				'bulantahun' => $bulantahun[$id],
				'target' => $target[$id],
				);

			if(!empty($key))
			{
				$hapus = mysql_query("DELETE FROM target_detail WHERE id_target='$idtarget' AND bulantahun='$bulantahun[$id]' AND employee_number='$key'");

				$detail=mysql_query("INSERT INTO target_detail 
					( id_target, bulantahun, employee_number,target )
					values 
					( '$idtarget','$bulantahun[$id]', '$key','$target[$id]') ");

				
				if(!$detail)
				{
					echo("<script>alert('Employee Number $key gagal update!');</script>");

				}
				//echo $idtarget." ".$bulantahun[$id]." ".$key." ".$target[$id]."<br>";
			}
		}
		echo "<script>window.location='../../main.php?route=target&act=detail&id=$idtarget'</script>";
	}
}
?>

