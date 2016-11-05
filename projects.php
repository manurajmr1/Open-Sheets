<?php 
include('config.php');
include('validate_token.php');
date_default_timezone_set("Asia/Kolkata");
$today           = date('Y-m-d');
$loggedUserEmail = $_SESSION['google_data']['email'];
$sql    		 = "SELECT fp.id,fp.project_name,fp.created_by,fp.created_on FROM fingent_projects fp LEFT JOIN fingent_project_sheet_shared_users fpss ON fp.id = fpss.project_id 
					WHERE fp.created_by = '$loggedUserEmail' OR fpss.shared_email = '$loggedUserEmail' ORDER BY fp.created_on DESC"; 
$query 		     = mysql_query( $sql, $conn );
$projects			 = [];
while($row = mysql_fetch_assoc($query)){
	if(date("Y-m-d", strtotime($row['created_on'])) == $today){
		$projects['today'][]    = $row;
	}else{
		$projects['earlier'][]  = $row;
	}
	
}
	
?>
<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Basic Header</title>

	<link rel="stylesheet" href="css/custom/demo.css">
	<link rel="stylesheet" href="css/custom/header-basic.css">
	<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
	<link href='http://fonts.googleapis.com/css?family=Cookie' rel='stylesheet' type='text/css'>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<style type="text/css">
	.projects-div {
		border:1px solid #CDCDCD;
		margin:10px 30px 10px 30px;
		padding:10px;
		background-color:white;
	}
	.projects{
	  text-decoration: none;
	  font-weight: bold;
	  color: #394242;
	}
	.header-title{
		color:white !important;
		font-size:20px !important;
		float:left;
	}
	.email-title{
		color:white;
		float:right !important;
	}
	</style>

</head>

	<body>

		<header class="header-basic">

			<!-- <div class="header-limiter">
				<nav>
					<a href="#" style="float:left">Fingent Sheets</a>					
				</nav>
			</div> -->
			<a class="header-title" href="projects.php">Fingent Sheets</a>
			<span class="email-title" ><?php echo $_SESSION['google_data']['email'];?> | <a href="logout.php" style="color:white;text-decoration:none;">Logout</a></span>
		</header>

		<!-- The content of your page would go here. -->
		<div class="" style="float:right;margin-right: 85px;margin-top: 5px;"> 
			<a class="btn btn-primary" href="actions.php?action=new_project">New Project</a>
		</div>
		<div style="margin:50px;padding:5px;">
			<?php if(count($projects) > 0){?>
				<?php if(isset($projects['today'])){?>
					<span style="margin-left:30px;"><b>Today</b></span>
					<?php foreach($projects['today'] as $project){?>
					<div class="projects-div">
					<a href="index.php?project_id=<?php echo $project['id'];?>" class="projects"><i class="fa fa-bars"></i> <?php echo $project['project_name'];?></a>
					<div style="float:right;"><?php echo date("Y-m-d",strtotime($project['created_on']));?></div>		
					</div>
					<?php }?>
				<?php }?>
				<?php if(isset($projects['earlier'])){?>
					<?php if(isset($projects['today']) && isset($projects['earlier'])){?>
					<span style="margin-left:30px;"><b>Earlier</b></span>
					<?php }?>
					<?php foreach($projects['earlier'] as $project){?>
					<div class="projects-div">
					<a href="index.php?project_id=<?php echo $project['id'];?>" class="projects"><i class="fa fa-bars"></i> <?php echo $project['project_name'];?></a>
					<div style="float:right;"><?php echo date("Y-m-d",strtotime($project['created_on']));?></div>		
					</div>
					<?php }?>		

				<?php }?>
			<?php }else{ ?>
				<div style="text-align:center">No Projects.</div>
			<?php }?>
		

		</div>

		<div class="menu">

			

		</div>



		<!-- Demo ads. Please ignore and remove. -->
		<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="http://cdn.tutorialzine.com/misc/enhance/v3.js" async></script>-->

	</body>

</html>
