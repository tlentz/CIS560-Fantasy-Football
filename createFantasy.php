<?php
include('header.php');

$query = "SELECT a.*, b.* FROM Player a INNER JOIN PlayerStat b ON b.playerStatID = a.playerID INNER JOIN Position c ON c.positionID = b.positionID";
$result = $mysqli->query($query);
$array = r2a($result);

foreach($array as $a){

}
?>

<table id="table" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Name</th>
            <th>Position</th>
            <th>Office</th>
            <th>Start date</th>
            <th>Salary</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($array as $a){ ?>
        <tr>
            <th><?= $a[0]['fName'].$a[0]['lName'] ?></th>
            <th><?= $a[0]['fName'] ?></th>
            <th><?= $a[0]['fName'] ?></th>
            <th><?= $a[0]['fName'] ?></th>
            <th><?= $a[0]['fName'] ?></th>
            <th><?= $a[0]['fName'] ?></th>
        </tr>
        <?php } ?>
    </tbody>
</table>

<?php
include('footer.php');

?>

<script>
$(document).ready(function() {
  $(document).ready(function(){
    $('#table').DataTable();
  });
} );
</script>
