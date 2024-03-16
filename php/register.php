<?php

$patientName = $_POST['patientName'];
$age  = $_POST['age'];
$Gender  = $_POST['Gender'];
$address = $_POST['address'];
$phoneNumber = $_POST['phoneNumber'];
$email = $_POST['email'];
$disease = $_POST['disease'];
$diseaseSpan = $_POST['diseaseSpan'];


if (!empty($patientName) || !empty($age) || !empty($Gender) || !empty($address) || !empty($phoneNumber) || !empty($email) || !empty($disease) || !empty($diseaseSpan) )
{

$server = "localhost";
$username = "root";
$password = "";
$database = "register";



// Create connection
$conn = new mysqli ($server, $username, $password, $database);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
  $SELECT = "SELECT email From reg Where email = ? Limit 1";
  $INSERT = "INSERT Into reg ( patientName, age, Gender, address, phoneNumber, email, disease ,  diseaseSpan)values(?,?,?,?,?,?,?,?)";

//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

    

     //checking username
      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssssssss", $patientName,$age,$Gender,$address,$phoneNumber,$email,$disease,$diseaseSpan);
      $stmt->execute();
      header("Location: success_page.php");
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}

?>