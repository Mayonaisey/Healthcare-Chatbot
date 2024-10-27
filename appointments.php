<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dark Bootstrap Admin </title>
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
                class="text-primary">Dark</strong><strong>Admin</strong></div>
            <div class="brand-text brand-sm"><strong class="text-primary">D</strong><strong>A</strong></div>
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
        <li><a href="index.html"> <i class="icon-home"></i>Home </a></li>
        <li><a href="tables.php"> <i class="icon-grid"></i>Tables </a></li>
        <li><a href="charts.html"> <i class="fa fa-bar-chart"></i>Charts </a></li>
        <li class="active"><a href="forms.html"> <i class="icon-padnote"></i>Appointments </a></li>
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
      <!-- Page Header-->
      <div class="page-header no-margin-bottom">
        <div class="container-fluid">
          <h2 class="h5 no-margin-bottom">Appointments</h2>
        </div>
      </div>
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

      // Query to retrieve appointment details, joining with user and doctor tables for more information
      $sql = "
    SELECT 
        a.appointment_id, 
        a.appointment_date, 
        a.appointment_time, 
        a.status, 
        u.first_name AS user_first_name, 
        u.last_name AS user_last_name, 
        d.first_name AS doctor_first_name, 
        d.last_name AS doctor_last_name
    FROM 
        Appointments a
    JOIN 
        Users u ON a.user_id = u.user_id
    JOIN 
        Doctors d ON a.doctor_id = d.doctor_id
    ORDER BY 
        a.appointment_date, a.appointment_time
";

      // Execute query
      $result = $conn->query($sql);

      // Basic HTML to display the results
      ?>
      
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
            $conn->close();
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
                  <form class="form-horizontal">

                    <div class="row">
                      <label class="col-sm-3 form-control-label">Material Inputs</label>
                      <div class="col-sm-9">
                        <div class="form-group-material">
                          <input id="register-username" type="text" name="registerUsername" required
                            class="input-material">
                          <label for="register-username" class="label-material">User ID</label>
                        </div>
                        <div class="form-group-material">
                          <input id="register-email" type="email" name="registerEmail" required class="input-material">
                          <label for="register-email" class="label-material">Doctor ID </label>
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
                        <input type="time" class="form-control">
                      </div>
                    </div>


                    <div class="form-group row">
                      <label class="col-sm-3 form-control-label">User Gender</label>
                      <div class="col-sm-9">
                        <select name="account" class="form-control mb-3 mb-3">
                          <option>Male</option>
                          <option>Female</option>
                        </select>
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
      <footer class="footer">
        <div class="footer__block block no-margin-bottom">
          <div class="container-fluid text-center">
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
  <script src="js/front.js"></script>
</body>

</html>