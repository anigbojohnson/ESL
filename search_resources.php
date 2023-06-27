<?php
session_start();
ob_start();
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
<html lang="en">
<head>
<title>Main Admin</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
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
	width: 400px;
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
 .footer {
     padding: 20px;
     text-align: left;
     background: #ddd;
     margin-top: 450px;
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
.imagedisplay{
  display:inline-block;
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
.text-block {
  position: absolute;
  bottom: 20px;
  right: 20px;
  background-color: black;
  color: white;
  padding-left: 20px;
  padding-right: 20px;
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



button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}



img.avatar {
  width: 40%;
  border-radius: 50%;
}



span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
div:nth-child(even) {

}
</style>
</head>
<body>
  <span style="display:inline;">
  <h2  style ="text-align: center;color:blue">ENUGU STATE LIBRARY </h2>
  <img style = " position: relative;
  left: 10px;" src="image\enugu_logo.JPG" width="70" height="70"  dispay ="inline-block">
</span>

<div class="navbar">


  <a style="float: left;"  class="home" value="home"><i class="fa fa-home" ></i></a>
  <a style="float: right;"  href="About_us.php" >About Us</a>
</div>
    <form autocomplete="off" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype = "multipart/form-data">
      <table>
        <tr>
          <b><label for="Search">Search</label></b>
          <select  name="catalogue" type="text"   style =" width: 10%; padding: 12px 20px;margin: 8px 0;display: inline-block; border: 1px solid #ccc; box-sizing: border-box;">
          <option value="library catalogue">Library Catalogue</option><option value="author">Author</option><option value="title">Title</option>
          <option value="isbn">ISBN</option><option value="callNumber">Call Number</option><option value="language">Language</option></select>
          <input type="text" placeholder = "Enter a word" name="searchtxt" style="  width: 40%;padding: 12px 20px;margin: 8px 0;display: inline-block;border: 1px solid #ccc; box-sizing: border-box;" onclick="displayHideSearch()">
          <button id ="search" type="submit" name="search" style = "background-color: blue;color: white;padding: 14px 20px;margin: 8px 0;border: none;  cursor: pointer; width: 10%;">Search</button>
        </tr>
      </table>
    </form>
    <div class="imagedisplay" style="padding:20px" id="imageone">
    <img src="image\front.JPG" width="500" height="400"  ><br>
    <span style="margin-right: 50px; color:blue;"> Front view </label><br>
  </div>
    <div class="imagedisplay" style="display:inline-block;" id="imagetwo">
      <img src="image\inside.JPG"width="500" height="400" ><br>
      <span style="margin-right: 50px; color:blue;"><label> Book catalogue </label></span>
  </div>
<?php
$login=$ID="";
if(isset($_POST['search'])){
  $search = test_input($_POST['searchtxt']);
  $selectType = test_input($_POST['catalogue']);
  switch($selectType){
    case "author":
        $sql = "SELECT * from resources where author LIKE '%$search%' ";
        $result = mysqli_query($conn ,$sql);
        display($result);
    break;
    case "title":
        $sql = "SELECT * from resources where title LIKE '%$search%' ";
        $result = mysqli_query($conn ,$sql);
        display($result);
    break;
    case "isbn":
        $sql = "SELECT * from resources where isbn LIKE '%$search%' ";
        $result = mysqli_query($conn ,$sql);
        display($result);
    break;
    case "callNumber":
        $sql = "SELECT * from resources where call_number LIKE '%$search%' ";
        $result = mysqli_query($conn ,$sql);
        display($result);
    break;
    case "language":
        $sql = "SELECT * from resources where language LIKE '%$search%' ";
        $result = mysqli_query($conn ,$sql);
        display($result);
    break;
    default:
    if($search !="" | $selectType=="language" | $selectType=="callNumber" | $selectType=="isbn" | $selectType=="title" | $selectType=="author"){
        $sql = "SELECT * from resources where language LIKE '%$search%' OR call_number LIKE '%$search%' OR isbn LIKE '%$search%' OR  title LIKE '%$search%' OR author LIKE '%$search%' ";
        $result = mysqli_query($conn ,$sql);
        display($result);
      } else{
        $error = "no result is available";
      }
  }
}
?>
<div style="float:left;" id="searchitem" >
<span class="error"><?php if(isset($error))echo   $error ; ?></span><br>

<?php
  function display($result){
    if(mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_assoc($result)) {

        echo '
         <form method="post" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'"  >
        <table  style="float: left; width:700px; border-collapse:collapse; " border=\"1px;\" >
        <tr> <th><input  style = "border:none; border-width:0px;" type="text" name="title" value="'.$row["title"].'" readonly></th></tr>
         <tr>
         <td><label for="author">Author:  </label></td>
          <td><input type="text" name="author" value="'.$row["author"].'" readonly></td></tr>
         <tr>
          <td><label for="Publication date">Publication date: </label></td>
        <td><input type="text" name="publicationDate" value="'.$row["publication_Date"].'" readonly></td></tr>
        <tr>  <td><label for="Availability">Availability: </label></td>
        <td> <input type="text" name="quntity" value="'.$row["quntity"].'" readonly></td></tr>
          <tr><td><label for="callNumber">call Number: </label></td>
        <td><input type="text" name="callNumber" value="'.$row["call_number"].'" readonly><td></tr>
          <tr><td><label for="isbn">ISBN: </label></td>
          <td><input type="text" name="isbn" value="'.$row["isbn"].'" readonly></td></tr>
        <tr><td>  <label for="issn">ISSN: </label></td>
          <td><input type="text" name="issn" value="'.$row["issn"].'" readonly></td></tr>
          <td><a  href="reserve_resources.php?ID='.$row["isbn"].'">Reserve</a></td>
      </table>
        </form>
        ';
        $image = $row['name'];
        $image_src = "upload_resources/".$image;
        echo '<table style="border-collapse:collapse; " border=\"1px;\" >';

        echo '<tr>';?> <img src='<?php echo $image_src;  ?>' height="200" width="200">  </tr>
        <?php
        echo '</table>
            </form>
            </hr>';
      }
  } else{
    echo  '<p> result is not available</p>';
  }
}
?>
</div>

<div style = "float:right">
<form autocomplete="off" action="patron_login.php" method="post" >
  <h2 style="text-align:center" >Patron Login</h2>
  <div style="text-align: center; margin: 2px 0 -10px 0;">
    <img src="image/login.jpg" alt="patron login" class="avatar">
  </div>

  <div style="padding: 0px 40px 70px 100px;">
    <label for="uname"><b>Username</b></label><br>
    <input type="text" value = "<?php
    if(isset($_GET['email'])){
       extract($_GET);
       $login = $_GET["email"];
       echo $login;
     }?> " placeholder="Enter Username" name="uname" style="width: 90%;padding: 12px 20px;margin: 8px 0;display: inline-block;border: 1px solid #ccc; box-sizing: border-box;" required><br>
    <label for="psw"><b>Password</b></label><br>
    <input type="password" value = "<?php if(isset($_GET['updatedPassword']))
    {
      extract($_GET);
      $ID = $_GET["updatedPassword"];
      echo $ID;
    }?>" placeholder="Enter Password" id="pass" style = "width: 90%; padding: 12px 20px; margin: 8px 0;display: inline;border: 1px solid #ccc;box-sizing: border-box; display: inline-block; position: relative; overflow: hidden;"name="psw" required><br>
    <input type="checkbox"  onclick="myFunction()" style="position: absolute;top: -45px; right: -180px; display: inline-block;position: relative;overflow: hidden;">
    <a href="pricing.php">Have you subsribed ?</a></span><br>
    <button type="submit"  name = "patron_login" style = "background-color: #4CAF50;top: -40px; right: -115px; color: white;padding: 14px 20px;margin: 8px 0; border: none; cursor: pointer;width: 50%;">Login</button>

     <a href="reset_password.php">Forgot password?</a></span>

  </div>
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
