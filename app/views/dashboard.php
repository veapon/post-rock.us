<!DOCTYPE html>
<html lang="en">
<head>
	<title>Dashboard</title>
	<?php include app_path().'/views/header.php'; ?>	
</head> 
<body>
	<?php include app_path().'/views/banner.php'; ?>	
	<div class="wrapper paper">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Hello, <?php echo $user->email; ?></h3>
			</div>
			<div class="panel-body">
				<a class="btn btn-default btn-sm" href="<?php echo url('band/create');?>">Add a band</a>
				<a class="btn btn-default btn-sm" href="<?php echo url('album/create');?>">Add an album</a>
			</div>
		</div>
	</div>
	<script src="http://cdn.staticfile.org/jquery/2.1.1-rc2/jquery.min.js"></script>
</body>
</html>
