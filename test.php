<?php
include('header.php');

// Check connection
if (!$mysqli) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully<br>";

echo "Hello world!!!";

$query = "SELECT * FROM Users";
$result = $mysqli->query($query);
$array = r2a($result);

echo "<pre>";print_r($array);echo "</pre>";

function r2a($r)
{
    $a = array();
    while($row = mysqli_fetch_assoc($r))
    {
        $a[] = $row;
    }
    return $a;
}

include('footer.php');
?>
