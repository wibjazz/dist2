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
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1 class="list-gds wow slideInUp" data-wow-duration=".5s" data-wow-delay="1.1s">
          <b>SO</b><small>- Control Panel</small> | <?php echo $naper1.'<small>'.$naper2.' '.$ver;?></small>          
        </h1>
        <ol class="breadcrumb">
          <li><a href="main.php?route=home"><i class="fa fa-home"></i> Beranda</a></li>
          <li class="active">Data Master</li>
          <li class="active">Produk</li>
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
                <h3 class="box-title">Data Produk (Pcs)</h3><br />
                
              </div><!-- /.box-header -->
              <div class="box-body">
              <div class="table table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead style="background-color: #eee; font-size: 110%">
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
                    $minctn = 50;
                    $minpcs = 500;
                    ?>
                    <tr align="left">
                      <td><?php echo $no; ?></td>
                      <td><?php echo $j['id_produk']; ?></td>
                      <td><?php echo $j['nama_produk']; ?></td>
                      <td align="center"><?php echo $j['isiperctn']; ?></td>
                      <?php
                      $nilai=number_format($j['stok_gudang']);
                      if($j['stok_gudang'] <= $minctn and $j['stok_gudang']!='0')
                      {
                        echo"<td align='center'  class='bg-yellow disabled'>$nilai</td>";
                      }
                      elseif($j['stok_gudang']=='0')
                      {
                        echo"<td align='center'  class='bg-red color-palette'>$nilai</td>";
                      }
                      else
                      {
                        echo"<td align='center'  class='bg-green disabled'>$nilai</td>";
                      }
                      ?>
                      <?php
                      $nilai=number_format($j['stok_kantor']);
                      if($j['stok_kantor'] <= $minpcs and $j['stok_kantor']!='0')
                      {
                        echo"<td align='center' class='bg-yellow disabled'>$nilai</td>";
                      }
                      elseif($j['stok_kantor']=='0')
                      {
                        echo"<td align='center' class='bg-red color-palette'>$nilai</td>";
                      }
                      else
                      {
                        echo"<td align='center' class='bg-green disabled'>$nilai</td>";
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
              <br />
              <p style="background-color:#000;"><b><font color="#FFFFFF">Catatan :</font> <font color="#00FF00">Hijau (Stok Diatas 50%)</font> -- <font color="#FFFF00">Kuning (Stok Dibawah 50%)</font> -- <font color="#FF0000">Merah (Stok Habis)</font></b></p>
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

//Form Tambah Barang
  case "tambah":
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tambah Data Barang
        <small>Form Input</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="main.php?route=home"><i class="fa fa-home"></i> Beranda</a></li>
        <li class="active">Data Master</li>
        <li class="active">Barang Stok Kantor</li>
        <li class="active">Tambah Data Barang</li>
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
              <form role="form" action="route/data_produk/aksi_produk.php?route=produk-kantor&act=input" method="post">
                <!-- text input -->
                <div class="form-group">
                  <label>Kode Supplier</label>
                  <select name="ids" class="form-control">
                   <option value="0">++ Pilih Kode Supplier++</option>
                   <?php
						//supplier
                   $supplier=mysql_query("select * from supplier");
                   while($s=mysql_fetch_array($supplier))
                   {
                     echo"<option value='$s[id_supp]'>$s[id_supp] - $s[nama_supp]</option>";
                   }
                   ?>
                 </select>
               </div>
               <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" name="nama" class="form-control" placeholder="Masukan barang ..." required="required"/>
              </div>
              <div class="form-group">
                <label>Kategori Barang</label>
                <select name="idc" class="form-control">
                 <option value="0">++ Pilih Kode Kategori++</option>
                 <?php
						//kategori
                 $kategori=mysql_query("select * from kategori");
                 while($k=mysql_fetch_array($kategori))
                 {
                   echo"<option value='$k[id_cat_produk]'>$k[id_cat_produk] - $k[nama_cat]</option>";
                 }
                 ?>
               </select>
             </div>
             <div class="form-group">
              <label>Jenis Barang</label>
              <select name="jenis" class="form-control">
               <option value="0">++ Pilih Jenis Barang ++</option>
               <option value="Produk">Produk</option>
               <option value="Bahan Baku">Bahan Baku</option>
             </select>
           </div>
           <div class="form-group">
            <label>Isi per Carton</label>
            <input type="text" name="isictn" class="form-control" placeholder="Masukan jumlah isi barang per carton ..." required="required"/>
          </div>
          <div class="form-group">
            <label>Satuan Barang</label>
            <select name="satuan" class="form-control">
             <option value="0">++ Pilih Satuan Barang ++</option>
             <option value="pack">Pack</option>
             <option value="box">Box</option>
             <option value="kaleng">Kaleng</option>
             <option value="pcs">Pcs</option>
             <option value="ctn">Ctn</option>
             <option value="botol">Botol</option>
             <option value="dirigen">Dirigen</option>
             <option value="galon">Galon</option>
             <option value="bags">Bags</option>
           </select>
         </div>                    
         <div class="form-group">
          <label>Ukuran Barang</label>
          <input type="text" name="ukuran" class="form-control" placeholder="Masukan ukuran barang ..." required="required"/>
        </div>
        <div class="form-group">
          <label>Ukuran Isi Barang</label>
          <select name="ukuran_isi" class="form-control">
           <option value="0">++ Pilih Ukuran Isi Barang ++</option>
           <option value="kg">Kg - Kilogram</option>
           <option value="gr">Gr - Gram</option>
           <option value="ons">Ons</option>
           <option value="ltr">Ltr - Liter</option>
           <option value="ml">Ml - Mili Liter</option>
           <option value="pcs">Pcs - Piecies</option>
         </select>
       </div>
       <div class="form-group">
        <label>Total Stok</label>
        <input type="text" name="stok" class="form-control" placeholder="Masukan jumlah total stok ..." required="required"/>
      </div>
      <div class="form-group">
        <label>Batasan Stok Minimal</label>
        <input type="text" name="stok_min" class="form-control" placeholder="Masukan batasan stok minimal ..." required="required"/>
      </div>
      <div class="form-group">
        <label>Batasan Stok Maksimal</label>
        <input type="text" name="stok_max" class="form-control" placeholder="Masukan batasan stok maksimal ..." required="required"/>
      </div>
      <div class="form-group">
        <label>Harga Beli</label>
        <input type="text" name="hpp" class="form-control" placeholder="Masukan nilai harga beli Rp. xxx ..." required="required"/>
      </div>
      <div class="form-group">
        <label>Harga Tradisional</label>
        <input type="text" name="harga_trad" class="form-control" placeholder="Masukan nilai harga jual tradisional Rp. xxx ..." required="required"/>
      </div>
      <div class="form-group">
        <label>Harga Modern</label>
        <input type="text" name="harga_mod" class="form-control" placeholder="Masukan nilai harga jual modern Rp. xxx ..." required="required"/>
      </div>
      <div class="form-group">
        <label>Tgl. Expired</label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
          <input type="text" name="tgl_ekspired" placeholder="Masukan tgl expired barang ..." class="form-control" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask/>
        </div><!-- /.input group -->
      </div><!-- /.form group -->
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


<!-- Page script -->
<script type="text/javascript">
  $(function () {
        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        //Money Euro
        $("[data-mask]").inputmask();

        //Date range picker
        $('#reservation').daterangepicker();
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
        //Date range as a button
        $('#daterange-btn').daterangepicker(
        {
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
            'Last 7 Days': [moment().subtract('days', 6), moment()],
            'Last 30 Days': [moment().subtract('days', 29), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
          },
          startDate: moment().subtract('days', 29),
          endDate: moment()
        },
        function (start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        );

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });

        //Colorpicker
        $(".my-colorpicker1").colorpicker();
        //color picker with addon
        $(".my-colorpicker2").colorpicker();

        //Timepicker
        $(".timepicker").timepicker({
          showInputs: false
        });
      });
    </script>
    
    <script>
      $(function() {	
       var dt='';
       $('#d1').datepicker();	
       
       
       $('#d2').datepicker({ 
        changeMonth:true,
        dateFormat: 'yy-mm-dd',
        changeYear:true,
      });
       
       $('#d3').datepicker({ 
        changeMonth:true,
        dateFormat: 'yy-mm-dd',
        changeYear:true,
        onClose: function (date) {
        	dt=date;
        	$( "#d4" ).datepicker("destroy");
        	showdate();
          
        }
      });
       
       $('#d5').datepicker({
        changeYear:true,
      });
       
       $( "#d6" ).datepicker();
       $( "#hFormat" ).change(function() {
        $( "#d6" ).datepicker( "option", "dateFormat", $( this ).val() );
      });
       
       
       
       function showdate()
       {
         $('#d4').datepicker({ 
          changeMonth:true,
          dateFormat: 'yy-mm-dd',
          changeYear:true,
          minDate: new Date(dt),
          hideIfNoPrevNext: true 
        });
       }
       
     });    
   </script>
   <?php
   break;

