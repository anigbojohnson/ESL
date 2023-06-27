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
$firstNameErr = $lastNameErr = $passportNumberErr = $passwordErr = $passwordConfirmErr = $genderErr =$phoneNumberErr = $addressErr = $emailErr = $confrimEmailErr = $dobErr =$cityErr= $stateErr=   $patronNumber = "";
$firstName = $passportNumber = $passsword = $passwordConfirm = $gender = $phoneNumber = $address = $confirmEmail = $email = $city = $dob = $state = $securityAnswer = $securityQuestion=$captchaAnswer=  $confirmEmail= "";
if (isset($_POST['register'])){
     $OK = true;
	if (empty($_POST["firstName"])) {
    //$firstNameErr =
    echo "First name is mandatory";
    $OK = false;
  } else {
    $firstName = test_input($_POST["firstName"]);

     if(!preg_match('/^[A-Za-z]+$/', $firstName)){
        //$firstNameErr =
        echo "Numbers , white space , and special character are invalid";
        $OK = false;
    }
  }
  if (empty($_POST["lastName"])) {
    //$lastNameErr =
    echo "last name is mandatory";
    $OK = false;
  } else {
    $lastName = test_input($_POST["lastName"]);
    if(!preg_match('/^[A-Za-z]+$/',$lastName)){
        //$lastNameErr =
        echo "Numbers , white space , and special character are invalid";
        $OK = false;
    }
  }

  if (empty($_POST["password"])) {
  // $passwordErr =
   echo "password is required";
   $OK = false;
 } else {
   $password = test_input($_POST["password"]);
   if(!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $password)){
     //$passwordErr =
     echo "invalid, must have atleast one lowercase , uppercase  letters and a number and atleast eight character";
       $OK = false;
   }else {
        $passwordConfirm = test_input($_POST["passwordConfirm"]);
       if (strcmp($password ,$passwordConfirm)!=0) {
         //$passwordConfirmErr =
         echo "password does not match";
           $OK = false;
      }
   }
 }


  if (empty($_POST["gender"])) {
    //$genderErr =
    echo "gender is required";
      $OK = false;
  } else {
    $gender = test_input($_POST["gender"]);
  }
  if (empty($_POST["phoneNumber"])) {
    //$phoneNumberErr =
    echo "phone number is required";
    $OK = false;
  } else {
    $phoneNumber = test_input($_POST["phoneNumber"]);
    if(!preg_match('/^(070|080|081|090|091)\d{8,9}$/', $phoneNumber)){
      echo "invalid phone number";
     }
  }
  if (empty($_POST["address"])) {
    //$addressErr =
    echo "address is required";
      $OK = false;
  } else {
    $address = test_input($_POST["address"]);
  }
  if (empty($_POST["email"])) {
    //$emailErr =
    echo "Email is required";
      $OK = false;
  } else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      //$emailErr =
      echo "Invalid email format";
      $OK = false;
    } else{
      $confirmEmail = test_input($_POST["confirmEmail"]);
      if (strcmp($email , $confirmEmail)!=0) {
          //$passwordConfirmErr =
          echo "email did not match";
          $OK = false;
      }
    }
  }
  if (empty($_POST["dob"])) {
     //$dobErr =
     echo "dob is required";
      $OK = false;
   } else {
     $dob  = test_input($_POST["dob"]);
    $age = date_diff (date_create(date('y-m-d')),date_create($dob));
    if($age->format('%y')< 18){
      echo "you are not accepted for registeration";
    }
   }


   if (empty($_POST["state"])) {
      //$stateErr =
      echo "State is required";
       $OK = false;
    } else {
      $state  = test_input($_POST["state"]);
    }
    if (empty($_POST["city"])) {
       //$cityErr =
       echo "City is required";
        $OK = false;
     } else {
       $city  = test_input($_POST["state"]);
     }
     if(empty($_POST["number"])){
       //$identityNumberErr =
       echo "identity type  must be selected";
       $OK = false;
     } else{
       $identityType = test_input($_POST["number"]);
       switch(test_input($_POST["number"])) {
         case "internationalPassport":

             if (empty(test_input($_POST["passportNumber"]))) {
                //$identityNumberErr =
                echo "Passport Number is required";
                 $OK = false;
              }
              if(!preg_match("/^\b[A]\d{8}\b$/", test_input($_POST["passportNumber"]))){
                //$identityNumberErr =
                echo "First character must be an Aphabet and the rest eight a number";
              } else{
                $identityNumber  = test_input($_POST["passportNumber"]);

               }
           break;
         case "voterCard":
               if (empty($_POST["voterIdentityNumber"])) {
               //$identityNumberErr =
                  echo "voter  Number is required";
                   $OK = false;
                } else{
                  $identityNumber = test_input($_POST["voterIdentityNumber"]);
                }
          break;

         case "driversLicence":
                   if (empty($_POST["driverLicenceNumber"])) {
                      //$identityNumberErr =
                      echo "Driver Licence number is required";
                       $OK = false;
                    } else{
                      $identityNumber = test_input($_POST["driverLicenceNumber"]);
                    }
             break;
        case "nationalId":
             if (empty($_POST["documentNumber"])) {
                //$identityNumberErr =
                echo "ducument  number is required";
                 $OK = false;
              }
              if(preg_match("\d{4}\s\d{4}\s\d{4}\s\d{4}", $_POST["documentNumber"])){
                //$identityNumberErr =
                 echo "must be sixteen numbers like so (1234 1234 5678 9123) ";
              } else{
                $identityNumber = test_input($_POST["documentNumber"]);
              }
            break;
       }

     }


   if(!empty($_FILES['file'])){

       $uploadFolder = "upload/";
       $fileName = $_FILES['file']['name'];
       $tempLocation = $uploadFolder.$fileName;
       $fileExt = pathinfo($tempLocation, PATHINFO_EXTENSION);
       $fileExt = strtolower($fileExt);
       $extArray = array("jpeg","jpg", "png","pdf");
       if(!in_array($fileExt,  $extArray)){
         //$fileTypeError =
         echo "The file type or extension must be either jpeg , jpg, png or pdf";
         $OK = false;
       }
       if( $_FILES['file']['size']>500000){
         //$fileSizeError =
         echo "your file  ".$fileName." size is ".intdiv($_FILES['file']['size'], 1024)."kb; must be less than 500kb";
         $OK = false;
       }
       if($_FILES['file']['error']!==0){
         //$fileSizeError =
         echo  "The file has an error while uploading";
         $OK = false;
       }
     }
     if(empty($_POST["captchaAnswer"])){
        //$captchaAnswer =
        echo "Captcha required";
        $OK === false;
      } else{
        $captchaAnswer =test_input($_POST["captchaAnswer"]);
        if(strcmp($_SESSION['capture'] , $captchaAnswer)!=0){
          //$captchaAnswerErr =
          echo  "Incorrect captcha value ";
          $OK === false;
        }
      }

      if(empty($_POST["securityQuestion"])){
        //$captchaAnswer =
        echo "security question required";
        $OK === false;
      } else{
        $securityQuestion =test_input($_POST["securityQuestion"]);
      }
      if(empty($_POST["securityAnswer"])){
        $securityAnswer = "security answer required";
        $OK === false;
      } else{
        $securityAnswer =test_input($_POST["securityAnswer"]);
      }
      if(empty($_POST["identityExpireDate"])){
        $identityExpireDateErr = "identity expiration date required";
        $OK === false;
      } else{
        $identityExpireDate =test_input($_POST["identityExpireDate"]);
      }
   if ( $OK === true) {
      $sql = " SELECT * FROM patron WHERE patron_Number='$identityNumber';";
      $result  = mysqli_query($conn, $sql);
    //  $result = mysqli_fetch_assoc ($quary);
        if ( mysqli_num_rows ($result) > 1 ){
              //$error =
              echo "Patron already registered";
              exit();
            } else {
            $fileNameWithoutExt = basename($fileName,".".$fileExt);
            $tempLocation = "upload_patron/".$fileNameWithoutExt.$identityNumber.".".$fileExt;
            if(move_uploaded_file($_FILES['file']['tmp_name'],$tempLocation )){
              $sql = "SELECT MAX(cast(right(patron_Number, 8) AS INT)) FROM patron;";
              $quary = mysqli_query($conn, $sql);
              $row = mysqli_fetch_assoc($quary);
              $initialNumber = "ESL00000000";
              $number = $row['patron_Number'] + 1;
              $numberLen = strlen($number);
              $number = substr( $initialNumber , 0 ,12-$numberLen);
              $patronNumber = $number.$number;
              $patronNumber = $row['quntity']===0 || $row['patron_Number']===null ? "ESL00000001": $patronNumber;
              $sql= "INSERT INTO patron (patron_Number, first_name,last_name, identity_number,identity_type, identityExpireDate, PASSWORD, gender, phone_number, address, email, city, state, dob,securityQuestion,securityAnswer,identity_file) VALUES
                    ('$patronNumber','$firstName','$lastName','$identityNumber' ,'$identityType ','$identityExpireDate','$password' , '$gender', '$phoneNumber','$address','$email' ,'$city' , '$state' , '$dob','$securityQuestion','$securityAnswer','$fileName')";
                    $quary = mysqli_query($conn, $sql);
                     mysqli_close($conn);
                    header("Location:patron_login.php");
                  } else {
                    echo "file failed to upload";
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
