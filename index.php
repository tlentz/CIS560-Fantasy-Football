<link rel="stylesheet" href="index.css">
<?php
include('includes/header.php');
?>

<div class="row">
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
</div>

<?php
include('includes/footer.php');
?>

<script>
  $(".tile").click(function(){
    id = $(this).children("h3").attr('id') + ".php";
    window.location.href= id;
  });
</script>
