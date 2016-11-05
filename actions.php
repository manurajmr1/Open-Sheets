<?php 
include("config.php");
$action = $_REQUEST['action'];
switch ($action) {
    case 'get_sheets':
        getSheets($_REQUEST);
        break;   
    case 'save_sheet':
        saveSheet($_REQUEST);
        break;
    case 'get_sheet_data_excel':
        getSheetData($_REQUEST,'excel');
        break;
    case 'get_sheet_data':
        getSheetData($_REQUEST,'edit');
        break;    
    
    default:
        break;
}

function getSheets($data){
	$project_id = $data['project_id'];

	$sql   =  "SELECT fps.id AS sheet_id,fps.sheet_name FROM fingent_project_sheets fps INNER JOIN fingent_projects fp ON fp.id = fps.project_id WHERE fps.project_id = '$project_id'";
	$query = mysql_query($sql);
	$sheetArray = [];
	while($row = mysql_fetch_assoc($query)){
		$sheetArray[] = $row;
	}
	echo json_encode($sheetArray);exit;
}

function saveSheet($data){
	$sheet_id 		= $data['sheet_id'];
	$sheetData 		= $data['data'];
	$sheetData		= json_decode($sheetData);
	$created_by		= "chinhcu.kurian@fingent.com";


	$temp			= [];
	$dataArray		= [];
	foreach($sheetData as $item){

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
	$query      = mysql_query($selectSql);
	if(mysql_num_rows($query) > 0){
		$updateSql  = "UPDATE fingent_project_sheet_data SET data = '$dataArray',updated_by = '$created_by',updated_on = NOW() WHERE sheet_id = $sheet_id";
		mysql_query($updateSql);

	}else{
		$insertSql 	= "INSERT INTO fingent_project_sheet_data (sheet_id,data,created_by,created_on) VALUES('$sheet_id','$dataArray','$created_by',NOW())";
		mysql_query($insertSql);	
	}
	if(mysql_affected_rows() > 0){
		$returnArray['status'] = "success";
		$returnArray['data']   = $sheetData;	
	}else{
		$returnArray['status'] = "failed";
		$returnArray['data']   = "";
	}

	echo json_encode($returnArray);exit;
}

function getSheetData($data,$type){
	$sheet_id 		= $data['sheet_id'];

	$sql 	= "SELECT fpsd.data FROM fingent_project_sheet_data fpsd INNER JOIN fingent_project_sheets fps ON fps.id = fpsd.sheet_id WHERE fpsd.sheet_id = $sheet_id ";
	$query 	= mysql_query($sql);
	$result = mysql_fetch_assoc($query);
	if($type == "edit"){
		$sheetDatas   = json_decode($result['data'],true);
		$sheetDataArray = [];
		foreach($sheetDatas as $sheetData){		
			$sheetDataArray[] = array_values($sheetData);
		}
		echo json_encode($sheetDataArray);exit;
	}else{
		echo $result['data'];exit; 
	}
	
	

}
?>