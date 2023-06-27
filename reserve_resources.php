<?php

ob_start();
session_start();
$servername = "localhost";
$username = "GP5";
$password = "12345";
$dbname = "gp5";


$conn = new mysqli($servername, $username, $password, $dbname);



if($conn->connect_error){
  die("connection faild". $conn->connect_error);
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
  width: 30%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 15%;
}

button:hover {
  opacity: 0.8;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}
.error{
  color: tomato;
}
/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
}
</style>
</head>
<body>

<h2>Reserve Form</h2>

<form autocomplete="off" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype = "multipart/form-data">
  <div style="padding: 16px;">
        <span xlass="error"><?php if(isset($loginErr))  echo $loginErr;?></span>
    <label for="uname"><b>Passport Number</b></label><br>
    <input type="text" placeholder="Enter Passport Number" name="uname" required><br>

    <label for="psw"><b>Password</b></label><br>
    <input type="password" placeholder="Enter Password" id="pass" name="psw" required><br>
      <input type="checkbox"  onclick="myFunction()" style="position: absolute;top: -55px; right: -360px; display: inline-block;position: relative;overflow: hidden;">
    <input type="text" style="display:none;" placeholder="enter isbn" name="isbn" value="<?php if(isset($_GET['ID'] ) ){extract($_GET); $isbn = $_GET['ID']; echo $isbn;} ?>">
    <button type="submit" name="reserve">Reserve</button>
      <button type="button" class="cancelbtn" style="  background-color: #f44336;padding: 14px 20px;width: 15%;" name="cancel_reserve">Cancel</button>
  </div>
</form>

<?php

if(isset($_POST["reserve"])){

  $isbn = test_input($_POST['isbn']);
  $password = test_input($_POST['psw']);
  $loginId = test_input($_POST['uname']);
  if(empty($loginId) || empty($password)){
    header("Location:reserve_resources.php?password=empty&loginid=empty");
    exit();
  }else{
    $sql = "SELECT * FROM patron WHERE Passport_Number= '$loginId'";
      $result = mysqli_query($conn ,$sql);
    if($result === false){
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
     } else {
        $row=mysqli_fetch_assoc($result);
          $loginVerify = strcmp($loginId ,$row["Passport_Number"]);
        $passwordVerify = strcmp($password ,$row["PASSWORD"]);
         if($passwordVerify==0 && $loginVerify==0 ){
          $updateIsbn = update_resource($isbn);
           if($updateIsbn===false){
             header("Location:reserve_resources.php?sql=failed");
              exit();
           }else {
             $insertIsbn = insert_checkout();
             if($insertIsbn === false){
                  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
             } else {
               header("Location:reserve_resources.php?book=reserved");
                }
           }
        }else {
           header("Location:reserve_resources.php?password=wrong");
          exit();
        }
    }

       mysqli_close($conn);
  }
}
if(isset($_POST['cancel_reserve'])){
  header("Location: search_resources.php");
  exit();
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function update_resource($isbn){
  $servername = "localhost";
  $username = "GP5";
  $password = "12345";
  $dbname = "gp5";


  $conn = new mysqli($servername, $username, $password, $dbname);

  if($conn->connect_error){
    die("connection faild". $conn->connect_error);
  }
    $result = mysqli_query($conn , "SELECT * FROM resources WHERE isbn = $isbn");

  if($result===false){

      echo "Error: " .$sql . "<br>" . mysqli_error($conn);
  }

}
function insert_checkout(){

  require_once('connection.php');
  $status = "reserve";
  $isbn = $_POST['isbn'];
  $PassportNumber = $_POST['uname'];
  $sql = "SELECT status from checkout where status='$status' AND Passport_Number='$PassportNumber'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $rowCount = mysqli_num_rows($result );
    if(  $rowCount>2){
      header("Location:search_resources.php?reserve=limitExceeded");
    }else{
  $sql = "INSERT INTO checkout (Passport_Number,isbn , status) VALUES ('$PassportNumber','$isbn' ,'$status')";
  $result = mysqli_query($conn, $sql);
  if($result==true){
    return $result;
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    exit();
   }
  }
}
?>
<script type="text/javascript">

function myFunction() {
  var x = document.getElementById("pass");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }

}
</script>
</body>
</html>
