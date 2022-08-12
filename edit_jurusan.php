<html>
<head>
    <title>Tampil Data Jurusan</title>
</head>
<body>
/*Untuk mengetengahkan kontent */
<center>
<?php include ('koneksi.php'); ?> /*Perintah memanggil file koneksi*/
/*Petingah untuk memastikan edit di klik */
<?php if ($_GET['id_jurusan']){
$id=$_GET['id_jurusan'];
$sql_edit=mysql_query("select * from tb_jurusan where id_jurusan='$id'");
while ($data=mysql_fetch_array($sql_edit)){
    $ed_id_jurusan=$data['id_jurusan'];
    $ed_nama_jurusan=$data['nama_jurusan'];
?>
    <form action="edit_jurusan.php" method="POST">
    <input type="hidden" name="id_jurusan" value="<?php echo $ed_id_jurusan ?>">
    Nama Jurusan :
    <input type="text" name="nama_jurusan" value="<?php echo $ed_nama_jurusan ?>">
    <br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="submit" name="update" value="Update">
    <a href='edit_jurusan.php'><input type="button" name="batal" value="Batal"> </a>
    </form>
    <br>
<?php } } ?>
<?php
/*Perintah untuk memastikan apakah tombol update di tekan*/
if ($_POST['update']){
$id_jurusan=$_POST['id_jurusan'];
$nama_jurusan=($_POST['nama_jurusan']);
$ubah=mysql_query("UPDATE tb_jurusan SET  nama_jurusan='$nama_jurusan' where id_jurusan='$id_jurusan'")or die(mysql_error());
} ?>
<table cellpadding="2" cellspacing="0" border="1">
    <thead>
        <th>No</th>
        <th width='150'>Nama Jurusan</th>
        <th>Aksi</th>
    </thead>
    <tbody>
    <?php
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
                              <td><a href='edit_jurusan.php?id_jurusan=".$row['id_jurusan']."'>Edit </a></td>
                      </tr>
                   ";
	$no++;
              };
    ?>
    </tbody>
    </table>
</center>
</body>
</html>