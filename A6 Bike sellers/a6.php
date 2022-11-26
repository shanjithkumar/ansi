<?php


$email  = $_POST['email'];
$psw = $_POST['psw'];
$pswrpt = $_POST['pswrpt'];




if (!empty($email) || !empty($psw) || !empty($pswrpt) )
{

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "a6sellers";



// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
  $SELECT = "SELECT email From signup Where email = ? Limit 1";
  $INSERT = "INSERT Into signup (email ,psw, pswrpt )values(?,?,?)";

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
      $stmt->bind_param("sss", $email,$psw,$pswrpt);
      $stmt->execute();
      echo "New record inserted sucessfully";
      $stmt->close();
     $conn->close();
     header("Location:home.html");
     exit();
     } else {
      // echo "Someone already register using this email";
      require("footer.php");
     }

    }
} else {
 echo "All field are required";
 die();
}
?>