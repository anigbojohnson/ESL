<?php
session_start();
ob_start();
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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<script src="https://smtpjs.com/v3/smtp.js">
</script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<style>
:root {
  --white: #ffffff;
}

.submitbtn{
  background-color:#d6eaf8;
  color:white;
  font-weight: bold;
   border: var(--white);
  height:50px;
  width: 100px;
  font-size: 16px;

}
.cursorIsbn {
    cursor:pointer;
    padding-top: 10px;
    border: 0.5px solid LightGray;
}

#icon{
  display:none;
  float:left;
}
input[type=text] {
  width: 40%;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  font-size: 16px;
  background-color: white;
  padding: 12px;
}
input[type=text]:focus {
  outline: none;
  border:2px solid lightblue;
}
ul li{
  list-style: none;
  font-size: 20px;
}
nav ul li a:hover {
  background-color: white;
}
.logout{
  float: right;
  padding-right: 40px;
  padding-top: 20px;
  font-size: 20px;
  text-decoration: none;
}
#logout{
  display: none;
}
a:hover {
  text-decoration:none;
}
@media only screen and (max-width: 575px) {
  .logout {
    display:none;
  }
  #logout{
    display: block;
  }

  .bg-light{
    display:none;
  }
  #renewBtn{
    background-color: green;
  }
  #icon{
    float: right;
    display: block;
    font-size: 30px;
    padding-right: 20px;
  }
}
ul li span{
  font-size: 12px;
  font-weight: bold;
}
.flex-container {
  display: flex;
}
.flex-picture-container{
  flex:1;
}
.flex-item-container{
  flex:1;
  font-size: 8px;
}
.flex-picture-checkout{
  flex:1;
  margin-right: 40px;
}
.flex-item-container ul li{
  font-size: 12px;
  padding-top:10px;
}
#renew_isbn{
  display: none;
}
.renewVisible{
  display:none;
}
.flex-item-container{
  font-size: 13px;
}
.surgestRecord{
  max-width: 200px;
}
.setError{
  color:red;
  margin-left: 95px;


}
</style>
</head>
<body>

  <div class="header">
  <h1 class="inHeader">Patron</h1>

</div>
<i id="icon"class="fa fa-bars" onclick="myIcon()"></i>
<div id="navbar"class="bg-light">
  <a class="logout" href="search_resources.php">Logout</a>
<nav class="navbar navbar-expand-sm">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link navbar-light" href="patron_profile.php">Patron Profile</a>
    </li>
    <li class="nav-item">
      <a class="nav-link navbar-light" href="patron_checkout.php">Checkout</a>
    </li>
    <li class="nav-item">
      <a class="nav-link navbar-light" href="update_password.php">Password Update</a>
      <li class="nav-item">
        <a id = "logout" class="nav-link navbar-light " href="search_resources.php">Logout</a>
      </li>
  </ul>
</nav>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<?php
$PassportNumber=$isbn="";
$PassportNumber  = $_SESSION['id'];
?>
<div class="container">
  <div class="row">
      <div class ="col-md-5">
        <form   action="patron_checkout_submit.php"  class="form-horizontal" method="post" onsubmit="event.preventDefault()">
          <h1>Checkout</h1>
          <span class="error">Please enter item isbn</span><br><br>
          <div class="form-group">
            <label class="control-label" for="isbn">ISBN:</label><br>
            <input type="text" autocomplete="off" placeholder="Enter isbn" name="isbn" id="isbn">
            <input type="text" placeholder="Enter passport number" hidden name="passport_number" value="<?php echo $PassportNumber ?>" id="passport_number">
            <button type="submit" id="submitBtn"class="submitbtn btn-lg" onclick= "checkout_resources()" name="submit">Submit</button>
            <ul class="list-group surgestRecord"  id="show-isbn">

            </ul>
          </div>
        </form>
      </div>

      <div class ="col-md-7">
        <ul>
          <h4>Requirement For Checkout :</h4>
          <li><span id="isbn_incorrect" class="glyphicon glyphicon-remove text-muted"> ISBN incorrect </span></li>
            <li><span id="already_borrowed" class="glyphicon glyphicon-remove text-muted"> Book already borrowed </span></li>
            <li><span id="exceed_limit"class="glyphicon glyphicon-remove text-muted"> User exceeds limit</span></li>
            <li><span  id="book_available" class="glyphicon glyphicon-remove text-muted"> Book is unavailable </span></li>
            <li><span id="due_return" class="glyphicon glyphicon-remove text-muted "> Book due return</span></li>
       </ul>
      </div>
    </div>
  </div>
<?php
resource_checkout($PassportNumber);

