<?php
session_start();
$dir="../../../../";
if (empty($_SESSION['username']) AND empty($_SESSION['passuser']))
{
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}else
{
	include $dir."config/koneksi.php";
	include $dir."config/fungsi_kode_otomatis.php";
	
	$route=$_GET['route'];
	$act=$_GET['act'];

//Hapus OR Detail
	if($route=='or' AND $act=='hapus')
	{
	//orders mod
		$omod=mysql_query("SELECT * from orders where id_orders = '$_GET[ido]'");
		$ot=mysql_fetch_array($omod);
		if($ot['status_orders']=='Setuju')
		{
			echo "<script>alert('Gagal hapus, Data Purchase Request sudah di Setujui !');</script>";
			echo "<script>window.location='../../main.php?route=order-request&act'</script>";
		}
		else
		{
			$hapus=mysql_query("SELECT * from orders_detail where id_orders='$_GET[ido]' AND id_produk='$_GET[idp]'");
			$h=mysql_fetch_array($hapus);
			mysql_query("DELETE from orders_detail where id_orders='$h[id_orders]' AND id_produk='$h[id_produk]'");
	// search
			$cek=mysql_query("SELECT * from orders_detail where id_orders='$h[id_orders]'");
			$ketemu=mysql_num_rows($cek);
			if($ketemu > 0)
			{
		 //orders detail
				$odt=mysql_query("SELECT * from orders_detail where id_orders='$h[id_orders]'");
				$total=0;
				$diskon=0;
				while($data=mysql_fetch_array($odt))
				{
					$subtotal = $data['harga'] * $data['jumlah'];
					$diskon1     = $subtotal * $data['diskon1'];
					$hasil_disc1 = $subtotal - $diskon1;
					$diskon2     = $hasil_disc1 * $data['diskon2'];
					$hasil_disc2 = $hasil_disc1 - $diskon2;
					$total       = $total + $hasil_disc2;
					$subdiskon   = $diskon1 + $diskon2;
					$diskon      = $diskon + $subdiskon;
				}
				
		 //orders
				$or=mysql_query("SELECT ppn from orders where id_orders = '$h[id_orders]'");
				$data2=mysql_fetch_array($or);
				$ppn2 = $total * $data2['ppn'];
				$grand = $total + $ppn2;
				mysql_query("UPDATE orders set total_bayar = '$grand', diskon_o='$diskon' where id_orders = '$h[id_orders]'"); 
				echo "<script>alert('Data barang berhasil dihapus');</script>";
				echo "<script>window.location='../../main.php?route=order-request&act=detail&ido=$_GET[ido]&idp=$_GET[idp]'</script>";
			}
			else
			{
				mysql_query("DELETE from orders where id_orders='$h[id_orders]'");
				echo "<script>alert('Data barang berhasil dihapus dari orders dan detail');</script>";
				echo "<script>window.location='../../main.php?route=order-request&act=detail&ido=$_GET[ido]&idp=$_GET[idp]'</script>";
			}
		}
	}

//tambah PPN
	elseif($route=='or' AND $act=='tambah-ppn')
	{
		$query=mysql_query("SELECT * from orders where id_orders = '$_GET[id]'");
		$q=mysql_fetch_array($query);
		if($q['ppn']=='0')
		{
			$ppn = $q['total_bayar'] * 0.1;
			$totall = $q['total_bayar'] + $ppn;
			$simpan=mysql_query("UPDATE orders set ppn = '0.1' ,
				total_bayar = '$totall' where id_orders = '$q[id_orders]'");
			header('location:../../main.php?route=order-request&act');
		}
		else
		{
			echo "<script>alert('PPN sudah pernah ditambahkan');</script>";
			echo "<script>window.location='../../main.php?route=order-request&act'</script>";
		}
	}

//Tambah OR
	elseif($route=='or' AND $act=='input')
	{
	//cek apakah stok barang masih ada
		$sql=mysql_query("SELECT stok_gudang from produk where id_produk='$_POST[produk]'");
		$r=mysql_fetch_array($sql);
		$stok = $r['stok_gudang'];
		if ($stok == 0){
			echo "<script>alert('stok produk habis');</script>";
			echo "<script>window.location='../../main.php?route=order-request&act'</script>";
		}
		else
		{ 
			$ido=autonumber("orders","id_orders",4,"OR");
			$jam=date('H:i:s');
			
	//hitung
			$subtotal = $_POST['harga'] * $_POST['jumbel'];
			$disc1 = $subtotal * $_POST['diskon1'];
			$hasil_disc1 = $subtotal - $disc1;

			$disc2 = $hasil_disc1 * $_POST['diskon2'];
			$hasil_disc2 = $hasil_disc1 - $disc2;
			
			$total_diskon = ($disc1 + $disc2);
			$xdisc=round($total_diskon);
			$xtotal=round($hasil_disc2);
			
	//orders
			$orders=mysql_query("INSERT into orders (id_orders,tgl_order,tgl_expired_po,tgl_jth_tempo,id_outlet,diskon_o,total_bayar,payment,employee_number,keterangan_o,manager) values ('$ido','$_POST[tgl_po]','$_POST[tgl_expired]','$_POST[tgl_tempo]','$_POST[kode]','$xdisc','$xtotal','$_POST[payment]','$_POST[en]','$_POST[nopo]','$_POST[manager]')");
			
	//orders detail
			$od=mysql_query("INSERT into orders_detail (id_orders,id_produk,jumlah,diskon1,diskon2,harga) values ('$ido','$_POST[produk]','$_POST[jumbel]','$_POST[diskon1]','$_POST[diskon2]','$_POST[harga]')");
			
			if($od)
			{
				echo "<script>alert('OR berhasil di input');</script>";
				echo "<script>window.location='../../main.php?route=order-request&act'</script>";
			}
			else
			{
				echo "<script>alert('OR gagal di input');</script>";
				echo "<script>window.location='../../main.php?route=order-request&act'</script>";
			}
		}
	}
//Edit OR
	elseif($route=='or' AND $act=='edit')
	{
		
		$query=mysql_query("SELECT * from orders where id_orders = '$_POST[ido]'");
		$q=mysql_fetch_array($query);

		$ppn = $q['ppn'];

		$detail=mysql_query("SELECT * from orders_detail where id_orders = '$_POST[ido]' AND id_produk = '$_POST[idp]' ");
		$d=mysql_fetch_array($detail);

		//Update detail
		$updetail=mysql_query("UPDATE orders_detail SET 
								id_produk = '$_POST[idp_baru]',
								jumlah = '$_POST[jumbel]',
								diskon1 = '$_POST[diskon1]',
								diskon2 = '$_POST[diskon2]',
								harga = '$_POST[harga]' 							
							WHERE id_orders = '$_POST[ido]' AND id_produk = '$_POST[idp]'  ");

	//hitung
		$totaldisc = 0 ;
		$totalakhir = 0;
		$total_diskon = 0 ;
		$proses=mysql_query("SELECT * from orders_detail where id_orders = '$_POST[ido]'  ");
		$no=1;
		while($p=mysql_fetch_array($proses))
		{
			$subtotal = $p['jumlah'] * $p['harga'];

			$t_disc1 = $subtotal * $p['diskon1'];

			$t_disc2 = ($subtotal - $t_disc1) * $p['diskon2'];

			$subdisc = $t_disc1 + $t_disc2 ;
			$totalitem = $subtotal - $subdisc ;

			$totaldisc =  $totaldisc + $subdisc;
			$totalakhir = round($totalakhir + $totalitem) ;
			$total_diskon = round($total_diskon + $subdisc) ;
		}

		
		$ppn = $totalakhir * $ppn ;
		$totalbayar = $totalakhir + $ppn ;


	//update order
		$up=mysql_query("UPDATE orders set diskon_o = '$totaldisc' ,
			total_bayar = '$totalbayar' where id_orders = '$_POST[ido]'");

		if($up)
		{
			echo "<script>alert('Data sudah di Update');</script>";
			echo "<script>window.location='../../main.php?route=order-request&act=detail&ido=$_POST[ido]'</script>";
		}
		else
		{
			echo "<script>alert('Update Gagal');</script>";
			echo "<script>window.location='../../main.php?route=order-request&act=detail&ido=$_POST[ido]&idp=$_POST[idp]'</script>";
		}
	}

//Tambah OR Lagi
	elseif($route=='or' AND $act=='input-lagi')
	{
	//cek apakah stok barang masih ada
		$sql=mysql_query("SELECT stok_kantor from produk where id_produk='$_POST[produk]'");
		$r=mysql_fetch_array($sql);
		$stok = $r['stok_kantor'];
		if ($stok == 0){
			echo "<script>alert('stok produk habis');</script>";
			echo "<script>window.location='../../main.php?route=order-request&act'</script>";
		}
		else
		{ 
	//jika stok barang tersedia, cek kembali apakah di tabel order detail sudah ada barang yang sama dengan id orders yang sama
			$periksa=mysql_query("SELECT id_produk FROM orders_detail WHERE id_produk='$_POST[produk]' AND id_orders='$_POST[ido]'");
			$oke=mysql_num_rows($periksa);
			if($oke==0)
			{
				
				$ido=$_POST['ido'];
				
	//hitung
				$subtotal = $_POST['harga'] * $_POST['jumbel'];
				$disc1 = $subtotal * $_POST['diskon1'];
				$hasil_disc1 = $subtotal - $disc1;
				$disc2 = $hasil_disc1 * $_POST['diskon2'];
				$hasil_disc2 = $hasil_disc1 - $disc2;
				$total_diskon = ($disc1 + $disc2);
				$xdisc=round($total_diskon);
				$xtotal=round($hasil_disc2);
				
	//orders
				$orders=mysql_query("UPDATE orders set diskon_o = diskon_o + $xdisc,
					total_bayar = total_bayar + $xtotal where id_orders = '$ido'"); 
				
	//orders detail
				$od=mysql_query("INSERT into orders_detail (id_orders,id_produk,jumlah,diskon1,diskon2,harga) values ('$ido','$_POST[produk]','$_POST[jumbel]','$_POST[diskon1]','$_POST[diskon2]','$_POST[harga]')");
				
				if($od)
				{
					echo "<script>alert('OR berhasil di input');</script>";
					echo "<script>window.location='../../main.php?route=order-request&act'</script>";
				}
				else
				{
					echo "<script>alert('OR gagal di input');</script>";
					echo "<script>window.location='../../main.php?route=order-request&act'</script>";
				}
			}
			else
			{
				echo "<script>alert('Barang sudah tersimpan, silahkan pilih barang yang lain');</script>";
				echo "<script>window.location='../../main.php?route=order-request&act'</script>";
			}
		}
	}
}
?>
