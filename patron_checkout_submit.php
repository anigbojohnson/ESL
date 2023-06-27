<?php
    use PHPMailer\PHPMailer\PHPMailer;

if(isset($_POST['searchBook'])){
  require("connection.php");
  $searchBook = test_input_checkout($_POST['searchBook']);
  if(!empty($searchBook)){
    $result = mysqli_query($conn ,"SELECT isbn from resources where isbn LIKE '$searchBook%'");
    if(mysqli_num_rows($result)>0){
      $index = 0;
      $isbnArray= array();

      while($row=mysqli_fetch_assoc($result)){
        $isbnArray = $isbnArray + array($index=>$row['isbn']);
        $index = $index + 1;
      }
      echo  json_encode( $isbnArray);
      exit();
    }else{
          $isbnStatus="No";
         $isbnActivity = array(
         "No"=> $isbnStatus,
         );
       echo  json_encode($isbnActivity);
        exit();
    }
  } else{
        $isbnStatus="No";
       $isbnActivity = array(
       "No"=> $isbnStatus,
       );
     echo  json_encode($isbnActivity);
      exit();
  }
}
if((isset($_POST['isbn'])  && isset($_POST['status']))) {
        require("connection.php");
        require("patron_login.php");
        $isbn = test_input_checkout($_POST['isbn']);
        $PassportNumber  = $_SESSION['id'];
        $status = test_input_checkout($_POST['status']);
        $checkout = test_input_checkout($_POST['checkout']);
        $sendEmail = test_input_checkout($_POST['emailSent']);
        $returnValidation = $resources = $checkout_status = $validateIsbn = $resourcesBorrowed = $checkoutLimit = $resourceAvailable = $dueReturn= $checkoutMode = "";

          if($status==="checkin" && !empty($isbn)){
                    if(strcmp($checkout,"checkin")===0){
                          $sendEmail =$sendEmail==="sendEmail"?sendEmail($PassportNumber,$isbn,$status):"";
                          $checkinStatus=resource_checkin($PassportNumber,$isbn,$status);
                           $resourcesActivity = array(
                             "email"=> $sendEmail,
                           "checkin_status"=> $checkinStatus
                          );
                      echo  json_encode($resourcesActivity );
                      exit();
                    }else {
                      $result = mysqli_query($conn," SELECT * FROM resources  WHERE isbn = '$isbn'");
                      $row = mysqli_fetch_assoc($result);
                      $days = '+'.$row['borrowing_duration'].''.'days';
                      $date = date("m/d/Y");
                      $returnDate =  date('Y-m-d', strtotime($date.$days));
                      $isbn = $row['isbn'];
                      $title = $row['title'];
                      $author = $row['author'];
                      $picture = $row['name'];
                      $status = "Checkin";
                      $dateBorrowed = gmdate("l jS F Y , H:i:s A");
                      $publicationDate = $row['publication_Date'];
                      $checkinMode = "checkin_process";

                      $resourcesActivity = array(
                      "checkinMode" => $checkinMode,
                      "status"=> $status,
                      "title" => $title,
                      "author" => $author,
                      "Date_borrowed" => $dateBorrowed,
                      "publication_Date"=> $publicationDate,
                      "Date_returned" => $returnDate,
                      "name" => $picture,
                      "isbn" => $isbn
                    );
                         echo  json_encode($resourcesActivity);
                         exit();
                    }
              }
          if(!empty($isbn)){
            $validateIsbn = check_isbn($isbn);
            $resourcesBorrowed = check_resource_borrowed($PassportNumber, $isbn ,$status);
            $checkoutLimit = check_checkout_limit($PassportNumber, $status);
            $resourceAvailable = check_resource_available($isbn);
            $dueReturn = check_resource_due_return($PassportNumber,$status);
          } else{
            exit();
          }
          if(($validateIsbn===""|| $validateIsbn===null) & ($resourcesBorrowed===""|| $resourcesBorrowed===null)  & ($checkoutLimit===""|| $checkoutLimit===null) & ($resourceAvailable===""|| $resourceAvailable===null) & ($dueReturn===""||$dueReturn===null)){
               $resources = "OK";
             }  else{
             $errorMessages = array(
            "validate_isbn" => $validateIsbn,
            "resources_borrowed" => $resourcesBorrowed,
            "checkout_limit" => $checkoutLimit,
            "resource_available" => $resourceAvailable,
            "due_return" => $dueReturn
          );
           echo  json_encode($errorMessages);
           exit();
         }
         if($resources ==="OK"){
              if($status=="checkout" || $status==="reserve"){
                    if(strcmp($checkout,"checkout")==0 || strcmp($checkout,"reserve")==0){

           $checkout_status = resource_checkout($PassportNumber,$isbn,$status);
           $sql = "SELECT *
                            FROM checkout ch JOIN  resources res
                            ON res.isbn = ch.isbn
                            JOIN patron pat
                            ON pat.Passport_Number = ch.Passport_Number
                            WHERE status = 'checkout'AND ch.Passport_Number='$PassportNumber' AND ch.isbn='$isbn'";
               $result = mysqli_query($conn,$sql);
               $row = mysqli_fetch_assoc($result);

                $isbn = $row['isbn'];
                $title = $row['title'];
                $author = $row['author'];
                $status = $row['status'];
                $dateBorrowed = $row['Date_borrowed'];
                $dueDate = $row['Due_Date'];
                $returnDate = $row['Date_returned'];

                $resourcesActivity = array(
                "checkout" => $checkout_status,
                "isbn" => $isbn,
                "status" => $status,
                "title" => $title,
                "author" => $author,
                "Date_borrowed" => $dateBorrowed,
                "Due_Date" => $dueDate,
                "Date_returned" => $returnDate,
                 "email"=>$sendEmail==="sendEmail"?sendEmail($PassportNumber,$isbn,$status):""
              );
              echo  json_encode($resourcesActivity );
              exit();
            } else{
                   $result = mysqli_query($conn," SELECT * from resources  WHERE isbn = '$isbn'");
                   $row = mysqli_fetch_assoc($result);
                   $days = '+'.$row['borrowing_duration'].''.'days';
                   $date = date("m/d/Y");
                   $returnDate =  date('Y-m-d', strtotime($date.$days));
                   $isbn = $row['isbn'];
                   $title = $row['title'];
                   $author = $row['author'];
                   $picture = $row['name'];
                   $status = "checkout";
                   $dateBorrowed = gmdate("l jS F Y , H:i:s A");
                   $publicationDate = $row['publication_Date'];
                   $checkoutMode = "checkout_process";

                   $resourcesActivity = array(
                   "checkoutMode" => $checkoutMode,
                   "status"=> $status,
                   "title" => $title,
                   "author" => $author,
                   "Date_borrowed" => $dateBorrowed,
                   "publication_Date"=> $publicationDate,
                   "Date_returned" => $returnDate,
                   "name" => $picture,
                   "isbn" => $isbn
                     );
                          echo  json_encode($resourcesActivity );
                          exit();
                     }
                   }
          if($status==="renew"){
             if(strcmp($checkout,"renew")===0){
                 $checkout_status=resource_renew_checkout($PassportNumber,$isbn,$status);
                 $sql = "SELECT * FROM checkout ch JOIN  resources res
                       ON res.isbn = ch.isbn
                       JOIN patron pat
                       ON pat.Passport_Number = ch.Passport_Number
                       WHERE status = 'renew' AND ch.Passport_Number = '$PassportNumber' AND ch.isbn='$isbn' AND Date_returned=CURDATE()";
                 $result = mysqli_query($conn , $sql);
                 $row = mysqli_fetch_assoc($result);
                 $isbn = $row['isbn'];
                 $title = $row['title'];
                 $author = $row['author'];
                 $status = $row['status'];
                 $dateBorrowed = $row['Date_borrowed'];
                 $dueDate = $row['Due_Date'];
                 $returnDate = $row['Date_returned'];

                 $resourcesActivity = array(
                      "email"=>$sendEmail==="sendEmail"?sendEmail($PassportNumber,$isbn,$status):"",
                     "renew_status"=> $checkout_status,
                     "isbn" => $isbn,
                     "status" => $status,
                     "title" => $title,
                     "author" => $author,
                     "Date_borrowed" => $dateBorrowed,
                     "Due_Date" => $dueDate,
                     "Date_returned" => $returnDate,
             );

              echo  json_encode($resourcesActivity);
             exit();
           } else{
                 $result = mysqli_query($conn," SELECT * FROM resources  WHERE isbn = '$isbn'");
                 $row = mysqli_fetch_assoc($result);
                 $days = '+'.$row['borrowing_duration'].''.'days';
                 $date = date("m/d/Y");
                 $returnDate =  date('Y-m-d', strtotime($date.$days));
                 $isbn = $row['isbn'];
                 $title = $row['title'];
                 $author = $row['author'];
                 $picture = $row['name'];
                 $status = "Renew";
                 $dateBorrowed = gmdate("l jS F Y , H:i:s A");
                 $publicationDate = $row['publication_Date'];
                 $checkoutMode = "renewed_process";

                 $resourcesActivity = array(
                 "checkoutMode" => $checkoutMode,
                 "status"=> $status,
                 "title" => $title,
                 "author" => $author,
                 "Date_borrowed" => $dateBorrowed,
                 "publication_Date"=> $publicationDate,
                 "Date_returned" => $returnDate,
                 "name" => $picture,
                 "isbn" => $isbn
               );
                    echo  json_encode($resourcesActivity);
                    exit();
              }
           }

      }
    }

