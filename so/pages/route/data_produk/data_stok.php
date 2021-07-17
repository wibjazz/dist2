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
	//Tampil Data Perwakilan
    default:
    ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="list-gds wow slideInUp" data-wow-duration=".5s" data-wow-delay="1.1s">
                Stok  
              </h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                <li class="breadcrumb-item active">Stok</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- SELECT2 EXAMPLE -->
          <div class="card card-default">          
            <!-- /.card-header -->
            <div class="card-body">
              <!-- Main row -->
              <div class="row">
                <!-- Left col -->
                <section class="col-lg-12 connectedSortable">
                  <!-- Custom tabs (Charts with tabs)-->
                  <div class="box
                  <div class="box-body">
                    <div class="table table-responsive">
                      <table id="example1" class="table table-bordered table-hover">
                        <thead style="background-color: maroon;color: white; ">
                          <tr>
                            <th>No.</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Isi / ctn</th>
                            <th>Stok Gudang (pcs)</th>
                            <th>Stok Kantor (pcs)</th>
                          </tr>
                        </thead>
                        <tbody>
                         <?php
        					//jadwal
                         $jadwal=mysql_query("select * from produk order by id_produk asc");
                         $no=1;
                         while($j=mysql_fetch_array($jadwal))
                         {
                          // $minctn = 50;
                          // $minpcs = 500;
                          $minpcs=$j['stok_min'];
                          $stokmin=$j['stok_min'];
                          ?>
                          <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $j['id_produk']; ?></td>
                            <td><?php echo $j['nama_produk']; ?></td>
                            <td align="center"><?php echo $j['isiperctn']; ?></td>
                            
                            <?php
                            $nilai=number_format($j['stok_gudang']);
                            if($j['stok_gudang'] <= $stokmin and $j['stok_gudang']!='0')
                            {
                              echo"<td align='center'><button class='btn btn-warning btn-flat btn-xs disabled' style='width: 80px'>$nilai</td>";
                            }
                            elseif($j['stok_gudang']=='0')
                            {
                              echo"<td align='center'><button class='btn btn-danger btn-flat btn-xs disabled' style='width: 80px'>$nilai</td>";
                            }
                            else
                            {
                              echo"<td align='center'><button class='btn btn-success btn-flat btn-xs disabled' style='width: 80px'>$nilai</td>";
                            }

                            $nilai=number_format($j['stok_kantor']);
                            if($j['stok_kantor'] <= $stokmin and $j['stok_kantor']!='0')
                            {
                              echo"<td align='center'><button class='btn btn-warning btn-flat btn-xs disabled' style='width: 80px'>$nilai</td>";
                            }
                            elseif($j['stok_kantor']=='0')
                            {
                              echo"<td align='center'><button class='btn btn-danger btn-flat btn-xs disabled' style='width: 80px'>$nilai</td>";
                            }
                            else
                            {
                              echo"<td align='center'><button class='btn btn-success btn-flat btn-xs disabled' style='width: 80px'>$nilai</td>";
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

                  Catatan :
                  <p></p>
                  
                  <button class="btn btn-block btn-success disabled btn-lg" style="width: 150px;"></button> (Stok di atas Buffer)

                  <button class="btn btn-block btn-warning disabled btn-lg" style="width: 150px;"></button> (Stok di bawah Buffer)

                  <button class="btn btn-block btn-danger disabled btn-lg" style="width: 150px;"></button> (Stok Habis)

                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </section><!-- /.Left col -->
          </div><!-- /.row (main row) -->
        </div>
      </div>
    </div>

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- page script -->

      <?php
      break;

 }
}
?>