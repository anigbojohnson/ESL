<!DOCTYPE html>
<html lang="en">
<head>
<title>Librarian</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>

* {
    box-sizing: border-box;
}

body {
    font-family: Arial, Helvetica, sans-serif;
    margin: 0;
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

th, td {
    text-align: center;
    padding: 8px;
}
.photo {

    position: absolute;
    right: 300px;
}

tr:nth-child(even){background-color: #f2f2f2}

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
}
.regbtn a{
    text-decoration: none;
    color: white;
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


/* Add padding to containers */
.container {
    padding: 16px;
    background-color: white;
}

/* Full-width input fields */
input[type=text], input[type=password], textarea, input[type=Date] {
    width: 100%;
    padding: 0px;
    margin: 0px 0 0px 0;
    display: inline-block;
    border: none;
    background: white;
}

input[type=text]:focus, input[type=password]:focus,
  textarea:focus {
    background-color: #ddd;
    outline: none;
}

/* Overwrite default styles of hr */
hr {
    border: 1px solid #f1f1f1;
    margin-bottom: 25px;
}

/* Set a style for the submit button */
.registerbtn {
    background-color: #4CAF50;
    color: white;
    padding: 16px 80px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    opacity: 0.9;
}

.registerbtn:hover {
    opacity: 1;
}

/* Add a blue text color to links */
a {
    color: dodgerblue;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
    background-color: #f1f1f1;
    text-align: center;
}


/*for style the country box*/

.autocomplete {
  /*the container must be positioned relative:*/
  position: relative;
  display: inline-block;
}
input, textarea {
  border: 1px solid transparent;
  background-color: #f1f1f1;
  padding: 10px;
  font-size: 16px;
}
input[id=myInput] {
  background-color: #f1f1f1;
  width: 100%;
}
input[type=submit] {
  background-color: DodgerBlue;
  color: #fff;
  cursor: pointer;
}
.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}
.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff;
  border-bottom: 1px solid #d4d4d4;
}
.autocomplete-items div:hover {
  /*when hovering an item:*/
  background-color: #e9e9e9;
}
.autocomplete-active {
  /*when navigating through the items using the arrow keys:*/
  background-color: DodgerBlue !important;
  color: #ffffff;
}

.error{
  color: tomato;
}

</style>

</head>
<body>

  <div class="header">
  <h1 class="inHeader">Librarian</h1>

</div>

<div class="navbar">
    <a  href="librarian_profile.php">Profile</a>
	<a  href="add_patron.php">Register Patron</a>
  <a href="add_librarian.php">Add Librarian</a>
  <a  style="background: #ddd; color: black;" href="check_in.php">Check in</a>
  <a  href="librarian_checkout.php">Checkout</a>
  <a href="manage_catalogue.php">Manage Catalogue</a>
  <a style="float: right;" href="librarian_login.php" class="home" value="home">Logout</a>

</div>
<?php
$isbnErr=$isbn=$PassportNumber=$phonenumber= $pname=$PassportNumberErr= $email = $image=$name="";
$status = "checkout";
if( isset($_GET["ID"])){
extract($_GET);
$ID = $_SESSION["ID"];
  $sql = "SELECT * FROM `patron` WHERE `Passport_Number` = '$ID';";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if(mysqli_num_rows($result) > 0){

$pname = $row['Patron_Name'];
$password = $row['PASSWORD'];
$PassportNumber = $row['Passport_Number'];
$image = $row['name'];
$image_src = "upload_patron/".$image;
}

}

 ?>
<form autocomplete="off" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
  <h1>Check In</h1>
  <hr>
<div class="container">

  <span   class="error">* <?php echo $PassportNumberErr; ?></span><br>
    <span>  <label for="ID"><b>Passport Number</b></label></span><br>
    <input  type="text" placeholder="Enter book passport number" name="passport" style ="    width: 30%;padding: 15px;  margin: 5px 0 22px 0;display: inline-block;border: none;background: #f1f1f1;
  " tabindex = 1 required value="<?php echo $PassportNumber; ?>" ><br>
  <span>  <label for="ID"><b>ISBN</b></label></span><br>
  <input  type="text" placeholder="Enter book isbn" name="isbn" style ="    width: 30%;padding: 15px;  margin: 5px 0 22px 0;display: inline-block;border: none;background: #f1f1f1;
" tabindex = 1 required value="<?php echo $isbn; ?>" >
  <span   class="error">* <?php echo $isbnErr; ?></span><br>
  <button type="submit" tabindex = 2 style ="width:80" class="registerbtn" width="20" name = "resources_checkout">Checkout</button><br>
</div>
</form>
</div>
<table width="100">
