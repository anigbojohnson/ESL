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
<title>ENUGU STATE LIBRARY</title>
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
    <a  href="librarian_profile.php">Profile</a>
	<a  href="add_patron.php">Register Patron</a>
  <a  style="background: #ddd; color: black;" href="add_librarian.php">Add Librarian</a>
  <a href="check_in.php">Check in</a>
  <a href="librarian_checkout.php">Checkout</a>
  <a href="manage_catalogue.php">Manage Catalogue</a>
  <a style="float: right;" href="librarian_login.php">Logout</a>

</div>

<div class="adds">

	<?php
$lnameErr = $imagesEr= $librarianNumberErr = $passwordErr = $passwordConfirmErr = $genderErr =$phoneNumberErr = $addressErr = $emailErr = $dobErr =$cityErr= $stateErr=$librarianTypesErr ="";
$lname = $librarianNumber = $passsword = $passwordConfirm = $gender = $phoneNumber = $address = $email = $city = $dob = $state =$images= $librarianTypesErr=$filename = $image= $target_dir ="";
 ?>
<div class="studList" style="overflow-x:auto;">
  <form autocomplete="off" action="<?php
    echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype = "multipart/form-data">
  <div>
    <span class="error">* <?php echo $librarianNumberErr ; ?></span><br>
    <input type="text"  style =" float:left ;width: 30%;padding: 12px 20px;margin: 8px 0;display: inline-block;border: 1px solid #ccc;border-radius: 4px;  box-sizing: border-box;" placeholder="Enter Passport number" name="Passport" required value="<?php echo $librarianNumber; ?>">
    <button type="submit" style=" width: 20%;background-color: #4CAF50; color: white; padding: 14px 20px; margin: 8px 0; border: none; border-radius: 4px;cursor: pointer;" name ="restore" >Restore Delete</button>
  </div>