function resource_checkout($PassportNumber){

            require("connection.php");
            $result = mysqli_query($conn,"SELECT *
            FROM checkout ch JOIN  resources res
            ON res.isbn = ch.isbn
            JOIN patron pat
            ON pat.Passport_Number = ch.Passport_Number
            WHERE (status = 'checkout'OR status = 'reserve' OR status = 'renew') AND ch.Passport_Number='$PassportNumber'");

          if($result===false){
            echo "<p>Error: ".$sql."<br>".mysqli_error($conn)."</p>";
              exit();
          } else{
            echo '<br><br>
          <div class="container" >
            <table class="table table-striped table-responsive-sm">
                <thead class="thead-dark">
                <tr>
                  <th>ISBN</th>
                  <th>TITLE</th>
                  <th>AUTHOR</th>
                  <th>Date Borrowed</th>
                  <th>Due Date</th>
                  <th>Status</th>
                  <th colspan="2">Action</th>
              </tr>
                </thead>
                  <tbody id= "remove_resource">';

                $index = 0;
                $renexIndex =0;
                $checkinIndex= 0;
                $reserveIndex = 0;
                  while($row = mysqli_fetch_assoc($result)){

                      ?>

                         <tr class="bookData">

                           <td ><?php echo $row["isbn"];?></td>
                           <td ><?php echo $row["title"]; ?></td>
                           <td ><?php echo $row["author"]; ?></td>
                           <td ><?php echo $row["Date_borrowed"]; ?></td>
                           <td ><?php echo $row["Due_Date"]; ?></td>
                           <td class="statusData" ><?php echo $row["status"]; ?></td>
                           <td>
                        <form action="patron_checkout_submit.php" method="post" onsubmit="event. preventDefault()">
                         <?php if($row["status"]==="checkout") {
                           ?>
                            <button class="btn btn-success renewBtn" value = "<?php echo $row["isbn"];?>" onclick="renew_checkout(<?php  echo "".$renexIndex;?>,<?php  echo "".$index;?>)" type="submit" >Renew</button>
                            <hr>
                           <button class="btn btn-danger checkinBtn" type="submit"  value = "<?php echo $row["isbn"];?>" onclick="resources_checkin(<?php  echo "".$checkinIndex;?>,<?php  echo $index;?>)" >Check in</button>
                            <?php $renexIndex = $renexIndex +1;
                            $index = $index + 1;
                          $checkinIndex = $checkinIndex + 1;

                        }

                            if($row["status"]==="reserve")  {?>
                              <button class="btn btn-primary checkout" value = "<?php echo $row["isbn"].' '.$reserveIndex;?>" onclick= "checkout_reserved_resources(<?php  echo "".$reserveIndex;?>,<?php  echo "".$index;?>)">Checkout</button><hr>

                          <?php
                          $reserveIndex = $reserveIndex +1;
                          $index = $index + 1;
                      }
                       if($row["status"]==="renew")  {?>
                           <button class="btn btn-danger checkinBtn" value = "<?php echo $row["isbn"];?>" type="submit" onclick= "resources_checkin(<?php  echo "".$checkinIndex;?>,<?php  echo $index;?>)">Check in</button><hr>
                      <?php
                      $checkinIndex = $checkinIndex + 1;
                      $index = $index + 1;
                    }

                    ?>
                            </form>
                           </td>

                         </tr>
                       </tbody>
                       <?php
                    }
                     ?>
                  </table>;
                  <?php
                }
              }
          ?>
<input type="text" id = "bookvalue" hidden >
<input type="text" id = "bookincrement" hidden >


<div class="modal " id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h2 class="modal-title text-center" id="modalTitle"></h2>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="flex-container">
          <div class="flex-picture-container">
            <img height="300px" id="picture"/>
          </div>
          <div class="flex-item-container">
            <ul>
              <div style="margin-bottom: 10px;">
                <span style="font-weight: bold;display:inline;">Title: </span>
                <li id="modal-title"  style="display:inline;"></li>
                <div>
              <div style="margin-top: 10px;">
                <span style="font-weight: bold;display:inline;">Author: </span>
                <li id="modal-author"  style="display:inline;"></li>
                <div>
              <div style="margin-top: 10px;">
                 <span style="font-weight: bold;display:inline;">Publication date: </span>
                 <li id="modal-publication-date" style="display:inline;"></li>
                <div>
              <div style="margin-top: 10px;">
                <span style="font-weight: bold;display:inline;">ISBN: </span>
                <li id="modal-isbn" style="display:inline;"></li>
               <div>
              <div style="margin-top: 10px;">
                <span style="font-weight: bold;display:inline;">Date borrowed:</span>
                 <li id="modal-date-borrowed" style="display:inline;"></li>
                <div>
              <div style="margin-top: 10px;">
                <span style="font-weight: bold;display:inline;">Date returned:</span>
                <li id="modal-date-returned" style="display:inline;"></li>
               <div>
             <div style="margin-top: 10px;">
                <span style="font-weight: bold;display:inline;">Status:</span>
                <li id="modal-status" style="display:inline;"></li>
              <div>
           </ul>
          </div>
          </div>
          </div>

      <div class="modal-footer">
        <div class="flex-container">
          <div class="form-group">
            <input type="checkbox" id="emailSent">
            <label for="email"> Send Email</label><br>

          </div>
          <div class="flex-picture-checkout">
              <button type="button" class="btn btn-success" data-dismiss="modal" style="display: none;" id="checkout">Checkout</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal" style="display: none;" id="checkin">Checkin</button>
              <button type="button" class="btn btn-primary renewCheckout" data-dismiss="modal" style="display: none;"id="renewCheckout">Renew Checkout</button>
              <button type="button" class="btn btn-primary checkoutReserve"data-dismiss="modal" style="display: none;"id="checkoutReserve">Checkout Reserve</button>
          </div>
        </div>
      </div>
     </div>
  </div>
</div>
</div>
<script src="checkout_renew_checkin_reseve.js?newversion">

</script>
</body>
</html>
