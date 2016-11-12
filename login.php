<style>
input[type="text"], input[type="password"]{
  width: 300px;
}
</style>
<?php
include('header.php');

if(isset($_POST['submit'])){
  $username = $_POST['username'];
  $password = $_POST['password'];

  $query = "SELECT * FROM Users WHERE username='".$username."' AND password='".$password."'";
  $result = $mysqli->query($query);
  if(!empty($result)){
    $array = r2a($result);
    $_SESSION['user']['id'] = $array[0]['userID'];
    $_SESSION['user']['username'] = $array[0]['username'];
    $_SESSION['user']['firstName'] = $array[0]['fName'];
    $_SESSION['user']['lastName'] = $array[0]['lName'];
    echo "Success";
    echo "<pre>";print_r($_SESSION); echo "</pre>";
  }
}
?>

<form method="post">
  <div class="form-group">
    <label for="firstName">Username</label>
    <input type="text" class="form-control" id="username" name="username">
  </div>
  <div class="form-group">
    <label>Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  <div class="form-group">
    <input type="submit" class="btn btn-primary" id="submit" name="submit" value="Login">
  </div>
</form>

<?php
include('footer.php');

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
