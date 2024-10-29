<!--read id number of last user from database-->
<?php
// Database connection credentials
$servername = "localhost";
$username = "root";  // Replace with your database username
$password = "";  // Replace with your database password
$dbname = "medical_chatbot";  // Replace with your database name
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Healthycare Chatbot </title>
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
   <?php include 'header.html';?>
  <div class="d-flex align-items-stretch">
  <!--sideee-->
  <?php include 'side.html'; ?>
      <section class="no-padding-top no-padding-bottom">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-3 col-sm-6">
              <div class="statistic-block block">
                <div class="progress-details d-flex align-items-end justify-content-between">
                  <div class="title">

                    <div class="icon"><i class="icon-user-1"></i></div><strong>All Patients</strong>
                  </div>
                  <div class="number dashtext-1">

                    <?php
                    $sql = "
                    SELECT COUNT(*) AS max_user_id
                    FROM 
                        users u
                ";

                    // Execute query
                    $result = $conn->query($sql);
                    $max_user_id = null;

                    if ($result->num_rows > 0) {
                      $row = $result->fetch_assoc();
                      $max_user_id = $row["max_user_id"];
                    } else {
                      echo "<p>No users found.</p>";
                    }
                    if ($max_user_id) {
                      echo $max_user_id;
                    } else {
                      echo "0";
                    }
                    ?>

                  </div>
                </div>
                <div class="progress progress-template">
                  <div role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"
                    class="progress-bar progress-bar-template dashbg-1"></div>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6">
              <div class="statistic-block block">
                <div class="progress-details d-flex align-items-end justify-content-between">
                  <div class="title">
                    <div class="icon"><i class="icon-contract"></i></div><strong>All Doctors</strong>
                  </div>
                  <div class="number dashtext-2">
                    <?php
                    $sql = " 
                       SELECT COUNT(*) AS max_dr_id
                    FROM 
                        doctors d
                ";
                    // Execute query
                    $result = $conn->query($sql);
                    $max_dr_id = null;

                    if ($result->num_rows > 0) {
                      $row = $result->fetch_assoc();
                      $max_dr_id = $row["max_dr_id"];
                    } else {
                      echo "<p>No doctors found.</p>";
                    }
                    if ($max_dr_id) {
                      echo $max_dr_id;
                    } else {
                      echo "0";
                    }
                    ?>
                  </div>
                </div>
                <div class="progress progress-template">
                  <div role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"
                    class="progress-bar progress-bar-template dashbg-2"></div>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6">
              <div class="statistic-block block">
                <div class="progress-details d-flex align-items-end justify-content-between">
                  <div class="title">
                    <div class="icon"><i class="icon-paper-and-pencil"></i></div><strong>All Appointments</strong>
                  </div>
                  <div class="number dashtext-3">
                  <?php
                    $sql = " 
                       SELECT COUNT(*) AS appts
                    FROM 
                        appointments ap
                ";
                    // Execute query
                    $result = $conn->query($sql);
                    $appts = null;

                    if ($result->num_rows > 0) {
                      $row = $result->fetch_assoc();
                      $appts = $row["appts"];
                    } else {
                      echo "<p>No doctors found.</p>";
                    }
                    if ($appts) {
                      echo $appts;
                    } else {
                      echo "0";
                    }
                    ?>
                  </div>
                </div>
                <div class="progress progress-template">
                  <div role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"
                    class="progress-bar progress-bar-template dashbg-3"></div>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6">
              <div class="statistic-block block">
                <div class="progress-details d-flex align-items-end justify-content-between">
                  <div class="title">
                    <div class="icon"><i class="icon-writing-whiteboard"></i></div><strong>All Projects</strong>
                  </div>
                  <div class="number dashtext-4">41</div>
                </div>
                <div class="progress progress-template">
                  <div role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"
                    class="progress-bar progress-bar-template dashbg-4"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="no-padding-bottom">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-4">
              <div class="bar-chart block no-margin-bottom">
                <canvas id="barChartExample1"></canvas>
              </div>
              <div class="bar-chart block">
                <canvas id="barChartExample2"></canvas>
              </div>
            </div>
            <div class="col-lg-8">
              <div class="line-cahrt block">
                <canvas id="lineCahrt"></canvas>
              </div>
            </div>
          </div>
        </div>
      </section>
      <?php $conn->close(); ?>
      <footer class="footer">
        <div class="footer__block block no-margin-bottom">
          <div class="container-fluid text-center">
            <!-- Please do not remove the backlink to us unless you support us at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
            <p class="no-margin-bottom">2024 &copy; HealthyCare. Download From <a target="_blank"
                href="https://templateshub.net">Templates Hub</a>.</p>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!-- JavaScript files-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/popper.js/umd/popper.min.js"> </script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
  <script src="js/charts-home.js"></script>
  <script src="js/front.js"></script>
</body>

</html>