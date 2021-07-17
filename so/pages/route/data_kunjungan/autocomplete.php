<?php
ob_start();
include "../../../config/koneksi.php";
$tgl=date('Y-m-d');
?>
<html>
<head>
    <title>Form Input Kunjungan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bselect/select2_bootstrap.min.css"/>
    <link rel="stylesheet" href="bselect/select2_select2.min.css"/>
    <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
    <!-- Tambahkan jqueryUI disini -->
    <script type="text/javascript" src="../../../js/jquery-1.8.1.min.js"></script>
    <script type="text/javascript" src="../../jquery-ui/js/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="../../jquery-ui/js/jquery-ui-1.10.4.custom.min.js"></script>
    <link type="text/css" rel="stylesheet" href="../../jquery-ui/css/smoothness/jquery-ui-1.10.4.custom.min.css"/>
</head>
<body>

<div class="col-md-6">
  <div class="box box-primary">
    <div class="box-header">
      <h3 class="box-title" align="center">FORM RENCANA KUNJUNGAN</h3>
    </div>
    <div class="box-body">
    <form method="post" action="aksi_ku.php?route=kunjungan&act=input">
        <table width="100%" border="0" align="center">
           <tr>
            <td colspan="2"><h3>A. Data Kunjungan</h3></td>
        </tr>

        <tr>
            <td>Tgl Kunjungan</td>
            <td>: <input type="text" id="datepicker" name="tgl_kunjungan" value="<?php echo $tgl ;?>" style="width:200px;" placeholder="Format : yyyy-mm-dd " required/></td>
        </tr>

      <tr>
    <td>Jenis Kunjungan</td>
    <td>: <select name="jenis_kunjungan" style="width:100px;">
                <option value="baru">Baru</option>
                <option value="lama">Lama</option>
              </select>
    </td>
    </tr>
    <tr>
    <td align="right">(Baru)</td><td>: Nama Toko<input type="text"  name="toko" style="width:200px;" placeholder="Nama toko " /> </td>
    </tr>
              <td align="right">(Lama)</td>
            <td>: Outlet <input type="text" id="kode" name="kode" required/></td>
        </tr>
        <tr>
          <td align="right"></td>
            <td>: Nama Outlet <span id="nama-outlet">-</span></td><td>
        </tr> 

    <tr>
        <td>Order</td>
        <td>: <input type="text"  name="order_po" style="width:200px;"  /></td>
    </tr>

<tr>
 <td>Keterangan</td>
 <td>: <input type="textarea" style="width:200px;" placeholder="Masukan Keterangan ..." name="keterangan" /></td>
</tr>

<tr>
 <td colspan="2"><input type="submit" class="btn btn-primary" value="Simpan" /></td>
</tr>
</table>
</form>
</div>
</div>
</div>
   <!-- <script type="text/javascript">
    $(document).ready(function(){
    $("#kode").autocomplete({
    minLength:2,
    source:'get_product.php',
    select:function(event, ui){
    $('#nama-produk').html(ui.item.nama);
	$('#alamat-outlet').html(ui.item.type);
    }
    });
    });
</script> -->

<script src="bselect/select2_jquery-1.11.2.min.js"></script>
<script src="bselect/select2_select2.min.js"></script>
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

</body>
</html>
<?php ob_flush(); ?>