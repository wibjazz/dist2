<?php
//session_start();
if (empty($_SESSION['namauser']) and empty($_SESSION['passuser'])) {
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
  <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {
  //$aksi="modul/mod_kategori/aksi_kategori.php";
  switch ($_GET['act']) {
      //Tampil Data Paket
    default:
?>
      <!-- DATA TABLES -->
      <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <img src="../images/logo1.png" width="100px" />
            ERP Online System - CDC
            <small>v.1 - Control Panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="main.php?route=home"><i class="fa fa-home"></i> Beranda</a></li>
            <li class="active">Sales Target</li>
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
                <!-- <div class="box-header">
                <h3 class="box-title">Data Target</h3><br />
                <button class="btn btn-primary" onclick="window.location='route/data_target/autocomplete.php'"><i class="fa fa-plus"></i> Tambah Data</button>
              </div> -->
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="table table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead style="background-color: #eee; font-size: 110%">
                        <tr>
                          <th width="10px">No.</th>
                          <th width="100px">Bulan Tahun</th>
                          <th style="text-align: right;">Modern</th>
                          <th style="text-align: right;">Tradisional</th>
                          <th style="text-align: right;">Total</th>
                          <th style="text-align: right;">Target</th>
                          <th width="200px" align="center">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        //jadwal
                        $jadwal = mysql_query("SELECT * from target order by id_target desc ");
                        $no = 1;
                        while ($j = mysql_fetch_array($jadwal)) {
                        ?>
                          <tr align="left">
                            <td><?php echo $no; ?></td>
                            <td><?php echo $j['bulantahun']; ?></td>

                            <?php

                            $sumtarget = mysql_query("SELECT SUM(target) as total from target_detail  where id_target='$j[id_target]' ");
                            $rowtarget = mysql_fetch_array($sumtarget);
                            ?>

                            <!-- <td style="text-align:right"><?php echo format_rupiah($row['total']); ?></td> -->

                            <?php

                            $awal = substr($j['bulantahun'], 3, 4) . "-" . substr($j['bulantahun'], 0, 2) . "-01";
                            $akhir = substr($j['bulantahun'], 3, 4) . "-" . substr($j['bulantahun'], 0, 2) . "-31";
                            // echo "$awal";
                            // echo "<br/>";
                            // echo "$akhir";

                            ?>


                            <?php
                            $tot = 0;
                            $tot1 = 0;
                            $total = 0;
                            $query = "SELECT SUM(total_bayar) FROM orders where tgl_order>='$awal' and tgl_order<='$akhir'   ";
                            $result = mysql_query($query);


                            // cetak
                            while ($row = mysql_fetch_array($result)) {
                              //secho "Total  = RP.". $row['SUM(total_bayar)'];    echo "<br />";
                              $tot = $tot + $row['SUM(total_bayar)'];
                            }

                            ?>

                            <td style="text-align:right"><?php echo format_rupiah($tot); ?></td>

                            <td style="text-align:right"><?php echo format_rupiah($total); ?></td>

                            <td style="text-align:right"><?php echo format_rupiah($rowtarget['total']); ?></td>

                            <td><a href="main.php?route=target&act=detail&id=<?php echo $j['id_target']; ?>"><button class="btn btn-primary"><i class="fa fa-search"></i> Detail</button></a>

                              <!-- <a href="route/data_target/autocomplete2.php?id=<?php echo $j['id_target']; ?>"><button class="btn btn-success"><i class="fa fa-plus"></i> Tambah</button></a> -->
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

      <!-- page script -->
      <script type="text/javascript">
        $(function() {
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
      $det = mysql_num_rows(mysql_query("SELECT id_target FROM target_detail WHERE id_target='$_GET[id]'"));
    ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Detail Target Marketing
            <small>View</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="main.php?route=home"><i class="fa fa-home"></i> Beranda</a></li>
            <li class="active">Target Sales</li>
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
                <div class="box-body">
                  <form method="post" action="route/data_target/aksi_target.php?route=target&act=input-lagi">
                    <div class="table table-responsive">

                      <table width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-bordered table-striped">
                        <tr bgcolor="#CCCCCC">
                          <td align="center" width="5px"><b>No</b></td>
                          <td align="left" width="150px"><b>Bulan Tahun</b></td>
                          <td align="left"><b>Sales/Marketing</b></td>
                          <td align="right" width="120px"><b>Modern</b></td>
                          <td align="right" width="120px"><b>Tradisional</b></td>
                          <td align="right" width="120px"><b>Total</b></td>
                          <td align="left" width="120px"><b>Target</b></td>
                        </tr>
                        <?php
                        $no = 1;
                        $sql = mysql_query("SELECT * from user_login where (login_hash='6' OR login_hash='3') and aktif='1' ");

                        $submodern = 0;
                        $subtrad = 0;
                        $subtotal = 0;
                        $subtarget = 0;


                        while ($s = mysql_fetch_array($sql)) {
                          // $prd=mysql_query("SELECT * from employee where employee_number='$s[employee_number]'");
                          // $t=mysql_fetch_array($prd);
                          $emp = mysql_query("SELECT  name_e  from employee  where employee_number='$s[employee_number]' AND id_jabatan='3' ");
                          $e = mysql_fetch_array($emp);

                          $target = mysql_query("SELECT bulantahun from target where id_target='$_GET[id]' ");
                          $t = mysql_fetch_array($target);

                          if ($det > 0) {
                            $vt = mysql_fetch_array(mysql_query("SELECT target FROM target_detail WHERE id_target = '$_GET[id]' AND bulantahun='$t[bulantahun]' AND employee_number='$s[employee_number]'"));
                            $vtarget = $vt["target"];
                          } else {
                            $vtarget = 0;
                          }

                        ?>
                          <tr bgcolor="#FFFFFF">
                            <td align="center"><?php echo $no; ?></td>
                            <td align="left"><?php echo $t['bulantahun']; ?></td>
                            <td align="left"><?php echo $e['name_e']; ?></td>

                            <?php
                            $awal = substr($t['bulantahun'], 3, 4) . "-" . substr($t['bulantahun'], 0, 2) . "-01";
                            $akhir = substr($t['bulantahun'], 3, 4) . "-" . substr($t['bulantahun'], 0, 2) . "-31";

                            $tot1 = 0;
                            $tot = 0;
                            $total = 0;
                            $query = "SELECT SUM(total_bayar) FROM orders where tgl_order>='$awal' and tgl_order<='$akhir' and employee_number= '$s[employee_number]' ";
                            $result = mysql_query($query);

                            

                            // cetak
                            while ($row = mysql_fetch_array($result)) {
                              //secho "Total  = RP.". $row['SUM(total_bayar)'];    echo "<br />";
                              $tot = $tot + $row['SUM(total_bayar)'];
                            }

                           

                            ?>


                            <td style="text-align:right"><?php echo format_rupiah($tot); ?></td>
                            
                            <td style="text-align:right"><?php echo format_rupiah($total); ?></td>


                            <td>
                              <input type="text" disabled="" name="target[]" value="<?php echo format_rupiah($vtarget); ?>">
                              <input type="hidden" name="bt[]" value="<?php echo $t['bulantahun']; ?>">
                              <input type="hidden" name="en[]" value="<?php echo $s['employee_number']; ?>">
                            </td>


                          </tr>
                        <?php
                          $no++;
                          $submodern = $submodern + $tot;
                          
                          $subtotal = $subtotal + $total;
                          $subtarget = $subtarget + $vtarget;
                        }
                        ?>

                        </tr>


                        <!--               <tr>
                <td colspan="3"></td>
                <td style="text-align:right"><strong><?php echo format_rupiah($submodern); ?></strong></td>
                
                <td style="text-align:right"><strong><?php echo format_rupiah($subtotal); ?></strong></td>
                <td ><strong><?php echo format_rupiah($subtarget); ?></strong></td>
                
              </tr> 
            -->
                      </table>
                    </div>

                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?> ">
                    <!-- <input type="submit" class="btn btn-primary" value="Simpan" /> -->
                    <input type="button" name="kembali" class="btn btn-primary" value="Kembali ..." onclick="location.href = 'main.php?route=target&act';" style="cursor:pointer;" />

                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div>
            <!--/.col (right) -->
          </div> <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php
      break;

      ?>

      <script>
        $(function() {
          var availableTags = [
            <?php
            $toko = mysql_query("SELECT * from outlet");
            while ($t = mysql_fetch_array($toko)) {
            ?> "<?php echo $t['id_outlet'];
                echo $t['nama_outlet']; ?>",
            <?php
            }
            ?>

          ];
          $("#tags").autocomplete({
            source: availableTags
          });
        });
      </script>
<?php
      break;
  }
}
?>