<?php
//session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
echo "<link href='style.css' rel='stylesheet' type='text/css'>
<center>Untuk mengakses modul, Anda harus login <br>";
echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
//$aksi="modul/mod_kategori/aksi_kategori.php";
switch($_GET['act']){
	//Tampil Data Paket
default:
?>
<!-- DATA TABLES -->
    <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <img src="../images/logo.png" width="100px" /> Aplikasi ERP v.2 Mitra Bersaudara
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="main.php?route=home"><i class="fa fa-home"></i> Beranda</a></li>
            <li class="active">Penjualan</li>
            <li class="active">Retur PO Tradisional</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">
              <!-- Custom tabs (Charts with tabs)-->
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data PO Tradisional</h3><br />
                  <button class="btn btn-primary" onclick="window.location='route/data_po_tradisional/autocomplete.php'"><i class="fa fa-plus"></i> Tambah Data</button>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>No. Faktur</th>
                        <th>Tgl. Order</th>
                        <th>Kode Outlet</th>
                        <th>Outlet</th>
                        <th>Total Bayar</th>
                        <th>Payment</th>
                        <th>Tgl. Expired PO</th>
                        <th>Status PO</th>
						<th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
					//jadwal
					$jadwal=mysql_query("select * from orders_t order by id_orders_t desc");
					$no=1;
					while($j=mysql_fetch_array($jadwal))
					{
						?>
                      <tr align="left">
                        <td><?php echo $no; ?></td>
                        <td><?php echo $j['id_orders_t']; ?></td>
                        <td><?php echo tgl_indo($j['tgl_order_t']); ?></td>
                        <td><?php echo $j['id_outlet']; ?></td>
                        <?php
                        //outlet
					$outlet=mysql_query("select * from outlet where id_outlet='$j[id_outlet]'");
					$o=mysql_fetch_array($outlet);
                    ?>
                        <td><?php echo $o['nama_outlet']; ?></td>
                        <td>Rp. <?php echo format_rupiah($j['total_bayar_t']); ?></td>
						<td><?php echo $j['payment_t']; ?></td>
                        <td><?php echo tgl_indo($j['tgl_expired_po_t']); ?></td>
                        <?php
						if($j['status_orders_t']=='Pending')
						{
							echo"<td bgcolor='#FF0000' style='color:#FFF;'>$j[status_orders_t]</td>";
						}
						elseif($j['status_orders_t']=='Printed')
						{
							echo"<td bgcolor='#FFFF00' style='color:#000;'>$j[status_orders_t]</td>";
						}
						elseif($j['status_orders_t']=='Delivered')
						{
							echo"<td bgcolor='#00FF00' style='color:#000;'>$j[status_orders_t]</td>";
						}
						?>
                        
                        <td><a href="main.php?route=po-tradisional&act=detail&id=<?php echo $j['id_orders_t']; ?>"><button class="btn btn-primary"><i class="fa fa-search"></i> Detail</button></a> <a href="route/data_po_tradisional/autocomplete2.php?id=<?php echo $j['id_orders_t']; ?>"><button class="btn btn-success"><i class="fa fa-plus"></i> Tambah</button></a></td>
                      </tr>
					 <?php
					 $no++;
					 }
					 ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </section><!-- /.Left col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	  
	  <!-- page script -->
    <script type="text/javascript">
      $(function () {
        $("#example1").dataTable();
        $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });
      });
    </script>
<?php
break;

