<?php
ob_start();
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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<style>



</style>

</head>
<body>
  <div class="header">
  <h1 class="inHeader">Librarian</h1>

</div>
<nav class="navbar navbar-expand-sm bg-light">

  <!-- Links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link navbar-light" href="librarian_profile.php">Librarian Profile</a>
    </li>
    <li class="nav-item">
      <a class="nav-link navbar-light" href="add_patron.php">Register Patron</a>
    </li>
    <li class="nav-item">
      <a class="nav-link navbar-light" href="add_librarian.php">Add Librarian</a>
    </li>
    <li class="nav-item">
      <a class="nav-link navbar-light" href="check_in.php">Check in</a>
    </li>
    <li class="nav-item">
      <a class="nav-link navbar-light " href="librarian_checkout.php">Checkout</a>
    </li>
    <li class="nav-item">
      <a class="nav-link navbar-light" href="manage_catalogue.php">Manage Catalogue</a>
    </li>
    <li class="nav-item">
     <a class="nav-link navbar-light" href="librarian_login.php">Logout</a>
   </li>
  </ul>

</nav>
<div class="container  pt-5">

<?php
$isbnErr=$isbn=$PassportNumber=$phonenumber= $pname=$PassportNumberErr= $email = $image=$name="";
$status = "checkout";


 ?>
<form autocomplete="off" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
  <h1>Check Out</h1>

  <span   class="error"> <?php echo $PassportNumberErr; ?></span><br>

    <span>  <label for="ID"><b>Passport Number</b></label></span><br>
    <input  type="text" placeholder="Enter book passport number" name="passport" style ="    width: 30%;padding: 15px;  margin: 5px 0 22px 0;display: inline-block;border: none;background: #f1f1f1;
  " tabindex = 1 required value="<?php echo $PassportNumber; ?>" ><br>
  <span>  <label for="ID"><b>ISBN</b></label></span><br>
  <input  type="text" placeholder="Enter book isbn" name="isbn" style ="    width: 30%;padding: 15px;  margin: 5px 0 22px 0;display: inline-block;border: none;background: #f1f1f1;
" tabindex = 1 required value="<?php echo $isbn; ?>" >
  <span   class="error"> <?php echo $isbnErr; ?></span><br>
  <input type="checkbox"  name="renew_item" value="main">
  <label for="main"> Renew Checkout</label><br>
  <button type="submit" tabindex = 2 style ="width:80" class="registerbtn" width="20" name = "resources_checkout">Checkout</button><br>
</div>
</form>
</div>





<table width="00">




<?php


