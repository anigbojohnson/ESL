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
<title>Main Admin</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="librarianStyle.css" rel="stylesheet">

</head>
<body>

  <div class="header">
  <h1 class="inHeader">Patron</h1>

</div>


<div class="navbar">
  <a  style="background: #ddd; color: black;"  href="patron_profile.php">Patron Profile</a>
	<a href="patron_checkout.php">Checkout</a>
  <a href="update_password.php">Password Update</a>
  <a href="borrowing_history.php">Borrow history</a>
  <a style="float: right;" href="search_resources.php" >Logout</a>

</div>
<div class="adds">

<?php
if(  isset($_SESSION["id"]) ){
  extract($_GET);
  $ID = $_SESSION["id"];
$sql = "SELECT * FROM `patron` WHERE Passport_Number=?";
$result = mysqli_query($conn, $sql);
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$sql)){
    header("Location: add_patron.php?error=sqlerror");
    exit();
  }
    mysqli_stmt_bind_param( $stmt ,"s" ,$ID );
    mysqli_stmt_execute($stmt);
    $resultCheck = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($resultCheck);
    echo'<div style="position: absolute; right: 300px;">';
    $image = $row['name'];
    $image_src = "upload_patron/".$image;
    echo '<tr>';?> <img src='<?php echo $image_src;  ?>' height="400" width="300">  </tr>
    <?php
  echo'</div>';
  echo' <form method="post" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'"  >';
  echo'<div class="container">';
   echo '<table style="float: left; width:700px; border-collapse:collapse; " border=\"1px;\" >
   <b><label for="PName">Patron name  </label></b><br>
  <input type="text" name="pName" value="'.$row["Patron_Name"].'" readonly><br>
  <b><label for="PNumber">Passport Number  </label></b><br>
  <input type="text" name="Passport_Number" value="'.$row["Passport_Number"].'" readonly><br>
   <b><label for="phoneNumber">Phone Number </label></b><br>
  <input type="text" name="phone_Number" value="'.$row["phone_number"].'" readonly><br>
   <b><label for="address">Address </label></b><br>
  <input type="text" name="address" value="'.$row["address"].'" readonly><br>
  <b><label for="email">Email </label></b><br>
  <input type="text" name="email" value="'.$row["email"].'" readonly><br>
  <b><label for="city">City </label></b><br>
  <input type="text" name="city" value="'.$row["city"].'" readonly><br>
  <b><label for="state">State </label></b><br>
  <input type="text" name="state" value="'.$row["state"].'" readonly><br>
  <b><label for="dob">DOB </label></b><br>
  <input type="text" name="state" value="'.$row["dob"].'" readonly><br></table>
  </table>
  </form>';

  echo '</div>';
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
