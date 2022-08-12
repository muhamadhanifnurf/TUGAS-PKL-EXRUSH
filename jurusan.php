<html>
<head>
    <title>Tampil Data Jurusan</title>
</head>
<body>
    <table cellpadding="2" cellspacing="0" border="1">
        <thead>
            <th>No</th>
            <th width='150'>Nama Jurusan</th>
        </thead>
        <tbody>
<?php
	include ('koneksi.php');
	//*********** Perintah menampilkan data jurusan ***********//
	$sql=mysql_query("select * from tb_jurusan order by id_jurusan ASC");
	$no=1;
                  while ($row=mysql_fetch_array($sql)){
                  $nama_jurusan=$row['nama_jurusan'];
                  echo "
                    <tr>
                        <td>".$no."</td>
                        <td width='150'>".$row['nama_jurusan']."</td>
                    </tr>
                           ";
	      $no++;
                };
            ?>
          </tbody>

    </table>
</body>
</html>