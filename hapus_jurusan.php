<html>
<head>
	<title>Tampil Data Jurusan</title>
</head>
<body>
<center>
<table cellpadding="2" cellspacing="0" border="1">
    <thead>
            <th>No</th>
            <th width='150'>Nama Jurusan</th>
            <th>Aksi</th>
    </thead>
<tbody>
    <?php
             include ('koneksi.php');
             //*********** Perintah menampilkan data jurusan ***********//
            $sql=mysql_query("select * from tb_jurusan order by id_jurusan ASC");
            $no=1;
                while ($row=mysql_fetch_array($sql)){
                $id_jurusan=$row['id_jurusan'];
                $nama_jurusan=$row['nama_jurusan'];
                echo "
                <tr>
                     <td>".$no."</td>
                     <td width='150'>".$row['nama_jurusan']."</td>
	  <td><a href='hapus_jurusan.php?hapus_id_jurusan=".$row['id_jurusan']."'>Hapus </a></td>
                 </tr>";
              $no++;
             };
   ?>
     </tbody>
    </table>
</center>
<?php
if ($_GET['hapus_id_jurusan']){
$id = $_GET['hapus_id_jurusan'];
$del="DELETE FROM tb_jurusan where id_jurusan='$id'";
$del= mysql_query($del);
} ?>
</body>
</html>