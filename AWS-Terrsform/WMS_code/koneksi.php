<?php

    $db      = 'stockgudang';
    $host    = 'wmsdb.cx2qys0agxur.us-east-1.rds.amazonaws.com';
    $pass    = 'sqladmin';
    $user    = 'admin';

    $koneksi = mysqli_connect($host, $user, $pass, $db);

    if (!$koneksi) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>
