<?php
session_start();
if(isset($_POST['patron_login'])){
  require("connection.php");
  $loginId = test_input($_POST['uname']);
  $password = test_input($_POST['psw']);

  if(empty($loginId) || empty($password)){
    header("Location:patron_login.php?error=emptyfield");
    exit();
  }else{
    $quary = "SELECT * FROM patron WHERE Passport_Number=?";
    $statement = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($statement,$quary)){
      header("Location:patron_login.php?error=sqlerror");
      exit();
    }
    else {
      mysqli_stmt_bind_param($statement, "s", $loginId);
      mysqli_stmt_execute($statement);
      $resultCheck = mysqli_stmt_get_result($statement);
      if($record=mysqli_fetch_assoc($resultCheck)){
        $passwordVerify = strcmp($password ,$record['PASSWORD']);
         if($passwordVerify== 0){
          $_SESSION['id'] = $record['Passport_Number'];
          header("Location:patron_profile.php?login=success");
        }else {
          header("Location:search_resources.php?error=wrongpassword");
          exit();
        }
      } else{
        header("Location:search_resources.php?error=nouser");
        exit();
      }
    }
    mysqli_stmt_free_result ($statement);
    mysqli_stmt_close($statement);
    mysqli_close($conn);
  }
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
