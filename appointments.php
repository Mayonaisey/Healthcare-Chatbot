<?php include 'addAppointment.php'; ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>HealthyCare Chatbot </title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="all,follow">
  <!-- Bootstrap CSS-->
  <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome CSS-->
  <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
  <!-- Custom Font Icons CSS-->
  <link rel="stylesheet" href="css/font.css">
  <!-- Google fonts - Muli-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
  <!-- theme stylesheet-->
  <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
  <!-- Custom stylesheet - for your changes-->
  <link rel="stylesheet" href="css/custom.css">
  <!-- Favicon-->
  <link rel="shortcut icon" href="img/favicon.ico">
  <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>

<body>

  <!--el header file henaaaa-->
  <?php include 'header.html';  ?>

  <div class="d-flex align-items-stretch">
    <?php include 'side.html'; ?>


    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - View Appointments</title>
    <style>
      table {
        width: 100%;
        border-collapse: collapse;
      }

      table,
      th,
      td {
        border: 1px solid black;
      }

      th,
      td {
        padding: 8px;
        text-align: left;
      }

      th {
        background-color: #f2f2f2;
      }
    </style>

    <br>

    <section class="no-padding-top no-padding-bottom">
      <div class="container-fluid">
        <h2>Appointment Details</h2>

        <?php
        if ($result->num_rows > 0) {
          // Output data in a table
          echo "<table>";
          echo "<tr><th>Appointment ID</th><th>User Name</th><th>Doctor Name</th><th>Date</th><th>Time</th><th>Status</th></tr>";

          // Fetch and display each row
          while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["appointment_id"] . "</td>";
            echo "<td>" . $row["user_first_name"] . " " . $row["user_last_name"] . "</td>";
            echo "<td>" . $row["doctor_first_name"] . " " . $row["doctor_last_name"] . "</td>";
            echo "<td>" . $row["appointment_date"] . "</td>";
            echo "<td>" . $row["appointment_time"] . "</td>";
            echo "<td>" . $row["status"] . "</td>";
            echo "</tr>";
          }
          echo "</table>";
        } else {
          echo "<p>No appointments found.</p>";
        }

        // Close connection

        ?>
      </div>
    </section>
    <br>
</body>

</html>
<section class="no-padding-top">
  <div class="container-fluid">
    <div class="row">
      <!-- Form Elements -->
      <div class="col-lg-12">
        <div class="block">
          <div class="title"><strong>Schedule an Appointment</strong></div>
          <div class="block-body">
            <form method="post" class="form-horizontal">

              <div class="row">
                <label class="col-sm-3 form-control-label">Material Inputs</label>
                <div class="col-sm-9">
                  <div class="form-group-material">
                    <input id="register-username" type="text" name="UserEmail" required
                      class="input-material">
                    <label for="register-username" class="label-material">User Email</label>
                  </div>
                  <div class="form-group-material">
                    <input id="register-email" type="email" name="DoctorEmail" required class="input-material">
                    <label for="register-email" class="label-material">Doctor Email </label>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 form-control-label">Appointment Date</label>
                <div class="col-sm-9">
                  <input type="date" name="date" class="form-control">
                </div>
              </div>
              <div class="line"></div>
              <div class="form-group row">
                <label class="col-sm-3 form-control-label">Time</label>
                <div class="col-sm-9">
                  <input type="time" name="time" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-9 ml-auto">
                  <button type="submit" class="btn btn-secondary">Cancel</button>
                  <button type="submit" class="btn btn-primary">Save changes</button>

                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php include 'footer.html' ?>
</div>
</div>
<!-- JavaScript files-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/popper.js/umd/popper.min.js"> </script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
<script src="vendor/chart.js/Chart.min.js"></script>
<script src="vendor/jquery-validation/jquery.validate.min.js"></script>
<script src="js/front.js"></script>
</body>

</html>