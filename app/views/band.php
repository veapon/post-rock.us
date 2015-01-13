<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $data->name;?></title>
	<?php include app_path().'/views/header.php'; ?>	
</head>
<body>
	<?php include app_path().'/views/banner.php'; ?>
	<div class="wrapper">
		<div class="main opacity-container">
			<div class="opacity-bg"></div>
			<div class="detail">
				<p>
					<img class="band-cover" src="<?php echo $data->cover; ?>" alt="<?php echo $data->name;?>">
				</p>
				<h1 class="band-title">
					<?php echo $data->name; ?>
				</h1>
				<p class="detail-meta">
					<?php
					if ($data->homepage) {
						echo '
							<a href="'.$data->homepage.'" target="_blank" class="band-link" title="Official Site"><i class="fa fa-home"></i></a>
						';
					}
					if ($data->facebook) {
						echo '
							<a href="'.$data->facebook.'" target="_blank" class="band-link" title="Facebook"><i class="fa fa-facebook-square"></i></a>
						';
					}
					if ($data->twitter) {
						echo '
							<a href="'.$data->twitter.'" target="_blank" class="band-link" title="Twitter"><i class="fa fa-twitter"></i></a>
						';
					}
					if ($data->soundcloud) {
						echo '
							<a href="'.$data->soundcloud.'" target="_blank" class="band-link" title="SoundClound"><i class="fa fa-soundcloud"></i></a>
						';
					}
					if ($data->bandcamp) {
						echo '
							<a href="'.$data->bandcamp.'" target="_blank" class="band-link" title="Bandcamp"><i class="fa fa-bold"></i></a>
						';
					}
				?>
				</p>
				<p class="detail-meta">
					<span class="meta-label">Region: </span>
					<?php echo $data->region; ?>
				</p>
				<?php
				if ($data->profile) {
						echo '<p class="band-profile">'.$data->profile.'</p>';
				}

				if ( ($user = Sentry::getUser()) && $user->hasAccess('band')) {
					echo '<p><a href="'.url('band/update/'.$data->id).'" title="Update profile"><i class="fa fa-edit"></i></a></p>';
				}
				?>
				
			</div>
						
		</div>		
	</div>
	<script src="http://cdn.staticfile.org/jquery/2.1.1-rc2/jquery.min.js"></script>
	<script src="http://cdn.staticfile.org/twitter-bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>
