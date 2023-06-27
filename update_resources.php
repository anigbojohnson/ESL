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
<html lang="en">
<head>
<title>Enugu State Library</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="librarianStyle.css">
</head>
<body>

<div class="header">
  <h1 class="inHeader">Main Librarian</h1>

</div>

<div class="navbar">
   <a  href="librarian_profile.php">Profile</a>
  <a href="add_patron.php">Register Patron</a>
  <a href="add_librarian.php">Add Librarian</a>
  <a href="check_in.php">Check In</a>
  <a href="librarian_checkout.php">Checkout</a>
  <a style="background: #ddd; color: black;" href="manage_catalogue.php">Manage Catalogue </a>
  <a style="float: right;" href="librarian_login.php" >Loguout</i></a>

</div>


<div class="adds">

<?php
$isbnErr = $issnErr = $titleErr = $publicationDateErr = $quntityErr = $languageErr = $replacementCostErr = $barcodeErr = $authorErr =$callNumberErr=$borrowingDurationErr= "";
$isbn = $issn = $title = $publicationDate = $language = $quntity = $replacementCost = $borrowingDuration = $barcode=   $target_file  = $author=$callNumber ="";
if( isset( $_GET['ID'])) {
extract($_GET);
$temp = $_GET["ID"];

  $sql = "SELECT * FROM `resources` WHERE `isbn` = '$temp';";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

if(mysqli_num_rows($result) > 0){
      $isbn = $row['isbn'];
      $issn = $row['issn'];
      $title = $row['title'];
      $publicationDate = $row['publication_Date'];
      $language = $row['language'];
      $quntity = $row['quntity'];
      $replacementCost = $row['replacement_cost'];
      $borrowingDuration =  $row['borrowing_duration'];
      $barcode = $row['barcode'];
      $author= $row['author'];
      $callNumber= $row['call_number'];
      $image = $row['image'];
      $name = $row['name'];
      $image_src = "upload_resources/".$name;
}
}
if(isset($_POST["update"])) {
  $status =false;
extract($_POST);
if (empty($_POST["issn"])) {
  $issnErr = "issn is required";
  $status =false;
} else {

  $issn = test_input($_POST["issn"]);

  if (!preg_match("/^[0-9]*$/",$issn) && strlen($issn)!= 8){
    $issnErr = "Only eight numbers is allowed";
      $status =false;
  }
}

if (empty($_POST["title"])) {
  $titleErr = "Title is required";
    $status =false;
} else {
  $title = test_input($_POST["title"]);
}

if (empty($_POST["author"])) {
  $authorErr = "author name is required";
    $status =false;
} else {
  $author = test_input($_POST["author"]);
}

if (empty($_POST["callNumber"])) {
  $callNumberErr = "call Number is required";
    $status =false;
} else {
  $callNumber = test_input($_POST["callNumber"]);
  if (!preg_match("/^[a-zA-Z0-9]*$/",$callNumber)) {
    $callNumberErr = "Only number is allowed and letter allowed";
      $status =false;
  }
}

if (empty($_POST["publicationDate"])) {
  $publicationDateErr = "publication date is required";
} else {

  $publicationDate = test_input($_POST["publicationDate"]);
  if (date("Y/m/d") >= $publicationDate) {
  $publicationDateErr = "invalid, date cannot be today or after";
    $status =false;
}
}

if (empty($_POST["language"])) {
  $languageErr = "language is required";
    $status =false;
} else {
  $language = test_input($_POST["language"]);
}

if (empty($_POST["quntity"])) {
  $quntityErr = "Quntity is required";
    $status =false;
} else {
  $quntity = test_input($_POST["quntity"]);
  if (!preg_match( "/^[0-9]*$/",$quntity)){
    $quntityErr = "Invalid , can only be number";
      $status =false;
  }
}

if (empty($_POST["cost"])) {
  $replacementCostErr = "cost is required";
    $status =false;
} else {
  $replacementCost = test_input($_POST["cost"]);
  if (!preg_match( "/^[0-9]*$/",$replacementCost) ){
    $replacementCostErr = "Invalid , can only by number";
      $status =false;
  }
}
if (empty($_POST["barcode"])) {
  $barcodeErr = "cost is required";
    $status =false;
} else {
  $barcode = test_input($_POST["barcode"]);
  if (!preg_match( "/^[0-9]{0,12}$/",$barcode)) {
    $barcodeErr = "Invalid , can only by twelve number";
      $status =false;
  }
}

if (empty($_POST["borrowingDuration"])) {
  $costErr = "Borrowing Duration is required";
    $status = false;
} else {
  $borrowingDuration = test_input($_POST["borrowingDuration"]);
  if (!preg_match( "/^[0-9]*$/",$borrowingDuration)) {
    $borrowingDurationErr = "Invalid , can only be number";
      $status =false;
  }

if(empty($isbn) && strlen($isbn) <=12 && $status =false && !preg_match( "/^[0-9]*$/",$isbn)){
    $isbnErr = "invalid, must be twelve number";
  } else{
      $sql = "SELECT isbn FROM resources WHERE isbn= $isbn";
      $quary = mysqli_query($conn, $sql);
      $quary = ($quary=== false) ? false : $quary;
      if($quary=== false){
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        exit();
      }
    else{
      $resultCheck = mysqli_num_rows ($quary);
      if ($resultCheck != 1){
              header("Location: update_resources.php?error=IdAlreadyTaken");
              exit();
       } else {
        $filename = $_FILES['file']['name'];
        $target_dir = "upload_resources/";
        $target_file = $target_dir.basename($_FILES['file']['name']);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $extensions_arr = array("jpg","jpeg","png","gif");
        if( in_array($imageFileType,$extensions_arr)||  !empty($filename)){
        $image_base64 = base64_encode(file_get_contents($_FILES['file']['tmp_name']));
        $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
        move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$filename);
        $sql = " UPDATE resources SET issn = $issn,  title = '$title', publication_Date = '$publicationDate' , author = '$author' , call_number = '$callNumber', language = '$language', quntity = $quntity,
        replacement_cost = $replacementCost, borrowing_duration = $borrowingDuration, barcode = $barcode, image = '$image' , name = '$filename' WHERE isbn = $isbn";
        $quary = mysqli_query($conn, $sql);
        if($quary===false){
              echo "Error: " . $sql . "<br>" . mysqli_error($conn);
              exit();
         } else {
           header("Location: view_resources.php?resources=updated");
           exit();
         }
    }
    if( empty($filename) ){
      $sql = "SELECT image , name from resources where isbn='$isbn'";
      $result = mysqli_query($sql);
      $row = mysqli_fetch_assoc($result);
      $image = $row['image'];
        $filename  = $row['name'];
      $sql = " UPDATE resources SET issn = $issn,  title = '$title', publication_Date = '$publicationDate' , author = '$author' , call_number = '$callNumber', language = '$language', quntity = $quntity,
      replacement_cost = $replacementCost, borrowing_duration = $borrowingDuration, barcode = $barcode WHERE isbn = $isbn";
      $quary = mysqli_query($conn, $sql);

      if($quary===false){
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            exit();
       } else {
         header("Location: view_resources.php?resources=updated");
         exit();
       }
     }
 }
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
    <h1>update Resources</h1>

    <hr>
    <div class="photo">
    <?php  echo '<tr>';?> <img src='<?php echo $image_src;  ?>' height="300" width="250">  </tr><br>

    <input type='file' name='file' /><br>
    </div>


    <div class="container">
    <label for="ISBN"><b> ISBN</b></label><br>
    <input type="text" placeholder="Enter your ISBN" name="isbn" required value="<?php echo $isbn ; ?>" >
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
    <input type="text" placeholder="Enter your Barcode" name="barcode" required value="<?php echo $barcode; ?>">
    <span class="error">* <?php echo $barcodeErr; ?></span><br>
<button type="submit" tabindex = 12 class="registerbtn" name = "update"> Update</button>
  </div>


</form>


</div>


<div class="footer">
  <h2>Footer</h2>
</div>
</body>
</html>
