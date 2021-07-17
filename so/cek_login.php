<?php
include "../config/koneksi.php";
function antiinjection($data)
{
  $filter_sql = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter_sql;
}

$username = antiinjection($_POST['username']);
$pass     = antiinjection(md5($_POST['password']));

$login=mysql_query("select * from user_login where username='$username' and password='$pass'");
$ketemu=mysql_num_rows($login);
$r=mysql_fetch_array($login);

$employee_number = $r['employee_number'];

$employee= mysql_query("SELECT * FROM employee WHERE employee_number='$employee_number'");
$fetch_employee= mysql_fetch_array($employee);
$id_jabatan =  $fetch_employee['id_jabatan'];

$jabatan= mysql_query("SELECT * FROM jabatan WHERE id_jabatan='$id_jabatan'");
$fetch_jabatan= mysql_fetch_array($jabatan);

// Apabila username dan password ditemukan
if ($ketemu > 0){
  session_start();
  /*session_register("namauser");
  session_register("namalengkap");
  session_register("passuser");
  session_register("leveluser");*/

  $_SESSION['namauser']     = $r['username'];
  $_SESSION['passuser']     = $r['password'];
  $_SESSION['jabatan']      = $fetch_jabatan['nama_jabatan'];
  $_SESSION['employee_number'] = $r['employee_number'];
  $_SESSION['login_hash']     = $r['login_hash'];
  
  header('location:pages/main.php?route=home');
}
else{
  echo "<script>alert('Login failured, please try again !');</script>";
  echo "<script>window.location='index.php'</script>";
}
?>