</form>
</div>
<hr>
<?php
if(isset($_POST["Passport"])){

   $librarianNumber= test_input($_POST["Passport"]);
    $librarianNumber = $librarianNumber.'.txt';
   $folder = "librarian_archives";
  if($handle = opendir($folder)){
     while(false !== ($entry = readdir( $handle ))){
       if($entry!='.'&& $entry!='..'){
         $posone = strpos($entry, '_')+1;
         $id = substr($entry,$posone);
         $pos = strpos($entry, '_');
         $name = substr($entry,0,$pos);
    //    echo 'the passport id is '. $PassportNumber;
      //// echo 'the id is '.$id;
    //   $PassportNumber = $PassportNumber;
      //  echo 'the name is '.$name."/n";
      //  echo 'the file is '.$entry."/n";
         if(strcmp($librarianNumber,$id)===0){
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
if(isset($_POST['upload']) && !(isset($_SESSION['librarianidother']) )){

	if (empty($_POST["lname"])) {
    $lnameErr = "librarian Name is required";
    $OK =false;
  } else {
    $lname = test_input($_POST["lname"]);

    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$lname)) {
      $lnameErr = "Only letters and white space allowed";
      $OK = false;
    }
  }

   if (empty($_POST["password"])) {
    $passwordErr = "password is required";
    $OK = false;
  } else {
    $password = test_input($_POST["password"]);
    if(!preg_match('@[A-Z]@', $password)){
      $passwordErr = "password must contain a uppercase character";
      $OK = false;
    }
    if(!preg_match('@[a-z]@', $password)){
      $passwordErr = "password must contain a lower character";
      $OK = false;
    }
   if(!preg_match('@[0-9]@', $password)){
      $passwordErr = "password must contain at least a number";
      $OK = false;
    }
    if( strlen($password) <= 8){
      $passwordErr = "password must be eight character long";
      $OK = false;
    }

  }
if (empty($_POST["passwordConfirm"])) {
    $passwordConfirmErr = "re-type password is required";
    $OK = false;
  } else {
     $passwordConfirm = test_input($_POST["passwordConfirm"]);
    if (strcmp($password ,$passwordConfirm)) {
        $passwordConfirmErr = "does not match. ";
        $OK = false;
    }
  }
  if (empty($_POST["gender"])) {
    $genderErr = "gender is required";
    $OK = false;
  } else {
    $gender = test_input($_POST["gender"]);
  }
  if (empty($_POST["phoneNumber"])) {
    $phoneNumberErr = "phone number is required";
    $OK = false;
  } else {
    $phoneNumber = test_input($_POST["phoneNumber"]);

  }
  if (empty($_POST["address"])) {
    $addressErr = "address is required";
    $OK = false;
  } else {
    $address = test_input($_POST["address"]);
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
    $OK = false;
  } else {
    $email = test_input($_POST["email"]);
    //check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
      $OK = false;
    }
  }
  if (empty($_POST["lib_type"])) {
    $librarianTypesErr = "librarian types is required";
    $OK = false;
  } else {
    $librarianTypes = test_input($_POST["lib_type"]);
  }
  if (empty($_POST["city"])) {
    $cityErr = "city is required";
    $OK = false;
  } else {
    $city = test_input($_POST["city"]);
  }
  if (empty($_POST["state"])) {
    $stateErr = "state is required";
    $OK = false;
  } else {
    $state = test_input($_POST["state"]);
  }
  if (empty($_POST["bob"])) {
    $dobErr = "dob is required";
    $OK = false;
  } else {
    $dob = test_input($_POST["dob"]);
  }
   if (empty($_POST["librarianNumber"]) && $OK==false && (!preg_match('/^ENUG[0-9]{4}$/', $librarianNumber ))) {
    $PassportNumberErr = "librarian Number is required(i.e ENUG1234)";
  }
  else {
    $librarianNumber = test_input($_POST["librarianNumber"]);
    $sql = " SELECT librarian_id FROM librarian WHERE  librarian_id = '$librarianNumber' ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $resultCheck = mysqli_num_rows($result);
    if($result==false){
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        exit();
      }
    if ($resultCheck > 0){
          $librarianNumberErr = "this ID already taken ";
          exit();
        } else {
                $filename = $_FILES['file']['name'];
                $target_dir = "upload_librarian/";
                $target_file = $target_dir.basename($_FILES["file"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $extensions_arr = array("jpg","jpeg","png","gif");
          if( in_array($imageFileType,$extensions_arr) ){
            $image_base64 = base64_encode(file_get_contents($_FILES['file']['tmp_name']) );
            $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
            $sql = "INSERT INTO librarian (librarian_id,librarian_Name,  password, Librarian_type	, email, phone_number ,  gender, address, DOB, city , state, image , name ) VALUES
             ('$librarianNumber',  '$lname', '$password' ,'$librarianTypes' , '$email' ,'$phoneNumber',  '$gender' , '$address ', '$dob ','$city ',' $state','$image','$filename')";
           $result = mysqli_query($conn, $sql);
           move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$filename);
           if($result==false){
               echo "Error: " . $sql . "<br>" . mysqli_error($conn);
               exit();
             } else{
                header("Location:view_librarian.php?add=successfully");
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
function readData($filename){

       $filename = "librarian_archives/".$filename;
       $entry = fopen($filename,"r");
       $librarianNumber = fgets($entry);
       $posone = strpos($librarianNumber, ':')+1;
       $librarianNumber = substr($librarianNumber,$posone);
       $lname = fgets($entry);
       $posone = strpos($lname, ':')+1;
       $lname= substr($lname,$posone);
       $password = fgets($entry);
       $posone = strpos($password, ':')+1;
       $password = substr($password,$posone);
       $librarianTypes = fgets($entry);
       $posone = strpos($librarianTypes, ':')+1;
       $librarianTypes = substr($librarianTypes,$posone);
       $gender = fgets($entry);
       $posone = strpos($gender, ':')+1;
       $gender = substr($gender,$posone);
       $address = fgets($entry);
       $posone = strpos($address, ':')+1;
       $address = substr($address,$posone);
       $phoneNumber = fgets($entry);
       $posone = strpos($phoneNumber, ':')+1;
       $phoneNumber = substr($phoneNumber,$posone);
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
       $image = fgets($entry);
       $posone = strpos( $image, ':')+1;
       $image = substr( $image,$posone);
       $name = fgets($entry);
       $posone = strpos( $name, ':')+1;
       $name = substr( $name,$posone);
       require_once('connection.php');
       $sql = "INSERT INTO librarian (librarian_id, librarian_name, password, Librarian_type, email, phone_number, gender, address, DOB, city, state, image, name) VALUES
       ('$librarianNumber','$lname', '$password', '$librarianTypes','$email','$phoneNumber','$gender','$address', '$dob' , '$city','$state',
         '$image','$name');";
          $quary = mysqli_query($conn, $sql);
           $quary = ($quary=== false) ? false : $quary;
       if ($quary !== false) {
        header("Location:view_librarian.php?deleteAdded=success");
           if  (unlink($filename)){
             echo "<p >the file name deleted is :</p>".$filename;
           }
         } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
      }
?>

	<form autocomplete="off" action="<?php
    echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype = "multipart/form-data">
  <div class="container">
    <h1>Add Librarian</h1>

    <label for="name"><b>librarian Name</b></label><br>
    <input type="text" placeholder="Enter your name" name="lname" tabindex = 1 required value="<?php echo $lname; ?>">
    <span class="error">* <?php echo $lnameErr; ?></span><br>

    <label for="ID"><b>Librarian Number</b></label><br>
    <input type="text" placeholder="Enter your librarian number(i.e ENUG1234)" maxlength="8" name="librarianNumber" tabindex = 2 required value="<?php echo $librarianNumber; ?>">
    <span class="error">* <?php echo $librarianNumberErr; ?></span><br>

    <label for="psw"><b>Password</b></label><br>
    <input type="password" placeholder="Enter password (i.e Sonship123)" name="password" tabindex = 3 id="pass" required value="<?php echo $passsword; ?>">
    <input type="checkbox" onclick="myFunction()">
    <span class="error">* <?php echo $passwordErr; ?></span><br>

    <label for="psw-repeat"><b>Confirm Password</b></label><br>
    <input type="password" placeholder="Confirm Password" name="passwordConfirm" id="passCon" tabindex = 4 required value="<?php echo $passwordConfirm; ?>">
    <input type="checkbox" onclick="myFunctionCon()">
    <span class="error">* <?php echo $passwordConfirmErr; ?></span><br>

    <b>Gender</b>
    <label class="container">Male
    <input type="radio"  name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male" checked >
    <span class="checkmark"></span>
    </label>

    <label class="container">Female
    <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">
    <span class="checkmark"></span>
    </label><br><br>

    <label for="phNo"><b>Phone Number</b></label><br>
    <input type="tel" placeholder="Enter phone number(i.e 09012121212)" name="phoneNumber" tabindex = 5 required  maxlength="11" value="<?php echo $phoneNumber; ?>">
    <span class="error">* <?php echo $phoneNumberErr;?> </span><br>

    <label for="address"><b>Address</b></label><br>
    <textarea  name="address"  tabindex = 6 rows="4" cols="50"  required value= " <?php echo $address; ?>">
    </textarea>
    <span class="error">* <?php echo $addressErr; ?></span><br>
    <br>

    <label for="email"><b>Email</b></label><br>
    <input type="text" placeholder="Enter Email(i.e anigboj@yaoo.com)" name="email"  tabindex = 7 required value="<?php echo $email; ?>">
    <span class="error">* <?php echo $emailErr; ?></span><br>

    <label for="state"><b>State</b></label>
    <select id="state" type="text" name="state" tabindex = 8 required value="<?php echo $state; ?>" onchange="populate('state','city')" >
      <option value="Abia">Abia</option><option value="Adamawa">Adamawa</option><option value="Akwa Ibom">Akwa Ibom</option><option value="Anambra">Anambra</option><option value="Bauchi">Bauchi</option>
      <option value="Bayelsa">Bayelsa</option><option value="Benue">Benue</option><option value="Borno">Borno</option><option value="Cross River">Cross River</option><option value="Delta">Delta</option>
      <option value="Ebonyi">Ebonyi</option><option value="Enugu">Enugu</option><option value="Edo">Edo</option><option value="Ekiti">Ekiti</option><option value="Gombe">Gombe</option>
      <option value="Imo">Imo</option><option value="Jigawa">Jigawa</option><option value="Kaduna">Kaduna</option><option value="Kano">Kano</option><option value="Katsina">Katsina</option>
      <option value="Kebbi">Kebbi</option><option value="Kogi">Kogi</option><option value="Kwara">Kwara</option><option value="Lagos">Lagos</option><option value="Nasarawa">Nasarawa</option>
      <option value="Niger">Niger</option><option value="Ogun">Ogun</option><option value="Ondo">Ondo</option><option value="Osun">Osun</option><option value="Oyo">Oyo</option>
      <option value="Plateau">Plateau</option><option value="Rivers">Rivers</option><option value="Sokoto">Sokoto</option><option value="Taraba">Taraba</option><option value="Yobe">Yobe</option><option value="Zamfara">Zamfara</option>
    </select><span class="error">* <?php echo $stateErr; ?></span><br><br>

    <label for="city"><b>City</b></label>
    <select id="city" type="text" name="city" tabindex = 9 required value="<?php echo $city; ?>"  >
    </select>
    <span class="error">* <?php echo $cityErr; ?></span><br><br>

    <label for="dob"><b>Date Of Birth</b></label><br>
    <input type="Date" placeholder="date of birth" name="dob" tabindex = 10
    value="<?php echo $dob; ?>">
    <span class="error">* <?php echo $dobErr; ?></span><br>
    <hr>

    <b>Librarian Types</b>
     <label class="container">Main
     <input type="radio"  name="lib_type" <?php if (isset($librarianTypes) && $librarianTypes=="main") echo "checked";?> value="main">
     <span class="checkmark"></span>
     </label>

    <label class="container">Others
    <input type="radio" name="lib_type" <?php if (isset($librarianTypes) && $librarianTypes=="others") echo "checked";?> value="others">
    <span class="checkmark"></span>
    <span class="error">* <?php echo $librarianTypesErr; ?></span><br>
    </label><br><br>

    <label for = "image"> image: </label>
     <input type='file' name='file' /><br>
    <button type="submit"  style="width:200"  tabindex = 12 class="registerbtn" name = "upload">Register</button>
  </div>

</form>

</div>
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
<script type="text/javascript">
sendLog();
function populate(state,city){
  var state = document.getElementById(state);
  var city = document.getElementById(city);
  city.innerHTML = "";
  switch(state.value){
    case "Abia":
    var lgaArray = ["|","aba | Aba","aba north l.g.a | Aba North L.G A","aba South | Aba South","arochkwuu | Arochkwuu","bende | Bende","ikwuano | Ikwuano","isiala Ngwa North | Isiala Ngwa North","isiala Ngwa South | Isiala Ngwa South","isukwuat | Isukwuat","obi Ngwa | Obi Ngwa","ohafia | Ohafia","osisioma | Osisioma","ugwunagbo | Ugwunagbo","ukwa East | Ukwa East","ukwa West | Ukwa West","umu Nneochi | Umu Nneochi",
    "umuahia | Umuahia","umuahiaNorth | Umuahia North","umuahiaSouth | UmuahiaSouth"];
    break;
    case "Adamawa":
    var lgaArray = ["|","demsa | Demsa","fufore | Fufore","ganye | Ganye","girei | Girei","gombi | Gombi","guyuk | Guyuk","hong | Hong","jada | Jada","lamurde | Lamurde","madagali | Madagali",
    "maiha | Maiha","mayo-Belwa | Mayo-Belwa","michika | Michika", "mubi North | Mubi North","mubi South | Mubi South", "numan | Numan","shelleng | Shelleng","song | Song","toungo | Toungo","yola |Yola ","jimeta | Jimeta"];
      break;
     case "Akwa Ibom":
     var lgaArray= ["|","abak | abak","Obolo | Eastern Obolo","eket | Eket","esit | Esit-Eket","essien| Essien Udim","ekpo | Etim-Ekpo","etinan | Etinan","ibeno | ibano","ibesikpo | Ibesikpo-Asutan","ibom |Ibiono-Ibom","ika | Ika","ikono|Ikono","abasi |Ikot Abasi",
                    "ekpene |Ikot Ekpene","ini| Ini","itu | Itu","mbo|Mbo","enin | Mkpat-Enin","atai | Nsit-Atai","ibom | Nsit-Ibom","ubium | Nsit-Ubium","obot|Obot-Akara","okobo | Okobo","onna | Onna","oron | Oron","oruk | Oruk Anam","ukanafun | Ukanafun","udung | Udung-Uko","uruan | Uruan(Adadia)" ,"Urue-Offong | Urue-Offong/Oruko",
                    "uyo|Uyo"];
      break;
     case "Anambra":
     var lgaArray= ["|","anambraEast | Anambra East","anambraWest | Anambra West "," ayamelum | Ayamelum "," ogbaru | Ogbaru","onitshaNorth | Onitsha North ","onitshaSouth | Onitsha South ","oyi | Oyi","awkaNorth| Awka North","awkaSouth | Awka South ","anaocha | Anaocha","dunukofia | Dunukofia","idemiliNorth | Idemili North",
                "idemiliSouth | Idemili South","njikoka | Njikoka","aguata | Aguata ","ekwusigo | Ekwusigo","ihiala | Ihiala ","nnewiNorth | Nnewi North","nnewiSouth | Nnewi South","orumbaNorth |Orumba North ","orumbaSouth| Orumba South"];
                break;
     case "Bauchi" :
    var lgaArray=[" | ", "alkaleri | Alkaleri","bauchi | Bauchi" ,"bogoro | Bogoro",  "dambam | Dambam","darazo | Darazo"," dass | Dass"," gamawa | Gamawa","ganjuwa | Ganjuwa",
             "giade | Giade","ItasGadau | Itas Gadau","jama | Jama", "katagum | Katagum", "kirfi | Kirfi","misau | Misau", "ningi | Ningi","Shira | Shira","TafawaBalewa | Tafawa Balewa","toro | Toro","warji | Warji", "zaki | Zaki "];
              break;
    case "Bayelsa":
     var lgaArray= [" | ","brass | Brass", "ekeremor | Ekeremor","kolokumaOpokuma | Kolokuma Opokuma", "nembe | Nembe", "ogbia | Ogbia","sagbama | Sagbama","southernIjaw| Southern Ijaw","yenagoa | Yenagoa"];
             break;
     case "Benue":
     var lgaArray= [" | ", "ado | Ado", "agatu | Agatu", "apa | Apa", "buruku | Buruku ", "gboko | Gboko", "guma| Guma","gwerEatWest | gwer East/West","katsina-Ala | Katsina-Ala","konshisha | Konshisha", "kwande | Kwande","logo | Logo", "makurdi | Makurdi", "obiOju | Obi Oju","ogbadibo | Ogbadibo"," ohimini | Ohimini","oju | Oju ","okpokwu | Okpokwu" ,"otukpo | Otukpo ","takar | Takar" ,"ukum | Ukum ",
              "ushongo | Ushongo" ,"vandeikya | Vandeikya"];
             break;
     case "Borno":
      var lgaArray= [" | ","abadam | Abadam", "uba | Askira Uba","bama | Bama" ,"bayo | Bayo","biu | Biu", "chibok | Chibok","damboa | Damboa" , "dikwa | Dikwa", " gubio| Gubio","Guzamala |Guzamala"," gwoza | Gwoza","hawul | Hawul","jere | Jere","Kaga | kaga","KalaBalge | Kala Balge","konduga | Konduga","Kukawa | Kukawa","KwayaKusar | Kwaya Kusar","mafa | Mafa", "magumeri | Magumeri", "maiduguri | Maiduguri" ,"marte| Marte",
      "mobbar | Mobbar" , "monguno | Monguno" , "ngala | Ngala " , "nganzai | Nganzai ","shani | Shani"];
            break;
    case "Cross River":
    var lgaArray = [" | ", "abi | Abi ", "akamkpa | Akamkpa", "akpabuyo | Akpabuyo","bekwarra | Bekwarra " , "biase | Biase","boki | Boki", "calabarMunicipal |Calabar","calabarSouth | Calabar South","etung | Etung ","ikom | Ikom","obanliku | Obanliku","obubra | Obubra","obudu | Obudu ","odukpani | Odukpani","ogoja | Ogoja","yakurr | Yakurr","yala| Yala"];
           break;
    case "Delta":
    var lgaArray = [" | ","aniochaNorth | Aniocha North" , "aniochaSouth | Aniocha South" ,"bomadi | Bomadi","burutu | Burutu","ethiopeEast| Ethiope East","ethiopeWest| Ethiope West","ikaNorthEast | Ika North East", "ikaSouth | Ika South","isokoNorth | Isoko North","isokoSouth| Isoko South","ndokwaEast | Ndokwa East","ndokwaWest | Ndokwa West","oshimiliNorth | Oshimili North",
                "oshimiliSouth | Oshimili South" , "patani | Patani","sapele | Sapele" ," udu | Udu","ughelliNorth | Ughelli North","ughelliSouth | Ughelli South" , "ukwuanipeople | Ukwuani people","uvwie | Uvwie" , "uvwie | Uvwie" , "warri | Warri" ,"warriNorth| Warri North","warriSouth | Warri South","warriSouthWest| Warri South West"];
    break;
    case "Ebonyi":
    var lgaArray = [" | ","abakaliki | Abakaliki ","afikpoNorth | Afikpo North","afikpoSouth | Afikpo South","ebonyi | Ebonyi","ezzaNorth| Ezza North","ezzaSouth| Ezza South","ikwo | Ikwo","ishielu | Ishielu", "ivo | Ivo","izzi | Izzi","ohaozara | Ohaozara","ohaukwu | Ohaukwu", "onicha | Onicha"];
     break;
     case "Enugu":
     var lgaArray = [" | ", "aninri | Aninri","awgu | Awgu","enuguEast | Enugu East","enuguNorth | Enugu North","enuguSouth | Enugu South", "ezeagu | Ezeagu","igboEtiti | Igbo Etiti","igboEzeNorth| Igbo Eze North", "igboEzeSouth | Igbo Eze South","isiUzo| Isi Uzo","nkanuEast | Nkanu East","nkanuWest| Nkanu West", "nsukka | Nsukka", "ojiRiver | Oji River","udenu | Udenu","udi | Udi","Uzo-Uwani | Uzo-Uwani"];
     break;
    case "Edo":
    var lgaArray = [" | ","akoko-Edo | Akoko-Edo","egor	| Egor","esanCentral	| Esan Central","esanNorthEast| Esan North East","esanSouthEast	| Esan South East","esanWest	| Esan West","EtsakoCentra | Etsako Centra","etsakoEast| Etsako East", "etsakoWest| Etsako West","Igueben	| Igueben","Ikpoba-Okha	| Ikpoba-Okha","oredo	| Oredo","Orhionmwon| Orhionmwon","oviaNorthEast|	Ovia North East","oviaSouthWest	| Ovia South West","owanEast	| Owan East",
    "owanWest| Owan West"	, "uhunmwonde | Uhunmwonde"];
     break;
    case "Ekiti":
     var lgaArray = [" | ","adoEkiti | Ado Ekiti" , "aramoko | Aramoko","efonAlaaye | Efon-Alaaye", "emure| Emure","idoOsi | Ido Osi","igede | Igede", "ijeroEkiti| Ijero-Ekiti","ikereEkiti | Ikere Ekiti", "ikoleEkiti| Ikole Ekiti", "ikole | Ikole","ise | Ise","Omuo | Omuo","oye | Oye" ];
    break;
case "Gombe":
var lgaArray = [" | ","akko | Akko" , "balanga | Balanga", "billiri | Billiri","dukku | Dukku", "funakaye | Funakaye", "gombe | Gombe", "kaltungo | Kaltungo", "kumo | Kumo","kwami | Kwami", "nafada | Nafada", "shongom | Shongom","yamaltuDeba | Yamaltu Deba"];
break;
case "Imo":
var lgaArray = [" | ","aboMbaise	| Abo-Mbaise","ahiazuMbaise	| Ahiazu-Mbaise","ehimeMbano	| Ehime-Mbano	","ezinihitte	| Ezinihitte","ideatoNorth|Ideato North","ideatoSouth| Ideato South",	"ihitteUboma	| Ihitte/Uboma","ikeduru | Ikeduru","isialaMbano	| Isiala-Mbano","isu | Isu","Mbaitoli	| Mbaitoli","ngorOkpala|	Ngor-Okpala","Njaba	| Njaba","nkwerre	| Nkwerre ","Nwangele	| Nwangele",
"obowo | Obowo","Oguta | Oguta", "ohajiEgbema| Ohaji/Egbema","Okigwe | Okigwe",	"orlu	| Orlu","Orsu	| Orsu","oruEast| Oru East"	,"oruWest| Oru West","owerriMunicipal|Owerri Municipal","owerriNorth	| Owerri North","owerriWest| Owerri West"	,"Unuimo | Unuimo"];
break;
case "Jigawa":
var lgaArray =[" | ", "auyo | Auyo","babura | Babura","biriniwa | Biriniwa","birninKudu | Birnin Kudu","buji | Buji", "dutse | Dutse","gagarawa | Gagarawa","garki | Garki","gumel | Gumel","guri | Guri","gwaram | Gwaram", "gwiwa | Gwiwa","hadejia | Hadejia","jahun | Jahun","kafinHausa | Kafin Hausa","kaugama | Kaugama"," kazaure | Kazaure","kiriKasama | Kiri Kasama"," kiyawa | Kiyawa","maigatari | Maigatari",
"malamMadori | Malam Madori","miga | Miga","ringim | Ringim","roni | Roni","suleTankarkar| Sule Tankarkar","taura | Taura","Yankwashi | Yankwashi" ];
break;
case "Kaduna":
var lgaArray = [" | ","birninGwari | Birnin Gwari","chikun | Chikun","giwa | Giwa","igabi | Igabi" ,"ikara | Ikara", "jaba | Jaba","jema | Jema","kachia | Kachia","kadunaNorth| Kaduna North","kadunaSouth | Kaduna South","kaduna | Kaduna","kagarko | Kagarko","kajuru | Kajuru","kaura | Kaura", "kauru | Kauru","kubau | Kubwa","kudan | Kudan"," lere | Lere","makarfi | Makarfi", " sabonGari | Sabon Gari","sanga | Sanga",
"soba | Soba","zangonKataf| Zangon Kataf", "zaria | Zaria"];
break;
case "Kano":
var lgaArray =[" | ","ajingi | Ajingi","albasu | Albasu","bagwai | Bagwai","bebeji | Bagwai","bichi | Bichi","bunkure | Bunkure","dala | Dala","dambatta | Dambatta","dawakinKudu| Dawakin Kudu","dawakinTofa| Dawakin Tofa","doguwa | Daoguwa","fagge | Fagge","gabasawa | Gabasawa","garko | Garko","garunMallam | Garun Mallam","gaya | Gaya","gezawa | Gezawa","gwale | Gwale","gwarzo | Gwarzo","kabo |  Kabo","KankMunicipal | Kano Municipal",
              "karaye | Karaye", "kibiya | Kibiya","kiru | Kiru","kumbotso | Kumbotso","kunchi | Kunchi","kura | Kura","madobi | Madobi","makoda | Makoda","minjibir | Minjibir","nasarawa | Nasarawa","rano | Rano"," riminGado | Rimin Gado","rogo | Rogo", "shanono | Shanono","sumaila | Sumaila","takai | Takai","tarauni | Tarauni","tofa | Tofa","tsanyawa | Tsanyawa","tudunWada | Tudun Wada", "ungogo | Ungogo","warawa | Warawa","wudil| Wudil"];
              break;
case "Katsina":
var lgaArray= [" | ","bakori | Bakori","batagarawa | Batagarawa","batsari | Batsari", "baure | Baure","Bindawa | Baure","charanchi | Charanchi","danMusa | Dan Musa","dandume | Dandume","danja | Danja","daura | Daura","dutsi | Dutsi","dutsinMa | Dutsin Ma","faskari| Faskari","funtua | Funtua","ingawa | Ingawa", "jibia | Jibia","kafur | Kafur","kaita | Kaita","kankara | Kankara","kankia | Kankia","katsina | Katsina",
               "kurfi | Kurfi","kusada | Kusada", "maiAdua| Mai Adua","malumfashi | Malumfashi","mani | Mani","mashi | Mashi","matazu | Matazu","musawa | Musawa","rimi | Rimi","sabuwa | Sabuwa","safana | Safana","sandamuZango| Sandamu Zango"];
               break;
case "Kebbi":
var lgaArray = [ " | ","aleiro | Aleiro","arewaDandi | Arewa Dandi","argungu | Argungu","augie | Augie","bagudo | Bagudo","birninKebbi | Birnin Kebbi","bunza | Bunza","dandi | Dandi ","fakai | Fakai","gwandu | Gwandu","jega | Jega","Kalgo | Kalgo","kokoBesse | Koko Besse",
                "maiyama | Maiyama","ngaski | Ngaski","sakaba |Sakaba","shanga | Shanga","suru | Suru","wasaguDanko| Wasagu Danko","yauri | Yauri","zuru | Zuru"];
               break;
case "Kogi":
var lgaArray = [" | ","adavi | Adavi","ajaokuta | Ajaokuta","ankpa | Ankpa","bassa | Bassa ","dekina | Dekina","ibaji | Ibaji","idah | Idah","igalamelaOdolu | Igalamela Odolu"," ijumu | Ijumu","kabbaBunu | Kabba Bunu","lokoja | Lokoja","mopaMuro | Mopa Muro","ofu | Ofu","okehi | Okehi",
"okene | Okene","olamaboro | Olamaboro","omala | Omala","yagbaEast | Yagba East","yagbaWest| Yagba West"];
break;
case "Kwara":
var lgaArray = [" | ","asa | Asa","baruten | Baruten","Edu | edu","Ekiti | ekiti","ifelodun | Ifelodun","ilorinEast | Ilorin East","ilorinSouth | Ilorin South","ilorinWest| Ilorin West","irepodun | Irepodun","isin | Isin"," kaiama | Kaiama","moro | Moro","offa | Offa","okeEro| Oke Ero","oyun | Oyun","pategi | Pategi"];
break;
case "Lagos":
var lgaArray = [" | ","alimosho | Alimosho","ajeromiIfelodun | Ajeromi Ifelodun","kosofe | Kosofe","mushin | Mushin","oshodiIsolo | Oshodi-Isolo","ojo | Ojo","ikorodu | Ikorodu","surulere | Surulere","agege | Agege","ifakoIjaiye | Ifako-Ijaiye"," somolu | Somolu"," amuwoOdofin | Amuwo Odofin"	,"lagosMainland	| Lagos Mainland",
"Ikeja | Ikeja","etiOsa | Eti-Osa","badagry	 | Badagry	","apapa | Apapa	"," lagosIsland | Lagos Island","epe | Epe","ibejuLekki | Ibeju-Lekki"];
break;
case "Nasarawa":
var lgaArray = [ " | ","Akwanga | Akwanga","doma | Doma","eggon | Eggon","karu | Karu"," keana | Keana"," keffi | Keffi","kokona | Kokona","lafia | Lafia","obi | Obi", "toto | Toto","wamba | Wamba"];
break;
case "Niger":
var lgaArray = [" | ","agaie | Agaie","agwara | Agwara","bida | Bida","borgu | Borgu","bosso | Bosso","chanchaga | Chanchaga","edati | Edati","gbako | Gbako","gurara | Gurara","katcha | Katcha","kontagora | Kontagora","lapai | Lapai","lavun | Lavun","magama | Magama","mariga | Mariga","mashegu | Mashegu"," mokwa | Mokwa"," munya | Munya",
"paikoro | Paikoro","rafi | Rafi","rijau | Rijau","shiroro | Shiroro","suleja | Suleja","tafa | Tafa","wushishi | Wushishi"];
break;
case "Ogun" :
var lgaArray = [" | ","abeokutaNorth | Abeokuta North","abeokutaSouth | Abeokuta South","adoOdoOta | Ado-Odo/Ota","ewekoro | Ewekoro ","ifo | Ifo "," ijebuEast  | Ijebu East ","ijebuNorth | Ijebu North ","IjebuNorthEast | Ijebu North East"," ijebuOde |  Ijebu Ode","ikenne | Ikenne ","imekoAfon | Imeko Afon ","ipokia | Ipokia","obafemiOwode | Obafemi Owode","Odogbolu  | Odogbolu ",
"Odeda | Odeda","ogunWaterside | Ogun Waterside","Remo North | Remo North","Sagamu | Sagamu","yewaNorth | Yewa North","Yewa South" | "Yewa South" ];
break;
case "Ondo":
var lgaArray = [" | ","ose | 0se","AkokoNorthEast | Akoko North-East","AkokoNorthWest| Akoko North-West","AkokoSouthEast | Akoko South-East","AkokoSouthWest| Akoko South-West"," akureNorth | Akure North"," akureSouth| Akure South","eseOdo | Ese Odo"," Idanre | Idanre"," Ifedore | Ifedore","igbaraoke | Igbara-oke","ilaje | Ilaje","ileOlujiOkeigbo | Ile Oluji Okeigbo","irele | Irele","TalkOka | Talk Oka"," OkaAkoko| Oka, Akoko","okitipupa | Okitipupa"," OndoEast| Ondo East",
"Ondo West | Ondo West","ose | Ose","owo | Owo"];
break;
case "Osun":
var lgaArray = [" | ","aiyedaade | Aiyedaade","aiyedire | Aiyedire","atakunmosaEast | Atakunmosa East","atakunmosaWest | Atakunmosa West","Boluwaduro | boluwaduro"," boripe | Boripe","edeNorth | Ede North","edeSouth | Ede South","egbedore | Egbedore","ejigbo | Ejigbo","ifeCentral | Ife Central","ifeEast | Ife East","ifeNorth | Ife North","ifeSouth | Ife South","ifedayo | Ifedayo",
                 "ifelodun | Ifelodun","Ila | Ila","ilesaEast | Ilesa East","ilesaWest | Ilesa West","irepodun | Irepodun","irewole | Irewole"," isokan | Isokan","iwo | Iwo","obokun | Obokun","odoOtin | Odo Otin","olaOluwa | Ola Oluwa","olorunda | Olorunda","oriade | Oriade","orolu | Orolu","osogbo | Osogbo"];
                 break;
case "Oyo":
var lgaArray = [" | ", " afijio | Afijio"," akinyele | Akinyele","atiba | Atiba","atisbo | Atisbo"," egbeda | Egbeda", "ibadanNorth| Ibadan North","ibadanNorthEast | Ibadan North-East"," ibadanNorthWest | Ibadan North-West","ibadanSouthEast | Ibadan South-East","ibadanSouthWest | Ibadan South-West","ibarapaCentral | Ibarapa Central","ibarapaEast | Ibarapa East","ibarapaNorth | Ibarapa North","ido | Ido",
"irepo | Irepo","iseyin | Iseyin","itesiwaju | Itesiwaju","iwajowa | Iwajowa", " kajola | Kajola", " lagelu | Lagelu","ogbomoshoNorth | Ogbomosho North","ogbomoshoSouth | Ogbomosho South"," ogoOluwa | Ogo Oluwa","olorunsogo | Olorunsogo","oluyole | Oluyole"," Ona Ara | Ona Ara","orelope | Orelope"," Ori Ire | OriIre"," OyoEast | Oyo East"," OyoWest | Oyo West"," sakiEast | Saki East"," sakiWest | Saki West",
"surulere | Surulere"];
break;
case "Plateau":
var lgaArray = [" | ", "BarkinLadi | BarkinLadi","Bassa | bassa","bokkos | Bokkos","josEast | Jos East"," josNorth | Jos North","josSouth | Jos South","kanam | Kanam"," kanke | Kanke"," langtangNorth | Langtang North"," langtangSouth | Langtang South"," mangu | Mangu"," mikang | Mikang",
"pankshin | Pankshin"," QuaanPan | Qua'an Pan", " Riyom | Riyom" ," shendam | Shendam", " wase | Wase"];
break;
case "Rivers":
var lgaArray = [" | ", " abuaOdual | Abua–Odual"," ahoadaEast | Ahoada East"," ahoadaWest | Ahoada West", " akukuToru | Akuku-Toru"," andoni | Andoni","asariToru | Asari-Toru"," bonny | Bonny"," degema | Degema"," eleme | Eleme"," emohua | Emohua","etche | Etche"," gokana | Gokana","ikwerre | Ikwerre","khana | Khana"," obioAkpor | Obio-Akpor"," ogbaEgbemaNdoni | Ogba–Egbema–Ndoni" ," oguBolo | Ogu–Bolo"," Okrika | Okrika",
" Omuma | Omuma"," OpoboNkoro | Opobo–Nkoro", " Oyigbo | Oyigbo", " portHarcourt | Port Harcourt","tai | Tai"];
break;
case "Sokoto":
var lgaArray = [" | ", "binji | Binji"," bodinga | Bodinga", " Dange | Dange"," gada | Gada" , " goronyo | Goronyo"," gudu | Gudu" ," gwadabawa | Gwadabawa"," Illela | Illela"," Isa | Isa "," kebbe | Kebbe"," Kware | Kware "," Rabah | Rabah ", "sabonBirni | Sabon Birni","shagari | Shagari","silame | Silame ","sokoto | Sokoto"," sokotoNorth | Sokoto North"," sokotoSouth | Sokoto South"," tambawal | Tambawal"," Tambawal | Tambawal",
"Tangaza | Tangaza","tureta | Tureta "," wamako | Wamako","wurno | Wurno ","yabo | Yabo" ];
break;
case "Taraba":
var lgaArray = [" | ", "ardoKola | Ardo Kola","bali | Bali","donga | Donga"," gashaka | Gashaka", " gassol | Gassol", "ibi | Ibi"," jalingo | Jalingo", "kurmi| Kurmi "," lau | Lau"," sardauna | Sardauna",
"takum | Takum"," ussa | Ussa", "wukari | Wukari"," yorro | Yorro", "zing | Zing"];
break;
case " Yobe":
var lgaArray = [" | ", "bade | Bade","bursari | Bursari"," damaturu | Damaturu"," fika | Fika"," fune | Fune"," geidam | Geidam"," gujba | Gujba"," gulani | Gulani"," jakusko | Jakusko"," karasuwa | Karasuwa"," machina | Machina"," nangere | Nangere",
"tarmuwa | Tarmuwa"," yunusari | Yunusari"];
break;
case "Zamfara":
var lgaArray = [" | ", "anka | Anka"," bakura | Bakura", " birninMagajiKiyaw | Birnin Magaji Kiyaw"," bukkuyum | Bukkuyum"," bungudu | Bungudu"," chafe | Chafe"," gummi | Gummi"," gusau | Gusau"," kauraNamoda | Kaura Namoda",
"Maradun | Maradun "," maru | Maru","Shinkafi | Shinkafi", " talataMafara | Talata Mafara"," zurmi | Zurmi"];
break;
              }

  for ( var option in lgaArray){
    var twins= lgaArray[option].split("|");
    var newOption = document.createElement("option");
    newOption.value = twins[0];
    newOption.innerHTML =twins[1];
    city.options.add(newOption);
  }

}
function myFunction() {
  var x = document.getElementById("pass");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }

}
function myFunctionCon(){
  var y = document.getElementById("passCon");
if (y.type === "password") {
  y.type = "text";
} else {
  y.type = "password";
}
}
</script>
</html>
