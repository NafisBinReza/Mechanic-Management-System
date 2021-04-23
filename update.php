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
	if (isset($_GET['edit'])) {
		$client_id = $_GET['edit'];
		echo $client_id;
	}
	if (isset($_POST['submit'])) {

		$client_appDate  = $_POST['client_appDate_update'];
		$client_choice   = $_POST['client_choice_update'];

		//Date clash check
		$date_query = "SELECT client_appDate FROM userpanel WHERE client_id = '$client_id'";

		$response = mysqli_query($connect, $date_query);

		$row = mysqli_fetch_assoc($response);

		$date_check = $row['client_appDate'];

		if ($date_check == $client_appDate) {
			echo "Booked appointment on same date, choose other day.";
		} else {
			//previous mechanic selection
			$mechanic_search = "SELECT client_choice FROM userpanel WHERE client_id = '$client_id'";

			$mecha_query = mysqli_query($connect, $mechanic_search);
			$row = mysqli_fetch_assoc($mecha_query);

			$mecha_down = $row['client_choice'];

			//Updated mechanic selection
			$mechanic_search = "SELECT mechanic_id FROM mechanic WHERE mechanic_id = '$client_choice'";

			$mecha_query = mysqli_query($connect, $mechanic_search);
			$row = mysqli_fetch_assoc($mecha_query);

			$mecha_up = $row['mechanic_id'];

			//Updated mechanic car servicing status
			$mechanic_query = "SELECT servicing_cars FROM mechanic WHERE mechanic_id = '$mecha_up'";

			$status = mysqli_query($connect, $mechanic_query);

			$row = mysqli_fetch_assoc($status);

			$free_check = $row['servicing_cars'];

			//Maximum limit check
			if ($free_check <= "4") {
				$query = "UPDATE `userpanel` SET `client_appDate`='$client_appDate', `client_choice`='$client_choice' WHERE `client_id`= '$client_id'";

				$msg = mysqli_query($connect, $query);
				if (!$msg) {
					die("Query Failed" . mysqli_error($connect));
				} else {
					echo "Successfully Appoinment created";
				}

				$free_check++;

				//adding to new Mechanic
				$update_query = "UPDATE `mechanic` SET `servicing_cars`='$free_check' WHERE `mechanic_id` = '$mecha_up'";
				$up_check = mysqli_query($connect, $update_query);

				//Servicing car selection of previous mechanic
				$mechanic_query = "SELECT servicing_cars FROM mechanic WHERE mechanic_id = '$mecha_down'";

				$status = mysqli_query($connect, $mechanic_query);

				$row = mysqli_fetch_assoc($status);

				$reduce = $row['servicing_cars'];
				$reduce--;
				
				//subtracting from previous mechanic
				$update_query = "UPDATE `mechanic` SET `servicing_cars`='$reduce' WHERE `mechanic_id` = '$mecha_down'";
				$down_check = mysqli_query($connect, $update_query);
			} else {
				echo "Mechanic Booked, select another mechanic";
			}
		}
	}

	?>

	<form action="" method="POST">

		<div class="form-group">
			<label>Date</label>
			<input name="client_appDate_update" class="form-control" autocomplete="off" type="date">
		</div>
		<div class="form-group">
			<label>mechanic</label>
			<input name="client_choice_update" class="form-control" autocomplete="off" type="text" placeholder="ADS, SKT, FCB, RMA, ARS">
		</div>
		<div class="form-group">
			<input name="submit" type="submit" class="btn btn-primary" value="Submit">
		</div>
	</form>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>

</html>