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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>

.topNavBar{
  background-color: #063970;
  height: 70px;
}
.topNavBar .container img{
  width: 60px;
  min-height: 81px;
  float:left;
  padding-bottom: 10px;
}

html,body{
  padding: 0px;
  margin: 0px;
  height: 100%;
  overflow-x: hidden;
}
.navBarAfter{
  background-color: #323232;
  height: 69px;
  width: 100%;
  position: relative;
}
header .navBarAfter #menuBar{
  display: none;
}
.navBarAfter ul li{
  float:left;
  list-style-type: none;
  padding-left: 10px;
  padding-right: 10px;
  padding-top: 20px;
  padding-bottom: 24px;
}

.navBarAfter.container {
  border: 1px solid black;
  height: inherit;
}
.navBarAfter ul li:last-child{
  float:right;
  list-style-type: none;
}
.navBarAfter ul li:not(:last-child):hover{
  background-color: #CC0066;
}
.navBarAfter ul li:not(:last-child) a:hover{
  color:#fff;
}
.navBarAfter ul li:last-child a:hover:hover{
  color: #CC0066;
}
.navBarAfter ul li:last-child a span{
  color:#fff;
  padding-right: 10px;
}
.navBarAfter ul li a{
  color: #fff;
  text-align: center;
  font-size: 18px;
  text-decoration: none;
}

@media only screen and (max-width: 995px) {
  .navBarAfter ul li:not(:last-child){
    display: none;
}
header .navBarAfter #menuBar{
    display: block;
    font-size: 30px;
    color: white;
    position: absolute;
    left: 20px;
    top: 20px;
  }
  header .navBarAfter #menuBar:hover{
    color:  blue;
  }

header.navBarAfter.openNavbar .container{position: relative;}
header.navBarAfter.openNavbar .container #menuBar {
     position: absolute;
     right: 0;
     top: 0;
   }
   .navBarAfter.openNavbar .container li a {
     float: none;
     display: block;
     text-align: left;
   }
}

@media screen and (max-width: 420px){
  .footer{
   font-size: 8px;
  }
}

.footerItem{
  color: white;
  text-decoration: none;
}
.footer .row.col-md-6.footer .list-group a:hover {
  text-decoration: none;
  color:red;
}

.webYear{
  color:white;
  margin-right: 10px;
}
h1{
  font-family:clearType ;
  margin-top: 40px;
  margin-bottom: 50px;
}

.footer{
  background-color: #063970;
  height: 70px;
  width: 100%;
  border:1px solid blue;
  padding-top: 15px;
  margin-top: 170px;
}
.moveUpPage{
  position: fixed;
  right:30px;
  bottom: 80px;
  color: red;
  font-size: 50px;
  cursor: pointer;
}
#row:nth-child(odd) {background-color: #e5e3e2;}
#row img{
  height: 300px;
  width: 230px;
  float:right;
  border-radius: 5px;
}
#row:hover{
  background-color: #f2f2f2;
}
#row{
  padding-top: 25px;
  padding-bottom: 25px;
}
* {
  box-sizing: border-box;
}
.content{
  margin-top:100px;
}
.search-content {
  display: flex;
 margin-top: 30px;
 justify-content: center;
}
.searchBtn{
  max-width: 30%;
  padding-left: 10px;
  padding-right: 10px;
  font-size: 15px;
  height: 40px;
  width:100px;
  border:1px solid #ccc;
  border-radius: 5px;
  font-weight: bold;
}

