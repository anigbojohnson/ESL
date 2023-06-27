<?php
session_start();
ob_start();
$servername = "localhost";
$username = "GP5";
$password = "12345";
$dbname = "gp5";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if(!$conn){
  die("connection faild". mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Main Admin</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="librarianStyle.css" rel="stylesheet">
<style>

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  border : none;


}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 2px;
  border: none;
}

table:nth-child(even) {

}
* {
    box-sizing: border-box;
}

body {
    font-family: Arial, Helvetica, sans-serif;
    margin: 0;

}
.error{
  color: tomato;
}
/* Style the header */
.header {

    padding: 8px;
    text-align: center;
    background: #1abc9c;
    color: white;

}

.inHeader{
	width: 400px;
	text-align: left;
}

/* Increase the font size of the h1 element */
.header h1 {
    font-size: 30px;
}

/* Style the top navigation bar */
.navbar {
    overflow: hidden;
    background-color: #333;
}

input {
    border: none;
    background-color: transparent;
 }

.home {
    background-color: #333;
    border: none;
    color: white;
    padding: 20px 20px;
    font-size: 25px;
    cursor: pointer;
    float: right;
}
.home:hover{
  background: #ddd;
  color: black;
}

/* Style the navigation bar links */
.navbar a {
    float: left;
    display: block;
    color: white;
    font-size: 25px;
    text-align: center;
    padding: 20px 20px;
    text-decoration: none;
    transition: 0.5s;
}

/* Right-aligned link */


/* Change color on hover */
.navbar a:hover {
    background-color: #ddd;
    color: black;
}

.dropdown {
    float: left;
    overflow: hidden;
}

input:focus, textarea:focus, select:focus{
       outline: none;
   }

.dropdown .dropbtn {
    font-size: 25px;
    border: none;
    outline: none;
    color: white;
    padding: 20px 20px;
    background-color: inherit;
    font-family: inherit;
    margin: 0;
}



.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    float: none;
    color: lightgray;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
    border-bottom: lightgray solid 1px;
    background: #333;

}

 .dropdown:hover .dropbtn {
  background-color: #ddd;
  color: black;
}

.dropdown-content a:hover {
    background-color: #ddd;
    color: black;
}

.dropdown:hover .dropdown-content {
    display: block;
}



/* Column container */
.row {
    display: flex;
    flex-wrap: wrap;
}

/* Create two unequal columns that sits next to each other */
/* Sidebar/left column */
.side {
    flex: 30%;
    background-color: #f1f1f1;
    padding: 5px;

}

/* Main column */
.main {
    flex: 70%;
    background-color: white;
    padding: 20px;

}



/* Footer */
.footer {
    padding: 20px;
    text-align: center;
    background: #ddd;
    margin-top: 450px;
}

/* Responsive layout - when the screen is less than 700px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 700px) {
    .row {
        flex-direction: column;
    }
}

/* Responsive layout - when the screen is less than 400px wide, make the navigation links stack on top of each other instead of next to each other */
@media screen and (max-width: 400px) {
    .navbar a {
        float: none;
        width:100%;
    }
}

@media screen and (max-width: 400px) {
  .topnav a:not(:first-child), .dropdown .dropbtn {
    float: none;
        width:100%;
  }

}

@media screen and (max-width: 400px) {
  .topnav.responsive {position: relative;}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: center;
  }
  .topnav.responsive .dropdown {float: none;}
  .topnav.responsive .dropdown-content {position: relative;}
  .topnav.responsive .dropdown .dropbtn {
    display: block;
    width: 100%;
    text-align: center;
  }
}

.accordion {
    background-color: #eee;
    color: #444;
    cursor: pointer;
    padding: 18px;
    width: 100%;
    border: none;
    text-align: left;
    outline: none;
    font-size: 20px;
    transition: 0.5s;
}

.active, .accordion:hover {
    background-color: #ccc;
}

.accordion:after {
    content: '\002B';
    color: #777;
    font-weight: bold;
    float: right;
    margin-left: 5px;
}

.active:after {
    content: "\2212";
}



.panel {
    padding: 0 18px;
    background-color: white;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease-out;
}

table {
    border-collapse: collapse;
    border-spacing: 0;
    width: 80%;
    border: 1px solid #ddd;
}


th, td input {
    text-align: center;
    padding: 2px;
    font-size: 20px;
    border-width:0px;
border:none;
}

td input{
    text-align: center;
    padding: 2px;
    border: none;
    border-width:0px;


}






#mySidenav button {
    position: absolute;
    left: -160px;
    transition: 0.3s;
    padding: 15px;
    padding-left: 5px;
    width: 190px;
    text-decoration: none;
    font-size: 2vw;
    color: white;
    border-radius: 0 5px 5px 0;
}

#mySidenav button:hover {
    left: 0;

}

#myBtn {
    top: 600px;
    background-color: red;
}


/*app state model box*/
/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    position: relative;
    background-color: #fefefe;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    width: 30%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
}

@keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
}

