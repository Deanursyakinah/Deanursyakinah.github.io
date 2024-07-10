<?php
$connectToSQL = mysqli_connect('localhost', 'root', '', 'tubeslama');
if (!$connectToSQL) {
    die("Error to connect: " . mysqli_connect_error());
}
?>