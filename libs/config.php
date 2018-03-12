<?php
$connect = mysqli_connect("localhost", "root", "", "snmptn-verifikasi");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

//mysqli_close($connect);
?>