//Form Detail PO
case "detail":
//orders
$order=mysql_query("select * from orders_t where id_orders_t='$_GET[id]'");
$o=mysql_fetch_array($order);
//toko
$toko=mysql_query("select * from outlet where id_outlet='$o[id_outlet]'");
$p=mysql_fetch_array($toko);
?>
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Detail PO Tradisional
            <small>View</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="main.php?route=home"><i class="fa fa-home"></i> Beranda</a></li>
            <li class="active">Transaksi</li>
            <li class="active">PO Tradisional</li>
            <li class="active">Detail PO Tradisional</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- right column -->
            <div class="col-md-12">
              <!-- general form elements disabled -->
              <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title">*Isi data dengan lengkap & jelas</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table width="100%" border="0" class="list">
	<tr>
    	<td width="100px">No. Pelanggan</td>
        <td>: <b><?php echo $p['id_outlet']; ?></b></td>
        <td width="150px">No. Faktur / Invoice</td>
        <td>: <b><?php echo $o['id_orders_t']; ?></b></td>
    </tr>
    <tr>
    	<td width="100px">Nama Pelanggan</td>
        <td>: <b><?php echo $p['nama_outlet']; ?></b></td>
        <td width="100px">Tgl PO</td>
        <td>: <b><?php echo tgl_indo($o['tgl_order_t']); ?></b></td>
    </tr>
    <tr>
    	<td width="100px">Alamat HO</td>
        <td>: <b><?php echo $p['alamat_outlet']; ?></b></td>
        <td width="100px">Tgl Jatuh Tempo</td>
        <td>: <b><?php echo tgl_indo($o['tgl_jth_tempo_t']); ?></b></td>
    </tr>
    <tr>
    	<td width="100px">Alamat Toko</td>
        <td>: <b><?php echo $p['alamat2_outlet']; ?></b></td>
        <td width="100px">Payment</td>
        <td>: <b><?php echo $o['payment_t']; ?></b></td>
    </tr>
    <tr>
    	<td width="100px">NPWP Toko</td>
        <td>: <b><?php echo $p['npwp']; ?></b>
        <td width="100px">No. PO & Tgl. Exp PO</td>
        <td>: <b><?php echo $o['keterangan_o_t']; ?> - <?php echo tgl_indo($o['tgl_expired_po_t']); ?></b>
    </tr>
    <tr>
    	<td width="100px"></td>
        <td></td>
        <td width="100px">Status Orders</td>
        <td>: <b><?php echo $o['status_orders_t']; ?></b></td>
    </tr>
</table>

<table width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-bordered table-striped">
  <tr bgcolor="#CCCCCC">
    <td align="center"><b>No</b></td>
    <td align="center"><b>Kode Barang</b></td>
    <td align="center"><b>Nama Barang</b></td>
    <td align="center"><b>Harga</b></td>   
    <td align="center"><b>Jml (Pcs)</b></td>
    <td align="center"><b>Diskon1</b></td>
    <td align="center"><b>Diskon2</b></td>
    <td align="center"><b>Sub Diskon</b></td>
    <td align="center"><b>Sub Total (Harga  x Beli x Diskon 1,2,3)</b></td>
    <td align="center"><b>Aksi</b></td>
  </tr>
  <?php
    $no = 1;
	$sql=mysql_query("select * from orders_detail_t where id_orders_t='$_GET[id]'");
	$total=0;
	$diskon=0;
  while($s=mysql_fetch_array($sql))
  {
	$prd=mysql_query("select * from produk where id_produk='$s[id_produk]'");
	$t=mysql_fetch_array($prd);
	
	$subtotal    = $s['harga_t'] * $s['jumlah_t']; 
	$total_rp    = format_rupiah($total); 
	$subtotal_rp = format_rupiah($subtotal); 
	$diskon1     = $subtotal * $s['diskon_t'];
	$hasil_disc1 = $subtotal - $diskon1;
	$diskon2     = $hasil_disc1 * $s['diskon2_t'];
	$hasil_disc2 = $hasil_disc1 - $diskon2;
	$subdiskon   = $diskon1 + $diskon2;
	$total       = $total + $hasil_disc2;
	$diskon      = $diskon + $subdiskon;
  ?>
  <tr bgcolor="#FFFFFF">
    <td align="center"><?php echo $no; echo "<input type='hidden' name='id[$no]' value='$s[id_orders_t]'"; ?></td>
    <td align="center"><?php echo $t['id_produk']; ?></td>
    <td align="center"><?php echo $t['nama_produk']; ?></td>
	<td align="center">Rp. <?php echo format_rupiah($s['harga_t']); ?></td>
    <td align="center"><?php echo $s['jumlah_t']; ?></td>
    <td align="center"><?php echo $s['diskon_t']; ?></td>
    <td align="center"><?php echo $s['diskon2_t']; ?></td>
    <td align="center">Rp. <?php echo format_rupiah($subdiskon); ?></td>
    <td align="center">Rp. <?php echo format_rupiah($hasil_disc2); ?></td>
    <td align="center"><a href="route/data_po_tradisional/aksi_po.php?route=po-tradisional&act=hapus&id=<?php echo $s['id_orders_t']; ?>&idp=<?php echo $s['id_produk']; ?>"><button class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button></a></td>
  </tr>
  <?php
  $no++;
  $prd2=mysql_query("select * from orders_t where id_orders_t='$s[id_orders_t]'");
	$q=mysql_fetch_array($prd2);
  }
  ?>
  <tr bgcolor="#FFFFFF" style="border:hidden;">
    <td align="right" colspan="11">
    <h4>Sub Total : Rp. <?php echo format_rupiah($total); ?></h4>
    <h4>Total Diskon : Rp. <?php echo format_rupiah($diskon); ?></h4>
    <?php
	$ppn = $total * $o['ppn_t'];
	?>
    <h4>PPN 10% : Rp. <?php echo format_rupiah($ppn); ?></h4>
    <b><a href="route/data_po_tradisional/aksi_po.php?route=po-tradisional&act=tambah-ppn&id=<?php echo $_GET['id']; ?>"><button class="btn btn-success">Add PPN 10%</button></a></b>
    <h4>Ubah Status PO : </h4><form method="post"><input type="hidden" value="<?php echo $o['id_orders_t']; ?>" name="id" /><select name="status_orders">
    											   <?php
												   if($o['status_orders_t']=='Pending')
												   {
													   echo"<option value='Pending' selected>Pending</option>
													   <option value='Printed'>Printed</option>
													   <option value='Delivered'>Delivered</option>";
												   }
												   elseif($o['status_orders_t']=='Printed')
												   {
													   echo"<option value='Pending'>Pending</option>
													   <option value='Printed' selected>Printed</option>
													   <option value='Delivered'>Delivered</option>";
												   }
												   else
												   {
													   echo"<option value='Pending'>Pending</option>
													   <option value='Printed'>Printed</option>
													   <option value='Delivered' selected>Delivered</option>";
												   }
												   ?>
                                                   </select> <button type="submit" name="proses" class="btn btn-primary">Proses...</button></form>
    <hr />
    <h3>Total Bayar : Rp. <?php echo format_rupiah($o['total_bayar_t']); ?></h3>
    </td>
  </tr>
  <?php
  $x=mysql_query("select * from orders_t where id_orders_t='$_GET[id]'");
  $y=mysql_fetch_array($x);
  ?>
