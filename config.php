<?php
error_reporting( ~E_ALL & ~E_NOTICE );
$conn = mysql_connect('localhost', 'root', '');
if (!$conn) {
    die('Could not connect: ' . mysql_error());
}
//echo 'Connected successfully';
mysql_select_db('estimation_tool');
//mysql_close($conn);


session_start();
include_once("src/Google_Client.php");
include_once("src/contrib/Google_Oauth2Service.php");
######### edit details ##########
$clientId = '745696031633-vlnintuj9n283h2m3k8r6ojetgm5i7te.apps.googleusercontent.com'; //Google CLIENT ID
$clientSecret = 'qn173zeIwCquZLlLRT_wlmKd'; //Google CLIENT SECRET
$redirectUrl = 'http://localhost/hackathon/login.php';  //return url (url to script)
$homeUrl = 'http://localhost/hackathon/login.php';  //return to home

##################################

$gClient = new Google_Client();
$gClient->setApplicationName('Login to Estimate Sheet');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectUrl);

$google_oauthV2 = new Google_Oauth2Service($gClient);


?>
