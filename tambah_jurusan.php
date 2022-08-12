<html>
<head>
	<title>Form Tambah Jurusan</title>
</head>
<body>

<form action="tambah_jurusan.php" method="POST">
Nama Jurusan :
<input type="text" name="nama_jurusan" value="" placeholder="Input nama jurusan">
<br>
<input type="submit" name="simpan" value="Simpan">
</form>

<?php
/*Mengecek apabila tombol simpan di klik*/
if ($_POST['simpan']) {
include ('koneksi.php');
/*Menerima dan Menampung data*/
$nama_jurusan = $_POST['nama_jurusan'];
/*Melakukan penyimpanan data*/
 $sql=mysql_query ("INSERT INTO tb_jurusan VALUES ('','$nama_jurusan')");
    }
 ?>

</body>
</html>