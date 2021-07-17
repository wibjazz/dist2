  <?php
  session_start();
  $dir="../../../../";
  date_default_timezone_set('Asia/Jakarta');
  include $dir."config/koneksi.php";
  include $dir."config/library.php";
  include $dir."config/fungsi_indotgl.php";
  include $dir."config/fungsi_rupiah.php";
//employee
  $employee=mysql_query("SELECT * from employee where employee_number='$_GET[id]'");
  $e=mysql_fetch_array($employee);
  ?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Cetak Laporan Outlet Sales</title>
    <link rel="stylesheet" href="<?php echo $dir;?>bootstrap/css/bootstrap.min.css">

    <style>
      table {
        border-collapse: collapse;
        font-family:Arial, Helvetica, sans-serif;
        font-size:14px;
      }

      td {
       font-size:12px;
     }

     table, td, th {
      border: 1px solid black;
    }
  </style>

  <style>
    .table1 {
      font-family: sans-serif;
      color: #444;
      border-collapse: collapse;
      width: 100%;
      border: 1px solid #f2f5f7;
    }

    .table1 tr th{
      background: maroon;
      color: #fff;
      font-size: 14px;
    }

    .table1, th, td {
      padding: 8px 20px;
      /*text-align: center;*/
      font-size: 12px;
    }

    .table1 tr:hover {
      background-color: #f5f5f5;
    }

    .table1 tr:nth-child(even) {
      background-color: #f2f2f2;
    }

  </style>
</head>

<body>
  <p align="center"><img src="<?php echo $dir;?>/images/logo1.png" width="100px"></p>
  <p align="center" style="font-size:12px; font-family:Arial, Helvetica, sans-serif;"><b>LAPORAN OUTLET</b><br/>
    <b>SALES : <?php echo $e['name_e']; ?></b></p>
    <table width="100%" cellpadding="5px" class="table1">
      <thead>
        <tr>
          <th>No.</th>
          <th>Kode Outlet</th>
          <th>Nama Outlet</th>
          <th>Alamat Outlet</th>
          <th>Telepon / Hp</th>
          <th>Jenis</th>
        </tr>
      </thead>
      <tbody>
       <?php
					//orders
       $orders_detail=mysql_query("SELECT * from outlet where employee_number='$_GET[id]' order by nama_outlet asc");
       $no=1;
       while($p=mysql_fetch_array($orders_detail))
       {
        ?>
        <tr >
          <td><?php echo $no; ?></td>
          <td><?php echo $p['id_outlet']; ?></td>
          <td align="left"><?php echo $p['nama_outlet']; ?></td>
          <td align="left"><?php echo $p['alamat_outlet']; ?></td>
          <td><?php echo $p['telp_outlet']; ?> / <?php echo $p['hp_outlet']; ?></td>
          <td><?php echo $p['jenis_outlet']; ?></td>                      
        </tr>
        <?php
        $no++;
      }
      ?>
    </tbody>
  </table>
  <p align="center">copyright &copy; 2020-<?php echo $thn_sekarang." ".$naper1." ".$naper2;?> </p>
  <!-- Bootstrap 3.3.5 -->
<script src="<?php echo $dir;?>bootstrap/js/bootstrap.min.js"></script>
</body>
</html>