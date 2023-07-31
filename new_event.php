<?php

include "db.php";
include "config.php";

$salesManQuery = "SELECT * FROM team_13_worker INNER JOIN team_13_worker_job USING(w_id) WHERE j_id = 1;";
$salesManRes = mysqli_query($connection, $salesManQuery);
if (!$salesManRes) {
    die("Query Failed (Display Inventory)");
}

$eventQuery = "SELECT * FROM team_13_event;";
$eventRes = mysqli_query($connection, $eventQuery);
if (!$eventRes) {
    die("Query Failed (Display Inventory)");
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

    <h1 class="text-center m-5 text-dark"> Customer Details</h1>
    <form action="action.php" method = "POST" autocomplete="on">
        <div class="mt-3 d-flex container-fluid col-6 input-group ">
            <div class="form-floating me-4 col-2 ">
                <input type="text" class="form-control required" name="FName" placeholder="First Name"><label for="FName" required>First
                    Name</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control required" name="LName" placeholder="Last Name"><label for="LName" required>Last
                    Name</label>
            </div>
        </div>

<div class = "container-fluid ">
    <div class = "col-4">
    <input type="text" class="form-control required mt-3" name="id" placeholder="Personal ID" required>
        <input type="phone" name="cell" class="form-control required col-4 mt-3 " placeholder="Phone Number" required>
    </div>
</div>

        <div class="mt-3 d-flex container-fluid input-group">
            <div class="form-floating me-4">
                <input type="text" class="form-control " name="City" placeholder="City"><label for="Name">City</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" name="street" placeholder="Street"><label
                    for="Name">Street</label>
            </div>
        </div>
        <div class="input-group">
            <input type="number" name="aptNo" class="form-control m-3" placeholder="Apartment Number"
                aria-label="Input group example " aria-describedby="aptNo" min=0>
        </div>
        </div>

        <div class="input-group d-flex row justify-content-center mb-3" id="datepicker">
            <h1 class="text-center m-5 text-dark"> Order Details</h1>

            <section class="col-4">
                <input type="date" class="form-control "  name="Date" placeholder="End date"
                    aria-label="Input group example" aria-describedby="datepicker" required>
        </div>
        </section>

        <div class="input-group container row ">
     
            <section class = "col-4">
                <label class = "ms-1 text-secondary">Event Type</label>
                <select name="event" class="form-select " aria-label=" select example" required>
                    <?php while ($eventRow = mysqli_fetch_assoc($eventRes)) {
                        echo "<option value='" . $eventRow["e_id"] . "'>" . $eventRow['e_type'] . "</option>";
                    }
                    ?>
                </select>
            </section>

            <section class = "col-4"> 
            <label class = "ms-1 text-secondary">Salesman</label>  
                <select name="Salesman" class="form-select col-4" aria-label=" select example" required>
                    <?php while ($salesManRow = mysqli_fetch_assoc($salesManRes)) {
                        echo "<option value='" . $salesManRow["w_id"] . "'>" . $salesManRow['f_name'] . " " . $salesManRow['l_name'] . "</option>";
                    }
                    ?>
            </select>
        </section>
        
        </div>

        <div class="input-group">
            <input type="number" name="guests" class="form-control m-3" placeholder="Number of guests "
                aria-label="Input group example " aria-describedby="guests " min=0 required>
             <input type="number" name="MinPrice" class="form-control m-3" placeholder="Minimum price "
                aria-label="Input group example " aria-describedby="MinPrice " min=0 required> 
            <input type="number" name="MealPrice" class="form-control m-3" placeholder="Meal price"
                aria-label="Input group example " aria-describedby="MealPrice " min=0 required>
                
        </div>
        <div class="container-fluid d-flex justify-content-center">
            <input type="hidden" name="insert_order" value= 1>
            <button type="submit" class="btn btn-primary mt-5 col-8 col-md-4 align-self-center">Place an order</button>
        </div>
    </form>
</body>

</html>
