<?php
session_start();
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
  <title>ENUGU STATE LIBRARY</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  body{
    background: #D3D3D3;
  }
    /* Remove the navbar's default rounded borders and increase the bottom margin */
    .navbar {
      margin-bottom: 50px;
      border-radius: 0;
    }
    .active{
      background-color: #C35817;
    }


    /* Remove the jumbotron's default bottom margin */
     .jumbotron {
      margin-bottom: 0;
	  background-color: #82a43a;
	   color: white;

    }

    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #c0c0c0;
      padding: 25px;
	  color:  white;
    }

		body {font-family: Arial, Helvetica, sans-serif;}

		/* Full-width input fields */
		input[type=text], input[type=password] {
			width: 100%;
			padding: 12px 20px;
			margin: 8px 0;
			display: inline-block;
			border: 1px solid #C35817;
			box-sizing: border-box;
		}

		/* Set a style for all buttons */
		button {
			background-color: #C35817;
			color: white;
			padding: 14px 20px;
			margin: 8px 0;
			border: none;
			cursor: pointer;
		}

.error{
  color: tomato;
}
.container-fluid{
      margin-bottom: 0;
    }

		@-webkit-keyframes animatezoom {
			from {-webkit-transform: scale(0)}
			to {-webkit-transform: scale(1)}
		}

		@keyframes animatezoom {
			from {transform: scale(0)}
			to {transform: scale(1)}
		}

		/* Change styles for span and cancel button on extra small screens */
		@media screen and (max-width: 300px) {
			span.psw {
			   display: block;
			   float: none;
			}
			.cancelbtn {
			   width: 100%;
         background-color: red;
			}
		}
  </style>
</head>
<body>
  <?php
if(isset($_POST['librarian_login']) && (isset($_POST['main']) || isset($_POST['other']))){
  $loginId = test_input($_POST['lname']);
  $password = test_input($_POST['psw']);


  if(empty($loginId) || empty($password)){
    header("Location:librarian_login.php?error=emptyfield");
    exit();
  }
  if(isset($_POST['main'])){
      $typeMain = "main";
    $sql = "SELECT * FROM librarian WHERE librarian_id='$loginId'  AND Librarian_type='$typeMain'";
    $result = mysqli_query($conn, $sql);
    if($row=mysqli_fetch_assoc($result)){
        $passwordVerify = strcmp($password ,$row['password']);
         if($passwordVerify== 0){

          $_SESSION['librarianidmain'] = $row['librarian_id'];

          header("Location:librarian_profile.php?login=$loginId");
        }else {
          header("Location:librarian_login.php?error=wrongpassword");
          exit();
        }
      } else{
        header("Location:librarian_login.php?error=nouser");
        exit();
      }
    }
    if(isset($_POST['other'])){
        $typeOther = "other";
        $sql = "SELECT * FROM librarian WHERE librarian_id='$loginId'  AND Librarian_type='$typeOther'";
        $result = mysqli_query($conn, $sql);
        if($row=mysqli_fetch_assoc($result)){
            $passwordVerify = strcmp($password ,$row['password']);
             if($passwordVerify== 0){

              $_SESSION['librarianidother'] = $row['librarian_id'];
              header("Location:librarian_profile.php?login=$loginId");
            }else {
              header("Location:librarian_login.php?error=wrongpassword");
              exit();
            }
          } else{
            header("Location:librarian_login.php?error=nouser");
            exit();
          }
      }
}
  function test_input($info) {
    $info = trim($info);
    $info = stripslashes($info);
    $info = htmlspecialchars($info);
    return $info;
  }
?>
<nav class="navbar navbar-inverse">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.html"><font color="#42d9f4">ENUGU STATE LIBRARY</font></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.html"></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
	  </ul>
    </div>
  </div>
</nav>
<div class="container">
  <div class="row">
    <div class="col-sm-6">
      <div class="panel panel-primary">
        <div class="panel-heading"></div>
			<div class="panel-body">
			 <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"   >
					<div>
            <input type="checkbox"  name="main" value="main">
            <label for="main"> main Librarian</label><br>
            <input type="checkbox"  name="other" value="other">
            <label for="others"> other librarian</label><br>
						<label for="uname"><b>Login ID</b></label>
						<input type="text" placeholder="Enter Username" name="lname" >
						<label for="psw"><b>Password</b></label>
						<input type="password" placeholder="Enter Password" id = "pass" name="psw" style="display: inline-block; position: relative;overflow: hidden;">
            <input type="checkbox" onclick="myFunction()" style="position: absolute;top: 170px; right: 45px;">
						<button type="submit"  name = "librarian_login" syle="background-color: blue;">Login</button>
						<label>
              <a href="librarian_forgotten_password.php">forgotten password</a>

      </label>
					</div>
				</form>
			</div>
			<div class="panel-footer"></div>
      </div>
    </div>

    <div class="col-sm-6">
      <div class="panel panel-primary">
        <div class="panel-heading">ENUGU STATE LIBRARY</div>
        <div class="panel-body">ENUGU STATE LIBRARY serve the entire people of enugu and nigeria at large</div>
        <div class="panel-footer"></div>
      </div>
    </div>
  </div>
</div><br>
<footer class="container-fluid text-center">
  <div class="jumbotron">
  <div class="container text-center">
    <h2>ENUGU STATE LIBRARY</h2>
  </div>
</div>
</footer>
<script>
var modal = document.getElementById('id01');
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
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
