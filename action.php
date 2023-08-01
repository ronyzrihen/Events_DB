<?php

include "db.php";
include "config.php";


if (!empty($_POST['incomeWeeks'])) {

    $query5 = "SELECT SUM(total_price) total_income FROM team_13_orders WHERE o_date BETWEEN date_sub(NOW(),INTERVAL 7 MONTH) AND NOW();";
    $Res = mysqli_query($connection, $query5);
    if (!$Res) {
        die("Query Failed (query_delivery)");
    }else{
        $income = mysqli_fetch_assoc($Res);
    }

}
////////////////////////////////////////////////////////////////////////////////
if (isset($_GET['returningCustomer'])) {

    $query4 = "SELECT c_id, f_name, l_name, count(*) o_num FROM team_13_customer INNER JOIN team_13_orders using(c_id) group by c_id having count(*) > 1;";
    $Res = mysqli_query($connection, $query4);
    if (!$Res) {
        die("Query Failed (query_delivery)");
    }
}
////////////////////////////////////////////////////////////////////////////////
if (isset($_GET['requiredStaff'])) {

    $query3 = "SELECT o_id, DAY(o_date) o_day, MONTH(o_date) o_month,YEAR(o_date) o_year, c_id , f_name, l_name, guest_num ,FLOOR(guest_num / 10) w_req ,w_count,FLOOR(guest_num / 20) c_req, c_count,n_count  FROM team_13_orders INNER JOIN team_13_customer using(c_id) LEFT JOIN (SELECT o_id, j_id ,count(*) w_count FROM team_13_order_worker LEFT JOIN team_13_worker_job using(w_id) group by o_id,j_id having j_id = 3 ) as waiters using(o_id)
LEFT JOIN (SELECT o_id, j_id, count(*) c_count FROM team_13_order_worker LEFT JOIN team_13_worker_job using(w_id) group by o_id,j_id having j_id = 2) cooks using (o_id) 
LEFT JOIN (SELECT o_id, j_id ,count(*) n_count FROM team_13_orders  LEFT JOIN team_13_order_worker using(o_id) LEFT JOIN team_13_worker_job using(w_id) group by o_id having n_count = 1 ) as nulls using (o_id)
group by o_id having w_count < guest_num / 10 or c_count < guest_num / 20  or n_count =1;";
    $Res = mysqli_query($connection, $query3);
    if (!$Res) {
        die("Query Failed (query_delivery)");
    }
}
////////////////////////////////////////////////////////////////////////////////
if (isset($_GET['activeEvent'])) {
    $query2 = "SELECT o_date, o_id ,c_id , f_name, l_name, guest_num, meal_price, min_price, total_price FROM team_13_orders INNER JOIN team_13_customer USING(c_id) WHERE o_date >= NOW();";
    $Res = mysqli_query($connection, $query2);
    if (!$Res) {
        die("Query Failed (query_delivery)");
    }
}
////////////////////////////////////////////////////////////////////////////////
if (!empty($_POST['numOfWeeks'])) {

    $query1 = "select o_date, o_id, c_id , f_name, l_name, guest_num, meal_price, min_price, total_price from team_13_orders inner join team_13_customer c using(c_id) where o_date between date_sub(now(),INTERVAL " . $_POST['numOfWeeks'] . " WEEK) and now();";
    $Res = mysqli_query($connection, $query1);
    if (!$Res) {
        die("Query Failed (query_delivery)");
    }

}
////////////////////////////////////////////////////////////////////////////////
if (!empty($_POST['insert_order'])) {

    $customer = "SELECT * FROM team_13_customer where c_id =" . $_POST['id'] . ";";
    $Res = mysqli_query($connection, $customer);
    if (!mysqli_num_rows($Res)) {
        $newCustomer = "INSERT INTO team_13_customer (c_id,f_name, l_name, street, apt_no, city, phone_number)
   VALUES ('" . $_POST['id'] . "','" . $_POST['FName'] . "','" . $_POST['LName'] . "','" . $_POST['street'] . "','" . $_POST['aptNo'] . "','" . $_POST['City'] . "','" . $_POST['cell'] . "');";
        $Res = mysqli_query($connection, $newCustomer);
        if (!$Res) {
            die("Query Failed (function)");
        }
    }

    $newOrder = "CALL new_order('" . $_POST['Date'] . "', " . $_POST['id'] . "," . $_POST['guests'] . "," . $_POST['MinPrice'] . "," . $_POST['MealPrice'] . "," . $_POST['event'] . ");";
    $Res = mysqli_query($connection, $newOrder);
    if (!$Res) {
        die("Query Failed (function)");
    }

}
////////////////////////////////////////////////////////////////////////////////



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Nunito" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
      
        <?php
        if (!empty($_POST['incomeWeeks'])) {
        echo "<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css'><link rel='stylesheet' href='./style.css'>";
        }
        ?>
    <title>Document</title>
