<?php
//session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser']))
{
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
  <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}else
{
  //$aksi="modul/mod_kategori/aksi_kategori.php";
  switch($_GET['act']){
	//Tampil Data Paket
    default:
    $tahun_ini=date('Y');
    ?>
    <!-- DATA TABLES -->
    <link rel="stylesheet" type="text/css" href="../config/style.css">
    <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          ERP Online System - CDC
          <small>v.3 - Control Panel</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="main.php?route=home"><i class="fa fa-home"></i> Beranda</a></li>
          <li class="active">Kunjungan</li>
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
                <h3 class="box-title">Data Kunjungan</h3><br />
                <button class="btn btn-primary" onclick="window.location='route/data_kunjungan/auto.php&act' "><i class="fa fa-plus"></i> Tambah Data Kunjungan</button>
                <a href="route/cetak/cetak-kunjungan.php">
                  <input type="button" class="btn btn-danger" value=" Cetak Detail Kunjungan" /></a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead style="background-color: #d2d6de; font-size: 100%">
                      <tr>
                        <th>No.</th>
                        <th>ID</th>
                        <th>Tgl. Kunjungan</th>
                        <th>Jam Berangkat</th>
                        <th>Jam Pulang</th>
                        <th>ID/Nama Pelanggan</th>
                        <th>Nilai PO</th>
                        <th>Order PO</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php
					//jadwal
                     $jadwal=mysql_query("SELECT * from kunjungan where employee_number='$_SESSION[employee_number]' and year(tgl_kunjungan)='$tahun_ini' order by id_kunjungan desc");
                     $no=1;
                     while($j=mysql_fetch_array($jadwal))
                     {
                      ?>
                      <tr align="left">
                        <td><?php echo $no; ?></td>
                        <td><?php echo $j['id_kunjungan']; ?></td>
                        <td><?php echo tgl_indo_short($j['tgl_kunjungan']); ?></td>
                        <td>
                          <?php
                          if ($j['jam_berangkat']=='00:00:00')
                            { ?>
                              <a href="route/data_kunjungan/aksi_ku.php?route=kunjungan_berangkat&act=cek&id=<?php echo $j['id_kunjungan']; ?>" title="Check"><button class="btn btn-primary"><?php echo $j['jam_berangkat']; ?> <i class="fa fa-square-o"></i></button></a>
                            </td>
                            <?php
                          }else{ ?>
                          <a  class="btn btn-info" ><strong><?php echo $j['jam_berangkat']; ?></strong> <i class="fa fa-check-square-o"> </a></td>
                          <?php
                        } ?>
                        
                        <td>
                          <?php
                          if ($j['jam_pulang']=='00:00:00')
                            { ?>
                              <a href="route/data_kunjungan/aksi_ku.php?route=kunjungan_pulang&act=cek&id=<?php echo $j['id_kunjungan']; ?>" title="Check"><button class="btn btn-primary"><?php echo $j['jam_pulang']; ?> <i class="fa fa-square-o"></i></button></a>
                            </td>
                            <?php
                          }else{ ?>
                          <a  class="btn btn-info" ><strong><?php echo $j['jam_pulang']; ?></strong> <i class="fa fa-check-square-o"> </a></td>
                          <?php
                        } 
                        //outlet
                        $outlet=mysql_query("SELECT * from outlet where id_outlet='$j[id_outlet]'");
                        $o=mysql_fetch_array($outlet);


                        ?>
                        <td><?php echo $j['id_outlet'].' - '.$o['nama_outlet']; ?></td>
                        <?php
                        if (substr($j['order_po'],0,3)=="PRM")
                        {
                          $ordermod=mysql_query("SELECT * from orders where id_orders='$j[order_po]'");
                          $fo=mysql_fetch_array($ordermod);
                          $totbyrmod=number_format($fo['total_bayar']);
                        // echo "<td>masuk</td>";
                          
                          echo "<td align='right'>$totbyrmod</td>";

                        }
                        ?> 
                        <td><?php echo $j['order_po']; ?></td>
                      <!-- <td><select name="order_po" style="width:100px;">
                        <option value="ada">Ada</option>
                        <option value="tidak ada">Tidak Ada</option>
                      </select></td> -->
                      <td><?php echo $j['keterangan']; ?></td>
                      
                      <td><a href="main.php?route=kunjungan&act=detail&id=<?php echo $j['id_kunjungan']; ?>"><button class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Detail</button></a></td>
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

//Form Detail PO
  case "detail":
//orders
  $tabel='';
  $order=mysql_query("SELECT * from kunjungan where id_kunjungan='$_GET[id]'");
  $o=mysql_fetch_array($order);
//toko
  $toko=mysql_query("SELECT * from outlet where id_outlet='$o[id_outlet]'");
  $p=mysql_fetch_array($toko);


   if (substr($o['order_po'],0,3)=="PRM")
    {
      $tabel='mod';
      $jadwal=mysql_query("SELECT * from orders where id_orders='$o[order_po]' ");
      $fj=mysql_fetch_array($jadwal);

      $moddetail=mysql_query("SELECT * from orders_detail where id_orders='$o[order_po]'");
    }

  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Detail Kunjungan
        <small>View</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="main.php?route=home"><i class="fa fa-home"></i> Beranda</a></li>
        <li class="active">Kunjungan</li>
        <li class="active">Detail</li>
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
                 <td width="150px">No. Kunjungan</td>
                 <td>: <b><?php echo $o['id_kunjungan']; ?></b></td>
               </tr>
               <tr>
                 <td width="100px">Nama Pelanggan</td>
                 <td>: <b><?php echo $p['nama_outlet']; ?></b></td>
                 <td width="100px">Tgl Kunjungan</td>
                 <td>: <b><?php echo tgl_indo($o['tgl_kunjungan']); ?></b></td>
               </tr>
               <tr>
                 <td width="100px">Alamat HO</td>
                 <td>: <b><?php echo $p['alamat_outlet']; ?></b></td>
                 <td width="100px">Jam Berangkat</td>
                 <td>: <b><?php echo ($o['jam_berangkat']); ?></b></td>
               </tr>
               <tr>
                 <td width="100px">Alamat Toko</td>
                 <td>: <b><?php echo $p['alamat2_outlet']; ?></b></td>
                 <td width="100px">Jam Pulang</td>
                 <td>: <b><?php echo $o['jam_pulang']; ?></b></td>
               </tr>
               <tr>
                 <td width="100px">NPWP Toko</td>
                 <td>: <b><?php echo $p['npwp']; ?></b>
                  <td width="100px">Keterngan</td>
                  <td>: <b><?php echo $o['keterangan']; ?> </b>
                  </tr>
                  <tr>
                   <td width="100px"></td>
                   <td></td>
                   <td width="100px">Status</td>
                   <td>: <b><?php echo $o['order_po']; ?></b></td>
                 </tr>
               </table>
               
               <button class="btn btn-primary pull-right" onclick="window.location='route/data_kunjungan/autocomplete3.php?id=<?php echo $o['id_kunjungan']; ?>'"><i class="fa fa-plus"></i> Edit Data</button>
               <hr>
               <div class="table-responsive">              
               <table id="example1" class="table table-bordered table-striped">
                <thead style="background-color: #d2d6de; font-size: 110%">
                  <tr align="center">
                    <th>No.</th>
                    <th>Id Produk</th>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <th>Disc 1</th>
                    <th>Disc 2</th>
                    <th>Harga</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $no=1;
                  while ($fmoddet=mysql_fetch_array($moddetail))
                  {
                    $prod=mysql_query("SELECT nama_produk from produk  where id_produk='$fmoddet[id_produk]'");
                    $fprod=mysql_fetch_array($prod);

                    if ($tabel=='mod')
                    {
                      $jumlah=$fmoddet['jumlah'];
                      $diskon1=$fmoddet['diskon1'];
                      $diskon2=$fmoddet['diskon2'];
                      $harga=number_format($fmoddet['harga']);
                    }
                    ?>                    

                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $fmoddet['id_produk']; ?></td>
                      <td><?php echo $fprod['nama_produk']; ?></td>
                      <td><?php echo $jumlah; ?></td>
                      <td><?php echo $diskon1; ?></td>
                      <td><?php echo $diskon2; ?></td>
                      <td align="right"><?php echo $harga; ?></td>
                    </tr>
                    <?php
                    $no++;
                  }
                  ?>
                </tbody>
              </table> 
            </div>

              <input type="button" name="kembali" class="btn btn-primary" value="Kembali ..." onclick="location.href = 'main.php?route=kunjungan&act';" style="cursor:pointer;" />
              
            </div><!-- /.box-body -->
          </div><!-- /.box -->
          
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

//Form Tambah Perwakilan
  case "tambah":
  ?>    
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tambah Data PO Modern
        <small>Form Input</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="main.php?route=home"><i class="fa fa-home"></i> Beranda</a></li>
        <li class="active">Transaksi</li>
        <li class="active">PO Modern</li>
        <li class="active">Tambah Data PO</li>
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
              <form role="form" action="route/data_po/aksi_po.php?route=po-modern&act=input" method="post">
                <legend>A. Data PO</legend>
                <!-- text input -->
                <div class="form-group">
                  <label>No. PO</label>
                  <input type="text" class="form-control" placeholder="Masukan No. PO yang tertera di Surat PO Modern ..."name="no_po"/>
                </div>
                <div class="form-group">
                  <label>Tgl PO</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" name="tgl_po" class="form-control" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask/>
                  </div><!-- /.input group -->
                </div><!-- /.form group -->
                <div class="form-group">
                  <label>Tgl Expired PO</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" name="tgl_expired" class="form-control" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask/>
                  </div><!-- /.input group -->
                </div><!-- /.form group -->
                <div class="form-group">
                  <label>Payment</label>
                  <select name="payment" class="form-control">
                   <option value="Credit">Credit</option>
                   <option value="Cash">Cash</option>
                 </select>
               </div>
               <div class="form-group">
                <label>Tgl Jatuh Tempo</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="tgl_jatuh_tempo" class="form-control" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask/>
                </div><!-- /.input group -->
              </div><!-- /.form group -->
              <legend>B. Data Outlet</legend>
              <div class="form-group">
                <label>Nama Outlet</label>
                <select name="outlet" class="form-control">
                 <?php
						//outlet
                 $outlet2=mysql_query("select * from outlet order by nama_outlet asc");
                 while($out=mysql_fetch_array($outlet2))
                 {
                   echo"<option value='$out[id_outlet]'>$out[id_outlet] - $out[nama_outlet]</option>";
                 }
                 ?>
               </select>
             </div>
             <legend>C. Data Produk</legend>
             <div class="form-group">
              <label>Nama Barang</label>
              <select name="produk" class="form-control">
               <?php
						//produk
               $produk=mysql_query("select * from produk where jenis = 'Produk' order by nama_produk asc");
               while($pro=mysql_fetch_array($produk))
               {
                 echo"<option value='$pro[id_produk]'>$pro[id_produk] - $pro[nama_produk]</option>";
               }
               ?>
             </select>
           </div>
           <div class="form-group">
            <label>Harga Barang Rp.</label>
            <input type="text" class="form-control" placeholder="Masukan harga produk ..." name="harga"/>
          </div>
          <div class="form-group">
            <label>Jumlah Beli</label>
            <input type="text" class="form-control" placeholder="Masukan jumlah beli ..." name="jumbel"/>
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
            <label>Diskon 3</label>
            <input type="text" class="form-control" placeholder="Masukan diskon3 ..." name="diskon3"/>
          </div>
          <div class="form-group">
            <hr />
            <input type="submit" class="btn btn-primary" value="Simpan" />
          </div>
        </form>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div><!--/.col (right) -->
</div>   <!-- /.row -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
  $(function() {
    var availableTags = [
    <?php
    $toko=mysql_query("select * from outlet");
    while($t=mysql_fetch_array($toko))
    {
      ?>
      "<?php echo $t['id_outlet']; echo $t['nama_outlet']; ?>",
      <?php
    }
    ?>
    
    ];
    $( "#tags" ).autocomplete({
      source: availableTags
    });
  });
</script>
<?php
break;
}
}
?>