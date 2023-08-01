
<?php

include "db.php";
include "config.php";

$staffQuery = "SELECT w_id , f_name, l_name, j_name FROM team_13_worker INNER JOIN team_13_worker_job USING(w_id) INNER JOIN team_13_job USING(j_id) WHERE j_id != 1  ORDER BY j_id;";
$staffRes = mysqli_query($connection, $staffQuery);
if (!$staffRes) {
    die("Query Failed (query_delivery)");
}
$orderQuery = "SELECT o_id, f_name, e_type, DAY(o_date), MONTH(o_date), YEAR(o_date) FROM team_13_orders INNER JOIN team_13_order_event USING(o_id) INNER JOIN team_13_event USING(e_id) INNER JOIN team_13_customer USING(c_id) WHERE o_date >= NOW() ORDER BY o_date ;";
$orderRes = mysqli_query($connection, $orderQuery);
if (!$orderRes) {
    die("Query Failed (query_delivery)");
}
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
    <title>Document</title>
</head>

<body>

    <section class="d-flex ">


        <section class="container ">
            <h1 class='fs-1 text-center'>Queries</h1>
            <section class="container col-6">
                <div class="list-group ">

                    <a href="new_event.php" class="list-group-item list-group-item-action">New Event</a>
                    <button type="button" class="list-group-item list-group-item-action" data-bs-toggle="modal"
                        data-bs-target="#recentEvents">Recent Events</button>
                    <a href="action.php?activeEvent=1" class="list-group-item list-group-item-action">Active Events</a>
                    <a href="action.php?requiredStaff=1" class="list-group-item list-group-item-action">Required
                        Staff</a>
                    <a href="action.php?returningCustomer=1" class="list-group-item list-group-item-action">Returning
                        Customers</a>
                        <button type="button" class="list-group-item list-group-item-action" data-bs-toggle="modal"
                            data-bs-target="#recentIncome">Recent Income</button>
                            
                            
                        </div>
                    </section>
                </section>
                <section>
                    
                    <h1 class='fs-1 text-center'>Procedures</h1>
                    <div class="list-group ">
                        
                        <button type="button" class="list-group-item list-group-item-action" data-bs-toggle="modal"
                            data-bs-target="#assignStaff">Recent Income</button>
            </div>
        </section>

    </section>

    <div class="modal fade" id="assignStaff" tabindex="-1" aria-labelledby="assignStaffLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="action.php" method="POST" class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="assignStaffLabel">Recent Income</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <select name="worker" class="form-select" required>
                    <?php while ($staffRow = mysqli_fetch_assoc($staffRes)) {
                        echo "<option value='" . $staffRow["w_id"] . "'>" . $staffRow['f_name'] . " " . $staffRow['l_name'] ." - ". $staffRow['j_name'] ."</option>";
                    }
                    ?>
                </select>
                <select name="Pevent" class="form-select" required>
                    <?php while ($orderRow = mysqli_fetch_assoc($orderRes)) {
                        echo "<option value='" . $orderRow["o_id"] . "'>" . $orderRow['f_name'] . "'s " . $orderRow['e_type'] ." - ". $orderRow['DAY(o_date)'] ."/". $orderRow['MONTH(o_date)'] ."/". $orderRow['YEAR(o_date)'] ."</option>";
                    }
                    ?>
                </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Retrive Data</button>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="recentIncome" tabindex="-1" aria-labelledby="recentIncomLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="action.php" method="POST" class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="recentIncomLabel">Recent Income</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group">
                        <input type="number" name="incomeWeeks" class="form-control m-3" placeholder="Number Of Weeks"
                            aria-label="Input group example " aria-describedby="incomeWeeks " min=0 required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Retrive Data</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="recentEvents" tabindex="-1" aria-labelledby="recentEventsLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="action.php" method="POST" class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="recentEventsLabel">Recent Events</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group">
                        <input type="number" name="numOfWeeks" class="form-control m-3" placeholder="Number Of Weeks"
                            aria-label="Input group example " aria-describedby="numOfWeeks " min=0 required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Retrive Data</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
