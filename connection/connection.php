<?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $db = 'project_uas_pwd';

    $conn = mysqli_connect($servername, $username, $password, $db);

    if(mysqli_connect_errno()){
        echo 'koneksi Gagal : '.mysqli_connect_error();
    }

?>