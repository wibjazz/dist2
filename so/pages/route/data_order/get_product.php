<?php
ob_start();
$dir="../../../../";
include $dir."config/koneksi.php";
$term = $_GET['term'];
$query = mysql_query("SELECT * from outlet where nama_outlet like '%".$term."%'");
$json = array();
while($produk = mysql_fetch_array($query)){
	$json[] = array(
'label' => $produk['id_outlet'].' – '.$produk['nama_outlet'], // text sugesti saat user mengetik di input box
'value' => $produk['id_outlet'], // nilai yang akan dimasukkan diinputbox saat user memilih salah satu sugesti
'nama' => $produk['nama_outlet'],
'type' => $produk['alamat_outlet']
);
}
header("Content-Type: text/json");
echo json_encode($json);
ob_flush();
?>