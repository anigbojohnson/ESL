<?php
ini_set('mysqli_connect_timeout',300);
ini_set('default_socket_timeout',300);
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
<html lang="en">
<head>
<title>Enugu State Library</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="librarianStyle.css">
</head>
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

th, td {
    text-align: center;
    padding: 8px;
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
    width: 35%;
    padding: 15px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: none;
    background: #f1f1f1;
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
    padding: 16px 180px;
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
<body>

<div class="header">
  <h1 class="inHeader">Librarian</h1>

</div>

<div class="navbar">
   <a  href="librarian_profile.php">Profile</a>
  <a href="add_patron.php">Register Patron</a>
  <a href="add_librarian.php">Add Librarian</a>
  <a href="check_in.php">Check In</a>
  <a href="librarian_checkout.php">Checkout</a>
  <a style="background: #ddd; color: black;" href="manage_catalogue.php">Manage Catalogue </a>
  <a style="float: right;" href="librarian_login.php" >Logout</a>

</div>
<div class="adds">
  <?php
  $isbnErr = $issnErr = $titleErr = $publicationDateErr = $quntityErr = $languageErr = $replacementCostErr = $barcodeErr = $authorErr =$callNumberErr=$borrowingDurationErr= "";
  $isbn = $issn = $title = $publicationDate = $language = $quntity = $replacementCost = $borrowingDuration = $barcode=   $target_file  = $author=$callNumber ="";
   ?>
  <div class="studList" style="overflow-x:auto;">
    <form autocomplete="off" action="<?php
      echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype = "multipart/form-data">
    <div >

      <span class="error">* <?php echo $isbnErr; ?></span><br>

      <input type="text"  style =" float:left ;width: 30%;padding: 12px 20px;margin: 8px 0;display: inline-block;border: 1px solid #ccc;border-radius: 4px;  box-sizing: border-box;" placeholder="Enter Passport number" name="Passport" required value="<?php echo $isbn; ?>">
      <button type="submit" style=" width: 20%;background-color: #4CAF50; color: white; padding: 14px 20px; margin: 8px 0; border: none; border-radius: 4px;cursor: pointer;" name ="restore" >Restore Delete</button>
    </div>
  </form>
  </div>
<div class="adds">

<?php

if(isset($_POST["Passport"])){

   $librarianNumber= test_input($_POST["Passport"]);
    $librarianNumber = $librarianNumber.'.txt';
   $folder = "resources_archives";
  if($handle = opendir($folder)){
     while(false !== ($entry = readdir( $handle ))){
       if($entry!='.'&& $entry!='..'){
         $posone= "";
         $id = "";
         $pos ="";
          $name = "";
         $posone = strpos($entry, '_')+1;
         $id = substr($entry,$posone);
         $pos = strpos($entry, '_');
         $name = substr($entry,0,$pos);
    //    echo 'the passport id is '. $PassportNumber;
      //// echo 'the id is '.$id;
    //   $PassportNumber = $PassportNumber;
      //  echo 'the name is '.$name."/n";
      //  echo 'the file is '.$entry."/n";
         if(strcmp($librarianNumber,$id)===0){
           $entry = $name."_".$id;
           echo 'the file is '.$entry;
           readData($entry);
           break;
         } else{
           echo 'they are not equal ';
         }
       }
     }
   }
}
if (isset($_POST["resources"])) {
  if (empty($_POST["issn"])) {
    $issnErr = "issn is required";
    $status = false;
  } else {

    $issn = test_input($_POST["issn"]);
    if (!preg_match("/^[0-9]*$/",$issn)){
      $issnErr = "Only number is allowed";
      $status = false;
    }
    if( strlen($issn)!= 8){
      $issnErr = "Only 8 number is allowed+";
      $status = false;
    }
  }

  if (empty($_POST["title"])) {
    $titleErr = "Title is required";
    $status = false;
  } else {
    $title = test_input($_POST["title"]);
  }

  if (empty($_POST["author"])) {
    $authorErr = "author name is required";
    $status = false;
  } else {
    $author = test_input($_POST["author"]);
  }

  if (empty($_POST["callNumber"])) {
    $callNumberErr = "call Number is required";
    $status = false;
  } else {
    $callNumber = test_input($_POST["callNumber"]);
    if (!preg_match("/^[a-zA-Z0-9]*$/",$callNumber)) {
      $callNumberErr = "Only number is allowed";
      $status = false;
    }
  }

  if (empty($_POST["publicationDate"])) {
    $publicationDateErr = "publication date is required";
    $status = false;
  } else {
     $date_now = new DateTime();
    $publicationDate = test_input($_POST["publicationDate"]);
    if ($date_now <= $publicationDate) {
    $publicationDateErr = "date cannot be today or after";
    $status = false;
  }
  }

  if (empty($_POST["language"])) {
    $languageErr = "language is required";
    $status = false;
  } else {
    $language = test_input($_POST["language"]);
  }

  if (empty($_POST["quntity"])) {
    $quntityErr = "Quntity is required";
    $status = false;
  } else {
    $quntity = test_input($_POST["quntity"]);
    // check if e-mail address is well-formed
    if (!preg_match( "/^[0-9]*$/",$quntity)){
      $quntityErr = "Invalid , can only be number";
      $status = false;
    }
  }

  if (empty($_POST["cost"])) {
    $replacementCostErr = "cost is required";
    $status = false;
  } else {
    $replacementCost = test_input($_POST["cost"]);
    // check if e-mail address is well-formed
    if (!preg_match( "/^[0-9]*$/",$replacementCost) ){
      $replacementCostErr = "Invalid , can only by number";
      $status = false;
    }
  }
  if (empty($_POST["barcode"])) {
    $barcodeErr = "barcode is required";
    $status = false;
  } else {
    $barcode = test_input($_POST["barcode"]);
    // check if e-mail address is well-formed
    if (!preg_match( "/^[0-9]*$/",$barcode)) {
      $barcodeErr = "Invalid , can only by number";
      $status = false;
    }
    if( strlen ($barcode) !=12){
      $barcodeErr = "Invalid , can only be twelve number";
      $status = false;
    }
  }

  if (empty($_POST["borrowingDuration"])) {
    $costErr = "Borrowing Duration is required";
    $status = false;
  } else {
    $borrowingDuration = test_input($_POST["borrowingDuration"]);
    if (!preg_match( "/^[0-9]*$/",$borrowingDuration)) {
      $borrowingDurationErr = "Invalid , can only be number";
     $status = false;
    }
  }

  if (empty($_POST["isbn"])) {
    $isbnErr = "isbn is required";
  }
  else {
  $isbn = test_input($_POST["isbn"]);
  if ( preg_match("/^[0-9]*$/",$issn) && !(strlen($isbn) == 13 || strlen($isbn) == 10 ) && $status = false) {
      $isbnErr = "invalid, Ten Or Thirteen number required";
      exit();
     }
    $sql = " SELECT isbn  FROM resources WHERE isbn = '$isbn' ";
      if (mysqli_query($conn, $sql)) {
        $filename = $_FILES['file']['name'];
        $target_dir = "upload_resources/";
        $target_file = $target_dir.basename($_FILES['file']['name']);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $extensions_arr = array("jpg","jpeg","png","gif");
        if( in_array($imageFileType,$extensions_arr) ){
          $image_base64 = base64_encode(file_get_contents($_FILES['file']['tmp_name']));
          $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
          $sql = " INSERT INTO resources (isbn, issn, title, publication_date, author, call_number, language, quntity, replacement_cost, borrowing_duration ,barcode ,image , name ) VALUES ('$isbn' ,'$issn' ,'$title' , '$publicationDate' ,'$author', '$callNumber', '$language' , '$quntity' , '$replacementCost' , '$borrowingDuration' ,'$barcode', '$image' ,'$filename')";
          move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$filename);
          if (mysqli_query($conn, $sql)) {
             move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);
             header("Location: view_resources.php?update=success");
            } else {
               echo "Error: " . $sql . "<br>" . mysqli_error($conn);
           }
   } else{
     echo '<p>cannot upload this types of file</p>';
   }

        } else {
           echo "Error: " . $sql . "<br>" . mysqli_error($conn);
       }
       $conn->close();
            }
        }


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
function readData($filename){
  require_once('connection.php');
       $filename = "resources_archives/".$filename;
       $entry = fopen($filename,"r");
       $isbn = fgets($entry);
       $posone = strpos(  $isbn, ':')+1;
        $isbn = substr($isbn,$posone);
       $issn = fgets($entry);
       $posone = strpos($issn, ':')+1;
       $issn= substr($issn,$posone);
       $title = fgets($entry);
       $posone = strpos($title, ':')+1;
       $title = substr($title,$posone);
       $publicationDate = fgets($entry);
       $posone = strpos($publicationDate, ':')+1;
       $publicationDate = substr($publicationDate,$posone);

       $author = fgets($entry);
       $posone = strpos($author, ':')+1;
       $author = substr($author,$posone);

       $callNumber = fgets($entry);
       $posone = strpos($callNumber, ':')+1;
       $callNumber = substr($callNumber,$posone);
       $language = fgets($entry);
       $posone = strpos($language , ':')+1;
       $language  = substr($language ,$posone);
       $quntity= fgets($entry);
       $posone = strpos($quntity, ':')+1;
       $quntity = substr($quntity,$posone);
       $replacementCost = fgets($entry);
       $posone = strpos($replacementCost, ':')+1;
       $replacementCost = substr($replacementCost,$posone);
       $borrowingDuration = fgets($entry);
       $posone = strpos( $borrowingDuration, ':')+1;
       $borrowingDuration = substr( $borrowingDuration,$posone);
       $barcode = fgets($entry);
       $posone = strpos( $barcode, ':')+1;
       $barcode = substr($barcode,$posone);
       $image = fgets($entry);
       $posone = strpos( $image, ':')+1;
       $image = substr( $image,$posone);
       $name = fgets($entry);
       $posone = strpos( $name, ':')+1;
       $name = substr( $name,$posone);
           $quary = mysqli_query($conn, " INSERT INTO resources (isbn, issn, title, publication_date, author, call_number, language, quntity, replacement_cost, borrowing_duration ,barcode ,image , name ) VALUES
              ('$isbn' ,'$issn' ,'$title' , '$publicationDate' ,'$author', '$callNumber', '$language' , '$quntity' , '$replacementCost' , '$borrowingDuration' ,'$barcode', '$image' ,'$name')");
       if ($quary !== false) {
          unlink($filename);
           header("Location:view_resources.php");
         } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
      }
?>
<form autocomplete="off" action="<?php
    echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype = "multipart/form-data">
    <h1>Add Resources</h1>
    <hr>
    <div class="container">
    <label for="ISBN"><b> ISBN</b></label><br>
    <input type="text" placeholder="ISBN (Ten or Thirteen Number)" name="isbn" required value="<?php echo $isbn ; ?>" >
    <span class="error">* <?php echo $isbnErr; ?></span><br>

    <label for="ISSN"><b> ISSN</b></label><br>
    <input type="text" placeholder="ISSN( eight number required)" name="issn" required value="<?php echo $issn ; ?>">
    <span class="error">* <?php echo $issnErr; ?></span><br>

    <label for="Title"><b>Title</b></label><br>
    <input type="text" placeholder="Enter Title" name="title" required value="<?php echo $title; ?>">
    <span class="error">* <?php echo $titleErr; ?></span><br>

    <label for="author"><b>Author</b></label><br>
    <input type="text" placeholder="Enter Author" name="author" required value="<?php echo $author; ?>">
    <span class="error">* <?php echo $authorErr; ?></span><br>

    <label for="callNumber"><b>LC call number</b></label><br>
    <input type="text" placeholder="Enter LC call number" name="callNumber" required  maxlength="10" value="<?php echo $callNumber; ?>">
    <span class="error">* <?php echo $callNumberErr;?> </span><br>

    <label for="publication"><b>publication date</b></label><br>
    <input type="Date" placeholder="Enter publication date" name="publicationDate" required value="<?php echo $publicationDate; ?>">
    <span class="error">* <?php echo $publicationDateErr; ?></span><br>

    <label for="language"><b>language</b></label><br>
    <input type="text" placeholder="enter language" name="language"value="<?php echo $language; ?>">
    <span class="error">* <?php echo $languageErr; ?></span><br>

    <label for="quntity"><b>Quntity</b> </label><br>
    <input type="number" placeholder="Enter your Quntity" name="quntity" min = "0" max ="100" required value="<?php echo $quntity; ?>">
    <span class="error">* <?php echo $quntityErr; ?></span><br>

    <label for="replacementCost"><b> Replacement Cost</b></label><br>
    <input type="text" placeholder="Enter your Replacement Cost" name="cost" required value="<?php echo $replacementCost; ?>">
    <span class="error">* <?php echo $replacementCostErr; ?></span><br>

    <label for="cost"><b> Borrowing Duration</b></label><br>
    <input type="number" placeholder="Enter your Borrowing duration" name="borrowingDuration" min = "0" max ="20" required value="<?php echo $borrowingDuration; ?>">
    <span class="error">* <?php echo $borrowingDurationErr; ?></span><br>

    <label for="barcode"><b>Barcode</b> </label><br>
    <input type="text" placeholder="Barcode( Twelve Number)" name="barcode" required value="<?php echo $barcode; ?>">
    <span class="error">* <?php echo $barcodeErr; ?></span><br>
        <label for = "image"> image: </label>
        <input type='file' name='file' /><br>
<button type="submit" tabindex = 12 class="registerbtn" name = "resources"> Update</button>
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
</body>
</html>
