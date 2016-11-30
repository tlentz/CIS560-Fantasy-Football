<link rel="stylesheet" href="index.css">
<?php
include('includes/header.php');
?>

<!--<div class="row">
  <div class="tile col-md-3">
      <h3 class="whiteText" id="viewStat">View Stats</h3>
  	  <p>Test</p>
  </div>
  <div class="tile col-md-3">
      <h3 class="whiteText" id="viewFantasy">View Fantasy Team</h3>
      <p>Test</p>
  </div>
  <div class="tile col-md-3">
      <h3 class="whiteText" id="createFantasy">Create Fantasy Team</h3>
      <p>Test</p>
  </div>
</div>-->
<?php
$season = "";
$week = "";
if(isset($_GET['season'])) {
  $season = $_GET['season'];
}
if(isset($_GET['week'])) {
  $week = $_GET['week'];
}
$teams = array();
if($season != "" && $week == "") {
  //$teams = getTeams($season,$week);
}
?>
<form method='GET'>
  <?php if($season == "" || $week == "") { ?>
    <div class="alert alert-warning">
      <strong>Warning!</strong> Both season and week must be selected.
    </div>
  <?php } ?>
  <div class='row'>
    <div class='col-sm-4'>
      <label>Season</label>
      <select class='form-control seasonWeek' name='season'><?php printSeasons($season); ?></select>
    </div>
    <div class='col-sm-4'>
      <label>Week</label>
      <select class='form-control seasonWeek' name='week'><?php printWeeks($season,$week); ?></select>
    </div>
    <div class='col-sm-4'>
      <label>&nbsp;</label>
      <a class='btn btn-primary form-control' href="createTeam.php?season=<?= $season ?>&week=<?= $week ?>">Create Team</a>
    </div>
  </div>

  <div class="page-header text-center">
		<h1>Your Team</h1>
	</div>
  <?php if(count($teams) > 1) { ?>
    <div class="alert alert-warning">
      No team this week.
    </div>
  <?php } else { ?>
    <table class='table table-striped'>
      <thead>
        <th>Position</th>
        <th>Player</th>
      </thead>
      <tbody>
        <tr><td>QB</td><td>QB Name</td></tr>
        <tr><td>RB</td><td>RB Name</td></tr>
        <tr><td>RB</td><td>RB Name</td></tr>
        <tr><td>WR</td><td>WR Name</td></tr>
        <tr><td>WR</td><td>WR Name</td></tr>
        <tr><td>TE</td><td>TE Name</td></tr>
        <tr><td>FLEX</td><td>FLEX Name</td></tr>
        <tr><td>DF</td><td>DF Name</td></tr>
        <tr><td>PK</td><td>PK Name</td></tr>
      </tbody>
    </table>
  <?php } ?>
</form>

<?php
include('includes/footer.php');
?>

<script>
  $(".tile").click(function() {
    id = $(this).children("h3").attr('id') + ".php";
    window.location.href= id;
  });
  $('.seasonWeek').change(function() {
    $(this).closest('form').trigger('submit');
  });
</script>
