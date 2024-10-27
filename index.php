<!--read id number of last user from database-->
<?php
// Database connection credentials
$servername = "localhost";
$username = "root";  // Replace with your database username
$password = "";  // Replace with your database password
$dbname = "project_drs";

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
  <header class="header">
    <nav class="navbar navbar-expand-lg">
      <div class="search-panel">
        <div class="search-inner d-flex align-items-center justify-content-center">
          <div class="close-btn">Close <i class="fa fa-close"></i></div>
          <form id="searchForm" action="#">
            <div class="form-group">
              <input type="search" name="search" placeholder="What are you searching for...">
              <button type="submit" class="submit">Search</button>
            </div>
          </form>
        </div>
      </div>
      <div class="container-fluid d-flex align-items-center justify-content-between">
        <div class="navbar-header">
          <!-- Navbar Header--><a href="index.html" class="navbar-brand">
            <div class="brand-text brand-big visible text-uppercase"><strong
                class="text-primary">Healthy</strong><strong>Care</strong></div>
            <div class="brand-text brand-sm"><strong class="text-primary">H</strong><strong>C</strong></div>
          </a>
          <!-- Sidebar Toggle Btn-->
          <button class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></button>
        </div>
        <div class="right-menu list-inline no-margin-bottom">
          <div class="list-inline-item"><a href="#" class="search-open nav-link"><i
                class="icon-magnifying-glass-browser"></i></a></div>
          <div class="list-inline-item dropdown"><a id="navbarDropdownMenuLink1" href="http://example.com"
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link messages-toggle"><i
                class="icon-email"></i><span class="badge dashbg-1">5</span></a>
            <div aria-labelledby="navbarDropdownMenuLink1" class="dropdown-menu messages"><a href="#"
                class="dropdown-item message d-flex align-items-center">
                <div class="profile"><img src="img/avatar-3.jpg" alt="..." class="img-fluid">
                  <div class="status online"></div>
                </div>
                <div class="content"> <strong class="d-block">Nadia Halsey</strong><span class="d-block">lorem ipsum
                    dolor sit amit</span><small class="date d-block">9:30am</small></div>
              </a><a href="#" class="dropdown-item message d-flex align-items-center">
                <div class="profile"><img src="img/avatar-2.jpg" alt="..." class="img-fluid">
                  <div class="status away"></div>
                </div>
                <div class="content"> <strong class="d-block">Peter Ramsy</strong><span class="d-block">lorem ipsum
                    dolor sit amit</span><small class="date d-block">7:40am</small></div>
              </a><a href="#" class="dropdown-item message d-flex align-items-center">
                <div class="profile"><img src="img/avatar-1.jpg" alt="..." class="img-fluid">
                  <div class="status busy"></div>
                </div>
                <div class="content"> <strong class="d-block">Sam Kaheil</strong><span class="d-block">lorem ipsum dolor
                    sit amit</span><small class="date d-block">6:55am</small></div>
              </a><a href="#" class="dropdown-item message d-flex align-items-center">
                <div class="profile"><img src="img/avatar-5.jpg" alt="..." class="img-fluid">
                  <div class="status offline"></div>
                </div>
                <div class="content"> <strong class="d-block">Sara Wood</strong><span class="d-block">lorem ipsum dolor
                    sit amit</span><small class="date d-block">10:30pm</small></div>
              </a><a href="#" class="dropdown-item text-center message"> <strong>See All Messages <i
                    class="fa fa-angle-right"></i></strong></a></div>
          </div>

          <!-- Languages dropdown    -->
          <div class="list-inline-item dropdown"><a id="languages" rel="nofollow" data-target="#" href="#"
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
              class="nav-link language dropdown-toggle"><img src="img/flags/16/GB.png" alt="English"><span
                class="d-none d-sm-inline-block">English</span></a>
            <div aria-labelledby="languages" class="dropdown-menu"><a rel="nofollow" href="#" class="dropdown-item">
                <img src="img/flags/16/DE.png" alt="English" class="mr-2"><span>German</span></a><a rel="nofollow"
                href="#" class="dropdown-item"> <img src="img/flags/16/FR.png" alt="English" class="mr-2"><span>French
                </span></a></div>
          </div>
          <!-- Log out               -->
          <div class="list-inline-item logout"> <a id="logout" href="login.html" class="nav-link">Logout <i
                class="icon-logout"></i></a></div>
        </div>
      </div>
    </nav>
  </header>
  <div class="d-flex align-items-stretch">
    <!-- Sidebar Navigation-->
    <nav id="sidebar">
      <!-- Sidebar Header-->
      <div class="sidebar-header d-flex align-items-center">
        <div class="avatar"><img src="img/avatar-6.jpg" alt="..." class="img-fluid rounded-circle"></div>
        <div class="title">
          <h1 class="h5">Mark Stephen</h1>
          <p>Web Designer</p>
        </div>
      </div>
      <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
      <ul class="list-unstyled">
        <li class="active"><a href="index.php"> <i class="icon-home"></i>Home </a></li>
        <li><a href="doctors.php"> <i class="icon-grid"></i>Doctors </a></li>
        <li><a href="charts.html"> <i class="fa fa-bar-chart"></i>Charts </a></li>
        <li><a href="appointments.php"> <i class="icon-padnote"></i>Appointments </a></li>
        <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i
              class="icon-windows"></i>Example dropdown </a>
          <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
            <li><a href="#">Page</a></li>
            <li><a href="#">Page</a></li>
            <li><a href="#">Page</a></li>
          </ul>
        </li>
        <li><a href="login.html"> <i class="icon-logout"></i>Login page </a></li>
    </nav>
    <!-- Sidebar Navigation end-->
    <div class="page-content">
      <div class="page-header">
        <div class="container-fluid">
          <h2 class="h5 no-margin-bottom">Dashboard</h2>
        </div>
      </div>
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