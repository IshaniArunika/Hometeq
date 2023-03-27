<?php
session_start();
$pagename="login"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file 
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page
 
echo "<form action=login_process.php method=post>";
    echo "<table style='border: 0px'>";
        echo "<tr><td style='border: 0px'><label class=fname>Email </label></td>";
        echo "<td style='border: 0px'><input type=Email id=log_email  name=log_email  size = 30 placeholder='Enter your Email'Required></td>";
        echo "</tr>";
        echo "<tr><td style='border: 0px'><label class=fname>Password  </label></td>";
        echo "<td style='border: 0px'><input type=text id=log_password name=log_password size = 30 placeholder='Enter your Password'Required></td>";
        echo "</tr>";
        echo "<tr><input type=hidden name=cru_req value=silogingnup>";
        echo "<td style='border: 0px'><button class=but type=submit>Log In </button></td>";
        echo "<td style='border: 0px'><button class=Clear onclick=clearForm()>Clear</button></td></tr>";
    echo "</table>";
echo "</form>";

include("footfile.html"); //include head layout
echo "</body>";
?>
