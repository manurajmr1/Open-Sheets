<?php 
include("config.php");
$sheet_id 		= $_POST['sheet_id'];
$data 			= $_POST['data'];
$data			= json_decode($data);
$created_by		= "chinhcu.kurian@fingent.com";


$temp			= [];
$dataArray		= [];
foreach($data as $item){

	$temp['Features'] 				= $item[0];
	$temp['Notes']	  				= $item[1];
	$temp['Code_and_Unit_Testing']  = $item[2];
	$temp['Design']   				= $item[3];
	$temp['Testing_and_Debugging']  = $item[4];
	$temp['BA']       				= $item[5];
	$temp['Total']    				= $item[6];
	$temp['Buffered'] 				= $item[7];
	$temp['Effort']   				= $item[8];

	$dataArray[]					= $temp;
}
$dataArray = json_encode($dataArray);

//$deleteSql    = "DELETE FROM fingent_project_sheet_data WHERE sheet_id = $sheet_id";

$selectSql  = "SELECT id FROM fingent_project_sheet_data WHERE sheet_id = $sheet_id";
$query      = mysql_query($selectSql,$conn);
if(mysql_num_rows($query) > 0){
	$updateSql  = "UPDATE fingent_project_sheet_data SET data = '$dataArray',updated_by = '$created_by',updated_on = NOW() WHERE sheet_id = $sheet_id";
	mysql_query($updateSql,$conn);

}else{
	$insertSql 	= "INSERT INTO fingent_project_sheet_data (sheet_id,data,created_by,created_on) VALUES('$sheet_id','$dataArray','$created_by',NOW())";
	mysql_query($insertSql,$conn);	
}
if(mysql_affected_rows($conn) > 0){
	$returnArray['status'] = "success";
	$returnArray['data']   = $data;	
}else{
	$returnArray['status'] = "failed";
	$returnArray['data']   = "";
}

echo json_encode($returnArray);exit;





?>