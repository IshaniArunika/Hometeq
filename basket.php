<?php
session_start();
include("db.php");
$pagename="smart basket"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
    include ("headfile.html"); //include header layout file 
    
    echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

    if (isset($_POST['h_prodid'])) {
       
        $newprodid = $_POST["h_prodid"];
        $reququantity = $_POST["p_quantitity"];

        // $_SESSION["prodId"] = $newprodid;
        // $_SESSION["p_quantitity"] = $reququantity;
        // echo "ID of seltected product: ".$newprodid."<br>";
        // echo "Quantity of seltected product: " .$reququantity;
        
    
        $_SESSION['basket'][$newprodid]=$reququantity;
        echo "<p><b>1 item added";
    } else {
        echo "Basket unchanged";
    }

    $total =0;

    echo "<p><table id='baskettable'>";

        echo "<tr>";
            echo "<th>Product name</th> <th>Price</th> <th>Quantity</th> <th>Subtotal</th><th>Remove Product</th>";
        echo "</tr>";
        
        if(isset($_SESSION['basket'])){
            foreach($_SESSION['basket'] as $index => $value ){
                $SQL = "SELECT prodId, prodName, prodPrice FROM Product WHERE prodId =". $index;
                $exeSQL = mysqli_query($conn, $SQL) or die(mysqli_error( $conn));
                $arrayp = mysqli_fetch_array($exeSQL);

                echo "<tr>";
                    echo "<td>".$arrayp['prodName']."</td>";
                    echo "<td>&pound".number_format($arrayp['prodPrice'],2)."</td>";
                    echo "<td style ='text-align:center;'>".$value."</td>";
                    $subtotal = $arrayp['prodPrice']*$value;
                    echo "<td>&pound".number_format($subtotal ,2)."</td>";
                    echo "<form action=basket.php method=post>";
                        echo "<td> ";
                            echo "<input type=submit name='submitbtn' value='Remove' id='submitbtn'>";
                        echo"</td>";
                        echo "<input type=hidden name=del_prodid value=".$prodinbasketarray['prodId'].">";
                    echo "</form>";
                echo "</tr>";

                $total=$total+$subtotal;

                
            }
        }else {
            echo "<p>Empty basket";
        }

        echo "<tr>";
            echo "<td colspan=4><b>TOTAL</td>";

            echo "<td><b>&pound".number_format($total ,2)."</td>";
        echo "<tr>";

    echo"</table>";
    echo "<br><p><a href='clearbasket.php'>CLEAR BASKET</a></p>" ; 
    echo "<br><p>New hometeq customers:<a href='signup.php'>Sing Up</a></p>" ; 
    echo "<br><p>Returning hometeq customers:<a href='login.php'>Log In</a></p>" ;   
    include("footfile.html"); //include head layout
echo "</body>";
?>

     
