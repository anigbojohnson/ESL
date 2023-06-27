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
  <meta charset="UTF-8">
  <title>Main Admin</title>
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
input[type=text],input[type=Date],input[type=password],textarea,select,input[type=file]{
  height: 35px;
  padding: 0px 20px;
  background-color:white;
  border: 1px solid #ccc;
  border-radius: 4px;
  outline: 1px solid pink;
}

#onColorChange:hover{
  color: #CC0066;
}
@media only screen and (max-width: 575px) {
  #row .sectionOne{
    float:right;
    clear: left;
  }
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

  .btn{
    max-width: 100%;
    padding-left: 10px;
    padding-right: 10px;
    font-size: 10px;
    border:1px solid #ccc;
  }

}
.error{
  color:red;
  font-size: 25px;
}
.footerItem{
  color: white;
  text-decoration: none;
}
.footer .row.col-md-6.footer .list-group a:hover {
  text-decoration: none;
  color:red;
}
.noRegisterLogin{
  margin-top: 20px;
  background-color: #e5e3e2;
  padding-top: 10px;
  padding-bottom: 15px;
  padding-left: 15px;

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
.loginLink{
  color:red;
}
.mandatory{
  background-color: #e5e3e2;
  padding-top: 10px;
  padding-bottom: 10px;
  text-align: center;
  font-weight: bold;
  margin-bottom: 50px;
}

* {
  box-sizing: border-box;
}

#content{
  min-height: 100%;
}
.firstAndLastName{
  position: relative;
  max-width: 90%;
  height: 90px;
}
.firstAndLastName .firstNameCol{
  display: block;
  width: 45%;
  position: absolute;
  height: 90px;
  top:0px;
  left:0px;
  bottom: 0px;
}
.firstAndLastName .lastNameCol{
  display: block;
  width: 45%;
  position: absolute;
  top:0px;
  right:0px;
  bottom: 0px;
  height: 90px;
}
.firstAndLastName .lastNameCol input[type=text]{
   width:100%;
   position: absolute;
   bottom:0px;
   right:0px;
}
.firstAndLastName .lastNameCol label{
   max-width:100%;
   position: absolute;
   top:10px;
   left:0px;
}

.firstAndLastName .firstNameCol #firstName{
   width:100%;
   position: absolute;
   bottom:0;
   right:0;
}

.firstAndLastName .firstNameCol label{
   max-width:100%;
   position: absolute;
   top:10px;
   left:0px;
}

.userIdentification{
  display: none;
  position: relative;
  max-width: 90%;
  height: 90px;
  margin-top: 30px;

}
.captureRow{
  position: relative;
  max-width: 90%;
  height: 70px;
  margin-left: 0px;
}
.captureRow .captureImage{
  position: absolute;
  width: 30%;
  top: 0;
  left: 0;
}
.captureRow .captureImage img{
  position: absolute;
  width: 100%;
  top: 40px;
  left: 0;
}
.captureRow .refreshCapture{
  position: absolute;
  width: 30%;
  top: 0;
  left: 30%;
}
.captureRow .refreshCapture a{
  position: absolute;
  width: 100%;
  top: 40px;
  left: 20px;
}
.captureRow .captchaAnswer{
  position: absolute;
  width: 30%;
  height: 80px;
  top: 0;
  right: 0;
}
.captureRow .captchaAnswer label{
  position: absolute;
  width: 100%;
  top: 0;
  right: 0;
}
.captureRow .captchaAnswer input[type=text]{
  position: absolute;
  width: 100%;
  top: 40px;
  right: 0;
}
.userIdentification .identification {
  display: inline-block;
  width: 45%;
  position: absolute;
  height: 90px;
  top:0px;
  left:0px;
  bottom: 0px;
}
.userIdentification .identification input[type=text]{
  width:100%;
  position: absolute;
  top:40px;
  right:0;
}
.userIdentification .identification label{
  max-width:100%;
  position: absolute;
  top:0;
  left:0;
}
.userIdentification .expireDate{
  width: 45%;
  position: absolute;
  top:0px;
  right:0px;
  bottom: 0px;
  height: 90px;
}
.userIdentification .expireDate label{
  max-width: 100%;
  position: absolute;
  top:0px;
  left:0px;
}
.userIdentification .expireDate #passportExpireDate{
  width: 100%;
  position: absolute;
  top:40px;
  right:0px;
}


.uploadFile{
  max-width: 90%;
  height: 95px;
  position: relative;
}

.uploadFile label{
  position: absolute;
  top:0;
  left:0;
  max-width: 100%;
}
.uploadFile input[type=file]{
  position: absolute;
  top:40px;
  left:0;
  max-width: 100%;
}

#content .row .sectionTwo{
  padding-left: 20px;

  background-color: #e5e3e2;
  padding-bottom: 30px;
}