.searchTxt{
  display: inline-block;
  min-width:40%;
  padding-left: 10px;
  padding-top:10px;
  padding-bottom: 10px;
  height: 40px;
  border:1px solid #ccc;
  outline: 1px solid pink;
  margin-right: 5px;
  margin-left: 5px;
}
.searchDropdown{
  min-width:40%;
  padding-left: 10px;
  padding-top:10px;
  padding-bottom: 10px;
  height: 40px;
  border: none;
}
.flexPatronDetailsRow {
  display: flex;
  flex-direction: row;
}
.flexPatronDetailsColumn{
  display: flex;
  flex-direction: column;
}
.flexPatronDetailsColumn .flexPatronDetailsRow b,p{
  padding-left: 5px;
}
@media only screen and (max-width: 575px) {
  #row .sectionTwo{
    float:left;
  }
}
.flexPatronDetailsColumn .flexPatronDetailsRow button:last-child{
  margin-left: 30px;
}
.flexPatronDetailsColumn .flexPatronDetailsRow button{
  width: 30%;
  height: 40px;
  font-weight: bold;
  font-size: 14px;
  margin-top: 10px;
  border-radius: 5px;
}
.dropdown-menu li:hover{
  background-color:LightGray;
  cursor: pointer;
}
@media screen and (max-width: 775px){
  .userIdentification .identification label{

    line-height: 13px;
  }
  .userIdentification .expireDate label{
    line-height: 13px;
    }
  }
}


</style>
</head>
<body>

