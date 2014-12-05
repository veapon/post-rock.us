<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Index</title>
	<link rel="stylesheet" href="http://cdn.staticfile.org/twitter-bootstrap/3.2.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo url('assets/css');?>/pr.css">
</head>
<body>
	<div class="wrapper">
		<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="container">

			</div>
		</nav>
		<div class="main">
			<div class="row paper detail">
				<div class="col-md-3">
					<img src="<?php echo Config::get('app.picHost').$data->album_cover; ?>" alt="<?php echo $data->album_name;?>" class="img-responsive img-thumbnail cover" id="cover">
				</div>
				<div class="col-md-9">
					<h1 class="title">
						<?php echo $data->album_name; ?>
					</h1>
					<p class="meta">
						<span class="glyphicon glyphicon-user"></span>
						<?php echo $data->artist_name; ?>
					</p>
					<p class="meta">
						<span class="glyphicon glyphicon-calendar"></span>
						<?php echo $data->release_date; ?>
					</p>
					<div class="tracks">
						<p><b>Tracks:</b></p>
						<?php echo str_replace("\n", "<br>", $data->tracks); ?>
					</div>
				</div>
			</div>
				
		</div>		
	</div>
	<script src="http://cdn.staticfile.org/jquery/2.1.1-rc2/jquery.min.js"></script>
	<script src="http://cdn.staticfile.org/twitter-bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>