/* The Close Button */
.close {
    color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;
}
.photo {
    position: absolute;
    right: 300px;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

.modal-header {
    padding: 2px 16px;
    background-color: #5cb85c;
    color: white;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
    padding: 2px 16px;
    background-color: #5cb85c;
    color: white;
}


.regbtn{

  background: dodgerblue;
  color: white;
  padding: 5px 16px;
  font-size: 18px;
  border-radius: 8px;
  cursor: pointer;
  transition: 0.5s;
  margin-right: 10px;
  text-decoration: none;
}

.delbtn{

  background: red;
  color: white;
  padding: 5px 16px;
  font-size: 18px;
  border-radius: 8px;
  cursor: pointer;
  transition: 0.5s;
  margin-right: 10px;
  text-decoration: none;
}


.regbtn:hover{
    background: lightgray;
    color: gray;
}

.studList{
    margin-left: 50px;
    margin-top: 100px;
}

.adds{
    margin-left: 50px;
    margin-top: 100px;
}
div:nth-child(even) {

}
</style>
</head>
<body>

  <div class="header">
  <h1 class="inHeader">Patron</h1>

</div>

<div class="navbar">
  <a  href="patron_profile.php">Patron Profile</a>
	<a href="patron_checkout.php">Checkout</a>
  <a style="background: #ddd; color: black;" href="update_password.php">Password Update</a>
  <a href="borrowing_history.php">Borrow history</a>

  <a style="float: right;" href="login.html" class="home" value="home"><i class="fa fa-home" ></i></a>

</div>

<div class="adds">

	<?php
$passwordErr = $passwordConfirmErr =$passsword = $passwordConfirm = $PassportNumber=$PassportNumberErr="";

  extract($_SESSION);
  $PassportNumber = $_SESSION["id"];
  $sql = "SELECT name FROM `patron` WHERE `Passport_Number` = '$PassportNumber';";

  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $image = $row['name'];
  $image_src = "upload_patron/".$image;
if(isset($_POST['submit'])){
  if (empty($_POST["password"])) {
   $passwordErr = "password is required";
 } else {
   $password = test_input($_POST["password"]);
   if(!preg_match('@[A-Z]@', $password)){
     $passwordErr = "password must contain a uppercase character";
   }
   if(!preg_match('@[a-z]@', $password)){
     $passwordErr = "password must contain a lower character";
   }
  if(!preg_match('@[0-9]@', $password)){
     $passwordErr = "password must contain at least a number";
   }
 if(!preg_match('@[^\w]@', $password)){
     $passwordErr = "password must contain at least one special character";
   }
   if( strlen($password) >= 8){
     $passwordErr = "password must be atleast eight character long";
   }
 }
if (empty($_POST["passwordConfirm"])) {
    $passwordConfirmErr = "confirm password is required";
  } else {
     $passwordConfirm = test_input($_POST["passwordConfirm"]);
    if (strcmp($password ,$passwordConfirm) != 0) {
        $passwordConfirmErr = "does not match. ";
    }
    if(strcmp($password ,$passwordConfirm)== 0){
      $sql = " UPDATE patron SET PASSWORD  = '$password' WHERE  Passport_Number = '$PassportNumber'";
      $result = mysqli_query($conn, $sql);
      if($result == false){
        echo "Error: " .$sql. "<br>" . mysqli_error($conn);
      } else{
        header("Location: save_password.php?password=updated");
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
	<form autocomplete="off" action="<?php
    echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype = "multipart/form-data">
  <div class="container">
    <h1>New Password</h1>
    <span class="error">Please enter new password</span>
    <hr>
    <div class="photo">
    <?php  echo '<tr>';?> <img src='<?php echo $image_src;  ?>' height="300" width="250">  </tr><br>
    </div>
    <hr>
    <span class="error"> <?php if(isset($Error)) echo $error; ?></span><br>
    <label for="password"><b>Password</b></label><br>
    <input type="password" placeholder="Enter your password" name="password" id = "pass" tabindex = 1 required value="<?php echo $password; ?>">
     <input type="checkbox" onclick="myFunction()">
    <span class="error">* <?php echo $passwordErr; ?></span><br>

    <label for="cfmpassword"><b>Confirm password</b></label><br>
    <input type="password" placeholder="Enter your confirm password" name="passwordConfirm" id = "passCon" tabindex = 2 required value="<?php echo $passwordConfirm; ?>">
     <input type="checkbox" onclick="myFunctionCon()">
    <span class="error">* <?php echo $passwordConfirmErr; ?></span><br>

    <button type="submit"  style="width:200"  tabindex = 3 class="registerbtn" name = "submit">Submit</button>
  </div>

</form>

</div>
<div class="footer">
  <h2>Footer</h2>
</div>

</body>
<script  type="text/javascript">
function myFunction() {
  var x = document.getElementById("pass");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }

}
function myFunctionCon(){
  var y = document.getElementById("passCon");
if (y.type === "password") {
  y.type = "text";
} else {
  y.type = "password";
}
}
</script>
</html>
