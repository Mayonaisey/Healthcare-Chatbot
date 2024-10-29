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
    
  <!--el header file henaaaa-->
   <?php include 'header.html';?>
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
                <li class="active"><a href="charts.html"> <i class="fa fa-bar-chart"></i>Charts </a></li>
                <li><a href="forms.html"> <i class="icon-padnote"></i>Forms </a></li>
                <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Example dropdown </a>
                  <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                    <li><a href="#">Page</a></li>
                    <li><a href="#">Page</a></li>
                    <li><a href="#">Page</a></li>
                  </ul>
                </li>
                <li><a href="login.html"> <i class="icon-logout"></i>Login page </a></li>
        </ul><span class="heading">Extras</span>
        <ul class="list-unstyled">
          <li> <a href="#"> <i class="icon-settings"></i>Demo </a></li>
          <li> <a href="#"> <i class="icon-writing-whiteboard"></i>Demo </a></li>
          <li> <a href="#"> <i class="icon-chart"></i>Demo </a></li>
        </ul>
      </nav>
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <!-- Page Header-->
        <div class="page-header no-margin-bottom">
          <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Charts</h2>
          </div>
        </div>
        <!-- Breadcrumb-->
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Charts            </li>
          </ul>
        </div>
        <section>
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-8">
                <div class="line-chart block chart">
                  <div class="title"><strong>Line Chart Example</strong></div>
                  <canvas id="lineChartCustom1"></canvas>
                </div>
              </div>
              <div class="col-lg-4">       
                <div class="lin-chart block chart">
                  <div class="title"><strong>Line Chart Example</strong></div>
                  <div class="line-chart chart margin-bottom-sm">
                    <canvas id="lineChartCustom2"></canvas>
                  </div>
                  <div class="line-chart chart">
                    <canvas id="lineChartCustom3"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="chart block">
                  <div class="title"> <strong>Bar Chart Example</strong></div>
                  <div class="bar-chart chart margin-bottom-sm">
                    <canvas id="barChartCustom1"></canvas>
                  </div>
                  <div class="bar-chart chart">
                    <canvas id="barChartCustom2"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-lg-8">
                <div class="bar-chart block chart">
                  <div class="title"><strong>Bar Chart Example</strong></div>
                  <div class="bar-chart chart">
                    <canvas id="barChartCustom3"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="pie-chart chart block">
                  <div class="title"><strong>Pie Chart Example</strong></div>
                  <div class="pie-chart chart margin-bottom-sm">
                    <canvas id="pieChartCustom1"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="doughnut-chart chart block">
                  <div class="title"><strong>Pie Chart Example</strong></div>
                  <div class="doughnut-chart chart margin-bottom-sm">
                    <canvas id="doughnutChartCustom1"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="polar-chart chart block">
                  <div class="title"><strong>Polar Chart Example</strong></div>
                  <div class="polar-chart chart margin-bottom-sm">
                    <canvas id="polarChartCustom"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="radar-chart chart block">
                  <div class="title"><strong>Radar Chart Example</strong></div>
                  <div class="radar-chart chart margin-bottom-sm">
                    <canvas id="radarChartCustom"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <footer class="footer">
          <div class="footer__block block no-margin-bottom">
            <div class="container-fluid text-center">
              <!-- Please do not remove the backlink to us unless you support us at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
               <p class="no-margin-bottom">2018 &copy; Your company. Download From <a target="_blank" href="https://templateshub.net">Templates Hub</a>.</p>
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
    <script src="js/charts-custom.js"></script>
    <script src="js/front.js"></script>
  </body>
</html>