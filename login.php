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
<html>
<head>
<title>Fingent Estimate Sheet</title>
<link href='https://fonts.googleapis.com/css?family=Roboto:400,700,900' rel='stylesheet' type='text/css'>
<style>
.loginBox
{
	margin:200px 30%;
	position:absolute;
}
</style>
</head>
<body>
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
</body>
</html>