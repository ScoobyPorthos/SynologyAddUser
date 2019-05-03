<?php
error_reporting( E_ALL );
function groupandpath($arg)
{
	$res = array();
	foreach ($arg as $value) {
		$group = preg_match("#^([a-zA-Z]+)\/(.+)$#",$value,$matches)?$matches[1]:$value;
			$res[$group][]=$value;
	}
	return $res;
}

$complete = true;

foreach ($_POST as $value) {
	if(empty($value))
		$complete = false;
}

if($complete)
{
	if($_POST['password']==$_POST['password_confirmation'] && $_POST['group']!='none')
	{
			//print_r($_POST);
			$file =fopen("./reg/".uniqid().".txt",'w+');

			$groups = groupandpath($_POST['group']);

			$string = $_POST['login']."|".$_POST['password']."|".$_POST['first_name']." ".$_POST['last_name']."|0|".$_POST['email']."|100\n"; // update for the right Group !
			foreach ($groups as $group=>$path) {
				$string.=$_POST['login']."|".$group."|".$_POST['first_name']." ".$_POST['last_name']."|".implode(',',$path)."\n";
			}
			fwrite($file,$string);
			fclose($file);
			unset($_POST);
			$msg = '<div class="alert alert-success" role="alert">
						Your request has beed taken. Your account will be activated within 24h. <br/>
						If you need a prompt access, email the person responsable ! (it is not GUS !) <br/>
						<a href="../"> Back to How to connect to the NAS</a>
					</div>';
	}
	elseif ($_POST['group']=='none') {
		$msg = '<div class="alert alert-danger" role="alert">
					You need to specify a group project.
					<a href="./"> Back </a>
				</div>';
	}
	else {
		$msg = '<div class="alert alert-danger" role="alert">
						Your password does not match ! <a href="./"> Back </a>
					</div>';
	}

}
else {
	$msg = '<div class="alert alert-danger" role="alert">
						All fields are required ! <a href="./"> Back </a>
					</div>';
}
?>
<html>
	<head>
		<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	</head>
	<body>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<!------ Include the above in your HEAD tag ---------->

		<div class="container">

		<div class="row">
			<br/><br/><br/><br/>
		    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
				<?php echo $msg; ?>
			</div>
		</div>
		</div>
	</body>
</html>
