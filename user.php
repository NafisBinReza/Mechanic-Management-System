<?php

include 'database.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>SignUp</title>
</head>

<body>

    <?php
    if (isset($_POST['submit'])) {

        $client_name     = $_POST['client_name'];
        $client_address  = $_POST['client_address'];
        $client_phone    = $_POST['client_phone'];
        $client_license  = $_POST['client_license'];
        $client_engine   = $_POST['client_engine'];
        $client_appDate  = $_POST['client_appDate'];
        $client_choice   = $_POST['client_choice'];

        //Date Selection Query
        $date_query = "SELECT client_appDate FROM userpanel WHERE client_name = '$client_name'";

        $response = mysqli_query($connect, $date_query);

        $row = mysqli_fetch_assoc($response);

        $date_check = $row['client_appDate'];

        //Date Checking
        if ($date_check == $client_appDate) {
            echo "Booked appointment on same date, choose other day.";
        } else {

            //mechanic car servicing status checking query
            $mechanic_query = "SELECT servicing_cars FROM mechanic WHERE mechanic_id = '$client_choice'";

            $status = mysqli_query($connect, $mechanic_query);

            $row = mysqli_fetch_assoc($status);

            $free_check = $row['servicing_cars'];

            //servicing check query
            if ($free_check <= "4") {

                //inserting data to table
                $query = "INSERT INTO userpanel (client_id, client_name, client_address, client_phone, client_license, client_engine, client_appDate, client_choice) VALUES ('', '$client_name', '$client_address', '$client_phone', '$client_license', '$client_engine', '$client_appDate', '$client_choice')";

                $msg = mysqli_query($connect, $query);
                if (!$msg) {
                    die("Query Failed" . mysqli_error($connect));
                } else {
                    echo "Successfully Appoinment created";
                }

                $free_check++;

                //updating mechanic table
                $update_query = "UPDATE `mechanic` SET `servicing_cars`='$free_check' WHERE `mechanic_id` = '$client_choice'";
                $up_check = mysqli_query($connect, $update_query);
            } else {
                echo "Mechanic Booked, select another mechanic";
            }
        }
    }

    ?>

    <form action="" method="POST">
        <div class="form-group">
            <label>Name</label>
            <input name="client_name" type="text" autocomplete="off" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Address</label>
            <input name="client_address" type="text" autocomplete="off" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Phone Numer</label>
            <input name="client_phone" type="text" autocomplete="off" class="form-control" required>
        </div>

        <div class="form-group">
            <label>License Number</label>
            <input name="client_license" class="form-control" autocomplete="off" type="text">
        </div>
        <div class="form-group">
            <label>Engine Number</label>
            <input name="client_engine" class="form-control" autocomplete="off" type="text">
        </div>
        <div class="form-group">
            <label>Date</label>
            <input name="client_appDate" class="form-control" autocomplete="off" type="date">
        </div>
        <div class="form-group">
            <label>mechanic</label>
            <input name="client_choice" class="form-control" autocomplete="off" type="text" placeholder="ADS, SKT, FCB, RMA, ARS">
        </div>
        <div class="form-group">
            <input name="submit" type="submit" class="btn btn-primary" value="Submit">
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>

</html>