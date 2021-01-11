<?php
include "header.php";
?>
<?php 
if(isset($_POST["confirm"])){
$accountN=$_POST["accountNumber"];
$remaining_balance=$_POST["remaining_balance"];
$sql_purchase_process="update bank_info set amount=".$remaining_balance." WHERE bankAccount=".$accountN.";";
$sq_execute_purchase=mysqli_query($con,$sql_purchase_process);
echo "<h2>purchase is made<br/> delivery will be made to your house anytime now.</h2>";
}
else if(!isset($_SESSION["uid"])){
    echo "<h1> sorry you canot make a purchase. pleas register as a user</h1>";
}
else{
$product_id=$_POST["product_id"];
$userID=$_SESSION["uid"];
echo "this is the buying page <br>";
$accountNumber=$_SESSION["Account_number"];
echo "user id is ".$_SESSION["uid"]."<br/>";
echo "product id is ".$product_id."<br/>";
echo "user account number is ".$_SESSION["Account_number"]."<br/>";
$sql_getAmount="select amount from bank_info where bankAccount=".$accountNumber.";";
$make_query_banck_amount=mysqli_query($con,$sql_getAmount);
$get_banck_row=mysqli_fetch_row($make_query_banck_amount);

$amount=$get_banck_row[0];
echo "user banck amount is  ".$amount."<br/>";
$sql_getAmount="select product_price from products where product_id=".$product_id.";";
$sql_get_price=mysqli_query($con,$sql_getAmount);
$price_row=mysqli_fetch_array($sql_get_price);

$product_price=$price_row[0];
echo "price of the product is".$product_price."<br/>";

$remaining_balance=$amount-$product_price;
echo "remaining balace after purchase is".$remaining_balance."<br/>";
if($remaining_balance<0)
 {
    echo "<h1> sorry you canot make a purchase. you have less balance you your account<br/> pleas do recharge</h1>";
 }
 else {
     echo "<form action='#' method='post'>
     <input type='submit' name='confirm' value='confirm to buy this item'>
     <input type='hidden' name='remaining_balance' value=".$remaining_balance.">
     <input type='hidden' name='accountNumber' value=".$accountNumber.">
 </form>
 ";
 }
}
?>
<?php
include "newslettter.php";
include "footer.php";
?>