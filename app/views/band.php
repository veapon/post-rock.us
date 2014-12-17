<?php include app_path().'/views/header.php'; ?>
<body>
	<div class="wrapper">
		<div class="main opacity-container">
			<div class="opacity-bg"></div>
			<div class="detail">
				<h1 class="title">
					<?php echo $data->name; ?>
				</h1>
				<p>
					<img class="band-cover" src="<?php echo Config::get('app.picHost').$data->cover; ?>" alt="<?php echo $data->name;?>">
				</p>
				<p class="detail-meta">
					<span class="meta-label">Links: </span>
					<?php
					if ($data->homepage) {
						echo '
							<a href="'.$data->homepage.'" target="_blank" class="band-link">Official Site</a>
						';
					}
					if ($data->facebook) {
						echo '
							<a href="'.$data->facebook.'" target="_blank" class="band-link">Facebook</a>
						';
					}
					if ($data->bandcamp) {
						echo '
							<a href="'.$data->bandcamp.'" target="_blank" class="band-link">Bandcamp</a>
						';
					}
				?>
				</p>
				<?php
				if ($data->profile) {
						echo '<p class="band-profile">'.$data->profile.'</p>';
				}
				?>
				
			</div>
						
		</div>		
	</div>
	<script src="http://cdn.staticfile.org/jquery/2.1.1-rc2/jquery.min.js"></script>
	<script src="http://cdn.staticfile.org/twitter-bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>
