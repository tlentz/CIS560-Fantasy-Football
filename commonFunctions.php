<?php
function r2a($r)
{
    $a = array();
    while($row = mysqli_fetch_assoc($r))
    {
        $a[] = $row;
    }
    return $a;
}
?>
