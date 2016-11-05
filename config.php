
<?php
$conn = mysql_connect('localhost', 'root', 'my$ql');
if (!$conn) {
    die('Could not connect: ' . mysql_error());
}
//echo 'Connected successfully';
mysql_select_db('estimation_tool');
//mysql_close($conn);
?>