<header>
  <div class="topNavBar">
    <div class="container">
      <img src="image/enugu_logo.jpg" alt="Enugu State Library Logo" >
    </div>
    </div>
  <div  class="navBarAfter" id="navBarAfter">
    <div class="container">
        <i id="menuBar" class="glyphicon glyphicon-menu-hamburger" onclick="openAndCloseNavBar()"></i>
    <ul>
      <li>
        <a  href="librarian_profile.php">Profile</a>
      </li>
      <li>
        <a  href="add_patron.php">Register Patron</a>
      </li>
      <li>
        <a href="add_librarian.php">Add Librarian</a>
      </li>
      <li>
       <a href="check_in.php">Check in</a>
     </li>
     <li>
       <a href="librarian_checkout.php">Checkout</a>
     </li>
     <li>
       <a href="manage_catalogue.php">Manage Catalogue</a>
     </li>
     <li>
       <a  class="onColorChange" href="librarian_login.php" ><span  id="onColorChange" class="glyphicon glyphicon-log-out"></span>Logout</a>
     </li>
   </ul>
 </div>
  </div>
 </header>
 <div class="container">
     <form action="/action_page.php">
       <div class ="search-content">
      <div class="dropdown">
        <button type="button"  class="btn searchDropdown bg-light dropdown-toggle" data-toggle="dropdown">  Search By </button>
         <ul class="dropdown-menu list-group">
            <li class="dropdown-item list-group-item" onclick="searchPatron()" id="patronName" href="#">Patron Name</li>
            <li class="dropdown-item list-group-item" onclick="searchPatron()" id="patronNumber" href="#">Patron Number</li>
            <li class="dropdown-item list-group-item" onclick="searchPatron()" id="identityNumber" href="#">Identity Number</li>
            <li class="dropdown-item list-group-item" onclick="searchPatron()" id="phoneNumber" href="#">Phone Number</li>
            <li class="dropdown-item list-group-item" onclick="searchPatron()" id="email" href="#">Email</li>
            <li class="dropdown-item list-group-item" onclick="searchPatron()" id="dob" href="#">DOB</li>
         </ul>
       </div>
         <input type="text"  autocomplete="off" class="searchTxt" placeholder="Search any patron" id="search">
         <button type="submit" class="btn-primary searchBtn">Submit</button>
       </div>
     </form>
     <div class="content">
       <?php
       $login=$ID="";
       if(isset($_POST['search'])){
         $search = test_input($_POST['searchtxt']);
         $selectType = test_input($_POST['patron_info']);
         switch($selectType){
           case "name":
               $sql = "SELECT * from patron where Patron_Name LIKE '%$search%' ";
               $result = mysqli_query($conn ,$sql);
               display($result);
           break;
           case "passport":
               $sql = "SELECT * from patron where Passport_Number LIKE '%$search%' ";
               $result = mysqli_query($conn ,$sql);
               display($result);
           break;
           case "gender":
               $sql = "SELECT * from patron where gender LIKE '%$search%' ";
               $result = mysqli_query($conn ,$sql);
               display($result);
           break;
           case "city":
               $sql = "SELECT * from patron where city LIKE '%$search%' ";
               $result = mysqli_query($conn ,$sql);
               display($result);
           break;
           case "address":
               $sql = "SELECT * from patron where address LIKE '%$search%' ";
               $result = mysqli_query($conn ,$sql);
               display($result);
           break;
           case "dob":
               $sql = "SELECT * from patron where dob LIKE '%$search%' ";
               $result = mysqli_query($conn ,$sql);
               display($result);
           break;
           case "state":
               $sql = "SELECT * from patron where state LIKE '%$search%' ";
               $result = mysqli_query($conn ,$sql);
               display($result);
           break;
           case "phone":
               $sql = "SELECT * from patron where phone_number LIKE '%$search%' ";
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
           echo '
         <div class="flexPatronDetailsColumn">
           <div class="flexPatronDetailsRow">
             <b>Patron name:</b>
             <p>'.$row["Patron_Name"].'</p>
           </div>
           <div class="flexPatronDetailsRow">
               <b>Passport Number:</b>
               <p>'.$row["Passport_Number"].'</p>
            </div>
            <div class="flexPatronDetailsRow">
                <b>Phone Number:</b>
                <p>'.$row["phone_number"].'</p>
             </div>
             <div class="flexPatronDetailsRow">
                 <b>Address:</b>
                 <p>'.$row["address"].'</p>
             </div>
             <div class="flexPatronDetailsRow">
                 <b>Email:</b>
                 <p>'.$row["email"].'</p>
             </div>
             <div class="flexPatronDetailsRow">
                 <b>City:</b>
                 <p>'.$row["city"].'</p>
             </div>
             <div class="flexPatronDetailsRow">
                 <b>State:</b>
                 <p>'.$row["state"].'</p>
             </div>
             <div class="flexPatronDetailsRow">
                 <b>DOB:</b>
                 <p>'.$row["dob"].'</p>
             </div>
             <div class="flexPatronDetailsRow">
                <button id = "updatePatron" class="btn-primary" name="update" onclick('.$row["Passport_Number"].')>Update</button>
                <button id = "deletePateon" class="btn-danger" name ="delete" onclick('.$row["Passport_Number"].') >Delete</button>
             </div>
           </div>
       ';
         $image = $row['identity_file'];
         $image_src = "upload_patron/".$image;


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

         $sql = "SELECT * FROM `patron` WHERE 1;";
         $result = mysqli_query($conn, $sql);

         while ($row = mysqli_fetch_assoc($result)) {

  echo '
     <div class="row" id="row">
      <div class="col-sm-6 sectionOne">
       <div class="flexPatronDetailsColumn">
         <div class="flexPatronDetailsRow">
           <b>Patron name:</b>
           <p>'.$row["first_Name"].'</p>
           <p>' .$row["last_name"].'</p>
         </div>
         <div class="flexPatronDetailsRow">
             <b>Identity Number:</b>
             <p>'.$row["Identity_number"].'</p>
          </div>
          <div class="flexPatronDetailsRow">
              <b>Phone Number:</b>
              <p>'.$row["phone_number"].'</p>
           </div>
           <div class="flexPatronDetailsRow">
               <b>Address:</b>
               <p>'.$row["address"].'</p>
           </div>
           <div class="flexPatronDetailsRow">
               <b>Email:</b>
               <p>'.$row["email"].'</p>
           </div>
           <div class="flexPatronDetailsRow">
               <b>City:</b>
               <p>'.$row["city"].'</p>
           </div>
           <div class="flexPatronDetailsRow">
               <b>State:</b>
               <p>'.$row["state"].'</p>
           </div>
           <div class="flexPatronDetailsRow">
               <b>DOB:</b>
               <p>'.$row["dob"].'</p>
           </div>
           <div class="flexPatronDetailsRow">
              <button id = "updatePatron" class="btn-primary" name="update" onclick('.$row["patron_Number"].')>Update</button>
              <button id = "deletePateon" class="btn-danger" name ="delete" onclick('.$row["patron_Number"].') >Delete</button>
           </div>
         </div>
       </div>';
       ?>
       <div class="col-sm-6 sectionTwo">
         <?php
         $image = $row["identity_file"];
         $image_src = "upload_patron/".$image;
         ?>
         <img src="<?php echo $image_src.""; ?>" alt="patron picture" >
       </div>
      </div>
     <?php

         }

         if(isset($_GET['ID'])){
           extract($_GET);
           $ID = $_GET['ID'];
           $sql = "SELECT * FROM patron WHERE 	Passport_Number = '$ID'";
            $result = $conn->query($sql) or die($conn->error);
           $row = $result->fetch_assoc();
             $filename = "patron_archives/".$row['Patron_Name']."_".$row['Passport_Number'];
             $file = $row['Patron_Name']."_".$row['Passport_Number'];
             if(file_exists($file)){
               header("Location:view_patron.php?exist=fileAlreadyExist");
             exist();
             } else {
               $fp = fopen($filename,"w");
               fwrite($fp ,"Passport Number:");
               fwrite($fp ,$row['Passport_Number'].PHP_EOL);
               fwrite($fp ,"Patron_Name:");
               fwrite($fp ,$row['Patron_Name'].PHP_EOL);
               fwrite($fp ,"Password:");
               fwrite($fp ,$row['PASSWORD'].PHP_EOL);
               fwrite($fp ,"Gender:");
               fwrite($fp ,$row['gender'].PHP_EOL);
               fwrite($fp ,"Phone Number:");
               fwrite($fp ,$row['phone_number'].PHP_EOL);
               fwrite($fp ,"Address:");
               fwrite($fp ,$row['address'].PHP_EOL);
               fwrite($fp ,"Email:");
               fwrite($fp ,$row['email'].PHP_EOL);
               fwrite($fp ,"City:");
               fwrite($fp ,$row['city'].PHP_EOL);
               fwrite($fp ,"State:");
               fwrite($fp ,$row['state'].PHP_EOL);
               fwrite($fp ,"DOB:");
               fwrite($fp ,$row['dob'].PHP_EOL);
               fwrite($fp ,"Name:");
               fwrite($fp ,$row['name'].PHP_EOL);
               fwrite($fp ,"Image:");
               fwrite($fp ,$row['image'].PHP_EOL);
               fclose($fp);

               $sql = " DELETE from patron where Passport_Number = ?";
               $stmt = mysqli_stmt_init( $conn);
               if (!mysqli_stmt_prepare($stmt, $sql)){
                 echo'<p>sql error</p>';
                 //$error = 'sql error';
                 exit();
               } else {
                 //$hashedpwd = password_hash( $passsword, PASSWORD_DEFAULT);
                 mysqli_stmt_bind_param ($stmt ,"s",  $ID);
                 mysqli_stmt_execute($stmt);
                 mysqli_stmt_free_result ($stmt);
                 echo'<p style="color:red">successfully deleted</p>';
                 //$error = $ID.' successfully deleted';
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
   </div>

<div class ="footer">
  <div class="container">
  <div class="row">
      <div class ="col-md-8">
        <span class="webYear"> &copy <span id="todate" ></span> Enugu State Library |</span>
          <a class="footerItem" href="#">Contact Us</a>
          <span class="webYear">|</span>
          <a class="footerItem" href="#">About Us</a>
          <span class="webYear">|</span>
          <a class="footerItem" href="#">Terms and conditions</a>
  </div>
  <div class ="col-md-4">
      <i class="fa fa-arrow-up moveUpPage" onclick="moveUpPage()"></i>
</div>
</div>
</div>
</div>
</body>
</html>
<script>
document.getElementById("patronName").addEventListener("click", function() {
  xhttp.open("POST", "submit_view_patron.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  let search = document.getElementById().value;
  xhttp.send("patronName="+"patronName");
  xhttp.onreadystatechange = function() {
  if(this.readyState === 4 && this.status === 200){
       let response = JSON.parse(this.responseText);
     }
   }
 });
</script>
