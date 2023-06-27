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
<title>Librarian</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="librarianStyle.css" rel="stylesheet">

</head>
<body>

  <div class="header">
  <h1 class="inHeader">Librarian</h1>

</div>


<div class="navbar">
  <a  style="background: #ddd; color: black;"  href="librarian_profile.php">Profile</a>
	<a  href="add_patron.php">Register Patron</a>
  <a href="add_librarian.php">Add Librarian</a>
  <a href="check_in.php">Check in</a>
  <a href="checkout.php">Checkout</a>
  <a href="manage_catalogue.php">Manage Catalogue</a>
  <a style="float: right;" href="librarian_login.php" >Logout</a>

</div>
<div class="adds">

  <form autocomplete="off" action="<?php
    echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype = "multipart/form-data">
  <div class="container">
    <button type="submit" style= " width :80;float:right;" tabindex = 2 class="registerbtn" name = "due_return">Due Date</button>
  </div>
</form>
<?php
if(  isset($_GET['login'])){
  extract($_GET);
  $ID = $_GET["login"];
$sql = "SELECT * FROM `librarian` WHERE librarian_id=?";

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
    $image_src = "upload_librarian/".$image;
    echo '<tr>';?> <img src='<?php echo $image_src;  ?>' height="400" width="300">  </tr>
    <?php
  echo'</div>';
  echo' <form method="post" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'"  >';
  echo'<div class="container">';
   echo '<table style="float: left; width:700px; border-collapse:collapse; " border=\"1px;\" >
   <b><label for="PName">Librarian Id:  </label></b><br>
  <input type="text" name="pName" value="'.$row["librarian_id"].'" readonly><br>
  <b><label for="PNumber">librarian Name  </label></b><br>
  <input type="text" name="Passport_Number" value="'.$row["librarian_name"].'" readonly><br>
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
  <input type="text" name="state" value="'.$row["DOB"].'" readonly><br></table>
  </table>
  </form>';

  echo '</div>';
}

  ?>
<?php

require_once 'vendor/autoload.php';
if(isset($_POST['due_return'])){

  $sql = "SELECT email, Due_Date, title FROM checkout join patron on patron.Passport_Number=checkout.Passport_Number join resources on resources.isbn= checkout.isbn  WHERE Due_Date = CURDATE() and status='checkout'";
  $result = mysqli_query($conn, $sql);
  $result = ($result=== false) ? false : $result;
  if ($result===false){
         echo "Error: " . $sql . "<br>" . mysqli_error($conn);
         exit();
      } else{
    $resultCheck = mysqli_num_rows($result);
      if(  $resultCheck < 0){
        header("Location: librarian_profile.php?error=noDueReturns");
      } else{
               while($row = mysqli_fetch_assoc($result)){
                 $title = $row['title'];
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
              $mail -> addAddress($row['email']);
              $mail -> isHTML(true);
              $mail -> Subject = "Return Book";
              $mail -> Body = "
                              Hi <br><br>
                              This book with title: $title is due; please return return<br>

                              Kind Regards,<br>
                              Enugu state library";
                              if($mail ->send())
                              header("Location: librarian_profile.php?email=sent");
                              else
                              $mail_error = "Mailing Error : ".$mail->ErrorInfo;
            }

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
