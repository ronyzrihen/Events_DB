<?php

include "db.php";
include "config.php";

if(!empty($_POST['insert_order'])){

$customer = "SELECT * FROM team_13_customer where c_id =".$_POST['id'].";";
$Res = mysqli_query($connection, $customer);

if(!mysqli_num_rows($Res)){
   $newCustomer = "INSERT INTO team_13_customer (c_id,f_name, l_name, street, apt_no, city, phone_number)
   VALUES ('".$_POST['id']."','".$_POST['FName']."','".$_POST['LName']."','".$_POST['street']."','".$_POST['aptNo']."','".$_POST['City']."','".$_POST['cell']."');";
echo $newCustomer;


}

$newOrder = "INSERT INTO team_13_orders (o_date, c_id ,guest_num, min_price, meal_price) VALUES(".$_POST['Date'].", ".$_POST['id'].",".$_POST['guests'].",".$_POST['MinPrice'].",".$_POST['MealPrice'].");";
//$Res = mysqli_query($connection,$newOrder);
//if(!$Res){
//    die("Query Failed (function)");
//}

}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
