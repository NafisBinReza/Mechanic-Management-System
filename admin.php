<?php
include 'database.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Panel</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="ajax/ajax.js"></script>
</head>

<body>
	<div class="container">
		<p id="success"></p>
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2>Admin <b>Panel</b></h2>
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
						</th>
						<th>SL NO</th>
						<th>Client Name</th>
						<th>Client Phone</th>
						<th>Client License</th>
						<th>Appoinment Date</th>
						<th>Mechanic</th>
						<th>ACTION</th>
					</tr>
				</thead>
				<tbody>

					<?php
					$result = mysqli_query($connect, "SELECT * FROM userpanel");
					$i = 1;
					while ($row = mysqli_fetch_array($result)) {
						$client_id = $row["client_id"];
					?>
						<tr>
							<td>
								<span class="custom-checkbox">
									<input type="checkbox" class="user_checkbox" data-user-id="<?php echo $row["client_id"]; ?>">
									<label for="checkbox2"></label>
								</span>
							</td>
							<td><?php echo $i; ?></td>
							<td><?php echo $row["client_name"]; ?></td>
							<td><?php echo $row["client_phone"]; ?></td>
							<td><?php echo $row["client_license"]; ?></td>
							<td><?php echo $row["client_appDate"]; ?></td>
							<td><?php echo $row["client_choice"]; ?></td>
							<td>
								<a href="update.php?edit=<?php echo $client_id; ?>" class="edit" data-toggle="modal">
									<i class="material-icons update" data-toggle="tooltip" client-id="<?php echo $row["client_id"]; ?>" client-name="<?php echo $row["client_name"]; ?>" client-license="<?php echo $row["client_license"]; ?>" client-appDate="<?php echo $row["client_appDate"]; ?>" client-choice="<?php echo $row["client_choice"]; ?>" title="Edit"></i>
								</a>

							</td>
						</tr>
					<?php
						$i++;
					}
					?>
				</tbody>
			</table>

		</div>
	</div>


	<div class="container">
		<p id="success"></p>
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2>Mechanic <b>Status</b></h2>
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						
						<th>Mechanic</th>
						<th>Servicing Car Satus</th>
						
					</tr>
				</thead>
				<tbody>

					<?php
					$result = mysqli_query($connect, "SELECT * FROM mechanic");
					while ($row = mysqli_fetch_array($result)) {
					?>
						<tr>
							
							<td><?php echo $row["mechanic_id"]; ?></td>
							<td><?php echo $row["servicing_cars"]; ?></td>
							
						</tr>
					<?php
					}
					?>
				</tbody>
			</table>

		</div>
	</div>
	<!-- Add Modal HTML
	<div id="addEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="user_form">
					<div class="modal-header">						
						<h4 class="modal-title">Add User</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>NAME</label>
							<input type="text" id="name" name="name" class="form-control" required>
						</div>
						<div class="form-group">
							<label>EMAIL</label>
							<input type="email" id="email" name="email" class="form-control" required>
						</div>
						<div class="form-group">
							<label>PHONE</label>
							<input type="phone" id="phone" name="phone" class="form-control" required>
						</div>
						<div class="form-group">
							<label>CITY</label>
							<input type="city" id="city" name="city" class="form-control" required>
						</div>					
					</div>
					<div class="modal-footer">
					    <input type="hidden" value="1" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-success" id="btn-add">Add</button>
					</div>
				</form>
			</div>
		</div>
	</div> -->
	<!-- Edit Modal HTML -->
	<div id="editEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="update_form">
					<div class="modal-header">
						<h4 class="modal-title">Edit User</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="id_u" name="id" class="form-control" required>
						<div class="form-group">
							<label>Appoinment Date</label>
							<input type="date" id="name_u" name="date_update" class="form-control" required>
						</div>

						<div class="form-group">
							<label>Mechanic</label>
							<input type="text" id="phone_u" name="choice_update" class="form-control" required>
						</div>

					</div>
					<div class="modal-footer">
						<input type="hidden" value="2" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-info" id="update">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>


	<?php

	if (count($_POST) > 0) {
		if ($_POST['type'] == 2) {

			$id = $_POST['id'];
			$date = $_POST['date_update'];
			$choice = $_POST['choice_update'];

			$sql = "UPDATE `userpanel` SET `client_appDate`='$date',`client_choice`='$choice' WHERE client_id=$id";
			mysqli_query($conn, $sql);
			if (mysqli_query($conn, $sql)) {
				echo json_encode(array("statusCode" => 200));
			} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
			mysqli_close($conn);
		}
	}
	?>

	<!-- Delete Modal HTML
	<div id="deleteEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
						
					<div class="modal-header">						
						<h4 class="modal-title">Delete User</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="id_d" name="id" class="form-control">					
						<p>Are you sure you want to delete these Records?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-danger" id="delete">Delete</button>
					</div>
				</form>
			</div>
		</div>
	</div> -->

</body>

</html>