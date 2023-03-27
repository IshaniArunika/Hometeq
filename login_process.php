<?php
session_start();
include("db.php"); // import diffrent php file
$pagename="Your Login Results"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file 
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page
$email =$_POST['log_email'];
$password= $_POST['log_password'];
                                                                                                        // echo just link with the html code
                                                                                                        // $-get s g v capture valuer pased by url using the get ;method
if (empty($email) or empty($password)) {
    echo "<p><b>Login failed!</b>";  
    echo "<br>login form incomplete";
    echo "<br>Make sure you provide all the required details</p>";
    echo "<br><p> Go back to <a href=login.php>login</a></p>";
}else{
    $SQL = "SELECT * From Users Where userEmail ='".$email."'";
    $exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error($conn));
    $nbrecs = mysqli_num_rows($exeSQL); // numberr of retrive rows
    
    
    if($nbrecs == 0){
    
        echo "Login Unsucssesful!";
        echo "Your Email nor recognized";
        echo "<p>Go Back To : <a href='signup.php'>Sign up</a></p>";
    }else
    {$userarray = mysqli_fetch_array($exeSQL);
        if($password <> $userarray['userPassword']){
            echo "Password not recognised, login again";
            echo "<p>Go Back To : <a href='signup.php'>Sign up</a></p>";
        }else{
            echo "Succsesfully login";
             $_SESSION['userid'] = $userarray['userId']  ;
             $_SESSION['usertype'] = $userarray['userType']   ;
             $_SESSION['fname'] = $userarray['userFName']   ;
             $_SESSION['sname'] = $userarray['userSName']   ;
            echo "<p>Welcome, ". $_SESSION['fname']." ".$_SESSION['sname']."</p>"; //display welcome greeting

            
            if ($_SESSION['usertype']=='C') //if user type is C, they are a customer
            { 
            echo "<p>User Type: homteq Customer</p>";
            }
            if ($_SESSION['usertype']=='A') //if user type is A, they are an admin
            { 
            echo "<p>User type: homteq Administrator</p>";
            }
            
            echo "<br><p>Continue shopping for <a href=index.php>Home Tech</a>";
            echo "<br>View your <a href=basket.php>Smart Basket</a></p>";

        }

    }
         
    

}

include("footfile.html");  
echo "</body>";
?>
