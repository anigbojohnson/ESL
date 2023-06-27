<?php
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
<html lang="en">
<head>
<title>Main Admin</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
  <h1 class="inHeader">Librarian</h1>

</div>

<div class="navbar">
    <a   href="librarian_profile.php">Profile</a>
	<a href="add_patron.php">Register Patron</a>
  <a style="background: #ddd; color: black;" href="add_librarian.php">Add Librarian</a>
  <a href="check_in.php">Check in</a>
  <a href="librarian_checkout.php">Checkout</a>
  <a href="manage_catalogue.php">Add Catalogue</a>
  <a style="float: right;" href="librarian_login.php" >Logout</a>
  <?php

  ?>

</div>

<div class="adds"><a class="regbtn" href="add_librarian.php">Add Librarian</a></div>
<form autocomplete="off" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype = "multipart/form-data">
  <table>
    <tr>
      <b><label for="Search">Search</label></b>
      <select  name="patron_info" type="text"   style =" width: 10%; padding: 12px 20px;margin: 8px 0;display: inline-block; border: 1px solid #ccc; box-sizing: border-box;">
      <option value="patron_info">librarian information</option><option value="name">librarian name</option><option value="id">Librarian Number</option>
      <option value="type">Librarian Type</option><option value="email">Email</option><option value="phone">Phone Number</option><option value="gender">Gender</option><option value="address">Address</option><option value="dob">DOB</option>
    <option value="city">City</option><option value="state">State</option></select>
      <input type="text" placeholder = "Enter a word" name="searchtxt" style="  width: 40%;padding: 12px 20px;margin: 8px 0;display: inline-block;border: 1px solid #ccc; box-sizing: border-box;" onclick="displayHideSearch()">
      <button id ="search" type="submit" name="search" style = "background-color: blue;color: white;padding: 14px 20px;margin: 8px 0;border: none;  cursor: pointer; width: 10%;">Search</button>
    </tr>
  </table>
