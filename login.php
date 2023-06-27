<?php
$servername = "localhost";
$username = "GP5";
$password = "12345";
$dbname = "gp5";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if(!$conn){
  die("connection faild". mysqli_connect_error());
}
if(isset($_POST['patron_login'])) {
  $loginId = test_input($_POST['uname']);
  $password = test_input($_POST['psw']);
  if(empty($loginId) || empty($password)){
    header("Location: patron_login.php?error=emptyfield");
      exit();
  } else{
    $quary = "SELECT * FROM patron WHERE Passport_Number=?";
    $statement = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($statement ,   $quary)){
      header("Location: patron_login.php?error=sqlerror");
      exit();
    }else{
      mysqli_stmt_bind_param( $statement , "s", $loginId);
      mysqli_stmt_execute($statement);
      $resultCheck = mysqli_stmt_get_result($statement);
      if($row = mysqli_fetch_assoc($resultCheck)){
        $passwordVerify = password_verify($password, $row['PASSWORD']);
        if($passwordVerify == true){
          session_start();
          $SESSION['id']= $row['Passport_Number'];
          header("Location: patron_login.php?successfull=login");
          exit();
        } else{
          $passwordErr ="wrong password";
          exit();
        }
        if($passwordVerify == false){
          $passwordErr ="password does not match";
          exit();
        }
        mysqli_stmt_free_result ($statement);
        mysqli_stmt_close($statement);
        mysqli_close($conn);
      } else {
        header("Location: patron_login.php?error=nouser");
        exit();
      }
    }
  }
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

 ?>
