<?php
ob_start();
include "../../../config/koneksi.php";
?>
<html>
<head>
<title>Form Input Target</title>
<link href="../../../bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="../../../dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
<link href="../../../dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
<!-- Tambahkan jqueryUI disini -->
<script type="text/javascript" src="../../jquery-ui/js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="../../jquery-ui/js/jquery-ui-1.10.4.custom.min.js"></script>
<link type="text/css" rel="stylesheet" href="../../jquery-ui/css/smoothness/jquery-ui-1.10.4.custom.min.css"/>
</head>
<body>
<h1 align="center">FORM INPUT TARGET | MITRA BERSAUDARA</h1>
<form method="post" action="aksi_target.php?route=target&act=input">
<table width="50%" border="0" align="center">
  	<tr>
       	<td colspan="2"><h3>A. Data PO</h3></td>
    </tr>

    <tr>
       	<td>Tgl PO</td>
        <!-- <td>: <input type="text" id="datepicker" name="tgl_po" style="width:400px;" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask required/></td> -->
        <td>
            <label for="month">Month: </label>
<input type="text" id="month" name="tgl_target" class="monthPicker" />
        </td>
    </tr>
        <tr>
        	<td colspan="2"><input type="submit" class="btn btn-primary" value="Simpan" /><br/> <input type="button" name="kembali" class="btn btn-primary" value="Kembali ..." onclick="location.href = '../../main.php?route=target';" style="cursor:pointer;" />
            </td>

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
		dateFormat:'yy-mm',
		yearRange:'-45:+10'
	});
});
</script>

<script type="text/javascript">
$(document).ready(function()
{   
    $(".monthPicker").datepicker({
        dateFormat: 'mm-yy',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,

        onClose: function(dateText, inst) {
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).val($.datepicker.formatDate('mm-yy', new Date(year, month, 1)));
        }
    });

    $(".monthPicker").focus(function () {
        $(".ui-datepicker-calendar").hide();
        $("#ui-datepicker-div").position({
            my: "center top",
            at: "center bottom",
            of: $(this)
        });
    });
});
</script>


<!-- <script>
$(function() {
	$("#datepicker2").datepicker({
		changeMonth:true,
		changeYear:true,
		dateFormat:'yy-mm',
		yearRange:'-45:+10'
	});
});
</script> -->

<!-- <script>
$(function() {
	$("#datepicker3").datepicker({
		changeMonth:true,
		changeYear:true,
		dateFormat:'yy-mm-dd',
		yearRange:'-45:+10'
	});
});
</script> -->
</body>
</html>
<?php ob_flush(); ?>