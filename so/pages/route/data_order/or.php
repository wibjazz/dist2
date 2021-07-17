<?php 

$dir="../../";
//session_start();
$en = $_SESSION['employee_number'];

if (empty($_SESSION['username']) AND empty($_SESSION['passuser']))
{
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
  <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../../index.php><b>LOGIN</b></a></center>";
}else
{

  switch($_GET['act']){
  //Tampil Data Paket
    default:
    $tahun_ini=date('Y');
    ?>
    <!-- Tambahkan jqueryUI disini -->
    <script type="text/javascript" src="<?php echo $dir;?>jquery-ui/js/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="<?php echo $dir;?>jquery-ui/js/jquery-ui-1.10.4.custom.min.js"></script>
    <link type="text/css" rel="stylesheet" href="<?php echo $dir;?>jquery-ui/css/smoothness/jquery-ui-1.10.4.custom.min.css"/>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="list-gds wow slideInUp" data-wow-duration=".5s" data-wow-delay="1.1s">
                Order Request
              </h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                <li class="breadcrumb-item active">Order Request</li>
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
                      <button class="btn btn-primary btn-sm" onclick="window.location='route/data_order/autocomplete.php?en=<?php echo $_SESSION['employee_number']; ?> '"><i class="fa fa-plus"></i> Tambah Data</button>
                      <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                          <thead style="background-color: maroon;color: white;">
                            <tr>
                              <th>No.</th>
                              <th>No. OR</th>
                              <th>Tgl. Order</th>
                              <!--  <th>Kode Outlet</th> -->
                              <th style="width: 200px">Kode/Nama Outlet</th>
                              <th>Total Bayar</th>
                              <th>Payment</th>
                              <th>Tgl. Expired PO</th>
                              <th>Status PO</th>
                              <th>Option Aksi</th>
                            </tr>
                          </thead>
                          <tbody style="font-size:90%">
                           <?php
					               //jadwal
                           $jadwal=mysql_query("SELECT * from orders where employee_number = '$_SESSION[employee_number]'  order by id_orders desc limit 40");
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
                            
                            <?php
                            //outlet
                            $outlet=mysql_query("SELECT * from outlet where id_outlet='$j[id_outlet]'");
                            $o=mysql_fetch_array($outlet);
                            ?>
                            <td><?php echo "<small><i>".$o['id_outlet']."</i></small> - ".$o['nama_outlet']; ?></td>
                            <td align="right"><?php echo format_rupiah($total+$ppn); ?></td>
                            <td><?php echo $j['payment']; ?></td>
                            <td><?php echo tgl_indo_short($j['tgl_expired_po']); ?></td>


                            <?php
                            if($j['status_orders']=='Pending') 
                            {
                              echo "<td><button class='btn btn-xs bg-red' style='width:100%; border-radius:1px '>$j[status_orders]</td>";
                            }
                            elseif($j['status_orders']=='Setuju')
                            {
                             echo "<td><button class='btn btn-xs bg-green' style='width:100%; border-radius:1px '>$j[status_orders]</td>";
                           }
                           elseif($j['status_orders']=='Proses')
                           {
                             echo "<td><button class='btn btn-xs bg-orange' style='width:100%; border-radius:1px '>$j[status_orders]</td>";
                           }
                           elseif($j['status_orders']=='Kirim')
                           {
                             echo "<td><button class='btn btn-xs bg-yellow' style='width:100%; border-radius:1px '>$j[status_orders]</td>";
                           }
                           elseif($j['status_orders']=='diTerima')
                           {
                             echo "<td><button class='btn btn-xs bg-blue' style='width:100%; border-radius:1px '>$j[status_orders]</td>";
                           }
                           else
                           {
                             echo "<td><button class='btn btn-xs bg-white' style='width:100%; border-radius:1px '>$j[status_orders]</td>";
                           }
                           ?>

                           <td>

                            <div class="btn-group">
                              <button type="button" class="btn btn-primary dropdown-toggle btn-xs" data-toggle="dropdown">Action
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                              </button>
                              <ul class="dropdown-menu" role="menu">

                                <li><a href="main.php?route=order-request&act=detail&ido=<?php echo $j['id_orders']; ?>"><button class="btn btn-success"><i class="fa fa-search"></i> Detail</button></a></li>

                                <li><a href="route/data_order/cetak_or.php?ido=<?php echo $j['id_orders']; ?>"><button class="btn btn-danger"><i class="fa fa-print"></i> Print</button></a></li>
                              </ul>
                            </div>
                          </td>
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

    <script type="text/javascript">
      $(document).ready(function(){
        $("#kode").autocomplete({
          minLength:2,
          source:'get_product.php',
          select:function(event, ui){
            $('#nama-outlet').html(ui.item.nama);
            $('#alamat-outlet').html(ui.item.type);
          }
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
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="list-gds wow slideInUp" data-wow-duration=".5s" data-wow-delay="1.1s">
                Order Request <small>detail</small>
              </h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Order Request</li>
                <li class="breadcrumb-item active">Detail</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>


      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">

          <div class="card card-default">
            <div class="card-body">
              <div class="row">

                <!-- right column -->
                <div class="col-md-12">
                  <!-- general form elements disabled -->
                  <div class="box box-warning">
                    <div class="box-body">
                      <div class="table-responsive"> 

                        <table width="100%" border="0" class="table1">
                         <tr>
                           <td width="100px">No. Pelanggan</td>
                           <td width="500px">: <b><?php echo $p['id_outlet']; ?></b></td>
                           <td width="150px">No. OR</td>
                           <td>: <b><?php echo $o['id_orders']; ?>/ PO : <?php echo $o['keterangan_o']; ?></b></td>
                         </tr>

                         <tr>
                           <td width="150px">Nama Pelanggan</td>
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
                           <td width="100px">Alamat Toko</td>
                           <td >: <b><?php echo $p['alamat2_outlet']; ?></b></td>
                           <td width="100px">Payment</td>
                           <td >: <b><?php echo $o['payment']; ?></b></td>
                         </tr>

                         <tr>
                          <td width="100px">No. PO</td>
                          <td >: <b><?php echo $o['keterangan_o']; ?> </b></td>
                          <td >Tgl. Exp PO</td>
                          <td >: <?php echo tgl_indo($o['tgl_expired_po']); ?></td>
                        </tr>

                        <tr>
                         <td width="100px">NPWP Toko</td>
                         <td>: <b><?php echo $p['npwp']; ?></b></td>
                         <td width="100px">Status Orders</td>
                         <td>: <b><?php echo $o['status_orders']; ?></b></td>
                       </tr>
                     </table>


                     <div class="table-responsive">
                      <?php
                      if ($o['status_orders']=="Pending" )
                      {
                        ?>

                        <li><a href="main.php?route=order-request&act=tambah-lagi&ido=<?php echo $o['id_orders']; ?>"><button class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Tambah</button></a></li>
                        <?php
                      }
                      ?>

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
                        <td align="right">Rp. <?php echo format_rupiah($subdiskon); ?></td>
                        <td align="right">Rp. <?php echo format_rupiah($hasil_disc2); ?></td>
                        <td align="center">
                          <?php
                          if ($o['status_orders']=="Pending")
                          {
                            ?>
                            <a href="route/data_order/aksi_or.php?route=or&act=hapus&ido=<?php echo $s['id_orders']; ?>&idp=<?php echo $s['id_produk']; ?>" title="Hapus"><button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button></a>

                            <a href="main.php?route=order-request&act=edit&ido=<?php echo $s['id_orders']; ?>&idp=<?php echo $s['id_produk']; ?>&idb=<?php echo $t['nama_produk'] ?>"><button class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></button></a>

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
                      <td align="right" colspan="9"><h6>
                        Sub Total : Rp. <?php echo format_rupiah($total); ?></h6>
                        <?php
                        $ppn = $total * $o['ppn'];
                        ?>


                        <hr />
                        <h6>Total Diskon : Rp. <?php echo format_rupiah($diskon); ?></h6>
                        <h6>PPn 10% : Rp. <?php echo format_rupiah($ppn); ?></h6>
                        <h6><strong>Total Bayar : Rp. <?php echo format_rupiah($total+$ppn); ?></strong></h6>

                      </td>
                      <td></td>
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
        </div>
      </div>
    </div>
  </div>
</div>
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php
break;

//Form Tambah
case "tambah-lagi":

//order
$tambah=mysql_query("SELECT * from orders where id_orders = '$_GET[ido]'");
$t=mysql_fetch_array($tambah);

//outlet
$outlet=mysql_query("SELECT * from outlet where id_outlet = '$t[id_outlet]'");
$ot=mysql_fetch_array($outlet);
?>    
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="list-gds wow slideInUp" data-wow-duration=".5s" data-wow-delay="1.1s">
            Order Request <small>tambah</small>
          </h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Beranda</a></li>
            <li class="breadcrumb-item active">Order Request</li>
            <li class="breadcrumb-item active">tambah</li>
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
          <div class="row">
            <!-- right column -->
            <div class="col-md-12">
              <!-- general form elements disabled -->
              <div class="box box-warning">
                <div class="box-body">
                  <form role="form" action="route/data_order/aksi_or.php?route=or&act=input-lagi" method="post">

                    <label>A. Data PO</label>
                    <!-- text input -->
                    <div class="form-group">
                      <label>No. PO</label>
                      <input type="text" class="form-control" placeholder="Masukan No. PO yang tertera di Surat PO ..." name="no_po" value="<?php echo $t['keterangan_o'];?>" readonly/>
                    </div>

                    <label>B. Data Pelanggan</label>
                    <div class="form-group">
                      <label>Nama Pelanggan</label>
                      <input type="text" class="form-control" placeholder="Masukan No. PO yang tertera di Surat PO Modern ..." name="outlet" value="<?php echo $ot['id_outlet']." - ".$ot['nama_outlet'];?>" readonly/>
                    </div>

                    <label>C. Data Produk</label>
                    <div class="form-group">
                      <label>Nama Barang</label>
                      <select name="produk" class="form-control">
                       <?php
                        //produk
                       $produk=mysql_query("SELECT * from produk where jenis = 'Produk' order by nama_produk asc");
                       while($pro=mysql_fetch_array($produk))
                       {
                         echo"<option value='$pro[id_produk]'>$pro[id_produk] - $pro[nama_produk] - $pro[stok_gudang]</option>";
                       }
                       ?>
                     </select>
                   </div>

                   <div class="form-group">
                    <label>Harga Barang Rp.</label>
                    <input type="text" class="form-control" placeholder="Masukan harga produk ..." name="harga" required="" />
                  </div>

                  <div class="form-group">
                    <label>Jumlah Beli</label>
                    <input type="text" class="form-control" placeholder="Masukan jumlah beli ..." name="jumbel" required="" />
                  </div>

                  <div class="form-group">
                    <label>Diskon 1</label>
                    <input type="text" class="form-control" placeholder="Masukan diskon 1 ..." name="diskon1"/>
                  </div>

                  <div class="form-group">
                    <label>Diskon 2</label>
                    <input type="text" class="form-control" placeholder="Masukan diskon2 ..." name="diskon2"/>
                  </div>
                  <div class="form-group">
                    <hr />
                    <input type="hidden" name="ido" value="<?php echo $_GET['ido'];?>">
                    <input type="submit" class="btn btn-primary" value="Simpan" />
                  </div>

                </form>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!--/.col (right) -->
        </div>   <!-- /.row -->
      </div>
    </div>
  </div>
</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script>
  $(function() {
   $("#datepicker").datepicker({
    changeMonth:true,
    changeYear:true,
    dateFormat:'yy-mm-dd',
    yearRange:'-45:+10'
  });
 });
</script>


<?php
break;


//Form edit
case "edit":

//order
$tambah=mysql_query("SELECT * from orders where id_orders = '$_GET[ido]'");
$t=mysql_fetch_array($tambah);

//detail
$det=mysql_query("SELECT * from orders_detail where id_orders = '$_GET[ido]' and id_produk = '$_GET[idp]' ");
$fdet=mysql_fetch_array($det);

//outlet
$outlet=mysql_query("SELECT * from outlet where id_outlet = '$t[id_outlet]'");
$ot=mysql_fetch_array($outlet);
?>    
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="list-gds wow slideInUp" data-wow-duration=".5s" data-wow-delay="1.1s">
            OR <small>edit</small>
          </h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Beranda</a></li>
            <li class="breadcrumb-item active">Order Request</li>
            <li class="breadcrumb-item active">edit</li>
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
          <div class="row">
            <!-- right column -->
            <div class="col-md-12">
              <!-- general form elements disabled -->
              <div class="box box-warning">
                <div class="box-body">
                  <form role="form" action="route/data_order/aksi_or.php?route=or&act=edit" method="post">

                    <label>A. Data PO</label>
                    <!-- text input -->
                    <div class="form-group">
                      <label>No. PO</label>
                      <input type="text" class="form-control" placeholder="Masukan No. PO yang tertera di Surat PO Modern ..." name="no_po" value="<?php echo $t['keterangan_o'];?>" readonly/>
                    </div>

                    <label>B. Data Pelanggan</label>
                    <div class="form-group">
                      <label>Nama Pelanggan</label>
                      <input type="text" class="form-control" placeholder="Masukan No. PO yang tertera di Surat PO Modern ..." name="outlet" value="<?php echo $ot['id_outlet']." - ".$ot['nama_outlet'];?>" readonly/>
                    </div>

                    <label>C. Data Produk</label>
                    <div class="form-group">
                      <label>Nama Barang</label>
                      <select name="idp_baru" class="form-control">
                        <option value="<?php echo $_GET['idp'];?>"><?php echo $_GET['idp']." - ".$_GET['idb'];?></option>
                       <?php
                        //produk
                       $produk=mysql_query("SELECT * from produk where jenis = 'Produk' order by nama_produk asc");
                       while($pro=mysql_fetch_array($produk))
                       {
                         echo"<option value='$pro[id_produk]'>$pro[id_produk] - $pro[nama_produk] - $pro[stok_gudang]</option>";
                       }
                       ?>
                     </select>
                   </div>

                   <div class="form-group">
                    <label>Harga Barang Rp.</label>
                    <input type="text" class="form-control" placeholder="Masukan harga produk ..." name="harga" value="<?php echo $fdet['harga'];?>" />
                  </div>

                  <div class="form-group">
                    <label>Jumlah Beli</label>
                    <input type="text" class="form-control" placeholder="Masukan jumlah beli ..." name="jumbel" value="<?php echo $fdet['jumlah'];?>" />
                  </div>

                  <div class="form-group">
                    <label>Diskon 1</label>
                    <input type="text" class="form-control" placeholder="Masukan diskon 1 ..." name="diskon1" value="<?php echo $fdet['diskon1'];?>" />
                  </div>

                  <div class="form-group">
                    <label>Diskon 2</label>
                    <input type="text" class="form-control" placeholder="Masukan diskon2 ..." name="diskon2" value="<?php echo $fdet['diskon2'];?>" />
                  </div>
                  <div class="form-group">
                    <hr />
                    <input type="hidden" name="ido" value="<?php echo $_GET['ido'];?>">
                    <input type="hidden" name="idp" value="<?php echo $_GET['idp'];?>">
                    <input type="submit" class="btn btn-primary" value="Simpan" />
                  </div>

                </form>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!--/.col (right) -->
        </div>   <!-- /.row -->
      </div>
    </div>
  </div>
</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script>
  $(function() {
   $("#datepicker").datepicker({
    changeMonth:true,
    changeYear:true,
    dateFormat:'yy-mm-dd',
    yearRange:'-45:+10'
  });
 });
</script>


<?php
break;


//edit data
case "edit_":


//employee
$employee=mysql_query("SELECT employee_number,name_e from employee where employee_number = '$en'");
$e = mysql_fetch_array($employee);
//link
$tambah=mysql_query("SELECT * from orders where id_orders = '$_GET[ido]'");
$t=mysql_fetch_array($tambah);

//outlet
$outlet=mysql_query("SELECT * from outlet where id_outlet = '$t[id_outlet]'");
$ot=mysql_fetch_array($outlet);

//detail
$detail=mysql_query("SELECT * from orders_detail where id_orders = '$_GET[ido]' and id_produk = '$_GET[idp]'");
$d=mysql_fetch_array($detail);

//produk
$produk=mysql_query("SELECT * from produk where id_produk='$_GET[idp]' ");
$pro=mysql_fetch_array($produk);

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="list-gds wow slideInUp" data-wow-duration=".5s" data-wow-delay="1.1s">
            Order Request <small>edit</small>
          </h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">Order Request</li>
            <li class="breadcrumb-item active">edit</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">

      <div class="card card-default">
        <div class="card-body">

          <!-- Main row -->
          <div class="row" >
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">
              <!-- Custom tabs (Charts with tabs)-->
              <div class="box" style="background-color: #eee">
                <div class="box-header" style="margin-top: -20px">
                  <h3 class="box-title"><h6>Form edit</h6></h3><br />

                </div><!-- /.box-header -->
                <div class="box-body" style="margin-top: -30px" >
                  <table id="example1" class="table-responsive">

                    <form method="post" action="route/data_order/aksi_or.php?route=or&act=edit">
                      <table width="50%" border="0" align="center" class="table table-responsive" >
                       <tr>
                         <td colspan="3"><h6>A. Data Order Request</h6></td>
                       </tr>
                       <tr>
                         <td>Sales/Kasir</td>
                         <td>:</td><td> 
                          <input type="text" name="nama" style="min-width:200px;" value="<?php echo $e['name_e']; ?>" readonly/></td>
                        </tr>

                        <tr>
                         <td>No. OR</td>
                         <td>:</td><td> <input type="text" style="width:200px;" value="<?php echo $t['id_orders']; ?>" name="ido" readonly /></td>
                       </tr>

                       <tr>
                         <td>No.PO</td>
                         <td>:</td><td> <input type="text" style="width:200px;" value="<?php echo $t['keterangan_o']; ?>" name="nopo" readonly /></td>
                       </tr>

                       <tr>
                         <td colspan="3"><h6>B. Data Barang</h6></td>
                       </tr>

                       <tr>
                         <td>Nama Barang</td>
                         <td>:</td><td> <select name="produk"  style="width:200px;"><option value="<?php echo $d['id_produk'];?>"><?php echo $d['id_produk'];?></option>
                           <?php

                           $produk=mysql_query("select * from produk order by nama_produk asc");
                           while($pro=mysql_fetch_array($produk))
                           {
                             echo "<option value='$pro[id_produk]'>$pro[id_produk] - $pro[nama_produk] - $pro[stok_gudang] pcs</option>";
                           }
                           ?>
                         </select></td>
                       </tr>

                       <tr>
                         <td>Harga Barang Rp.</td>
                         <td>:</td><td> <input type="text" style="width:200px;" placeholder="Masukan harga produk ..." name="harga" value="<?php echo $d['harga']; ?>" required/></td>
                       </tr>
                       <tr>
                         <td>Jumlah Beli</td>
                         <td>:</td><td> <input type="text" style="width:200px;" placeholder="Masukan jumlah beli ..." name="jumbel"  value="<?php echo $d['jumlah']; ?>" required/></td>
                       </tr>
                       <tr>
                         <td>Diskon 1</td>
                         <td>:</td><td> <input type="text" style="width:200px;" placeholder="Masukan diskon 1 ..." name="diskon1" value="<?php echo $d['diskon1']; ?>" /></td>
                       </tr>
                       <tr>
                         <td>Diskon 2</td>
                         <td>:</td><td> <input type="text" style="width:200px;" placeholder="Masukan diskon 2 ..." name="diskon2" value="<?php echo $d['diskon2']; ?>"/></td>
                       </tr>
                       <tr>
                         <td colspan="3">
                          <input type="hidden" name="en" value="<?php echo $e['employee_number']; ?>" />
                          <input type="hidden" name="ido" value="<?php echo $_GET['ido']; ?>" />
                          <input type="hidden" name="idp" value="<?php echo $_GET['idp']; ?>" />
                          <input type="submit" class="btn btn-primary" value="Simpan" /></td>
                        </tr>
                      </table>
                    </form>

                  </table>
                </div>
              </div>
            </section>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- jQuery -->

<?php
break;
//mulai case

case "edit2":

    //link
$tambah=mysql_query("SELECT * from orders where id_orders = '$_GET[ido]'");
$t=mysql_fetch_array($tambah);

//outlet
$outlet=mysql_query("SELECT * from outlet where id_outlet = '$t[id_outlet]'");
$ot=mysql_fetch_array($outlet);

//detail
$detail=mysql_query("SELECT * from orders_detail where id_orders = '$_GET[ido]' and id_produk = '$_GET[idp]'");
$d=mysql_fetch_array($detail);

//produk
$produk=mysql_query("SELECT * from produk where id_produk='$_GET[idp]' ");
$pro=mysql_fetch_array($produk);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="list-gds wow slideInUp" data-wow-duration=".5s" data-wow-delay="1.1s">
            Order Request <small>edit</small></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Beranda</a></li>
              <li class="breadcrumb-item active">Order Request</li>
              <li class="breadcrumb-item active">edit</li>
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
                  <div class="box-body" style="margin-top: -70px">
                    <table id="example1" class="table table-bordered table-striped">

                      <form method="post" action="aksi_or.php?route=or&act=edit">
                        <table width="50%" border="0" align="center">
                         <tr>
                           <td colspan="3"><h6>A. Data Order Request</h6></td>
                         </tr>
                         <tr>
                           <td width="40%">No. OR</td>
                           <td>:</td><td> <input type="text" style="width:350px;" value="<?php echo $t['id_orders']; ?>" name="ido" readonly /></td>
                         </tr>
                         <tr>
                           <td>No. Surat Pesanan PO</td>
                           <td>:</td><td> <input type="text" style="width:350px;" value="<?php echo $t['keterangan_o']; ?>" name="nopo" readonly /></td>
                         </tr>
                         <tr>
                           <td>Tgl PO</td>
                           <td>:</td><td> <input type="text" name="tgl_po" style="width:350px;" data-inputmask="'alias': 'yyyy-mm-dd'" value="<?php echo $t['tgl_order']; ?>" readonly data-mask /></td>
                         </tr>
                         <tr>
                           <td>Tgl. Expired PO</td>
                           <td>:</td><td> <input type="text" value="<?php echo $t['tgl_expired_po']; ?>" readonly name="tgl_expired" style="width:350px;" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask /></td>
                         </tr>
                         <tr>
                           <td>Tgl. Jatuh Tempo</td>
                           <td>:</td><td> <input type="text" value="<?php echo $t['tgl_jth_tempo']; ?>" readonly name="tgl_tempo" style="width:350px;" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask /></td>
                         </tr>
                         <tr>
                           <td colspan="3"><h6>C. Data Barang</h6></td>
                         </tr>
                         <tr>
                           <td>Nama Barang</td>
                           <td>:</td><td> <select name="produk" style="width:350px;">
                             <?php

                             $produk=mysql_query("SELECT * from produk  order by nama_produk asc");
                             while($pro=mysql_fetch_array($produk))
                             {
                               echo"<option value='$pro[id_produk]'>$pro[id_produk] - $pro[nama_produk] - $pro[stok_kantor] pcs</option>";
                             }
                             ?>
                           </select></td>
                         </tr>
                         <tr>
                           <td>Harga Barang Rp.</td>
                           <td>:</td><td> <input type="text" style="width:350px;" placeholder="Masukan harga produk ..." name="harga" value="<?php echo $d['harga']; ?>"/></td>
                         </tr>
                         <tr>
                           <td>Jumlah Beli</td>
                           <td>:</td><td> <input type="text" style="width:350px;"  placeholder="Masukan jumlah beli ..." name="jumbel" value="<?php echo $d['jumlah']; ?>"/></td>
                         </tr>
                         <tr>
                           <td>Diskon 1</td>
                           <td>:</td><td> <input type="text" style="width:350px;" placeholder="Masukan diskon 1 ..." name="diskon1" value="<?php echo $d['diskon1']; ?>"/></td>
                         </tr>
                         <tr>
                           <td>Diskon 2</td>
                           <td>:</td><td> <input type="text" style="width:350px;" placeholder="Masukan diskon 2 ..." name="diskon2" value="<?php echo $d['diskon2']; ?>"/></td>
                         </tr>
                         <tr>
                          <input type="hidden" name="idp" value="<?php echo $d['id_produk']; ?> ">
                          <td colspan="2"><input type="submit" class="btn btn-primary" value="Simpan" /></td>
                        </tr>
                      </table>
                    </form>
                  </table>
                </div>
              </div>
            </section>
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


<script>
  $(function() {
   $("#datepicker").datepicker({
    changeMonth:true,
    changeYear:true,
    dateFormat:'yy-mm-dd',
    yearRange:'-45:+10'
  });
 });
</script>

<script>
  $(function() {
   $("#datepicker2").datepicker({
    changeMonth:true,
    changeYear:true,
    dateFormat:'yy-mm-dd',
    yearRange:'-45:+10'
  });
 });
</script>

<script>
  $(function() {
   $("#datepicker3").datepicker({
    changeMonth:true,
    changeYear:true,
    dateFormat:'yy-mm-dd',
    yearRange:'-45:+10'
  });
 });
</script>




<?php
break;

//habis case
}
}
?>