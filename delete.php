<?php

$foto_id = $_GET["foto_id"];

include './function.php';

mysqli_query($conn, "DELETE FROM foto WHERE foto_id = $foto_id");

header('Location: ' . $_SERVER['HTTP_REFERER']);