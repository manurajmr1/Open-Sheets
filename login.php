<?php
include_once "config.php";
if (isset($_REQUEST['code'])) {
    $gClient->authenticate();
    $_SESSION['token'] = $gClient->getAccessToken();
    header('Location: ' . filter_var($redirect_url, FILTER_SANITIZE_URL));
}
if (isset($_SESSION['token'])) {
    $gClient->setAccessToken($_SESSION['token']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title> Fingent sheets</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<!-- Bootstrap Core CSS -->
<link href="css/custom/bootstrap.min.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="css/custom/one-page-wonder.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
<link rel="stylesheet" href="css/custom/style.css">
<!-- jQuery -->
<script src="js/jquery.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'>
</script>
<script src="js/index.js"></script>
<style type="text/css">
.header-class{
background-color:white;
color:black}
</style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar  navbar-fixed-top header-class" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
               <a class="navbar-brand" href="#">Fingent sheets </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
       <div class="headline">
            <div class="container">
               <div class="pen-title">
                 <br><br><br><br><br>
                  <!-- Form Module-->
                   <div class="module form-module">
                        
                        <div class="loginBox">
<?php
if (isset($_GET['msg'])) {echo "<center><h3>" . $_GET['msg'] . "</h3></center>";}
if ($gClient->getAccessToken()) {
    $userProfile = $google_oauthV2->userinfo->get();print_r($userProfile);
    $_SESSION['google_data'] = $userProfile;
    header("location: projects.php");
    $_SESSION['token'] = $gClient->getAccessToken();
} else {
    $authUrl = $gClient->createAuthUrl();
}

if (isset($authUrl)) {
    echo '<a href="' . $authUrl . '" class="loginButton"><img src="sign-in-with-google.png" alt=""/></a>';
} else {
    echo '<a href="logout.php?logout">Logout</a>';
}
?>

                        </div>
                  </div>
             </div>
            </div>
        </div>
     <!-- Page Content -->
    <div class ="container">







     </div>
     <!-- Footer -->
     
<style type="text/css">
.foot
{
  position: absolute;
  right: 0;
  bottom: 0;
  left: 0;
  background-color: white;
  text-align: center;
  color:#178ab4;

}
</style>
<footer class= foot>
     <div class="row" >
          <div class="col-lg-12"><center>
              <center><br>
                
                 <h4>All Rights Reserved.    Fingent Global Solutions.</h4>
                <br>
              </center>
          </div>
      </div>
</footer>


</body>
</html>


</body>
</html>