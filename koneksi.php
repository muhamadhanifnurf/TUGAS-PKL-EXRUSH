<?php

$host = 'localhost';
$user = 'root';
$password = '';
$db = 'absensi_guru';

$koneksi = mysqli_connect($host, $user, $password, $db);
if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}
$users       = "";
$data_guru      = "";
$jadwal_guru    = "";
$absensi_guru  = "";
$sukses    = "";
$error     = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if ($op == 'delete') {
    $id     = $_GET['id'];
    $sql1   = "delete from tugas where id = '$id'";
    $q1     = mysqli_query($koneksi, $sql1);
    if ($q1) {
        $sukses = "Berhasil hapus data";
    } else {
        $error  = "Gagal melakukan delete data";
    }
}
if ($op == 'edit') {
    $id         = $_GET['id'];
    $sql1       = "select * from tugas where id = '$id'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $users        = $r1['users'];
    $data_guru       = $r1['data_guru'];
    $jadwal_guru     = $r1['jadwal_guru'];
    $absensi_guru   = $r1['absensi_guru'];

    if ($users == '') {
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) { //untuk create
    $users        = $_POST['users'];
    $data_guru       = $_POST['data_guru'];
    $jadwal_guru     = $_POST['jadwal_guru'];
    $absensi_guru   = $_POST['absensi_guru'];

    if ($users && $data_guru && $jadwal_guru && $absensi_guru) {
        if ($op == 'edit') { //untuk update
            $sql1    = "update tugas set users ='$users', data_guru='$data_guru', jadwal_guru='$jadwal_guru', absensi_guru='$absensi_guru' where id ='$id'";
            $q1     = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error = "Data gagal diupdate";
            }
        } else { //untuk insert
            $sql1   = "insert into tugas(users,data_guru,jadwal_guru,absensi_guru) values ('$users', '$data_guru','$jadwal_guru','$absensi_guru')";
            $q1     = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses     = "Berhasil memasukkan data baru";
            } else {
                $error      = "Gagal memasukkan data";
            }
        }
    } else {
        $error = "Silahkan masukkan semua data";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Guru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .max-auto {
            width: 800px;
        }

        .card {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="mx-auto">
        <!--untuk memasukkan data-->
        <div class="card">
            <div class="card-header">
                Create / Edit Data
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:300;url=koneksi.php"); //300 : detik/5menit
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    header("refresh:300;url=koneksi.php");
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="users" class="col-sm-2 col-form-label">Users</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="users" name="users" value="<?php echo $users ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="data_guru" class="col-sm-2 col-form-label">Data Guru</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="data_guru" name="data_guru" value="<?php echo $data_guru ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jadwal_guru" class="col-sm-2 col-form-label">Jadwal Guru</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="jadwal_guru" name="jadwal_guru" value="<?php echo $jadwal_guru ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="absensi_guru" class="col-sm-2 col-form-label">Absensi Guru</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="absensi_guru" name="absensi_guru" value="<?php echo $absensi_guru ?>">
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>

        <!--untuk mengeluarkan data-->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Data Guru
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Users</th>
                            <th scope="col">Data Guru</th>
                            <th scope="col">Jadwal Guru</th>
                            <th scope="col">Absensi Guru</th>
                        </tr>
                    <tbody>
                        <?php
                        $sql2   = "select * from tugas order by id desc";
                        $q2     = mysqli_query($koneksi, $sql2);
                        $urut   = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id         = $r2['id'];
                            $users        = $r2['users'];
                            $data_guru       = $r2['data_guru'];
                            $jadwal_guru     = $r2['jadwal_guru'];
                            $absensi_guru   = $r2['absensi_guru'];

                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $users ?></td>
                                <td scope="row"><?php echo $data_guru ?></td>
                                <td scope="row"><?php echo $jadwal_guru ?></td>
                                <td scope="row"><?php echo $absensi_guru ?></td>
                                <td scope="row">
                                    <a href="koneksi.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="koneksi.php?op=delete&id=<?php echo $id ?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delte</button></a>
                                </td>
                            </tr>
                        <?php

                        }
                        ?>
                    </tbody>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</body>

</html>