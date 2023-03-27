<?php
session_start();
include("db.php");
$pagename="smart basket"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
    include ("headfile.html"); //include header layout file 
    include ("detectlogin.php");
    echo "<h4>".$pagename."</h4>"; //display name of the page on the web page
     //if the value of the product id to be deleted (which was posted through the hidden field) is set
    if (isset($_POST['del_prodid']))
    {
        //capture the posted product id and assign it to a local variable $delprodid
        $delprodid=$_POST['del_prodid'];

      //  console.log($_SESSION['basket'][$delprodid])
        //unset the cell of the session for this posted product id variable
        unset ($_SESSION['basket'][$delprodid]);
        //display a "1 item removed from the basket" message
        echo "<p>1 item removed";
    }


    if (isset($_POST['h_prodid']))
    {
        $newprodid = $_POST["h_prodid"];
        $reququantity = $_POST["p_quantitity"];

        //create new session in the basket session array.
        $_SESSION["basket"][$newprodid] = $reququantity;

        echo "<p><b>1 item added";


    }else{
        echo "<p><b>Basket unchanged ";
    }

    $total = 0;

    echo "<table id='baskettable'>";
        echo "<tr>";
        echo "<th>Product Name</th><th>Price</th><th>Quantity</th><th>Subtotal</th><th>Remove Product</th>";

        echo "</tr>";
         

        if (isset($_SESSION['basket']))
        {
            foreach($_SESSION['basket'] as $index => $value)
            {
                $SQL="select prodId, prodName, prodPrice from Product where prodId=".$index;
                $exeSQL=mysqli_query($conn, $SQL) or die (mysql_error());
                $arrayp=mysqli_fetch_array($exeSQL);
                echo "<tr>";
                    echo "<td>".$arrayp['prodName']."</td>";
                    echo "<td>&pound".number_format($arrayp['prodPrice'],2)."</td>";
                    echo "<td style='text-align:center;'>".$value."</td>";
                    $subtotal=$arrayp['prodPrice'] * $value;
                    echo "<td>&pound".number_format($subtotal,2)."</td>";
                    $total=$total+$subtotal;

                    echo "<form action=basket.php method=post>";
                        echo "<td>";
                            echo "<input type=submit value='Remove' id='submitbtn'>";
                        echo "</td>";
                       echo "<input type=hidden name=del_prodid value=".$arrayp['prodId'].">";
                    echo "</form>";

                echo "</tr>";

            }
        }else{
            echo "<p>Empty basket";
        }

        echo "<tr>";
            echo "<td colspan=4>TOTAL</td>";
            echo "<td>&pound".number_format($total,2)."</td>";
        echo "</tr>";
             
    echo "</table>";
    echo "<br><p><a href='clearbasket.php'>CLEAR BASKET</a></p>";

    if (isset($_SESSION['userid'])) 
    {
        echo "<br><p><a href=checkout.php>CHECKOUT</a></p>";
    }else{
        echo "<br><p>New homteq customers: <a href='signup.php'>Sign up</a></p>";
        echo "<p>Returning homteq customers: <a href='login.php'>Login</a></p>";
    }  
    
    include("footfile.html"); //include head layout
echo "</body>";
?>

     
