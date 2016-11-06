<?php
include_once("config.php");

$sheet_id 		= $_POST['sheet_id'];
$shares 		= explode(",",$_POST['shares']);
$user                   = $_SESSION["google_data"]["email"];
        
    
$selectSql  = "SELECT project_id FROM fingent_project_sheets WHERE id = $sheet_id LIMIT 0,1";
$result      = mysql_query($selectSql,$conn);
while ($row = mysql_fetch_array($result)) {  
    $projid = $row['project_id'];  
}

foreach ($shares as $value) {
    $insertSql 	= "INSERT INTO fingent_project_sheet_shared_users (project_id,shared_email,created_by,created_on) VALUES('$projid','$value','$user',NOW())";
    echo $insertSql;
    mysql_query($insertSql,$conn);
}    

?>