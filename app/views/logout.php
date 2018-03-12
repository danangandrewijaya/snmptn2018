<?php
(!isset($_SESSION))?session_start():"";
session_destroy();
header("location:unauth.php?page=login");
