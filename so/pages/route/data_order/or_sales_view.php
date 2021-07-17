<?php 
//session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser']))
{
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
  <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../../index.php><b>LOGIN</b></a></center>";
}else
{
  //$aksi="modul/mod_kategori/aksi_kategori.php";
  switch($_GET['act']){
  //Tampil Data Paket
    default:
    $tahun_ini=date('Y');
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="list-gds wow slideInUp" data-wow-duration=".5s" data-wow-delay="1.1s">
                <b>Order Request <small>Sales</small> - </b><?php echo $naper1.'<small> '.$naper2.' '.$ver;?></small>   
              </h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Beranda</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>


      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          
          <div class="card card-default">
            
            <!-- /.card-header -->
            <div class="card-body">
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="box">

              <div class="box-body">
                
                <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead style="background-color: #d2d6de;">
                      <tr>
                        <th>No.</th>
                        <th>No. Request</th>
                        <th>Tgl. Order</th>
                       <!--  <th>Kode Outlet</th> -->
                        <th style="width: 150px">Kode/Nama Outlet</th>
                        <th>Total Bayar</th>
                        <th>Payment</th>
                        <th>Tgl. Expired PO</th>
                        <th>Status PO</th>
                      </tr>
                    </thead>
                    <tbody style="font-size:90%">
                     <?php
					       //jadwal
                     $jadwal=mysql_query("SELECT * from orders where employee_number = '$_SESSION[employee_number]' and status_orders='$_GET[status_orders]'  order by id_orders desc");
                     $no=1;
                     while($j=mysql_fetch_array($jadwal))
                     {

                      $sql=mysql_query("SELECT * from orders_detail where id_orders='$j[id_orders]'");
                      $total=0;
                      $diskon=0;
                      while($s=mysql_fetch_array($sql))
                      {
                       $subtotal    = $s['harga'] * $s['jumlah']; 
                       $total_rp    = format_rupiah($total); 
                       $subtotal_rp = format_rupiah($subtotal); 
                       $diskon1     = $subtotal * $s['diskon1'];
                       $hasil_disc1 = $subtotal - $diskon1;
                       $diskon2     = $hasil_disc1 * $s['diskon2'];
                       $hasil_disc2 = $hasil_disc1 - $diskon2;
                       $subdiskon   = $diskon1 + $diskon2;
                       $total       = $total + $hasil_disc2;
                       $diskon      = $diskon + $subdiskon;
                     }
                     $ppn = $total * $j['ppn'];

                     ?>
                     <tr align="left">
                      <td><?php echo $no; ?></td>
                      <td><?php echo $j['id_orders']; ?></td>
                      <td><?php echo tgl_indo_short($j['tgl_order']); ?></td>
                      <!-- <td><?php echo $j['id_outlet']; ?></td> -->
                      <?php
              //outlet
                      $outlet=mysql_query("SELECT * from outlet where id_outlet='$j[id_outlet]'");
                      $o=mysql_fetch_array($outlet);
                      ?>
                      <td><?php echo "<i>".$o['id_outlet']."</i> - ".$o['nama_outlet']; ?></td>
                      <td align="right">Rp. <?php echo format_rupiah($total+$ppn); ?></td>
                      <td><?php echo $j['payment']; ?></td>
                      <td><?php echo tgl_indo($j['tgl_expired_po']); ?></td>
                      <?php
                        if($j['status_orders']=='Pending') 
                        {
                          echo "<td><button class='btn btn-sm bg-red-active' style='width:100%; border-radius:1px '>$j[status_orders]</td>";
                       }
                       elseif($j['status_orders']=='Setuju')
                       {
                         echo "<td><button class='btn btn-sm bg-green' style='width:100%; border-radius:1px '>$j[status_orders]</td>";
                       }
                       elseif($j['status_orders']=='Proses')
                       {
                         echo "<td><button class='btn btn-sm bg-orange' style='width:100%; border-radius:1px '>$j[status_orders]</td>";
                       }
                       elseif($j['status_orders']=='Kirim')
                       {
                         echo "<td><button class='btn btn-sm bg-yellow' style='width:100%; border-radius:1px '>$j[status_orders]</td>";
                       }
                       elseif($j['status_orders']=='diTerima')
                       {
                         echo "<td><button class='btn btn-sm bg-blue' style='width:100%; border-radius:1px '>$j[status_orders]</td>";
                       }
                       ?>

                  </tr>
                  <?php
                  $no++;
                }
                ?>
              </tbody>
            </table>
          </div>
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

//Form Detail OR
case "detail":
//orders
$order=mysql_query("SELECT * from orders where id_orders='$_GET[ido]'");
$o=mysql_fetch_array($order);
//toko
$toko=mysql_query("SELECT * from outlet where id_outlet='$o[id_outlet]'");
$p=mysql_fetch_array($toko);
//sales
$sales=mysql_query("SELECT employee_number,name_e from employee where employee_number = '$o[employee_number]'");
$ss=mysql_fetch_array($sales);
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Detail OR
      <small>View</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="main.php?route=home"><i class="fa fa-home"></i> Beranda</a></li>
      <li class="active">Order Request</li>
      <li class="active">Detail OR</li>
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
            <div class="table-responsive">

              <table width="100%" border="0" class="list">

               <tr>
                 <td width="100px">No. Pelanggan</td>
                 <td width="500px">: <b><?php echo $p['id_outlet']; ?></b></td>
                 <td width="150px">No. OR</td>
                 <td>: <b><?php echo $o['id_orders']; ?>/ PO : <?php echo $o['keterangan_o']; ?></b></td>
               </tr>
               <tr>
                 <td width="130px">Nama Pelanggan</td>
                 <td>: <b><?php echo $p['nama_outlet']; ?></b></td>
                 <td width="100px">Tgl PO</td>
                 <td>: <b><?php echo tgl_indo($o['tgl_order']); ?></b></td>
               </tr>
               <tr>
                 <td width="100px">Alamat HO</td>
                 <td>: <b><?php echo $p['alamat_outlet']; ?></b></td>
                 <td width="100px">Tgl Jatuh Tempo</td>
                 <td>: <b><?php echo tgl_indo($o['tgl_jth_tempo']); ?></b></td>
               </tr>
               <tr>
                 <td width="100px" rowspan="2">Alamat Toko</td>
                 <td rowspan="2">: <b><?php echo $p['alamat2_outlet']; ?></b></td>
                 <td width="100px">Payment</td>
                 <td>: <b><?php echo $o['payment']; ?></b></td>
               </tr>
               <tr>


                <td width="100px">No. PO & Tgl. Exp PO</td>
                <td>: <b><?php echo $o['keterangan_o']; ?> - <?php echo tgl_indo($o['tgl_expired_po']); ?></b>
                </tr>
                <tr>
                 <td width="100px">NPWP Toko</td>
                 <td>: <b><?php echo $p['npwp']; ?></b>
                   <td width="100px">Status Orders</td>
                   <td>: <b><?php echo $o['status_orders']; ?></b></td>
                 </tr>
               </table>
             </td>

             
             <div class="table-responsive">

               <table width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-bordered table-striped">
                 <thead style="background-color: #d2d6de; font-size: 110%">
                  <tr bgcolor="#CCCCCC">
                    <td align="center"><b>No</b></td>
                    <td align="center"><b>Kode Barang</b></td>
                    <td align="center"><b>Nama Barang</b></td>
                    <td align="center"><b>Harga</b></td>   
                    <td align="center"><b>Jml (Pcs)</b></td>
                    <td align="center"><b>Diskon1</b></td>
                    <td align="center"><b>Diskon2</b></td>
                    <td align="center"><b>Sub Diskon</b></td>
                    <td align="center" width="160px"><b>Sub Total (Harga  x Beli x Diskon 1,2)</b></td>
                    <td align="center"><b>Aksi</b></td>
                  </tr>
                </thead>
                <?php
                $no = 1;
                $sql=mysql_query("SELECT * from orders_detail where id_orders='$_GET[ido]'");
                $total=0;
                $diskon=0;
                while($s=mysql_fetch_array($sql))
                {
                 $prd=mysql_query("SELECT * from produk where id_produk='$s[id_produk]'");
                 $t=mysql_fetch_array($prd);

                 $subtotal    = $s['harga'] * $s['jumlah']; 
                 $total_rp    = format_rupiah($total); 
                 $subtotal_rp = format_rupiah($subtotal); 
                 $diskon1     = $subtotal * $s['diskon1'];
                 $hasil_disc1 = $subtotal - $diskon1;
                 $diskon2     = $hasil_disc1 * $s['diskon2'];
                 $hasil_disc2 = $hasil_disc1 - $diskon2;
                 $subdiskon   = $diskon1 + $diskon2;
                 $total       = $total + $hasil_disc2;
                 $diskon      = $diskon + $subdiskon;
                 ?>
                 <tr bgcolor="#FFFFFF">
                  <td align="center"><?php echo $no; echo "<input type='hidden' name='id[$no]' value='$s[id_orders]'"; ?></td>
                  <td align="center"><?php echo $t['id_produk']; ?></td>
                  <td align="center"><?php echo $t['nama_produk']; ?></td>
                  <td align="center">Rp. <?php echo format_rupiah($s['harga']); ?></td>
                  <td align="center"><?php echo $s['jumlah']; ?></td>
                  <td align="center"><?php echo $s['diskon1']; ?></td>
                  <td align="center"><?php echo $s['diskon2']; ?></td>
                  <td align="center">Rp. <?php echo format_rupiah($subdiskon); ?></td>
                  <td align="center">Rp. <?php echo format_rupiah($hasil_disc2); ?></td>
                  <td align="center">
                    <?php
                    if ($o['status_orders']=="Waiting")
                    {
                      ?>
                      <a href="route/data_order/aksi_pr.php?route=pr&act=hapus&ido=<?php echo $s['id_orders']; ?>&idp=<?php echo $s['id_produk']; ?>" title="Hapus"><button class="btn btn-danger"><i class="fa fa-trash"> Hapus</i></button></a>

                      <a href="route/data_order/autocomplete3.php?ido=<?php echo $s['id_orders']; ?>&idp=<?php echo $s['id_produk']; ?>"><button class="btn btn-primary"><i class="fa fa-plus"></i> Edit</button></a>

                      <?php
                    }
                    ?>
                  </td>
                </tr>
                <?php
                $no++;
                $prd2=mysql_query("SELECT * from orders where id_orders='$s[id_orders]'");
                $q=mysql_fetch_array($prd2);
              }
              ?>
              <tr bgcolor="#FFFFFF" style="border:hidden;">
                <td align="right" colspan="11">
                  <h3>Sub Total : Rp. <?php echo format_rupiah($total); ?></h3>
                  <?php
                  $ppn = $total * $o['ppn'];
                  ?>

    <!-- <h4>PPN 10% : Rp. <?php echo format_rupiah($ppn); ?></h4>
      <b><a href="route/data_order_modern/aksi_pr.php?route=pr-modern&act=tambah-ppn&id=<?php echo $_GET['id']; ?>"><button class="btn btn-success">Add PPN 10%</button></a></b> -->
      <hr />
      <h4>Total Diskon : Rp. <?php echo format_rupiah($diskon); ?></h4>
      <h4>PPn 10% : Rp. <?php echo format_rupiah($ppn); ?></h4>
      <h3>Total Bayar : Rp. <?php echo format_rupiah($total+$ppn); ?></h3>
      
    </td>
  </tr>
  <?php
  $x=mysql_query("SELECT * from orders where id_orders='$_GET[ido]'");
  $y=mysql_fetch_array($x);
  ?>
</table>
</div>

<input type="button" name="kembali" class="btn btn-primary" value="Kembali ..." onclick="location.href = 'main.php?route=order-request&act';" style="cursor:pointer;" />
</div>
</div><!-- /.box-body -->
</div><!-- /.box -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php
break;
//mulai case

case "tambah2":
?>
<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <img src="../images/logo.png" width="100px" /> Penambahan Data
      <small>Barang</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="main.php?route=home"><i class="fa fa-home"></i> Beranda</a></li>
      <li class="active">Order Request</li>
      <li class="active">Penambahan Data Barang</li>
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
            <!--<a href="main.php?route=fit"><button class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</button></a>
              <br><br>-->
              <h3 class="box-title">Detail Data FIT</h3><br />
            </div>
            
            <div class="box-body">

              <!-- <form role="form" action="route/aksi_pr.php?route=pr-modern&act=input-lagi" method="post"> -->
                <form method="post" action="aksi_pr.php?route=pr&act=input-lagi">
                  <table id="" class="table table-bordered table-striped">
                    <thead>
                      <tr align="center">
                        <th colspan="3">
                          <input type="button" class="addRow btn btn-success" style="width: 100%" value="TAMBAH BARANG" />
                        </th>
                      </tr>
                      <tr align="center">
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>QTY</th>
                        <th>Disc1</th>
                        <th>Disc2</th>
                        <th width="50px"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $ndata = mysql_num_rows(mysql_query("SELECT id_orders FROM orders_detail WHERE id_orders='$_GET[ido]'"));
                      if($ndata > 0){
                        $adata = mysql_query("SELECT * FROM orders_detail  where id_orders='$_GET[ido]' ORDER BY id_orders ASC");
                        while($dp = mysql_fetch_array($adata)){
                          ?>
                          <tr>
                            <td>
                              <input type="text" class="form-control" placeholder="Nama Barang ..." name="produk[]" value="<?php echo $dp["id_produk"];?>" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" />
                            </td>
                            <td>
                              <input type="text" class="form-control" placeholder="QTY ..." name="harga[]" value="<?php echo $dp["harga"];?>" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" />
                            </td>
                            <td>
                              <input type="text" class="form-control" placeholder="QTY ..." name="jumbel[]" value="<?php echo $dp["jumlah"];?>" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" />
                            </td>
                            <td>
                              <input type="text" class="form-control" placeholder="QTY ..." name="disc1l[]" value="<?php echo $dp["diskon1"];?>" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" />
                            </td>
                            <td>
                              <input type="text" class="form-control" placeholder="QTY ..." name="disc2[]" value="<?php echo $dp["diskon2"];?>" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" />
                            </td>
                            <td>
                              <input type="button" class="delRow  btn btn-danger" value="DEL"/>
                            </td>
                          </tr>
                          <?php
                        }
                      }
                      else{
                        ?>
                        <tr>
                          <td>
                            <input type="text" class="form-control" placeholder="Nama Barang ..." name="produk[]" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" required />
                          </td>
                          <td>
                            <input type="text" class="form-control" placeholder="QTY ..." name="jumbel[]" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" required />
                          </td>
                          <td>
                            <input type="button" class="delRow  btn btn-danger" value="DEL"/>
                          </td>
                        </tr>
                        <?php
                      }
                      ?>
                      <tr>
                        <th colspan="3">
                          <input type="hidden" name="id_orders" value="<?php echo $_GET["ido"];?>">
                          <input type="submit" name="simpan" class="btn btn-primary" value="PROSES ..." />
                          <input type="button" name="kembali" class="btn btn-primary" value="Kembali ..." onclick="location.href = 'main.php?route=order-request-mod';" style="cursor:pointer;" />
                        </th>
                      </tr>


                    </tbody>
                  </table>
                </form>
                
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <script src="../js/jquery-1.8.1.min.js" type="text/javascript"></script>
    <script src="../js/jquery.table.addrow.js" type="text/javascript"></script>
    <script type="text/javascript">
      (function($){
        $(document).ready(function(){
          $(".addRow").btnAddRow();
          $(".delRow").btnDelRow();
        });
      })(jQuery);
    </script>
    <?php
    break;

//habis case
  }
}
?>