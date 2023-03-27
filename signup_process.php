<?php
session_start();
include("db.php");
$pagename="Sign Up Results"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file 
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page



$fname = $_POST['fname'];
$lname =  $_POST['lname'];
$address=  $_POST['Address'];
$postCode=  $_POST['PostCode'];
$telno=  $_POST['TelNo'];
$email= $_POST['Email'];
$password1=  $_POST['pass1'];
$password2 =  $_POST['pass2'];

if($password1 == $password2){
    $SQL = "INSERT INTO users( userFName, userSName, userAddress, userPostCode, userTelNo, userEmail, userPassword)
VALUES ('$fname','$lname ','$address','$postCode','$telno','$email','$password1' )";
    if (mysqli_query($conn, $SQL)) {
        echo "<h3>data stored in a database successfully."
            . " Please browse your localhost php my admin"
            . " to view the updated data</h3>";
    } else {
        echo "ERROR: Hush! Sorry $SQL. "
            . mysqli_error($conn);
}
// Close connection
mysqli_close($conn);
}else{
    echo "Password not match ";
}




include("footfile.html"); //include head layout
echo "</body>";

// echo"<script>";
// function clearForm() {
//     var form = document.querySelector('form'); // get the form element
//     var inputs = form.querySelectorAll('input'); // get all the input elements in the form
//     for (var i = 0; i < inputs.length; i++) {
//       inputs[i].value = ''; // reset the value of each input to an empty string
//     }
//   }
// echo"</script>";
?>