</head>

<body>

    <?php



if (!empty($_POST['incomeWeeks'])) {
    

    echo "<h1 class='text-center m-4 mt-5 text-secondary'>Total Income The Past ".$_POST['incomeWeeks']." Weeks</h1>";
    echo"
    
    <div class = 'container p-5 bg-light border  border-success mt-5 rounded-4 bg-body-tertiary shadow'>
    
        <h1 class='fs-1 text-center text-success '>".$income['total_income']." ₪</h1>

    </div>";
        

    }

    //////////////////////////////////////////////////////////////////////////////////////
    if (isset($_GET['returningCustomer'])) {


        echo "<h1 class='text-center m-4 text-secondary'>Returning Customers</h1>";
        echo "
        <table class='table table-striped table-dark table-hover container text-center'>
        <thead>
        
        <tr>
        <td>Customer ID</td>
        <td>Customer Name</td>
        <td>Number Of Orders</td>
        </tr>
        </thead>
        <tbody>
        ";
        while ($row = mysqli_fetch_assoc($Res)) {

            echo "
            <tr>
            
            <td>" . $row['c_id'] . "</td>
            <td>" . $row['f_name'] . " " . $row['l_name'] . "</td>
            <td>" . $row['o_num'] . "</td>";
            echo "</tr>";
        }
        echo "
        </tbody>
        </table>";


    }
    //////////////////////////////////////////////////////////////////////////////////////
    if (isset($_GET['requiredStaff'])) {


        echo "<h1 class='text-center m-4 text-secondary'>Required Staff</h1>";
        echo "
        <table class='table table-striped table-dark table-hover container text-center'>
        <thead>
        
        <tr>
        <td>Order ID</td>
        <td>Event Date</td>
        <td>Customer ID</td>
        <td>Customer Name</td>
        <td>Guest Number</td>
        <td>Waiters</td>
        <td>Cooks</td>
        </tr>
        </thead>
        <tbody>
        ";
        while ($row = mysqli_fetch_assoc($Res)) {

            echo "
            <tr>
            <td>" . $row['o_id'] . "</td>
            <td>" . $row['o_day'] . "/" . $row['o_month'] . "/" . $row['o_year'] . "</td>
            <td>" . $row['c_id'] . "</td>
            <td>" . $row['f_name'] . " " . $row['l_name'] . "</td>
            <td>" . $row['guest_num'] . "</td>
            <td>";
            if (!$row['w_count']) {
                echo "0 / " . $row['w_req'] . "</td>";
            } else {
                echo $row['w_count'] . " / " . $row['w_req'] . "</td>";
            }
            echo "<td>";
            if (!$row['c_count']) {
                echo "0 / " . $row['c_req'] . "</td>";
            } else {
                echo $row['c_count'] . " / " . $row['c_req'] . "</td>";
            }
            echo "</tr>";
        }
        echo "
        </tbody>
        </table>";
    }
    //////////////////////////////////////////////////////////////////////////////////////
    if (!empty($_POST['numOfWeeks']) || !empty($_GET['activeEvent'])) {

        echo "<h1 class='text-center m-4 text-secondary'>";
        if (!empty($_POST['numOfWeeks'])) {
            echo " Events From The Past " . $_POST['numOfWeeks'] . " Weeks </h1>";
        }
        if (!empty($_GET['activeEvent'])) {
            echo " Active Events </h1>";
        }
        echo "
    <table class='table table-striped table-dark table-hover container text-center'>
    <thead>
    
    <tr>
    <td>Order ID</td>
    <td>Event Date</td>
    <td>Customer ID</td>
    <td>Customer Name</td>
    <td>Guest Number</td>
    <td>Meal Price</td>
    <td>Min Price</td>
    <td>Total Price</td>
    </tr>
    </thead>
    <tbody>
    ";
        while ($row = mysqli_fetch_assoc($Res)) {
            echo "
            <tr>
            <td>" . $row['o_id'] . "</td>
            <td>" . $row['o_date'] . "</td>
            <td>" . $row['c_id'] . "</td>
            <td>" . $row['f_name'] . " " . $row['l_name'] . "</td>
            <td>" . $row['guest_num'] . "</td>
            <td>" . $row['meal_price'] . "</td>
            <td>" . $row['min_price'] . "</td>
            <td>" . $row['total_price'] . "</td>
        </tr>
";
        }
        echo "
    </tbody>
    </table>";
    }
    if (!empty($_POST['incomeWeeks'])) {
     echo "<script src='https://cdn.jsdelivr.net/npm/tsparticles-confetti@2.11.0/tsparticles.confetti.bundle.min.js'></script><script  src='./script.js'></script>";
    }
   ?>
</body>

</html>