</form>
<?php
$error = $librarianName = $phoneNumber = $gender =$address =$email =$city = $state = $dob = $password= $librarian_type= $name =$image="";
$login=$ID="";
if(isset($_POST['search'])){
  $search = test_input($_POST['searchtxt']);
  $selectType = test_input($_POST['patron_info']);
  switch($selectType){
    case "id":
        $sql = "SELECT * from librarian where librarian_id LIKE '%$search%' ";
        $result = mysqli_query($conn ,$sql);
        display($result);
    break;
    case "gender":
        $sql = "SELECT * from librarian where gender LIKE '%$search%' ";
        $result = mysqli_query($conn ,$sql);
        display($result);
    break;
    case "name":
        $sql = "SELECT * from librarian where librarian_name LIKE '%$search%' ";
        $result = mysqli_query($conn ,$sql);
        display($result);
    break;
    case "type":
        $sql = "SELECT * from librarian where Librarian_type LIKE '%$search%' ";
        $result = mysqli_query($conn ,$sql);
        display($result);
    break;
    case "email":
        $sql = "SELECT * from librarian where email LIKE '%$search%' ";
        $result = mysqli_query($conn ,$sql);
        display($result);
    break;
    case "address":
        $sql = "SELECT * from librarian where address LIKE '%$search%' ";
        $result = mysqli_query($conn ,$sql);
        display($result);
    break;
    case "dob":
        $sql = "SELECT * from librarian where dob LIKE '%$search%' ";
        $result = mysqli_query($conn ,$sql);
        display($result);
    break;
    case "state":
        $sql = "SELECT * from librarian where state LIKE '%$search%' ";
        $result = mysqli_query($conn ,$sql);
        display($result);
    break;
    case "city":
        $sql = "SELECT * from librarian where city LIKE '%$search%' ";
        $result = mysqli_query($conn ,$sql);
        display($result);
    break;
    case "phone":
        $sql = "SELECT * from librarian where phone_number LIKE '%$search%' ";
        $result = mysqli_query($conn ,$sql);
        display($result);
    break;
    default:
    if($search !="" | $selectType=="name" | $selectType=="id" | $selectType=="phone" | $selectType=="type" | $selectType=="email" | $selectType=="city"  | $selectType=="state" | $selectType=="address" | $selectType=="dob"| $selectType=="gender"){
        $sql = "SELECT * from librarian where librarian_id LIKE '%$search%' OR librarian_name LIKE '%$search%' OR Librarian_type LIKE '%$search%' OR  email LIKE '%$search%' OR phone_number LIKE '%$search%'  OR gender LIKE '%$search%' OR address LIKE '%$search%' OR DOB LIKE '%$search%' OR city LIKE '%$search%' OR state LIKE '%$search%'";
        $result = mysqli_query($conn ,$sql);
        display($result);
      } else{
        $error = "no result is available";
      }
  }
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
function display($result){
  if(mysqli_num_rows($result) > 0){
  while($row = mysqli_fetch_assoc($result)) {
    echo '
     <form method="post" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'"  >
    <table  style="float: left; width:700px; border-collapse:collapse; " border=\"1px;\" >
    <tr>
    <td width = "200" ><label for="PName">Librarian Name:  </label></td>
    <td><input type="text" name="pName" value="'.$row["librarian_name"].'" readonly></td></tr>
    <tr>
    <td><label for="PNumber">Librarian Id:  </label></td>
    <td><input type="text" name="Passport_Number" value="'.$row["librarian_id"].'" readonly></td></tr>
    <tr>
    <td><label for="phoneNumber">Phone Number: </label></td>
    <td><input type="text" name="phone_Number" value="'.$row["phone_number"].'" readonly></td></tr>
    <tr>
    <td><label for="gender">Gender:  </label></td>
    <td><input type="text" name="gender" value="'.$row["gender"].'" readonly></td></tr>
    <tr>  <td><label for="address">Address: </label></td>
    <td> <input type="text" name="address" value="'.$row["address"].'" readonly></td></tr>
    <tr><td><label for="email">Email: </label></td>
    <td><input type="text" name="email" value="'.$row["email"].'" readonly><td></tr>
    <tr><td><label for="city">City: </label></td>
    <td><input type="text" name="city" value="'.$row["city"].'" readonly></td></tr>
    <tr><td>  <label for="state">State: </label></td>
    <td><input type="text" name="state" value="'.$row["state"].'" readonly></td></tr>
    <tr><td>  <label for="dob">DOB: </label></td>
    <td><input type="text" name="state" value="'.$row["DOB"].'" readonly></td></tr>
    <tr><td><a id = "patron"  class="regbtn" href="update_librarian.php?ID='.$row["librarian_id"].'">Update</a></td>
      <td><a id = "patrondel" class="delbtn" name =" del" href="view_librarian.php?ID='.$row["librarian_id"].'">Delete</a></td>
  </tr>
  </table>';
  $image = $row['name'];
  $image_src = "upload_librarian/".$image;
  ?>


  <?php
  echo '<table style="border-collapse:collapse; " border=\"1px;\" >';

  echo '<tr>';?> <img src='<?php echo $image_src;  ?>' height="200" width="200">  </tr>
  <?php
  echo '</table>
    </form>
    </hr>';
  }
  }
}

 ?>

<div class="studList" style="overflow-x:auto;">

<?php

  $sql = "SELECT * FROM `librarian` WHERE 1;";
  $result = mysqli_query($conn, $sql);
  while ($row = mysqli_fetch_assoc($result)) {
    echo '
     <form method="post" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'"  >
    <table  style="float: left; width:700px; border-collapse:collapse; " border=\"1px;\" >
    <tr>
    <td width = "200" ><label for="PName">Librarian Name:  </label></td>
    <td><input type="text" name="pName" value="'.$row["librarian_name"].'" readonly></td></tr>
    <tr>
    <td><label for="PNumber">Librarian Id:  </label></td>
    <td><input type="text" name="Passport_Number" value="'.$row["librarian_id"].'" readonly></td></tr>
    <tr>
    <td><label for="phoneNumber">Phone Number: </label></td>
    <td><input type="text" name="phone_Number" value="'.$row["phone_number"].'" readonly></td></tr>
    <tr>
    <td><label for="gender">Gender:  </label></td>
    <td><input type="text" name="gender" value="'.$row["gender"].'" readonly></td></tr>
    <tr>  <td><label for="address">Address: </label></td>
    <td> <input type="text" name="address" value="'.$row["address"].'" readonly></td></tr>
    <tr><td><label for="email">Email: </label></td>
    <td><input type="text" name="email" value="'.$row["email"].'" readonly><td></tr>
    <tr><td><label for="city">City: </label></td>
    <td><input type="text" name="city" value="'.$row["city"].'" readonly></td></tr>
    <tr><td>  <label for="state">State: </label></td>
    <td><input type="text" name="state" value="'.$row["state"].'" readonly></td></tr>
    <tr><td>  <label for="dob">DOB: </label></td>
    <td><input type="text" name="state" value="'.$row["DOB"].'" readonly></td></tr>
    <tr><td><a id = "patron"  class="regbtn" href="update_librarian.php?ID='.$row["librarian_id"].'">Update</a></td>
      <td><a id = "patrondel" class="delbtn" name =" del" href="view_librarian.php?ID='.$row["librarian_id"].'">Delete</a></td>
  </tr>
  </table>';
  $image = $row['name'];
  $image_src = "upload_librarian/".$image;
  ?>


  <?php
  echo '<table style="border-collapse:collapse; " border=\"1px;\" >';

  echo '<tr>';?> <img src='<?php echo $image_src;  ?>' height="200" width="200">  </tr>
  <?php
  echo '</table>
    </form>
    </hr>';
  }
if(isset($_GET['ID'])){
    extract($_GET);
    $ID = $_GET['ID'];
    $sql = "SELECT * FROM librarian WHERE 	librarian_id = '$ID'";
    $result = $conn->query($sql) or die($conn->error);
    $row = $result->fetch_assoc();
    $filename = "librarian_archives/".$row['librarian_name']."_".$row['librarian_id'];
    $file = $row['librarian_name']."_".$row['librarian_id'];
    if(file_exists($file)){
      header("Location:view_patron.php?exist=fileAlreadyExist");
    exist();
    } else {
$fp = fopen($filename,"w");
fwrite($fp ,"Librarian Id:");
fwrite($fp ,$row['librarian_id'].PHP_EOL);
fwrite($fp ,"Librarian Name:");
fwrite($fp ,$row['librarian_name'].PHP_EOL);
fwrite($fp ,"Password:");
fwrite($fp ,$row['password'].PHP_EOL);
fwrite($fp ,"Librarian Type:");
fwrite($fp ,$row['Librarian_type'].PHP_EOL);
fwrite($fp ,"Email:");
fwrite($fp ,$row['email'].PHP_EOL);
fwrite($fp ,"Phone Number:");
fwrite($fp ,$row['phone_number'].PHP_EOL);
fwrite($fp ,"Gender:");
fwrite($fp ,$row['gender'].PHP_EOL);
fwrite($fp ,"Address:");
fwrite($fp ,$row['address'].PHP_EOL);
fwrite($fp ,"DOB:");
fwrite($fp ,$row['DOB'].PHP_EOL);
fwrite($fp ,"City:");
fwrite($fp ,$row['city'].PHP_EOL);
fwrite($fp ,"State:");
fwrite($fp ,$row['state'].PHP_EOL);
fwrite($fp ,"Image:");
fwrite($fp ,$row['image'].PHP_EOL);
fwrite($fp ,"Name:");
fwrite($fp ,$row['name'].PHP_EOL);
fclose($fp);
$sql = " DELETE from librarian where librarian_id = ?";
$stmt = mysqli_stmt_init( $conn);
if (!mysqli_stmt_prepare($stmt, $sql)){
  echo'<p>sql error</p>';
  //$error = 'sql error';
  exit();
} else {
  mysqli_stmt_bind_param ($stmt ,"s",  $ID);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_free_result ($stmt);
  echo '<div style="color:red"<div>';
  echo'<p successfully deleted</p>';
  echo '<p>Name</p>'.$ID;
  echo '<p>Name</p>'.$row['librarian_name'];
  echo '</div>';
     }
   }

}

?>
<span class="error">* <?php echo $error; ?></span><br>
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
</html>
