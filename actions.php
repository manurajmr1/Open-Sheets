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
    case 'save_project_name':
        saveProjectName($_REQUEST);
        break;    
    case 'get_project_details':
        getProjectDetails($_REQUEST);
        break;
    case 'new_project':
        createNewProject();
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
	$sheetDataText  = $data['data_text'];
	$created_by		= $_SESSION['google_data']['email'];


	$temp			= [];
	$dataArray		= [];
	$dataTextArray  = [];
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

	foreach($sheetDataText as $item){

		$temp['Features'] 				= $item[0];
		$temp['Notes']	  				= $item[1];
		$temp['Code_and_Unit_Testing']  = $item[2];
		$temp['Design']   				= $item[3];
		$temp['Testing_and_Debugging']  = $item[4];
		$temp['BA']       				= $item[5];
		$temp['Total']    				= $item[6];
		$temp['Buffered'] 				= $item[7];
		$temp['Effort']   				= $item[8];

		$dataTextArray[]				= $temp;
	}

	$dataArray = json_encode($dataArray);

	//$deleteSql    = "DELETE FROM fingent_project_sheet_data WHERE sheet_id = $sheet_id";

	$selectSql  = "SELECT id FROM fingent_project_sheet_data WHERE sheet_id = $sheet_id";
	$query      = mysql_query($selectSql);
	if(mysql_num_rows($query) > 0){
		$updateSql  = "UPDATE fingent_project_sheet_data SET data = '$dataArray',data_text= '$sheetDataText',updated_by = '$created_by',updated_on = NOW() WHERE sheet_id = $sheet_id";
		mysql_query($updateSql);

	}else{
		$insertSql 	= "INSERT INTO fingent_project_sheet_data (sheet_id,data,data_text,created_by,created_on) VALUES('$sheet_id','$dataArray','$sheetDataText','$created_by',NOW())";
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

	$sql 	= "SELECT fps.sheet_name,fpsd.data FROM fingent_project_sheet_data fpsd INNER JOIN fingent_project_sheets fps ON fps.id = fpsd.sheet_id WHERE fpsd.sheet_id = $sheet_id ";
	$query 	= mysql_query($sql);
	if(mysql_num_rows($query) > 0){
		$result = mysql_fetch_assoc($query);
		if($type == "edit"){
			$sheetDatas   = json_decode($result['data'],true);
			$sheetDataArray = [];
			foreach($sheetDatas as $sheetData){		
				$sheetDataArray[] = array_values($sheetData);
			}
			$returnArray['datas'] 	= $sheetDataArray;
			$returnArray['sheet_name'] = $result['sheet_name']; 
			echo json_encode($returnArray);exit;
		}else{
			echo $result['data'];exit; 
		}	
	}else{
		echo "";exit;
	}
}

function saveProjectName($data){
	$project_id   = $data['project_id'];
	$project_name = $data['project_name'];

	$sql = "UPDATE fingent_projects SET project_name = $project_name WHERE project_id = $project_id";
	mysql_query($sql);
	echo "success";exit;

}

function getProjectDetails($data){
	$project_id   = $data['project_id'];

	$sql = "SELECT * FROM fingent_projects WHERE id = $project_id";
	$query = mysql_query($sql);
	$result = mysql_fetch_assoc($query);
	echo json_encode($result);exit;
}

function createNewProject(){

	$created_by = $_SESSION['google_data']['email'];
	$insertSql = "INSERT INTO fingent_projects (project_name,created_by,created_on) VALUES('Untitled','$created_by',NOW())";
	mysql_query($insertSql);
	$project_id = mysql_insert_id();

	$insertSql1 = "INSERT INTO fingent_project_sheets (project_id,sheet_name,created_by,created_on) VALUES('$project_id','sheet 1','$created_by',NOW())";
	mysql_query($insertSql1);
	/*$sheet_id = mysql_insert_id();
	$returnArray['project_id'] 		= $project_id;
	$returnArray['project_name'] 	= 'Untitled';
	$returnArray['sheet_id']        = $sheet_id;
	$returnArray['sheet_name']		= 'sheet 1';*/

	header("location:index.php?project_id=$project_id");

}
?>