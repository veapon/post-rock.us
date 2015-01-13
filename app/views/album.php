<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $data['album_name'];?></title>
	<?php include app_path().'/views/header.php'; ?>	
</head>
<body>
	<?php include app_path().'/views/banner.php'; ?>
	<div class="wrapper">
		<div class="row detail opacity-container">
			<div class="opacity-bg"></div>
			<div class="col-md-4">
				<img src="<?php echo Config::get('app.picHost').'/album/'.$data['album_id'].'.jpg'; ?>" alt="<?php echo $data['album_name'];?>" class="img-responsive cover" id="cover">				
			</div>
			<div class="col-md-8">
				<h1 class="title">
					<?php echo $data['album_name']; ?>
				</h1>
				<p class="meta">
					<span class="fa fa-users"></span>
					<?php 
					$html = '';
					foreach($data['bands'] as $v) {
						$html .= ' <a class="band" href="'.url('band/'.$v['id']).'">'.$v['name'].'</a> /';
					}
					echo trim($html, '/');
					?>

				</p>
				<p class="meta" title="Release date">
					<span class="fa fa-calendar"></span>
					<?php echo $data['release_date']; ?>
				</p>
				<div class="tracks">
					<b>Tracks:</b><br>
					<?php echo str_replace("\n", "<br>", $data['tracks']); ?>
				</div>
				<?php
				if ( ($user = Sentry::getUser()) && $user->hasAccess('album')) {
					echo '<p style="margin-top: 10px;"><a href="'.url('album/update/'.$data['album_id']).'" title="Update profile"><i class="fa fa-edit"></i></a></p>';
				}
				?>
			</div>				
		</div>		
	</div>
	<script src="http://cdn.staticfile.org/jquery/2.1.1-rc2/jquery.min.js"></script>
	<script src="http://cdn.staticfile.org/twitter-bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>
