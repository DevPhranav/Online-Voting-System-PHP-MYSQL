<?php

$con = mysqli_connect("localhost", "root", "root", "onlinevotingsystem");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

?>