if(isset($_POST['isbn']) && isset($_POST['passport']) && !(isset($_POST['renew_item']))) {
      extract($_SESSION);
      $isbn = test_input($_POST['isbn']);
      $PassportNumber  = test_input($_POST['passport']);
        $status = "checkout";
        $result = mysqli_query($conn,"SELECT isbn FROM checkout WHERE Passport_Number='$PassportNumber' AND isbn='$isbn' AND status='$status'");
    if(empty($isbn)){
          header("Location:librarian_checkout.php?error=emptyfield");
        }
  if ( mysqli_num_rows($result)>= 1){
            header("Location:librarian_checkout.php?error=AlreadyBorrowed");
 } else {
      $result = mysqli_query($conn, "SELECT  isbn from checkout where Passport_Number= '$PassportNumber' and status ='$status'");
      $count = mysqli_num_rows($result);
      if($count  >= 3){
          header("Location:librarian_checkout.php?error=exceedLimit");
      } else{
        $result = mysqli_query($conn," SELECT  quntity from resources where isbn = '$isbn'");
        $row = mysqli_fetch_assoc($result);
        if(  $row['quntity']==0){
          header("Location:librarian_checkout.php?error=bookUnAvailable");
        } else{
            $result = mysqli_query($conn,"SELECT * from checkout where Passport_Number= '$PassportNumber' and status ='$status' and Due_Date < CURDATE()");
            $rowCount = mysqli_num_rows($result);
            if($rowCount > 0){
              header("Location:librarian_checkout.php?error=BookDueReturn");
              exit();
            } else{
              $result = mysqli_query($conn," SELECT borrowing_duration from resources  where isbn = '$isbn'");
              $row = mysqli_fetch_assoc($result);
              $days = '+'.$row['borrowing_duration'].' '.'days';
              $date = date("m/d/Y");
              $returnDate =  date('Y-m-d', strtotime($date.$days));
              $sql = "INSERT INTO  checkout (id,Passport_Number,isbn, Date_borrowed,status ,Due_Date) VALUES (null,'$PassportNumber', '$isbn',CURDATE(),'$status','$returnDate')";
              $result = mysqli_query($conn,$sql);
              if($result===false){
                  echo "Error: " .$sql. "<br>" . mysqli_error($conn);
                  exit();
              } else{
                $result = mysqli_query($conn," SELECT quntity from resources  where isbn = '$isbn'");
                $row = mysqli_fetch_assoc($result);
                $quntity = $row['quntity']-1;
                $sql = "UPDATE resources SET quntity = '$quntity' where isbn= '$isbn'";
                $result = mysqli_query($conn,$sql);
                if($result === false){
                    header("Location:librarian_checkout.php.php?error=quntitynotUpdated");
                    exit();
                }
              $result = mysqli_query($conn,"SELECT *
              from checkout ch join  resources res
              on res.isbn = ch.isbn
              join patron pat
              on pat.Passport_Number = ch.Passport_Number
              where status = '$status' and ch.Passport_Number='$PassportNumber'");
              if($result===false){
                  echo "Error: " . "<br>" . mysqli_error($conn);
                  exit();
              } else{
                echo '  <tr>
                  <th>Passport Number</th>
                    <th>ISBN</th>
                    <th>TITLE</th>
                    <th>AUTHOR</th>
                    <th>Date Borrowed</th>
                    <th>Due Date</th>
                    <th>Action</th>
                        </tr>';
              while($row = mysqli_fetch_assoc($result)){
                echo'
               <tr>
                    <td><input type="text" name="isbn" size="5000" value="'.$row["Passport_Number"].'" readonly></td>
                    <td><input type="text" name="isbn" size="5000" value="'.$row["isbn"].'" readonly></td>
                    <td><input type="text" name="title" size="5000" value="'.$row["title"].'" readonly></td>
                    <td><input type="text" name="author" size="5000" value="'.$row["author"].'" readonly></td>
                    <td><input type="text" name="dateBorrowed" size="5000" value="'.$row["Date_borrowed"].'" readonly></td>
                    <td><input type="text" name="dueDate" size="5000" value="'.$row["Due_Date"].'" readonly></td>
                   <td><input type="text" name="dueDate" size="5000" value="'.$row["status"].'" readonly></td>

        </tr>';
                    }

                }
            }
          }
       }
    }
  }
}
if(isset($_POST['isbn']) && isset( $_POST['passport']) && isset($_POST['renew_item'])) {
  $id= 0;
      extract($_SESSION);
      $isbn = test_input($_POST['isbn']);
      $PassportNumber  = test_input($_POST['passport']);
      $renewitem  = test_input($_POST['renew_item']);
        $status = "checkout";
        $result = mysqli_query($conn,"SELECT isbn,id FROM checkout WHERE Passport_Number='$PassportNumber' AND isbn='$isbn' AND status='$status'");
        $row = mysqli_fetch_assoc(  $result);
        $id = $row['id'];
    if(empty($isbn)){
          header("Location:librarian_checkout.php?error=emptyfield");
        }
  if ( mysqli_num_rows($result) == 1){
      $result = mysqli_query($conn, "SELECT  isbn from checkout where Passport_Number= '$PassportNumber' and status ='$status'");
      $count = mysqli_num_rows($result);
      if($count  >= 3){
          header("Location:librarian_checkout.php?error=exceedLimit");
      } else{
            $result = mysqli_query($conn,"SELECT * from checkout where Passport_Number= '$PassportNumber' and status ='$status' and Due_Date < CURDATE()");
            $rowCount = mysqli_num_rows($result);
            if($rowCount > 0){
              header("Location:librarian_checkout.php?error=BookDueReturn");
              exit();
            } else{
              $result = mysqli_query($conn," SELECT borrowing_duration from resources  where isbn = '$isbn'");
              $row = mysqli_fetch_assoc($result);
              $days = '+'.$row['borrowing_duration'].' '.'days';
              $date = date("m/d/Y");
              $returnDate =  date('Y-m-d', strtotime($date.$days));

              $sql = "UPDATE  checkout SET Date_borrowed = CURDATE() ,Due_Date = '$returnDate' where id ='$id'";
              $result = mysqli_query($conn,$sql);
              if($result===false){
                  echo "Error: " .$sql. "<br>" . mysqli_error($conn);
                  exit();
              } else{
              $result = mysqli_query($conn,"SELECT *
              from checkout ch join  resources res
              on res.isbn = ch.isbn
              join patron pat
              on pat.Passport_Number = ch.Passport_Number
              where status = '$status' and ch.Passport_Number='$PassportNumber' and id = '$id'");
              if($result===false){
                  echo "Error: " . "<br>" . mysqli_error($conn);
                  exit();
              } else{
                echo'
                <tr>
                <th>Passport Number</th>
                  <th>ISBN</th>
                  <th>TITLE</th>
                  <th>AUTHOR</th>
                  <th>Date Borrowed</th>
                  <th>Due Date</th>
                  <th>Action</th>
              </tr>';
              while($row = mysqli_fetch_assoc($result)){
                echo'
               <tr>
                    <td><input type="text" name="isbn" size="5000" value="'.$row["Passport_Number"].'" readonly></td>
                    <td><input type="text" name="isbn" size="5000" value="'.$row["isbn"].'" readonly></td>
                    <td><input type="text" name="title" size="5000" value="'.$row["title"].'" readonly></td>
                    <td><input type="text" name="author" size="5000" value="'.$row["author"].'" readonly></td>
                    <td><input type="text" name="dateBorrowed" size="5000" value="'.$row["Date_borrowed"].'" readonly></td>
                    <td><input type="text" name="dueDate" size="5000" value="'.$row["Due_Date"].'" readonly></td>
                   <td><input type="text" name="dueDate" size="5000" value="'.$row["status"].'" readonly></td>

        </tr>';
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
</div>
</body>
</script>
</html>
