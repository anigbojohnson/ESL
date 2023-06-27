<?php

if(isset($_POST['isbn']) && isset($_POST['passport_number'])) {
      require("connection.php");
      $error = "";
      $isbn = test_input($_POST['isbn']);
      $status = test_input("checkin");
      $PassportNumber = test_input($_POST['passport_number']);
   if(empty($isbn) && empty($PassportNumber)){
      echo"empty field";
      } else {

             $sql = "UPDATE checkout SET  status='$status' , Date_returned = CURDATE() , Due_Date = null WHERE Passport_Number= '$PassportNumber' AND isbn= '$isbn' AND (status='checkout' OR status='renew')";
             $result = mysqli_query($conn,$sql);
              if($result===false){
                  echo "Error: " .$sql. "<br>" . mysqli_error($conn);
                  exit();
              } else{
                $result = mysqli_query($conn," SELECT quntity from resources  where isbn = '$isbn'");
                $row = mysqli_fetch_assoc($result);
                $quntity = $row['quntity']+1;
                $result = mysqli_query($conn,"UPDATE resources SET quntity = '$quntity' where isbn= '$isbn'");
                  ?>
                  <script>
                      document.getElementById("remove_resource").style.display="none";
                  </script>

                  <?php

                  }
                }


       }else{
         header("Location:patron_checkout.php");
       }


function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
}


?>
