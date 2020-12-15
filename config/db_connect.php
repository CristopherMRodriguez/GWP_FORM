<?php

$conn = mysqli_connect("localhost", "cris", "bebe", "GWP");
if (!$conn) {
  echo 'Connection error: ' . mysqli_connect_error();
}

?>