function test_input_checkout($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  function check_isbn($isbn){

    require("connection.php");
    $returnValidation = "";
    $result = mysqli_query($conn," SELECT * FROM resources  WHERE isbn = '$isbn'");
    if( mysqli_num_rows($result)<= 0){
    // error incorrect isbn
        $returnValidation = "ONE";

        return  $returnValidation;
        }
    }

  function check_resource_borrowed($passportNumber, $isbn ,$status ){
    require("connection.php");
    $returnValidation = "";
    if($status !== "renew"){
      $result = mysqli_query($conn,"SELECT * FROM checkout WHERE Passport_Number='$passportNumber' AND isbn='$isbn' AND
        (status='checkout' OR status='renew'OR status='reserve')");
      $row = mysqli_fetch_assoc($result);
      if ( mysqli_num_rows($result)>= 1 && $row['status']!=='reserve' && $row['status']!=='checkin'){
        // Already checked out , reserved or renewed
              $returnValidation = "TWO";
              return  $returnValidation;
            }
          }
        }

  function check_checkout_limit($passportNumber, $status ){
    require("connection.php");
    $returnValidation = "";
    if($status !=="renew"){
      $result = mysqli_query($conn, "SELECT isbn FROM checkout WHERE Passport_Number= '$passportNumber' AND (status ='checkout' OR status ='renew') ");
      $count = mysqli_num_rows($result);
      if($count  >= 3){
        // exceed limit of checkout
         $returnValidation = "THREE";
         return $returnValidation;
    }
  }
}
function check_resource_available($isbn){
  require("connection.php");
  $returnValidation = "";
  $returnValidation = check_isbn($isbn);

    $result = mysqli_query($conn," SELECT  quntity,isbn FROM resources WHERE isbn = '$isbn'");
    $row = mysqli_fetch_assoc($result);
    if(  $row['quntity'] <=0 && $row['isbn']===$isbn){
      // book UnAvailable
        $returnValidation = "FOUR";
        return $returnValidation;
      }

  }
  function check_resource_due_return($passportNumber,$status){
    require("connection.php");
    $returnValidation = "";
    $result = mysqli_query($conn,"SELECT * FROM checkout WHERE Passport_Number= '$passportNumber' AND status ='$status' AND Due_Date<CURDATE()");
    $rowCount = mysqli_num_rows($result);
    if($rowCount  > 0){
      // book due return
      $returnValidation = "FIVE";
      return $returnValidation;
    }
  }
  function resource_checkout($PassportNumber,$isbn,$status){
    require("connection.php");
    $result = mysqli_query($conn," SELECT * FROM resources  WHERE isbn = '$isbn'");
    $row = mysqli_fetch_assoc($result);
    $days = '+'.$row['borrowing_duration'].' '.'days';
    $date = date("m/d/Y");
    $returnDate =  date('Y-m-d', strtotime($date.$days));
    if($status==="checkout"){
      $sql = "INSERT INTO  checkout (id,Passport_Number,isbn, Date_borrowed,status ,Due_Date) VALUES (NULL,'$PassportNumber', '$isbn',CURDATE(),'checkout','$returnDate')";
      $result = mysqli_query($conn,$sql);
      if($result===false){
          return "not checkedout";

      } else{
        $result = mysqli_query($conn," SELECT quntity from resources  WHERE isbn = '$isbn'");
        $row = mysqli_fetch_assoc($result);
        $quntity = $row['quntity']-1;
        $sql = "UPDATE resources SET quntity = '$quntity' WHERE isbn= '$isbn'";
        $result = mysqli_query($conn,$sql);
        return "checkout";
      }
    }
   if($status==="reserve"){
      $result = mysqli_query($conn,"UPDATE checkout SET Date_borrowed = CURDATE(),Due_Date= '$returnDate',Date_returned=CURDATE(),status='checkout' WHERE isbn= '$isbn' AND Passport_Number='$PassportNumber' AND status='reserve'");
      if($result===false){
          return "not checkedout";
        } else{
        return "checkout";
      }
    }
}


function resource_renew_checkout($PassportNumber,$isbn,$status){
  require("connection.php");
  $result = mysqli_query($conn," SELECT * from resources  WHERE isbn = '$isbn'");
  $row = mysqli_fetch_assoc($result);
  $days = '+'.$row['borrowing_duration'].' '.'days';
  $date = date("m/d/Y");
  $returnDate =  date('Y-m-d', strtotime($date.$days));
  $result = mysqli_query($conn,"UPDATE checkout SET Date_borrowed = CURDATE(),Due_Date= '$returnDate',Date_returned=CURDATE(),status='$status' WHERE isbn= '$isbn' AND Passport_Number='$PassportNumber' AND status='checkout'");
  if($result!==false){
      return "renewed";
  }
}
function resource_checkin($PassportNumber,$isbn,$status){
  require("connection.php");
  $result = mysqli_query($conn,"UPDATE checkout SET Date_returned=CURDATE(),status='checkin' WHERE isbn= '$isbn' AND Passport_Number='$PassportNumber'
  AND (status='checkout'||status='renew')");
  $result = mysqli_query($conn," SELECT * from resources  WHERE isbn = '$isbn'");
  $row = mysqli_fetch_assoc($result);
  $quntity = $row['quntity']+1;
  $result = mysqli_query($conn,"UPDATE resources SET quntity='$quntity' WHERE isbn= '$isbn'");
  if($result!==false){
    return "checkin";
  }
}
function sendEmail($PassportNumber,$isbn,$status){
    require("connection.php");

  require_once 'PHPMailer\PHPMailer.php';
  require_once 'PHPMailer\SMTP.php';
    require_once 'PHPMailer\POP3.php';
  require_once 'PHPMailer\Exception.php';
  $sql = "SELECT * FROM checkout JOIN patron ON patron.Passport_Number=checkout.Passport_Number JOIN resources ON resources.isbn= checkout.isbn  WHERE checkout.Passport_Number = '$PassportNumber' AND (status='checkout' OR status='reserve' OR status='renew') AND checkout.isbn='$isbn'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $mail = new PHPMailer();

  $mail->SMTPDebug = 0;
  $mail->isSMTP();
  $mail->Host = "smtp.gmail.com";
  $mail->SMTPAuth = true;
  $mail->Username = test_input_checkout("anigbojohnsona@gmail.com");
  $mail->Password = "charis123";
  //$mail->SMTPSecure = "ssl";
  //$mail->Port= 465;
  $mail->SMTPOptions = array(
'ssl' => array(
'verify_peer' => false,
'verify_peer_name' => false,
'allow_self_signed' => true
)
);
  $mail->From = test_input_checkout("anigbojohnsona@gmail.com");
  $mail->setFrom(test_input_checkout('anigbojohnsona@gmail.com'), 'ENUGU Library');
  $mail->FromName ="Enugu State Library";
  $mail->addAddress($row['email']);
  $mail->isHTML(true);
  $mail->Subject = $status." Book";
  $mail_error = "Mailing Error : ".$mail->ErrorInfo;
  $mail->SMTPKeepAlive = true;
  $mail->Mailer = "smtp";
  $mail->Body = '
  Hi '.$row['Patron_Name'].',<br><br>
  Here are the detail of the following book you just '.$status.':<br>


   <div class="container">
    <div class="row">
        <div class ="col-md-5" style="list-style-type:none;">
            <ul style="list-style-type:none;">
            <div style="margin-bottom: 10px;">
              <span style="font-weight: bold;display:inline;">Title: </span>
              <li style="display:inline;">'.$row['title'].'</li>
              </div>
            <div style="margin-top: 10px;">
              <span style="font-weight: bold;display:inline;">Author: </span>
              <li id="modal-author"  style="display:inline;">'.$row['author'].'</li>
              <div>
            <div style="margin-top: 10px;">
               <span style="font-weight: bold;display:inline;">Publication date: </span>
               <li id="modal-publication-date" style="display:inline;">'.$row['publication_Date'].'</li>
              <div>
            <div style="margin-top: 10px;">
              <span style="font-weight: bold;display:inline;">ISBN: </span>
              <li style="display:inline;">'.$row['isbn'].'</li>
             <div>
            <div style="margin-top:10px;">
              <span style="font-weight: bold;display:inline;">Date borrowed:</span>
               <li id="modal-date-borrowed" style="display:inline;">'.$row['Date_borrowed'].'</li>
              <div>
            <div style="margin-top: 10px;">
              <span style="font-weight: bold;display:inline;">Date returned:</span>
              <li  style="display:inline;">'.$row['Date_returned'].'</li>
             <div>
           <div style="margin-top: 10px;">
              <span style="font-weight: bold;display:inline;">Status:</span>
              <li id="modal-status" style="display:inline;">'.$row['status'].'</li>
            <div>
            </ul>
          </div>
        <div class ="col-md-7">
            <img src="cid:books" >
          <ul>
         </ul>
        </div>
     </div>
    </div><br><br>
    Best wishes,<br>
    Enugu State Library';
    $mail->AddEmbeddedImage('upload_resources/'.$row['name'],"books");
  if($mail ->send())
     return "email sent";
  else
    return $mail->ErrorInfo;
}
?>
