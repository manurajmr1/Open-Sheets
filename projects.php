<!DOCTYPE html>
<html lang="en">
<head>
<title> Fingent sheets</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<!-- Bootstrap Core CSS -->
<link href="css/custom/bootstrap.min.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="css/custom/one-page-wonder.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
<link rel="stylesheet" href="css/custom/style.css">
<style type="text/css">
body
{
color:#337ab7;
}
.header-class{
background-color:white;
color:black;
}
.jumbotron
{
background-color:white;
height:auto;
}
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}

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
.section-title{
	margin-left: 30px;
	color: #394242;
	font-weight:bold;
}

</style>
</head>
<?php 
include('config.php');

date_default_timezone_set("Asia/Kolkata");
$today           = date('Y-m-d');
$loggedUserEmail = "chinchu.kurian@fingent.com";
$sql    		 = "SELECT * FROM fingent_projects ORDER BY created_on DESC"; 
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
<body>
    <!-- Navigation -->
    <nav class="navbar  navbar-fixed-top header-class" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
               <a class="navbar-brand" href="#">Fingent sheets </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
<!--repeation ends-->
<hr>
<div style="margin:50px"></div>
<div class="container" >
	<div class="" style="float:right"> 
		<a class="btn btn-primary" >Create Project</a>
	</div>

<?php if(count($projects) > 0){?>
	<?php if(isset($projects['today'])){?>

	<div class="container" >
		<div class="" style="margin: 20px 0px 20px 0px;"> 
		<div>
			<span class="section-title"><b>Today</b></span>
		</div>
		<?php foreach($projects['today'] as $project){?>    
	    	<div class="projects-div" >	
	 	  		<a href="view.php?project_id=<?php echo $project['id'];?>" class="projects"><i class="fa fa-bars"></i> <?php echo $project['project_name'];?></a>
	 	  		<div style="float:right;"><?php echo date("Y-m-d",strtotime($project['created_on']));?></div>		
	 	  	</div>	
		<?php }?>
		</div>
	</div>
	<?php }?>
	<?php if(isset($projects['earlier'])){?>

	<div class="container">
		<div class="" style="margin: 20px 0px 20px 0px;">
		<?php if(isset($projects['today']) && isset($projects['earlier'])){?>
			<div>
				<span class="section-title"><b>Earlier</b></span>
			</div>
		<?php }?>
		
		<?php foreach($projects['earlier'] as $project){?>
		<div class="projects-div">	
	 	  	<a href="view.php?project_id=<?php echo $project['id'];?>" class="projects"><i class="fa fa-bars"></i> <?php echo $project['project_name'];?></a>
	 	  	<div style="float:right;"><?php echo date("Y-m-d",strtotime($project['created_on']));?></div>	
 	  	</div>
		<?php }?>
		
		</table>
		</div>
	</div>
	<?php }?>
<?php }else{?>
	<div class="container" >No projects</div>
<?php }?>
</div>
</body>

</head>
