<?php
session_start();
if (empty($_SESSION['user'])) {
  header('Location: login.php');
}
require 'function.php';

$foto_id = $_GET['foto_id'];

$query = mysqli_query($conn, "SELECT * FROM `foto` WHERE `foto_id` = $foto_id LIMIT 1");
$foto = mysqli_fetch_assoc($query);

if (isset($_POST['submit'])) {
    $judul_foto = $_POST['judul_foto'];
    $deskripsi_foto = $_POST['deskripsi_foto'];


    if ($_FILES['file']) {
        $filename = uniqid() . "_" . $_FILES['file']['name'];

        move_uploaded_file($_FILES['file']['tmp_name'], './foto/' . $filename);
    } else {
        $filename = $foto['lokasi_file'];
    }

    $query = mysqli_query($conn, "UPDATE `foto` SET `judul_foto` = '$judul_foto', `deskripsi_foto` = '$deskripsi_foto', `lokasi_file` = '$filename' WHERE foto_id = $foto_id");

    if ($query > 0) {
        header('Location: index.php');
    } else {
        echo "<script>alert('Gagal Update')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Document</title>
</head>
<body>
<div class="d-flex justify-content-center mt-5">
<form class="border border-secondary w-25 p-3 rounded" action="" method="POST"  enctype="multipart/form-data">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">judul Foto</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="judul_foto" value="<?= $foto['judul_foto'] ?>" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">deskripsi foto</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="deskripsi_foto" value="<?= $foto['deskripsi_foto'] ?>" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">File</label>
    <input type="file" class="form-control" id="exampleInputEmail1" name="lokasi_file" aria-describedby="emailHelp">
  </div>
  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
  </div>
</form> 
</body>
</html>