//Form Edit Barang
   case "edit":
//edit
   $edit = mysql_query("select * from produk where id_produk = '$_GET[id]'");
   $e = mysql_fetch_array($edit);
   ?>
   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Data Barang
        <small>Form Edit</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="main.php?route=home"><i class="fa fa-home"></i> Beranda</a></li>
        <li class="active">Data Master</li>
        <li class="active">Barang Stok Gudang</li>
        <li class="active">Edit Data Barang</li>
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
              <form role="form" action="route/data_produk/aksi_produk.php?route=produk-kantor&act=edit" method="post">
                <!-- text input -->
                <div class="form-group">
                  <label>Kode Supplier</label>
                  <select name="ids" class="form-control">
                   <option value="0">++ Pilih Kode Supplier++</option>
                   <?php
						//supplier
                   $supplier=mysql_query("select * from supplier");
                   while($s=mysql_fetch_array($supplier))
                   {
                     if($e['id_supp']==$s['id_supp'])
                     {
                      echo"<option value='$s[id_supp]' selected='selected'>$s[id_supp] - $s[nama_supp]</option>";
                    }
                    else
                    {
                      echo"<option value='$s[id_supp]'>$s[id_supp] - $s[nama_supp]</option>";
                    }
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" name="nama" class="form-control" value="<?php echo $e['nama_produk']; ?>" required="required"/> <input type="hidden" name="idp" class="form-control" value="<?php echo $e['id_produk']; ?>" readonly="readonly"/>
              </div>
              <div class="form-group">
                <label>Kategori Barang</label>
                <select name="idc" class="form-control">
                 <option value="0">++ Pilih Kode Kategori++</option>
                 <?php
						//kategori
                 $kategori=mysql_query("select * from kategori");
                 while($k=mysql_fetch_array($kategori))
                 {
                   if($e['id_cat_produk']==$k['id_cat_produk'])
                   {
                    echo"<option value='$k[id_cat_produk]' selected='selected'>$k[id_cat_produk] - $k[nama_cat]</option>";
                  }
                  else
                  {
                    echo"<option value='$k[id_cat_produk]'>$k[id_cat_produk] - $k[nama_cat]</option>";
                  }
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label>Jenis Barang</label>
              <select name="jenis" class="form-control">
               <?php
               if($e['jenis']=='Produk')
               {
                 echo'
                 <option value="0">++ Pilih Jenis Barang ++</option>
                 <option value="Produk" selected="selected">Produk</option>
                 <option value="Bahan Baku">Bahan Baku</option>';
               }
               elseif($e['jenis']=='Bahan Baku')
               {
                 echo'
                 <option value="0">++ Pilih Jenis Barang ++</option>
                 <option value="Produk">Produk</option>
                 <option value="Bahan Baku" selected="selected">Bahan Baku</option>';
               }
               ?>
             </select>
           </div>
           <div class="form-group">
            <label>Isi per Carton</label>
            <input type="text" name="isictn" class="form-control" value="<?php echo $e['isiperctn']; ?>" required="required"/>
          </div>
          <div class="form-group">
            <label>Satuan Barang</label>
            <select name="satuan" class="form-control">
             <?php
             if($e['satuan']=='pack')
             {
              echo "<option value='pack' selected='selected'>Pack</option>
              <option value='box'>Box</option>
              <option value='kaleng'>Kaleng</option>
              <option value='pcs'>Pcs</option>
              <option value='ctn'>Ctn</option>
              <option value='botol'>Botol</option>
              <option value='dirigen'>Dirigen</option>
              <option value='galon'>Galon</option>
              <option value='bags'>Bags</option>";
            }
            elseif($e['satuan']=='box')
            {
              echo "<option value='pack'>Pack</option>
              <option value='box' selected='selected'>Box</option>
              <option value='kaleng'>Kaleng</option>
              <option value='pcs'>Pcs</option>
              <option value='ctn'>Ctn</option>
              <option value='botol'>Botol</option>
              <option value='dirigen'>Dirigen</option>
              <option value='galon'>Galon</option>
              <option value='bags'>Bags</option>";
            }
            elseif($e['satuan']=='kaleng')
            {
              echo "<option value='pack'>Pack</option>
              <option value='box'>Box</option>
              <option value='kaleng' selected='selected'>Kaleng</option>
              <option value='pcs'>Pcs</option>
              <option value='ctn'>Ctn</option>
              <option value='botol'>Botol</option>
              <option value='dirigen'>Dirigen</option>
              <option value='galon'>Galon</option>
              <option value='bags'>Bags</option>";
            }
            elseif($e['satuan']=='pcs')
            {
              echo "<option value='pack'>Pack</option>
              <option value='box'>Box</option>
              <option value='kaleng'>Kaleng</option>
              <option value='pcs' selected='selected'>Pcs</option>
              <option value='ctn'>Ctn</option>
              <option value='botol'>Botol</option>
              <option value='dirigen'>Dirigen</option>
              <option value='galon'>Galon</option>
              <option value='bags'>Bags</option>";
            }
            elseif($e['satuan']=='ctn')
            {
              echo "<option value='pack'>Pack</option>
              <option value='box'>Box</option>
              <option value='kaleng'>Kaleng</option>
              <option value='pcs'>Pcs</option>
              <option value='ctn' selected='selected'>Ctn</option>
              <option value='botol'>Botol</option>
              <option value='dirigen'>Dirigen</option>
              <option value='galon'>Galon</option>
              <option value='bags'>Bags</option>";
            }
            elseif($e['satuan']=='botol')
            {
              echo "<option value='pack'>Pack</option>
              <option value='box'>Box</option>
              <option value='kaleng'>Kaleng</option>
              <option value='pcs'>Pcs</option>
              <option value='ctn'>Ctn</option>
              <option value='botol' selected='selected'>Botol</option>
              <option value='dirigen'>Dirigen</option>
              <option value='galon'>Galon</option>
              <option value='bags'>Bags</option>";
            }
            elseif($e['satuan']=='dirigen')
            {
              echo "<option value='pack'>Pack</option>
              <option value='box'>Box</option>
              <option value='kaleng'>Kaleng</option>
              <option value='pcs'>Pcs</option>
              <option value='ctn'>Ctn</option>
              <option value='botol'>Botol</option>
              <option value='dirigen' selected='selected'>Dirigen</option>
              <option value='galon'>Galon</option>
              <option value='bags'>Bags</option>";
            }
            elseif($e['satuan']=='galon')
            {
              echo "<option value='pack'>Pack</option>
              <option value='box'>Box</option>
              <option value='kaleng'>Kaleng</option>
              <option value='pcs'>Pcs</option>
              <option value='ctn'>Ctn</option>
              <option value='botol' selected='selected'>Botol</option>
              <option value='dirigen'>Dirigen</option>
              <option value='galon' selected='selected'>Galon</option>
              <option value='bags'>Bags</option>";
            }
            else
            {
              echo "<option value='pack'>Pack</option>
              <option value='box'>Box</option>
              <option value='kaleng'>Kaleng</option>
              <option value='pcs'>Pcs</option>
              <option value='ctn'>Ctn</option>
              <option value='botol' selected='selected'>Botol</option>
              <option value='dirigen'>Dirigen</option>
              <option value='galon' selected='selected'>Galon</option>
              <option value='bags' selected='selected'>Bags</option>";
            }
            
            ?>
          </select>
        </div>                    
        <div class="form-group">
          <label>Ukuran Barang</label>
          <input type="text" name="ukuran" class="form-control" value="<?php echo $e['ukuran']; ?>" required="required"/>
        </div>
        <div class="form-group">
          <label>Ukuran Isi Barang</label>
          <select name="ukuran_isi" class="form-control">
           <?php
           if($e['ukuran_isi']=='kg')
           {
            echo "<option value='kg' selected='selected'>Kg - Kilogram</option>
            <option value='gr'>Gr - Gram</option>
            <option value='ons'>Ons</option>
            <option value='ltr'>Ltr - Liter</option>
            <option value='ml'>Ml - Mili Liter</option>
            <option value='pcs'>Pcs - Piecies</option>";
          }
          elseif($e['ukuran_isi']=='gr')
          {
            echo "<option value='kg'>Kg - Kilogram</option>
            <option value='gr' selected='selected'>Gr - Gram</option>
            <option value='ons'>Ons</option>
            <option value='ltr'>Ltr - Liter</option>
            <option value='ml'>Ml - Mili Liter</option>
            <option value='pcs'>Pcs - Piecies</option>";
          }
          elseif($e['ukuran_isi']=='ons')
          {
            echo "<option value='kg'>Kg - Kilogram</option>
            <option value='gr'>Gr - Gram</option>
            <option value='ons' selected='selected'>Ons</option>
            <option value='ltr'>Ltr - Liter</option>
            <option value='ml'>Ml - Mili Liter</option>
            <option value='pcs'>Pcs - Piecies</option>";
          }
          elseif($e['ukuran_isi']=='ltr')
          {
            echo "<option value='kg'>Kg - Kilogram</option>
            <option value='gr'>Gr - Gram</option>
            <option value='ons'>Ons</option>
            <option value='ltr' selected='selected'>Ltr - Liter</option>
            <option value='ml'>Ml - Mili Liter</option>
            <option value='pcs'>Pcs - Piecies</option>";
          }
          elseif($e['ukuran_isi']=='ml')
          {
            echo "<option value='kg'>Kg - Kilogram</option>
            <option value='gr'>Gr - Gram</option>
            <option value='ons'>Ons</option>
            <option value='ltr'>Ltr - Liter</option>
            <option value='ml' selected='selected'>Ml - Mili Liter</option>
            <option value='pcs'>Pcs - Piecies</option>";
          }
          else
          {
            echo "<option value='kg'>Kg - Kilogram</option>
            <option value='gr'>Gr - Gram</option>
            <option value='ons'>Ons</option>
            <option value='ltr'>Ltr - Liter</option>
            <option value='ml'>Ml - Mili Liter</option>
            <option value='pcs' selected='selected'>Pcs - Piecies</option>";
          }
          ?>
        </select>
      </div>
      <div class="form-group">
        <label>Stok Gudang</label>
        <input type="text" name="stok_gudang" class="form-control" value="<?php echo $e['stok_gudang']; ?>" required="required"/>
      </div>
      <div class="form-group">
        <label>Stok Kantor</label>
        <input type="text" name="stok_kantor" class="form-control" value="<?php echo $e['stok_kantor']; ?>" required="required"/>
      </div>
      <div class="form-group">
        <label>Batasan Stok Minimal</label>
        <input type="text" name="stok_min" class="form-control" value="<?php echo $e['stok_min']; ?>" required="required"/>
      </div>
      <div class="form-group">
        <label>Batasan Stok Maksimal</label>
        <input type="text" name="stok_max" class="form-control" value="<?php echo $e['stok_max']; ?>" required="required"/>
      </div>
      <div class="form-group">
        <label>Harga Beli</label>
        <input type="text" name="hpp" class="form-control" value="<?php echo $e['hrg_beli']; ?>" required="required"/>
      </div>
      <div class="form-group">
        <label>Harga Tradisional</label>
        <input type="text" name="harga_trad" class="form-control" value="<?php echo $e['hrg_tradisional']; ?>" required="required"/>
      </div>
      <div class="form-group">
        <label>Harga Modern</label>
        <input type="text" name="harga_mod" class="form-control" value="<?php echo $e['hrg_modern']; ?>" required="required"/>
      </div>
      <div class="form-group">
        <label>Tgl. Expired</label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
          <input type="text" name="tgl_ekspired" value="<?php echo $e['expired']; ?>" class="form-control" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask/>
        </div><!-- /.input group -->
      </div><!-- /.form group -->
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


<!-- Page script -->
<script type="text/javascript">
  $(function () {
        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        //Money Euro
        $("[data-mask]").inputmask();

        //Date range picker
        $('#reservation').daterangepicker();
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
        //Date range as a button
        $('#daterange-btn').daterangepicker(
        {
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
            'Last 7 Days': [moment().subtract('days', 6), moment()],
            'Last 30 Days': [moment().subtract('days', 29), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
          },
          startDate: moment().subtract('days', 29),
          endDate: moment()
        },
        function (start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        );

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });

        //Colorpicker
        $(".my-colorpicker1").colorpicker();
        //color picker with addon
        $(".my-colorpicker2").colorpicker();

        //Timepicker
        $(".timepicker").timepicker({
          showInputs: false
        });
      });
    </script>
    
    <script>
      $(function() {	
       var dt='';
       $('#d1').datepicker();	
       
       
       $('#d2').datepicker({ 
        changeMonth:true,
        dateFormat: 'yy-mm-dd',
        changeYear:true,
      });
       
       $('#d3').datepicker({ 
        changeMonth:true,
        dateFormat: 'yy-mm-dd',
        changeYear:true,
        onClose: function (date) {
        	dt=date;
        	$( "#d4" ).datepicker("destroy");
        	showdate();
          
        }
      });
       
       $('#d5').datepicker({
        changeYear:true,
      });
       
       $( "#d6" ).datepicker();
       $( "#hFormat" ).change(function() {
        $( "#d6" ).datepicker( "option", "dateFormat", $( this ).val() );
      });
       
       
       
       function showdate()
       {
         $('#d4').datepicker({ 
          changeMonth:true,
          dateFormat: 'yy-mm-dd',
          changeYear:true,
          minDate: new Date(dt),
          hideIfNoPrevNext: true 
        });
       }
       
     });    
   </script>
   <?php
   break;
 }
}
?>