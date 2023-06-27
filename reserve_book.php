<?php
require_once('connection.php');
if(isset($_GET['ID'])&& isset($_GET['isbn']) && isset($_GET['status'])) {
      $isbn = $_GET['isbn'];
      $PassportNumber = $_GET['ID'];
      $status = $_GET['status'];

  if(empty($isbn)){
      header("Location:librarian_checkout.php?error=emptyfield");
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
            $result = mysqli_query($conn,"SELECT isbn from checkout where Passport_Number= '$PassportNumber' and status ='$status' and Due_Date >CURDATE()");
            $rowCount = mysqli_num_rows($result);
            if($result === false){
              header("Location:librarian_checkout.php?error=BookDueReturn");
              exit();
            } else{
              $st ="checkout";
              $sql = " UPDATE checkout SET status='$st'  where status = '$status' AND Passport_Number='$PassportNumber' AND isbn = '$isbn'";
              $result = mysqli_query($conn,$sql);
              if($result === false){
                echo "Error: " .$sql. "<br>" . mysqli_error($conn);
              }
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
                    header("Location:librarian_checkout.php?error=quntitynotUpdated");
                    exit();
                }
              $result = mysqli_query($conn,"SELECT *
              from checkout ch join  resources res
              on res.isbn = ch.isbn
              join patron pat
              on pat.Passport_Number = ch.Passport_Number
              where status = '$st' and ch.Passport_Number='$PassportNumber'");
              if($result===false){
                  echo "Error: " . "<br>" . mysqli_error($conn);
                  exit();
              } else{
              while($row = mysqli_fetch_assoc($result)){
                echo'
               <tr>
                    <td><input type="text" name="isbn" size="5000" value="'.$row["isbn"].'" readonly></td>
                    <td><input type="text" name="title" size="5000" value="'.$row["title"].'" readonly></td>
                    <td><input type="text" name="author" size="5000" value="'.$row["author"].'" readonly></td>
                    <td><input type="text" name="dateBorrowed" size="5000" value="'.$row["Date_borrowed"].'" readonly></td>
                    <td><input type="text" name="dueDate" size="5000" value="'.$row["Due_Date"].'" readonly></td>

        </tr>';
        $book_status = $row['status'];
        borrowing_St($book_status,$PassportNumber);
        echo '</tr>';
                    }

                }
            }
          }
       }
    }
  }
}
function borrowing_St($book_status,$PassportNumber ){
  switch($book_status ){
    case 'reserve':
      echo'<td><a id = "patron"  style="background:blue;" size="5000" href="reserve_book.php?ID='.$PassportNumber.'">Reserve</a></td>';
      break;
    case 'checkout':
      echo'<td><a id = "patron"  style="background:green;" size="5000" href="checkin.php?ID='.$PassportNumber.'&isbn='.$isbn.'">Check in</a></td>';
      break;
  }

}
 ?>
