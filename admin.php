<?php

$connect = mysqli_connect("localhost", "root", "", "assignment3");
if (!$connect) {
  die("Database Connection Failed" . mysqli_error($connect));
}
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

  <title>Admin Panel</title>
</head>

<body>


  <h1 class="h3 mb-4 text-gray-800">Adming Panel</h1>
  <table>
    <thead>
      <tr>
        <th scope="col">SL</th>
        <th scope="col">Client Name</th>
        <th scope="col">Client Phone</th>
        <th scope="col">Car Number</th>
        <th scope="col">Appointment Date</th>
        <th scope="col">Mechanic</th>
        <th scope="col">Update Date</th>
        <th scope="col">Update Choice</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $query = "SELECT * FROM userpanel";

      $select_info = mysqli_query($connect, $query);
      global $client_id;

      $sl = 0;

      while ($row = mysqli_fetch_assoc($select_info)) {
        $client_id = $row['client_id'];
        $client_name = $row['client_name'];
        $client_phone = $row['client_phone'];
        $client_license = $row['client_license'];
        $client_appDate = $row['client_appDate'];
        $client_choice = $row['client_choice'];

        $sl++;
      ?>
        <tr>
          <th scope="row"><?php echo $sl; ?></th>
          <td><?php echo $client_name; ?></td>
          <td><?php echo $client_phone; ?></td>
          <td><?php echo $client_license; ?></td>
          <td><?php echo $client_appDate; ?></td>
          <td><?php echo $client_choice; ?></td>
          <td>
            <div class="btn-group">
              <form action="" method="GET">
                <input name="client_appDate_update" class="form-control" autocomplete="off" type="date">
                <a href="admin.php?update_appDate=<?php echo $client_id; ?>" class="btn btn-danger btn-sm">Update Date</a>

              </form>
            </div>
          </td>
          <td>
            <div class="btn-group">
              <form action="" method="GET">
                <input name="client_choice_update" class="form-control" autocomplete="off" type="text">
                <a href="admin.php?update_choice=<?php echo $client_id; ?>" class="btn btn-danger btn-sm">Update Choice</a>

              </form>
            </div>
          </td>
        </tr>
      <?php  } ?>

      <td>

      </td>
      <td>

      </td>


      <?php


      if (isset($_GET['update_appDate'])) {
        $the_con_id = $_GET['update_appDate'];
        $client_choice_update = $_GET['client_appDate_update'];

        $query = "UPDATE `userpanel` SET `client_appDate` = '$client_appDate_update' WHERE client_id = '$the_con_id'";
        $delete_con = mysqli_query($connect, $query);
        if (!$delete_con) {
          die("Query Failed" . mysqli_error($connect));
        } else {
          echo "success";
          // header("Location: admin.php");
        }
      }


      if (isset($_GET['update_choice'])) {
        $the_con_id = $_GET['update_choice'];
        $client_choice_update = $_GET['client_choice_update'];

        $query = "UPDATE `userpanel` SET `client_choice` = '$client_choice_update' WHERE client_id = '$the_con_id'";
        $delete_con = mysqli_query($connect, $query);
        if (!$delete_con) {
          die("Query Failed" . mysqli_error($connect));
        } else {
          echo "success";
          // header("Location: admin.php");
        }
      }



      ?>


  </table>





  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

</body>

</html>