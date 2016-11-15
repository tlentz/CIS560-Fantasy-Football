<?php
session_start();
session_destroy();
include('includes/header.php');
?>
<div class="alert alert-success">
  <strong>Success!</strong> You have been logged out successfully.
</div>
<?php
include('includes/footer.php');
?>
