<?php 
require('controller/session.php');
require('controller/connect_env.php');

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Thermal Detection</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.ico">
    <!-- Font Awesome CDN-->
    <!-- you can replace it by local Font Awesome-->
    <script src="https://use.fontawesome.com/99347ac47f.js"></script>
    <!-- Font Icons CSS-->
    <link rel="stylesheet" href="https://file.myfontastic.com/da58YPMQ7U5HY8Rb6UxkNf/icons.css">
     <style type="text/css">

.paging-nav {
  text-align: right;
  padding-top: 2px;
}

.paging-nav a {
  margin: auto 1px;
  text-decoration: none;
  display: inline-block;
  padding: 1px 7px;
  background: #91b9e6;
  color: white;
  border-radius: 3px;
}

.paging-nav .selected-page {
  background: #187ed5;
  font-weight: bold;
}

.paging-nav,
#tableData {
  width: 400px;
  margin: 0 auto;
  font-family: Arial, sans-serif;
}
</style>
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <div class="page home-page">
      <!-- Main Navbar-->
      <header class="header">
        <nav class="navbar">
          <!-- Search Box-->
          <div class="search-box">
            <button class="dismiss"><i class="icon-close"></i></button>
          </div>
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <!-- Navbar Header-->
              <div class="navbar-header">
                <!-- Navbar Brand --><a href="dashboard.php" class="navbar-brand">
                  <div class="brand-text brand-big hidden-lg-down"><span>Thermal Detection</span></div>
                <!-- Toggle Button--><a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
              </div>
              <!-- Navbar Menu -->
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
              
                <!-- Logout    -->
		<li class="nav-item"><a href="dashboard-1.php" class="nav-link logout">Temperature Log<i class="fa fa-sign-out"></i></a></li>
		<li class="nav-item"><a href="dashboard-2.php" class="nav-link logout">Detected Images<i class="fa fa-sign-out"></i></a></li>
		<li class="nav-item"><a href="logout.php" class="nav-link logout">Logout<i class="fa fa-sign-out"></i></a></li>
              </ul>
            </div>
          </div>
        </nav>
      </header>
      <div class="page-content d-flex align-items-stretch">
        <!-- Side Navbar -->
        <nav class="side-navbar">
          <!-- Sidebar Header-->
          <div class="sidebar-header d-flex align-items-center">
            <div class="avatar"><img src="img/User_Circle.png" alt="..." class="img-fluid rounded-circle"></div>
            <div class="title">
              <h1 class="h4"><?php echo $_SESSION['username']; ?> </h1>
              <p><?php echo $_SESSION['userID']; ?></p>
            </div>
          </div>
          <!-- Sidebar Navidation Menus-->
        </nav>
        <div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">Dashboard</h2>
            </div>
          </header>
          <!-- Dashboard Counts Section-->

          <!-- Dashboard Header Section    -->
          <section class="dashboard-header">
            <div class="container-fluid">
              <div class="row">
              <div class="col-lg-12">
                  <div class="card">
                    <div class="card-close">
                      <div class="dropdown">
                        <button type="button" id="closeCard" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                        <div aria-labelledby="closeCard" class="dropdown-menu has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a>
                        </div>
                      </div>
                    </div>
                  <div class="card-header d-flex align-items-center">
                        <h3 class="h4">Camera Viewing</h3>
                  </div>
                      <div class="card-body">
                      <p>Camera Viewing Goes Here</p>
                      </div>
              </div><!-- end for the camera viewing card -- >

              <!-- Basic Form-->
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-close">
                      <div class="dropdown">
                        <button type="button" id="closeCard" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                        <div aria-labelledby="closeCard" class="dropdown-menu has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a></div>
                      </div>
                    </div>
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">Sensor Threshold</h3>
                    </div>
                    <div class="card-body">
		      <b> Current Temperature Threshold: </b> 
			<?php 
				$qstring = "SELECT thres_temp FROM tbl_threshold ORDER BY thres_id DESC LIMIT 1;";
	
				$result = $conn_env->query($qstring);
				if ($result->num_rows > 0) {
				    while($row = $result->fetch_assoc()) {
					echo $row['thres_temp'] . "&deg;C";
				    }
				} else {
					echo $conn_env->error;
				    echo "Nothing set yet. Please set the threshold below.";
				}
				$conn->close();
			 ?>
			<br /><hr />
			<b> Current Humidity Threshold: </b>
			<?php
			$qstring = "SELECT thres_humidity FROM tbl_threshold ORDER BY thres_id DESC LIMIT 1;";
	
				$result = $conn_env->query($qstring);
				if ($result->num_rows > 0) {
				    while($row = $result->fetch_assoc()) {
					echo $row['thres_humidity'] . "%";
				    }
				} else {
					echo $conn_env->error;
				    echo "Nothing set yet. Please set the threshold below.";
				}
				$conn_env->close();

			?>
			<hr />
                      <form method="POST" action="data/save_thres.php">
                        <div class="form-group">
                          <label class="form-control-label"> <strong> Humidity </strong> </label>
                          <input type="text" placeholder="Enter Humidity Value (Range: 1-100, Relative Humidity %)" class="form-control" name="humidity_set">
                        </div>
                        <div class="form-group">       
                          <label class="form-control-label"><strong> Temperature <strong /></label>
                          <input type="text" placeholder="Enter Temperature Value (Range: 1-100, Celsius)" class="form-control" name="temp_set">
                        </div>
                        <div class="form-group">       
                          <input type="submit" value="Update" class="btn btn-primary">
                        </div>
                      </form>


                    </div>
                  </div>
                </div>
              </div>
              </div>
            </div>
          </section>

          <!-- Page Footer-->
          <footer class="main-footer">
            <div class="container-fluid">
              <div class="row">
                <div class="col-sm-6">
                  <p>Thermal Detection &copy; 2017</p>
                </div>
                <div class="col-sm-6 text-right">
                  <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
                </div>
              </div>
            </div>
          </footer>
        </div>
      </div>
    </div>
    <!-- Javascript files-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> 
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/paging.js"></script> 
<script type="text/javascript">
            $(document).ready(function() {
                $('#tableData').paging({limit:10});
            });

	$(document).ready(function() {
		        $('#tableImages').paging({limit:5});
		    });
        </script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID.-->
    <!---->
    <script>
      (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
      function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
      e=o.createElement(i);r=o.getElementsByTagName(i)[0];
      e.src='//www.google-analytics.com/analytics.js';
      r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
      ga('create','UA-XXXXX-X');ga('send','pageview');
    </script>
  </body>
</html>
