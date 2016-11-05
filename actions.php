<?php 
include("config.php");
$action = $_POST['action'];
switch ($action) {
    case 'get_sheets':
        getSheets($_POST);
        break;   
    case 'add_sheet':
        addSheet($_POST);
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
?>