</table>
<?php
if(isset($_POST['proses']))
{
	  // Update stok barang saat transaksi sukses (Lunas)
   if ($_POST['status_orders']=='Printed'){ 
    
      // Update untuk mengurangi stok 
      $cek=mysql_query("UPDATE produk,orders_detail_t SET produk.total_stok=produk.total_stok-orders_detail_t.jumlah_t WHERE produk.id_produk=orders_detail_t.id_produk and orders_detail_t.id_orders_t='$_POST[id]'");
	  if($cek)
	  {
		  echo"<script>alert('Status PO Printed :)');</script>";
	  }
	  else
	  {
		  echo"<script>alert('Status PO Printed :(');</script>";
	  }

      // Update status order
      mysql_query("UPDATE orders_t SET status_orders_t='$_POST[status_orders]' where id_orders_t='$_POST[id]'");

      echo"<script>window.location='main.php?route=po-tradisional'</script>";
    }	  
	  elseif($_POST['status_orders']=='Pending'){
	    // Update untuk menambah stok
	    $cek2=mysql_query("UPDATE produk,orders_detail_t SET produk.total_stok=produk.total_stok+orders_detail_t.jumlah_t WHERE produk.id_produk=orders_detail_t.id_produk and orders_detail_t.id_orders_t='$_POST[id]'");
		if($cek2)
	  	{
		  echo"<script>alert('Status PO Pending :)');</script>";
	  	}
	  	else
	  	{
		  echo"<script>alert('Status PO Pending :(');</script>";
	  	} 

	    // Update status order Batal
      mysql_query("UPDATE orders_t SET status_orders_t='$_POST[status_orders]' where id_orders_t='$_POST[id]'");

	    echo"<script>window.location='main.php?route=po-tradisional'</script>";
	  }
	  else{
	    // Update status order Delivered
      mysql_query("UPDATE orders_t SET status_orders_t='$_POST[status_orders]' where id_orders_t='$_POST[id]'");

	    echo"<script>window.location='main.php?route=po-tradisional'</script>";
	  }
}
?>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              
              <!-- general form elements disabled -->
              <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title">*Data Surat Jalan</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
