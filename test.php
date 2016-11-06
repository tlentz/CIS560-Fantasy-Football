<?php
$mysqli = new mysqli("mysql.cis.ksu.edu", "markloev", "pcEkhG5B5kg8XExJ%RD");

// Check connection
if (!$mysqli) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully<br>";

echo "Hello world!!!";
?>