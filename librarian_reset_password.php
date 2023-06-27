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


    text-align: center;
    background: #1abc9c;
    color: white;

}

.inHeader{

	text-align: center;
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
    text-align: left;
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
    <img src="image/enugu_logo.jpg" width="75" height="82  margin = 0px" style="float:left;"></img>
  <h1 class="inHeader"><center>Enugu State Library</center></h1>

</div>

<div class="navbar">
  <a style="float: left;"  class="home" value="home"><i class="fa fa-home" ></i></a>
  <a style="float: left;"  href="reset_password.php" >Reset Password</a>
  <a style="float: right;"  href="reset_password.php" >Reset Password</a>

</div>

<div class="adds">

	<?php
  require_once 'vendor/autoload.php';
  define("PROJECT_NAME","http://localhost/GP5");
  if(isset($_POST['submit'])){
if(empty($_POST["email"])) {
  $emailErr = "email required";
} else{
    $email = test_input($_POST['email']);
    $sql = "SELECT librarian_Name FROM librarian WHERE email='$email'";
    $quary = mysqli_query($conn, $sql);
    $quary = ($quary=== false) ? false : $quary;
    if ($quary===false){
           echo "Error: " . $sql . "<br>" . mysqli_error($conn);
           exit();
        }  else{

        if(  $resultCheck > 1){
          header("Location: reset_password.php?error=invalidEmail");
        } else{
          $tokenEmail = generateToken();
          $sql = "UPDATE librarian SET password = '$tokenEmail' WHERE email='$email'";
          $quary = mysqli_query($conn, $sql);
          $quary = ($quary=== false) ? false : $quary;
          if ($quary===false){
                 echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                 exit();
              } else{
                $mail = new PHPMailer\PHPMailer\PHPMailer;
                $mail -> SMTPDebug = 0;
                $mail -> isSMTP();
                $mail -> Host = "smtp.gmail.com";
                $mail -> SMTPAuth = true;
                $mail -> Username = "anigbojohnsona@gmail.com";
                $mail -> Password = "charis123";
                $mail -> SMTPSecure = "tls";
                $mail -> Port =587;
                $mail -> From = "anigbojohnsona@gmail.com";
                $mail -> FromName ="Enugu State Library";
                $mail -> addAddress($email);
                $mail -> isHTML(true);
                $mail -> Subject = "Forget Password Recorvery";
                $mail -> Body = "
                                Hi <br><br>
                                This is now your new password:<br>
                                password =$tokenEmail<br>
                                Kind Regards,<br>
                                Enugu state library";
                                if($mail ->send())
                                header("Location: reset_password.php?email=sent");
                                else
                                $mail_error = "Mailing Error : ".$mail->ErrorInfo;
              }

         }
      }
    }
  }


  function generateToken($len = 12){
    $emailToken = "qwertyuiopasdfghjklzxcvbnm78894561230";
    $emailToken = str_shuffle($emailToken);
    $emailToken = substr($emailToken, 0,$len);
    return $emailToken;
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

    <span style="align:center;"><h1>Forgotten Password</h1><span>
      <?php if(!empty($mail_error )) {?>
      <div class="error">
        <p> <?php echo $mail_error;
      }?>
    <label for="password"><b>Email</b></label><br>
    <input type="text" placeholder="Enter your email" name="email" style="align:center;"tabindex = 1 required >
    <button type="submit"  style="width:200"  tabindex = 2 class="registerbtn" style="align:center;" name = "submit">Reset Password</button>

</form>

</div>
<div class="footer">
  <p>Address: 4 Market Rd, Achara, Enugu, Nigeria</p>
<b><p>Hours:</p></b>
<p>Monday	8am–4pm</p>
<p>Tuesday	8am–4pm</p>
<p>Wednesday	8am–4pm</p>
<p>Thursday	8am–4pm</p>
<p>Friday	8am–4pm</p>
<p>Phone: +234 803 489 8985<p>
</div>

</body>


</script>
</html>
