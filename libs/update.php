<?php
include "config.php";

if(isset($_POST["id"]))
{
 $value = mysqli_real_escape_string($connect, $_POST["value"]);
 $query = "UPDATE prestasi SET ".$_POST["column_name"]."='".$value."', flag_ver = 1 WHERE id_prestasi = '".$_POST["id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Updated';
 }
}
?>
