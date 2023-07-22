<?php
// Opens a connection to a MySQL server.
$connection=mysqli_connect ("localhost", 'root', '','tms');
if (!$connection) {
    die('Not connected : ' . mysqli_connect_error());
}
