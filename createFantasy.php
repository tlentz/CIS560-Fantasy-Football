<?php
include('includes/header.php');

//$query = "SELECT a.*, b.* FROM Player a INNER JOIN PlayerStat b ON b.playerStatID = a.playerID INNER JOIN Position c ON c.positionID = b.positionID";
$query = "SELECT * FROM Users";
$result = $mysqli->query($query);
$array = r2a($result);

?>

<table id="table" class="display table-striped table-inverse table-hover" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Name</th>
            <th>Position</th>
            <th>Office</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($array as $a){ ?>
        <tr>
            <th><?= $a['fName'].$a['lName'] ?></th>
            <th><?= $a['password'] ?></th>
            <th><?= $a['username'] ?></th>
        </tr>
        <?php } ?>
    </tbody>
</table>

<?php
include('includes/footer.php');

?>

<script>
$(document).ready(function() {
  $(document).ready(function(){
    $('#table').DataTable();
  });
} );
</script>