#content .row .sectionOne{

  background-color: #e5e3e2;
  padding-left: 20px;
  padding-bottom: 20px;
}
@media screen and (max-width: 775px){
  .userIdentification .identification label{

    line-height: 13px;
  }
  .userIdentification .expireDate label{
    line-height: 13px;
  }

}
.passr{
  padding-right: 20px;
  margin-bottom: 25px;

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
  <div class="container" id="content">
    <form autocomplete="off" action="submit_patron_registration.php" method="post" enctype="multipart/form-data">

    <h1>Register</h1>
<div class="mandatory"> The field with<span class="error"> * </span>is mandatory</div>
    <div class="row" id="row" >
        <div class ="col-md-6 col-sm-6" >
          <div class="sectionOne">
          <div class="firstAndLastName">
            <div class="firstNameCol">
                <label for="firstName"><b>First Name</b><span class="error">*</span></label>
                <input type="text" autocomplete="off"  placeholder="First Name" name="firstName" id="firstName" tabindex = 1 >
            </div>
            <div class="lastNameCol">
                <label for="lastName"><b>Last Name</b><span class="error">*</span></label>
                <input  type="text"  autocomplete="off" placeholder="Last Name" name="lastName" id="lastName" tabindex = 2>
          </div>
        </div><br><br>

        <div class="row passr">
          <div class=" col-6 passportIdentity">
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input " id="passport" name="number" value="internationalPassport" onclick=" displayIdAndExpireDate(0)">
                <label class="custom-control-label" for="passport">International Passport</label><br>
            </div>
          </div>
          <div class="col-6  voterCardIdentity">
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input" id="voterCard" name="number" value="voterCard" onclick=" displayIdAndExpireDate(3)">
                <label class="custom-control-label" for="voterCard">Voter Card</label><br>
            </div>
          </div>
          <div class=" col-6 nationalIdentity">
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" class="custom-control-input" id="nationalId" name="number" value="nationalId" onclick=" displayIdAndExpireDate(1)">
              <label class="custom-control-label" for="nationalId">National ID</label><br>
          </div>
        </div>
        <div class="col-6 driversLicence">
          <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" class="custom-control-input" id="driversLicence" name="number" value="driversLicence" onclick=" displayIdAndExpireDate(2)">
              <label class="custom-control-label" for="driversLicence">Driver Licence</label>
            </div>
          </div>
        </div>

    <div class="userIdentification">
     <div class="identification">
        <label for="passportNumber"><b>Passport Number.</b><span class="error">*</span></label><br>
        <input type="text"  autocomplete="off" placeholder="Passport Number"  name="passportNumber" id ="passportNumber" maxlength="10" tabindex = 3>
      </div>

   <div class="identification">
      <label for="documentNumber"><b>Document Number.</b><span class="error">*</span></label><br>
      <input type="text"  autocomplete="off"  placeholder="Document Number"  name="documentNumber" onkeypress="formatNationalId()" id ="documentNumber" maxlength="19" tabindex = 3>
    </div>

    <div class="identification">
      <label for="driverLicenceNumber"><b>Licence Number.</b><span class="error">*</span></label>
      <input type="text"  autocomplete="off"  placeholder="Driver Licence Number"  name="driverLicenceNumber" id ="driverLicenceNumber" maxlength="10" tabindex = 3>
    </div>

    <div class="identification">
      <label for="voterIdentityNumber"><b>Voter Number.</b><span class="error">*</span></label><br>
      <input type="text" autocomplete="off"  placeholder="Document Number"  name="voterIdentityNumber" id ="voterIdentityNumber" maxlength="10" tabindex = 3>
    </div>

    <div class="expireDate">
      <label for="passportExpireDate"><b>Expiration Date</b><span class="error">*</span></label><br>
      <input type="Date" autocomplete="off"   <?php echo "max="?>"<?php
  $year = date("Y");
  $month = date("m")-6;
  $day = date("d");
  echo $year."-".$month."-".$day;
  ?>"placeholder="Passport Expire Date"  name="identityExpireDate" id ="passportExpireDate">
  </div>
</div>
   <div class="uploadFile">
     <label for="file"><b>please upload identity file</b><span class="error">*</span></label><br>
     <input type="file" style="min-width: 100%;" autocomplete="off" id="file"  name="file"  ><br><br>
   </div>

     <label for="password"><b>Password</b><span class="error">*</span></label><br>
     <input type="password" style="min-width: 90%;"autocomplete="off" id="password"  placeholder="Password" name="password"  tabindex = 5  >   <br><br>

    <label for="confirmPassword"><b>Confirm Password</b><span class="error">*</span></label><br>
      <input type="password" style="min-width: 90%;"autocomplete="off" id="confirmPassword"  placeholder="Confirm Password" name="passwordConfirm"  tabindex = 5>
     <br><br>


    <label for="phoneNumber"><b>Phone Number</b><span class="error">*</span></label><br>
    <input type="text" class="input-phone" autocomplete="off" style="min-width: 90%;" placeholder="Phone Number" id="phoneNumber" name="phoneNumber" tabindex = 7   maxlength="11" >
    <br><br>

    <label for="emailAddress"><b>Email Address</b><span class="error">*</span></label><br>
   <input type="text" autocomplete="off" style="min-width: 90%;" id="emailAddress" placeholder="Email Address" name="email"  tabindex = 8 >
    <br><br>

    <label for="confirmEmail"><b>Confirm Email Address</b><span class="error">*</span></label><br>
   <input type="text" autocomplete="off" style="min-width: 90%;" id="confirmEmail" placeholder="Confirm Email Address" name="confirmEmail"  tabindex = 8>
    <br><br>

 </div>
</div>

    <div class ="col-md-6 col-sm-6 "  >
      <div class="sectionTwo">
        <label for="address"><b>Address</b><span class="error">*</span></label><br>
        <textarea  name="address" style="min-width: 90%;"id="address" autocomplete="off"  tabindex = 9 maxlength="70" minlength="5">
        </textarea><br><br>

        <label for="gender"><b>Gender</b><span class="error">*</span></label><br>
        <select id="gender" style="min-width: 90%;" name="gender" id="gender" tabindex = 6   >
          <option value="select">select an option</option><option value="Male">Male</option><option value="Female">Female</option>
        </select><br><br>

    <label for="state"><b>State</b><span class="error">*</span></label><br>
    <select id="state"   style="min-width: 90%;" name="state" id="state"tabindex = 10  onchange="populate('state','city')" >
        <option value="Abia">Abia</option><option value="Adamawa">Adamawa</option><option value="Akwa Ibom">Akwa Ibom</option><option value="Anambra">Anambra</option><option value="Bauchi">Bauchi</option>
        <option value="Bayelsa">Bayelsa</option><option value="Benue">Benue</option><option value="Borno">Borno</option><option value="Cross River">Cross River</option><option value="Delta">Delta</option>
        <option value="Ebonyi">Ebonyi</option><option value="Enugu">Enugu</option><option value="Edo">Edo</option><option value="Ekiti">Ekiti</option><option value="Gombe">Gombe</option>
        <option value="Imo">Imo</option><option value="Jigawa">Jigawa</option><option value="Kaduna">Kaduna</option><option value="Kano">Kano</option><option value="Katsina">Katsina</option>
        <option value="Kebbi">Kebbi</option><option value="Kogi">Kogi</option><option value="Kwara">Kwara</option><option value="Lagos">Lagos</option><option value="Nasarawa">Nasarawa</option>
        <option value="Niger">Niger</option><option value="Ogun">Ogun</option><option value="Ondo">Ondo</option><option value="Osun">Osun</option><option value="Oyo">Oyo</option>
        <option value="Plateau">Plateau</option><option value="Rivers">Rivers</option><option value="Sokoto">Sokoto</option><option value="Taraba">Taraba</option><option value="Yobe">Yobe</option><option value="Zamfara">Zamfara</option>
    </select><br><br>

    <label for="city"><b>City</b><span class="error">*</span></label><br>
    <select id="city" type="text" style="min-width: 90%;" name="city"  id="city" style="width:80%;" tabindex = 11 >
    </select><br><br>

    <label for="dob"><b>Date Of Birth</b><span class="error">*</span></label><br>
    <input id ="dob" type="Date" style="  min-width: 90%;" autocomplete="off" id="dob" <?php echo "max="?>"<?php
$year = date("Y")-18;
$month = date("m");
$day = date("d");
echo $year."-".$month."-".$day;
?>" placeholder="date of birth" name="dob" tabindex = 12 ><br><br>

    <label for="securityQuestion"><b>Security Questions</b><span class="error">*</span></label><br>
    <select   style="min-width: 90%;" name="securityQuestion" id="securityQuestion"  tabindex = 13  required onchange="populate('state','city')" >
      <option value="questionOne">What is your maiden name?</option><option value="questionTwo">Your favourite world leader?</option>
      <option value="questionThree">Your favourite color?</option><option value="questionFour">The best footballer the world? </option>
      <option value="questionFive">The brand of your smartphone?</option><option value="questionSix">What is your nickname?</option>
      <option value="questionSeven">The name of your best friend?</option></select><br><br>

    <label for="securityAnswer"><b>Security Answer</b><span class="error">*</span></label><br>
    <input type="text" autocomplete="off" style="min-width: 90%;" placeholder="Security Answer" name="securityAnswer" id="securityAnswer" tabindex = 14 ><br><br>


    <div class="row captureRow">
        <div class="col-sm-4 captureImage">
            <img src="capture_value.php"  name="captureImage" alt ="capture image"tabindex = 15  id="captureImage">
        </div>
        <div class="col-sm-4 refreshCapture">
          <a href="capture_value.php" class="glyphicon glyphicon-refresh" data-toggle="tooltip" title="Refresh capcha"> Refresh capcha</a>
        </div>
        <div class="col-sm-4 captchaAnswer">
          <label for="captchaAnswer"><b>Captcha Answer</b><span class="error">*</span></label><br>
          <input type="text" autocomplete="off"  id="captchaAnswer" placeholder="Captcha Answer"   name="captchaAnswer"  tabindex = 16 >
        </div>
  </div><br><br>
    <button type="submit"  class="btn btn-primary"   tabindex = 16 name ="register">Register</button>
  </form>
 </div>
    <div class="noRegisterLogin"> If you have registered, please login <a href="" class="loginLink"> here</a></div> </div>
    </div>
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
<script src="register_patron.js?newversion">
</script>
