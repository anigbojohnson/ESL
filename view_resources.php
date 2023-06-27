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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>


</style>
</head>
<body>

<nav class="navbar navbar-expand-sm bg-light navbar-dark bg-dark ">

  <ul class="navbar-nav">
    <a class="navbar-brand" href="#">
    <img src="image/enugu_logo.jpg" alt="Logo" style="width:40px;">
  </a>
    <li class="nav-item">
      <a class="nav-link " href="librarian_profile.php">Profile</a>
    </li>
    <li class="nav-item">
      <a class="nav-link " href="add_patron.php">Register Patron</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="add_librarian.php">Add Librarian</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="check_in.php">Check in</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="librarian_checkout.php">Checkout</a>
    </li>
    <li class="nav-item">
        <a  class="nav-link" href="librarian_login.php"  >Logout</a>
    </li>
  </ul>

</nav>
<div><a  href="manage_catalogue.php">Manage catalogue</a></div>
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
<div class="studList" style="overflow-x:auto;">



<?php
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
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
function display($result){
  if(mysqli_num_rows($result) > 0){
  while ($row = mysqli_fetch_assoc($result)) {

      ?>

    <ul class="list-group">
      <li ><?php echo $row["title"]; ?></li>
      <li ><?php echo $row["author"]; ?></li>
      <li ><?php echo $row["publication_Date"]; ?></li>
      <li ><?php echo $row["quntity"]; ?></li>
      <li ><?php echo $row["call_number"]; ?></li>
      <li ><?php echo $row["isbn"]; ?> </li>
      <li class="list-group-item"><?php echo $row["issn"]; ?></li>
    </ul>
  <?php
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
  $index = 0;
  $sql = "SELECT * FROM `resources` WHERE 1;";
  $result = mysqli_query($conn, $sql);
  $rowcount=mysqli_num_rows($result);
  $rowcount = $rowcount % 2;
  while ($row = mysqli_fetch_assoc($result)) {

    if($rowcount==0){
      echo '<table  style="background-color: #9e978d ;float: left; width:700px; border-collapse:collapse; " border=\"1px;\" >';
    } else {
        echo '<table  style="background-color: 	#FFFFFF ; float: left; width:700px; border-collapse:collapse; " border=\"1px;\" >';
    }

      echo '

      <tr> <th><input style="color:green ; align:center; font-size: 20px;" type="text" name="title" value="'.$row["title"].'" readonly></th></tr>
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
      <tr><td><a class="regbtn" href="update_resources.php?ID='.$row["isbn"].'">Update</a></td>
      <td><a class="delbtn" href="view_resources.php?ID='.$row["isbn"].'">Delete</a></td>

  </tr>
    </table>


      ';
      $image = $row['name'];
      $image_src = "upload_resources/".$image;
      echo '<table style="border-collapse:collapse; " border=\"1px;\" >';

      echo '<tr>';?> <img src='<?php echo $image_src;  ?>' height="200" width="200">  </tr>
      <?php
      echo '</table>
          </form>
          ';
          $rowcount = $rowcount -1;
          ?>

          <?php
    }
if(isset($_GET['ID'])){
  extract($_GET);
  $ID = $_GET['ID'];
  $sql = "SELECT * FROM resources WHERE isbn = '$ID'";
  $result = $conn->query($sql) or die($conn->error);
  $row = $result->fetch_assoc();
  $filename = "resources_archives/".$row['title']."_".$row['isbn'];
  $file = $row['title'].$row['isbn'];
  if (file_exists($file )){
      header("Location:view_patron.php?exist=fileAlreadyExist");
        exit();
 } else{
$fp = fopen($filename,"w");
fwrite($fp ,"ISBN:");
fwrite($fp ,$row['isbn'].PHP_EOL);
fwrite($fp ,"ISSN:");
fwrite($fp ,$row['issn'].PHP_EOL);
fwrite($fp ,"Title:");
fwrite($fp ,$row['title'].PHP_EOL);
fwrite($fp ,"Publication Date:");
fwrite($fp ,$row['publication_Date'].PHP_EOL);
fwrite($fp ,"Author:");
fwrite($fp ,$row['author'].PHP_EOL);
fwrite($fp ,"Call Number:");
fwrite($fp ,$row['call_number'].PHP_EOL);
fwrite($fp ,"Language:");
fwrite($fp ,$row['language'].PHP_EOL);
fwrite($fp ,"Quntity:");
fwrite($fp ,$row['quntity'].PHP_EOL);
fwrite($fp ,"Replacement Cost:");
fwrite($fp ,$row['replacement_cost'].PHP_EOL);
fwrite($fp ,"Borrowing Duration:");
fwrite($fp ,$row['borrowing_duration'].PHP_EOL);
fwrite($fp ,"Barcode:");
fwrite($fp ,$row['barcode'].PHP_EOL);
fwrite($fp ,"Image:");
fwrite($fp ,$row['image'].PHP_EOL);
fwrite($fp ,"Name:");
fwrite($fp ,$row['name'].PHP_EOL);
fclose($fp);
$sql = " DELETE from resources where isbn = ?";
$stmt = mysqli_stmt_init( $conn);
if (!mysqli_stmt_prepare($stmt, $sql)){
  echo'<p>sql error</p>';
  exit();
} else {
  mysqli_stmt_bind_param ($stmt ,"s",  $ID);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_free_result ($stmt);
  echo '<span style="color:red"<div>';
  echo'<p>successfully deleted</p>';
  echo '<p>isbn: </p>'.$ID;
  echo '<p>Title: </p>'.$row['title'];
  echo'<p>stored in this file: </p>'.$filename;
  echo '</div>';
     }
   }
}

?>
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
