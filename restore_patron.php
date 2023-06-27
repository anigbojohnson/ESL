<?php
ini_set('mysqli_connect_timeout',300);
ini_set('default_socket_timeout',300);
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="librarianStyle.css" rel="stylesheet">
<style>


</style>

</head>
<body>



  <nav class="navbar navbar-expand-sm bg-light">

    </ul>

  </nav>


<div >
  <?php
  $PassportNumberErr =$PassportNumber="";
   ?>
     <hr>
  <div>
    <form autocomplete="off" action="<?php
      echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype = "multipart/form-data">
    <div >

      <span class="error">* <?php echo $PassportNumberErr; ?></span><br>

      <input type="text"  style =" float:left ;width: 30%;padding: 12px 20px;margin: 8px 0;display: inline-block;border: 1px solid #ccc;border-radius: 4px;  box-sizing: border-box;" placeholder="Enter Passport number" name="Passport" required value="<?php echo $PassportNumber; ?>">
      <button type="submit" style=" width: 20%;background-color: #4CAF50; color: white; padding: 14px 20px; margin: 8px 0; border: none; border-radius: 4px;cursor: pointer;" name ="restore" >Restore Delete</button>
    </div>
  </form>
  </div>

<?php
// define variables and set to empty values
$pnameErr = $PassportNumberErr = $passwordErr = $passwordConfirmErr = $genderErr =$phoneNumberErr = $addressErr = $emailErr = $dobErr =$cityErr= $stateErr= "";
$pname = $PassportNumber = $passsword = $passwordConfirm = $gender = $phoneNumber = $address = $email = $city = $dob = $state =$images= "";
if(isset($_POST["Passport"])){

   $PassportNumber = test_input($_POST["Passport"]);
    $PassportNumber = $PassportNumber .'.txt';
   $folder = "patron_archives";
  if($handle = opendir($folder)){
     while(false !== ($entry = readdir( $handle ))){
       if($entry!='.'&& $entry!='..'){
         $posone = strpos($entry, '_')+1;
         $id = substr($entry,$posone);
         $pos = strpos($entry, '_');
         $name = substr($entry,0,$pos);
        echo 'the passport id is '. $PassportNumber;
       echo 'the id is '.$id;
       $PassportNumber = $PassportNumber;
      //  echo 'the name is '.$name."/n";
      //  echo 'the file is '.$entry."/n";
         if(strcmp($PassportNumber,$id)===0){
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
function readData($filename){
       $filename = "patron_archives/".$filename;
       $entry = fopen($filename,"r");
       $PassportNumber = fgets($entry);
       $posone = strpos($PassportNumber, ':')+1;
       $PassportNumber = substr($PassportNumber,$posone);
       $pname = fgets($entry);
       $posone = strpos($pname, ':')+1;
       $pname= substr($pname,$posone);
       $password = fgets($entry);
       $posone = strpos($password, ':')+1;
       $password = substr($password,$posone);
       $gender = fgets($entry);
       $posone = strpos($gender, ':')+1;
       $gender = substr($gender,$posone);
       $phoneNumber = fgets($entry);
       $posone = strpos($phoneNumber, ':')+1;
       $phoneNumber = substr($phoneNumber,$posone);
       $address = fgets($entry);
       $posone = strpos($address, ':')+1;
       $address = substr($address,$posone);
       $email = fgets($entry);
       $posone = strpos($email, ':')+1;
       $email = substr($email,$posone);
       $city = fgets($entry);
       $posone = strpos($city, ':')+1;
       $city = substr($city,$posone);
       $state = fgets($entry);
       $posone = strpos($state, ':')+1;
       $state = substr($state,$posone);
       $dob = fgets($entry);
       $posone = strpos( $dob, ':')+1;
       $dob = substr( $dob,$posone);
       $name = fgets($entry);
       $posone = strpos( $name, ':')+1;
       $name = substr($name,$posone);
       $image = fgets($entry);
       $posone = strpos( $image, ':')+1;
       $image = substr( $image,$posone);

       require_once('connection.php');
       $sql = "INSERT INTO patron ( Patron_Name, Passport_Number, PASSWORD, gender, phone_number, address, email, city, state, dob, image, name) VALUES ('$pname' ,'$PassportNumber' , '$password' , '$gender', '$phoneNumber' ,
          '$address', '$email', '$city' , '$state' , '$dob', '$image','$name' )";
          $quary = mysqli_query($conn, $sql);
           $quary = ($quary=== false) ? false : $quary;
       if ($quary !== false) {

         //unlink(basename($filename,"txt"));
         header("Location:view_patron.php?restore=success");

         } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
      }
?>
</body>
</html>