<table width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-bordered table-striped">
  <tr style="background-color:#CCC;">
    <td align="center"><b>No</b></td>
    <td align="center"><b>No. Invoice</b></td>   
    <td align="center"><b>Outlet</b></td>
    <td align="center"><b>Tgl Kirim</b></td>
    <td align="center"><b>Tgl Kembali</b></td>
    <td align="center"><b>Tgl Terima</b></td>
    <td align="center"><b>Pengirim</b></td>   
    <td align="center"><b>Checker</b></td>
    <td align="center"><b>Penerima</b></td>
    <td align="center"><b>Aksi</b></td>
  </tr>
  <?php
      $rw = mysql_query("SELECT * FROM surat_jalan where id_inv='$_GET[id]'");
      $no = 1;
  while($s=mysql_fetch_array($rw))
  {
  ?>
  <tr bgcolor="#FFFFFF">
    <td align="center"><?php echo $no; ?></td>
    <td align="center"><?php echo $s['id_inv']; ?></td>
    <?php
	$jenis=mysql_query("select * from outlet where id_outlet='$s[id_outlet]'");
	while($j=mysql_fetch_array($jenis))
	{
		echo"<td align='center'>$j[nama_outlet]</td>";
	}
	?>
    <td align="center"><?php echo $s['tgl_kirim']; ?></td>
    <td align="center"><?php echo $s['tgl_kembali']; ?></td>
    <?php 
	if($s['status_surat']=='Belum Diterima')
	{
		echo "<td align='center' bgcolor='#FF0000' style='color:#FFF;'>$s[tgl_terima]</td>";
	}
	else
	{
		echo "<td align='center' bgcolor='#0066FF' style='color:#FFF;'>$s[tgl_terima]</td>";
	}
	?>
    <td align="center"><?php echo $s['pengirim']; ?></td>
    <td align="center"><?php echo $s['checker']; ?></td>
    <td align="center"><?php echo $s['penerima']; ?></td>
    <td align="center"><a href="route/data_po_tradisional/aksi_po.php?route=po-tradisional&act=ubahstatus&id=<?php echo $s['id_inv']; ?>"><button class="btn btn-success"><i class="fa fa-pencil"></i> Update</button></a></td>
  </tr>
  <?php
  $no++;
  }
  
  ?>
</table>
<table width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-bordered table-striped">
  <tr style="background-color:#CCC;">
    <td align="center"><b>Biaya TOL</b></td>   
    <td align="center"><b>Biaya Parkir</b></td>
    <td align="center"><b>Biaya Checker</b></td>
    <td align="center"><b>Biaya Kuli</b></td>
    <td align="center"><b>Biaya Satpam</b></td>   
    <td align="center"><b>Checker Outlet</b></td>
  </tr>
  <?php
      $rws = mysql_query("SELECT * FROM surat_jalan where id_inv='$_GET[id]'");
      $no2 = 1;
  while($t=mysql_fetch_array($rws))
  {
  ?>
  <tr bgcolor="#FFFFFF">
    <td align="center">Rp. <?php echo format_rupiah($t['biaya_tol']); ?></td>
    <td align="center">Rp. <?php echo format_rupiah($t['biaya_parkir']); ?></td>
    <td align="center">Rp. <?php echo format_rupiah($t['biaya_checker']); ?></td>
    <td align="center">Rp. <?php echo format_rupiah($t['biaya_kuli']); ?></td>
    <td align="center">Rp. <?php echo format_rupiah($t['biaya_satpam']); ?></td>
    <td align="center">Rp. <?php echo format_rupiah($t['checker_outlet']); ?></td>
  </tr>
  <?php
  $no2++;
  }
  
  ?>
</table><br />
<b>Catatan : Tgl Terima Merah = Belum Diterima | Tgl Terima Biru = Sudah Diterima</b>
            </div><!--/.col (right) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<?php
break;

//Form Edit Paket
case "edit":
$edit=mysql_query("select * from paket where id_paket='$_GET[id]'");
$r=mysql_fetch_array($edit);
?>
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Edit Perwakilan Jamaah Alhijaz Indowisata
            <small>Biodata</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="main.php?route=home"><i class="fa fa-home"></i> Beranda</a></li>
            <li class="active">Data Master</li>
            <li class="active">Data Paket</li>
            <li class="active">Edit Data Paket</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- right column -->
            <div class="col-md-12">
              <!-- general form elements disabled -->
              <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title">*Isi data dengan lengkap & jelas</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <form role="form" action="route/data_paket/aksi_paket.php?route=paket&act=edit" method="post">
                    <!-- text input -->
                    <div class="form-group">
                      <label>ID Paket</label>
                      <input type="text" class="form-control" value="<?php echo $r['id_paket']; ?>" readonly="readonly" name="idp"/>
                    </div>
                    
                    <div class="form-group">
                      <hr />
                      <input type="submit" class="btn btn-primary" value="Update" />
                    </div>
                  </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!--/.col (right) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      
      
<?php
break;
}
}
?>