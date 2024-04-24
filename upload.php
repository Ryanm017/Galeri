<?php

session_start();
if (empty($_SESSION['user'])) {
    header('Location: login.php');
}
include './function.php';

if (isset($_POST['submit'])) {
    $judul_foto = $_POST['judul_foto'];
    $deskripsi_foto = $_POST['deskripsi_foto'];
    $user_id = $_SESSION['user']['user_id'];
    $tanggal_unggahan = date('Y-m-d');

    $tmp_file = $_FILES['lokasi_file']['tmp_name'];
    $nama_file = uniqid() . "_" . $_FILES['lokasi_file']['name'];

    move_uploaded_file($tmp_file, './foto/' . $nama_file);

    $query = mysqli_query($conn, "INSERT INTO `foto` VALUES ('', '$judul_foto', '$deskripsi_foto', '$tanggal_unggahan', '$nama_file', '$user_id')");

    if ($query > 0) {
        header('Location: index.php');
    } else {
        echo "<script>alert('Upload Gagal')</script>";
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
    <title>upload</title>
</head>
<body>
<nav>
    <label class="logo"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-peace" viewBox="0 0 16 16">
  <path d="M7.5 1.018a7 7 0 0 0-4.79 11.566L7.5 7.793zm1 0v6.775l4.79 4.79A7 7 0 0 0 8.5 1.018m4.084 12.273L8.5 9.207v5.775a6.97 6.97 0 0 0 4.084-1.691M7.5 14.982V9.207l-4.084 4.084A6.97 6.97 0 0 0 7.5 14.982M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8"/>
</svg></label>
    <ul>
      <li>
        <a href="./index.php"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
  <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z"/>
  <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z"/>
</svg></a>
        
      </li>
        <?php if (!empty($_SESSION['user'])) : ?>
          <li>
            <a href="upload.php"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-folder-plus" viewBox="0 0 16 16">
  <path d="m.5 3 .04.87a2 2 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2m5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19q-.362.002-.683.12L1.5 2.98a1 1 0 0 1 1-.98z"/>
  <path d="M13.5 9a.5.5 0 0 1 .5.5V11h1.5a.5.5 0 1 1 0 1H14v1.5a.5.5 0 1 1-1 0V12h-1.5a.5.5 0 0 1 0-1H13V9.5a.5.5 0 0 1 .5-.5"/>
</svg></a>
          </li>
          <li>
            <a href="profile.php"><a href="profile.php"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
  <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
</svg></a>
          </li>
          <li>
            <a href="logout.php"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-door-open-fill" viewBox="0 0 16 16">
  <path d="M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15zM11 2h.5a.5.5 0 0 1 .5.5V15h-1zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1"/>
</svg></a> 
           
          </li>
        <?php else : ?>
          <li>
            <a href="./login.php">Login</a>
          </li>
          <li>
            <a href="./register.php">Register</a>
          </li> 
      </ul>
      <?php endif; ?>
    </div>
</nav>
<div class="d-flex justify-content-center mt-5">
<form class="border border-secondary w-25 p-3 rounded" action="" method="POST" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">judul Foto</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="judul_foto" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">deskripsi foto</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="deskripsi_foto" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Tanggal</label>
    <input type="date" class="form-control" id="exampleInputEmail1" name="tanggal_unggahan" aria-describedby="emailHelp">
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