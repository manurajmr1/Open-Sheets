
<?php
$conn = mysql_connect('localhost', 'root', 'a5qE9iXUFkg0wKL');
if (!$conn) {
    die('Could not connect: ' . mysql_error());
}
//echo 'Connected successfully';
mysql_select_db('estimation_tool');
//mysql_close($conn);
?>
