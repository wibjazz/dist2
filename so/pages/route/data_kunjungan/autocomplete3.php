<?php
ob_start();
include "../../../config/koneksi.php";
?>
<html>
<head>
    <title>Form Input PO Tradisional</title>
    <link href="../../../bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="../../../dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="../../../dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="bselect/select2_bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="bselect/select2_select2.min.css" type="text/css"/>
    <script type="text/javascript" src="bselect/select2_jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="bselect/select2_select2.min.js"></script>
    <!-- Tambahkan jqueryUI disini -->
    <script type="text/javascript" src="../../jquery-ui/js/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="../../jquery-ui/js/jquery-ui-1.10.4.custom.min.js"></script>
    <link type="text/css" rel="stylesheet" href="../../jquery-ui/css/smoothness/jquery-ui-1.10.4.custom.min.css"/>
</head>
<body>

    <?php
    $ku=mysql_query("SELECT * from kunjungan where id_kunjungan='$_GET[id]' ");
    $fku=mysql_fetch_array($ku);

    $out=mysql_query("SELECT * from outlet where id_outlet='$fku[id_outlet]' ");
    $fout=mysql_fetch_array($out);

    ?>
    <h1 align="center">FORM EDIT KUNJUNGAN| MITRA BERSAUDARA</h1>
    <form method="post" action="aksi_ku.php?route=kunjungan&act=edit">

        <table width="50%" border="0" align="center">
         <tr>
            <td colspan="2"><h3>A. Data Kunjungan</h3></td>
        </tr>
        <tr>
            <td width="150px">No. Kunjungan</td>
            <td>: <input type="text" style="width:400px;" name="id_kunjungan" value="<?php echo $fku['id_kunjungan'] ;?> " required/></td>
        </tr>
        <tr>
            <td>Tgl Kunjungan</td>
            <td>: <input type="text" id="datepicker" name="tgl_kunjungan" style="width:400px;" data-inputmask="'alias': 'yyyy-mm-dd'" value="<?php echo $fku['tgl_kunjungan'] ;?> " data-mask /></td>
        </tr>
        <tr>
            <td>Jam Berangkat</td>
            <td>: <input type="text" id="datepicker2" name="jam_berangkat" style="width:400px;" data-inputmask="'alias': 'jm-mm-dd'" value="<?php echo $fku['jam_berangkat'] ;?> " data-mask /></td>
        </tr>
        <tr>
            <td>Jam Pulang</td>
            <td>: <input type="text" id="datepicker2" name="jam_pulang" style="width:400px;" data-inputmask="'alias': 'jm-mm-dd'" value="<?php echo $fku['jam_pulang'] ;?> " data-mask /></td>
        </tr>
    <!-- <tr>
       	<td>Metode Pembayaran</td>
        <td>: <select name="payment" style="width:400px;">
                    	<option value="Credit">Credit</option>
                        <option value="Cash">Cash</option>
                      </select></td>
                  </tr> -->
<!--         <tr>
        	<td>Tgl. Jatuh Tempo</td>
            <td>: <input type="text" id="datepicker3" name="tgl_tempo" style="width:400px;" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask required/></td>
        </tr> -->
        <tr>
        	<td colspan="2"><h3>B. Data Outlet / Toko</h3></td>
        </tr>
        <!-- <tr>
        	<td>Nama Outlet</td>
            <td>: <select id="kota" name="id_outlet" class="form-control"  value="<?php echo $fku['id_outlet'];?>"  style="width:400px;">
                <?php
		//outlet
                $outlet=mysql_query("select * from outlet order by nama_outlet asc");
                echo "<option value='$fku[id_outlet]'>$fku[id_outlet] - $fout[nama_outlet]</option>";
                while($x=mysql_fetch_array($outlet))
                {
                 echo"<option value='$x[id_outlet]'>$x[id_outlet] - $x[nama_outlet]</option>";
             }
             ?>
         </select></td>
     </tr> -->
     <!-- <tr>
       <td>Alamat Outlet</td>
       
       <td>: <input type="text" id="alamat_outlet" name="alamat_outlet" style="width:400px; "  value="<?php echo $fout['alamat_outlet'] ;?> " readonly/></td>
   </tr> -->
<!-- yang baru  -->
        <tr>
          <?php 
          $outlet=mysql_query("SELECT * from outlet where id_outlet='$fku[id_outlet]' ");
          $fo=mysql_fetch_array($outlet);

          ?>
            <td>Outlet :</td>
            <td><input type="text" id="kode" name="id_outlet" value="<?php echo $fku['id_outlet'] ;?>" required/></td>
        
        </tr>
        <tr>
            <td>Nama Outlet :</td>
            <td><span id="nama-outlet" >-</span></td>
        </tr>

   <tr>
       <td colspan="2"><h3>C. Data Barang</h3></td>
   </tr>
        <!-- <tr>
        	<td>Nama Barang</td>
            <td>: <select name="produk" style="width:400px;">
                      	<?php
						//produk
						$produk=mysql_query("select * from produk where jenis = 'Produk' order by nama_produk asc");
						while($pro=mysql_fetch_array($produk))
						{
							echo"<option value='$pro[id_produk]'>$pro[id_produk] - $pro[nama_produk], Stok : $pro[total_stok] pcs</option>";
						}
						?>
                      </select></td>
                  </tr> -->
                  <tr>
                   <td>Order PO</td>
                   <td>: <input type="text" style="width:400px;" placeholder="Masukan ada order tdk ..." name="order_po" value="<?php echo $fku['order_po'] ;?> " /></td>
               </tr>
               <tr>
                   <td>Keterangan :</td>
                   <td>: <input type="text" style="width:400px;" placeholder="Masukan Keterangan ..." name="ket" value="<?php echo $fku['keterangan'] ;?> " /></td>
               </tr>
<!--         <tr>
        	<td>Diskon 1</td>
            <td>: <input type="text" style="width:400px;" placeholder="Masukan diskon 1 ..." name="diskon1" required/></td>
        </tr> -->
<!--         <tr>
        	<td>Diskon 2</td>
            <td>: <input type="text" style="width:400px;" placeholder="Masukan diskon 2 ..." name="diskon2" required/></td>
        </tr> -->
<!--         <tr>
        	<td>Diskon 3</td>
            <td>: <input type="text" style="width:400px;" placeholder="Masukan diskon 3 ..." name="diskon3" required/></td>
        </tr> -->
        <tr>
        	<td colspan="2"><input type="submit" class="btn btn-primary" value="Simpan" /></td>
        </tr>
    </table>
</form>  

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

<script>
    $(document).ready(function () {
        $("#kota").select2({
            placeholder: "Please Select"
        });
    });
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
</body>
</html>
<?php ob_flush(); ?>