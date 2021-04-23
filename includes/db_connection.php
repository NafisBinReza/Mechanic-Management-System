<?php

$connect = mysqli_connect("localhost", "root", "", "assignment3");
if (!$connect) {
  die("Database Connection Failed" . mysqli_error($connect));
}


?>