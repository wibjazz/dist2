<?php
//koneksi
include "../../../config/koneksi.php";
//link
$tambah=mysql_query("select * from orders where id_orders = '$_GET[id]'");
$t=mysql_fetch_array($tambah);
//outlet
$outlet=mysql_query("select * from outlet where id_outlet = '$t[id_outlet]'");
$ot=mysql_fetch_array($outlet);
?>

<!doctype html>
<html>
<head>
<title>Form Input PO Modern</title>
<link href="../../../bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="../../../dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
<link href="../../../dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
<!-- Tambahkan jqueryUI disini -->
<script type="text/javascript" src="../../jquery-ui/js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="../../jquery-ui/js/jquery-ui-1.10.4.custom.min.js"></script>
<link type="text/css" rel="stylesheet" href="../../jquery-ui/css/smoothness/jquery-ui-1.10.4.custom.min.css"/>
</head>
<body>
    <h1 align="center">FORM INPUT PO MODERN | MITRA BERSAUDARA</h1>
    <form method="post" action="aksi_po.php?route=po-modern&act=input-lagi">
    <table width="50%" border="0" align="center">
    	<tr>
        	<td colspan="2"><h3>A. Data PO</h3></td>
        </tr>
        <tr>
        	<td width="150px">No. PO</td>
            <td>: <input type="text" style="width:400px;" value="<?php echo $t['keterangan_o']; ?>" name="no_po" readonly/> <input type="hidden" style="width:400px;" value="<?php echo $t['id_orders']; ?>" name="ido"/></td>
        </tr>
        <tr>
        	<td>Tgl PO</td>
            <td>: <input type="text" name="tgl_po" style="width:400px;" data-inputmask="'alias': 'yyyy-mm-dd'" value="<?php echo $t['tgl_order']; ?>" readonly data-mask/></td>
        </tr>
        <tr>
        	<td>Tgl. Expired PO</td>
            <td>: <input type="text" value="<?php echo $t['tgl_expired_po']; ?>" readonly name="tgl_expired" style="width:400px;" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask/></td>
        </tr>
        <tr>
        	<td>Metode Pembayaran</td>
            <td>: <select name="payment" style="width:400px;">
            			<?php
						if($t['payment']=='Credit')
						{
							echo"
                      	<option value='Credit' selected>Credit</option>
                        <option value='Cash'>Cash</option>";
						}
						else
						{
							echo"
                      	<option value='Credit'>Credit</option>
                        <option value='Cash' selected>Cash</option>";
						}
						?>
                      </select></td>
        </tr>
        <tr>
        	<td>Tgl. Jatuh Tempo</td>
            <td>: <input type="text" value="<?php echo $t['tgl_jth_tempo']; ?>" readonly name="tgl_tempo" style="width:400px;" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask/></td>
        </tr>
        <tr>
        	<td colspan="2"><h3>B. Data Outlet / Toko</h3></td>
        </tr>
        <tr>
        	<td>Nama Outlet</td>
            <td>: <input type="hidden" name="kode" value="<?php echo $t['id_outlet']; ?>" readonly/> <input type="text" name="nama_outlet" value="<?php echo $ot['nama_outlet']; ?>" readonly/></td>
        </tr>
        <tr>
        	<td>Alamat Outlet</td>
            <td>: <span id="alamat-outlet"><?php echo $ot['alamat_outlet']; ?></span></td>
        </tr>
        <tr>
        	<td colspan="2"><h3>C. Data Barang</h3></td>
        </tr>
        <tr>
        	<td>Nama Barang</td>
            <td>: <select name="produk" style="width:400px;">
                      	<?php
						//produk
						$produk=mysql_query("select * from produk where jenis = 'Produk' order by nama_produk asc");
						while($pro=mysql_fetch_array($produk))
						{
							echo"<option value='$pro[id_produk]'>$pro[id_produk] - $pro[nama_produk] - $pro[stok_kantor] pcs</option>";
						}
						?>
                      </select></td>
        </tr>
        <tr>
        	<td>Harga Barang Rp.</td>
            <td>: <input type="text" style="width:400px;" placeholder="Masukan harga produk ..." name="harga"/></td>
        </tr>
        <tr>
        	<td>Jumlah Beli</td>
            <td>: <input type="text" style="width:400px;" placeholder="Masukan jumlah beli ..." name="jumbel"/></td>
        </tr>
        <tr>
        	<td>Diskon 1</td>
            <td>: <input type="text" style="width:400px;" placeholder="Masukan diskon 1 ..." name="diskon1"/></td>
        </tr>
        <tr>
        	<td>Diskon 2</td>
            <td>: <input type="text" style="width:400px;" placeholder="Masukan diskon 2 ..." name="diskon2"/></td>
        </tr>
        <tr>
        	<td>Diskon 3</td>
            <td>: <input type="text" style="width:400px;" placeholder="Masukan diskon 3 ..." name="diskon3"/></td>
        </tr>
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
    $('#nama-produk').html(ui.item.nama);
	$('#alamat-outlet').html(ui.item.type);
    }
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