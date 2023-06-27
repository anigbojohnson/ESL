<?php
session_start();
$servername = "localhost";
$username = "GP5";
$password = "12345";
$dbname = "gp5";
$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error){
  die("connection faild". $conn->connect_error);
}
require_once'vendor/autoload.php';
//use PhpOffice\Phpspreedsheet\Spreadsheet;
//use PhpOffice\phpSpreadsheet\Writer\Xlsx;

  ?>
