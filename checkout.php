<?php
session_start();
include("db.php");
mysqli_report(MYSQLI_REPORT_OFF);
include ("detectlogin.php");
$pagename="checkout"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file 
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

$currentdatetime = date('Y-m-d H:i:s');
$SQL = "INSERT INTO Orders (userId ,orderDateTime, orderStatus )   VALUES
( '".$_SESSION['userid']."','".$currentdatetime."', 'Placed' ) " ;

if(mysqli_query($conn,$SQL)){
    echo "Order Success";

}else{
    echo  "Order Error";
}

include("footfile.html"); //include head layout
echo "</body>";
?>
