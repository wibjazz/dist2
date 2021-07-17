<?php
session_start();
// koneksi
include "../../../config/koneksi.php";
include "../../../config/fungsi_indotgl.php";
include "../../../config/fungsi_rupiah.php";

$year=date('Y');
$tahun_ini=date('Y');

?>

    <!-- DATA TABLES -->
    <link href="../config/style.css" rel="stylesheet" type="text/css" />
    <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
  <p align="center"><img src="../../../images/logo1.png" width="100px"></p>
  <p align="center" style="font-size:12px; font-family:Arial, Helvetica, sans-serif;"><b>LAPORAN KUNJUNGAN SALES</b></p>
  <p>di Cetak tgl : <?php echo date('d-m-Y'); ?><p>

<style type="text/css">
table {
    max-width: 100%;
    background-color: transparent;
    border-collapse: collapse;
    border-spacing: 1;
    font-family: Arial, Helvetica, sans-serif;
}
  table, th {
    border: 1px solid black;
    padding: 3px;
}
table, th, td {
   border: 1px solid black;
   padding: 3px;
}
</style>

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->

      <!-- Main content -->
      <section class="content">
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="box">
<!--               <div class="box-header">
                <h3 class="box-title">Data Kunjungan Sales</h3>
              </div><!-- /.box-header --> 
              <div class="box-body">
                <div class="table-responsive">
                <table width="100%" border="0" cellspacing="2" >
                  <thead style="background-color: #FF0000; color: #ffffff ;">
                    <tr>
                      <th>No.</th>
                      <th>Tgl Kunjungan</th>
                      <th>Jam Berangkat</th>
                      <th>Jam Pulang</th>
                      <th width="300px">ID/Nama Outlet</th>
                      <th>Nilai PO</th>
                      <th>Order PO</th>
                      <th>Keterangan</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php
          //jadwal
                   $jadwal=mysql_query("SELECT * from kunjungan where year(tgl_kunjungan)='$tahun_ini' and employee_number='$_SESSION[employee_number]' order by id_kunjungan desc ");
                   $no=1;
                   $tgl=date('Y-m-d');

                   while($j=mysql_fetch_array($jadwal))
                   {

                    //order 
                    $out=mysql_query("SELECT * from outlet where id_outlet='$j[id_outlet]'");
                    $fo=mysql_fetch_array($out);

                    //employee
                    ?>
                    <tr align="left">
                      <td><?php echo $no; ?></td>
                      <td><?php echo $j['tgl_kunjungan']; ?></td>
                      <td><?php echo $j['jam_berangkat']; ?></td>
                      <td><?php echo $j['jam_pulang']; ?></td>
                      <td><?php echo $j['id_outlet'].' - '.$fo['nama_outlet']; ?></td>
                      <?php
                      if (substr($j['order_po'],0,3)=="PRM")
                      {
                        $ordermod=mysql_query("SELECT * from orders_mod where id_orders_mod='$j[order_po]'");
                        $fo=mysql_fetch_array($ordermod);
                        $totbyrmod=number_format($fo['total_bayar_mod']);
                        // echo "<td>masuk</td>";
                        
                        echo "<td align='right'>$totbyrmod</td>";

                      }else
                      {
                        echo "<td></td>";
                      }
                      ?> 
                      <td><?php echo $j['order_po']; ?></td>
                      <td><?php echo $j['keterangan']; ?></td>
                      
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
  </div>
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
 