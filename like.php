<?php

session_start();
include './function.php';

$foto_id = $_GET['foto_id'];
$user_id = $_SESSION['user']['user_id'];
$tanggal_like = date('Y-m-d');

$q = mysqli_query($conn, "SELECT * FROM like_foto WHERE foto_id = $foto_id AND user_id = $user_id");

if (mysqli_num_rows($q) > 0) {
    mysqli_query($conn, "DELETE FROM like_foto WHERE foto_id = $foto_id AND user_id = $user_id");
} else {
    mysqli_query($conn, "INSERT INTO like_foto VALUES ('', '$foto_id', '$user_id', '$tanggal_like')");
}


header('Location: ' . $_SERVER['HTTP_REFERER']);
