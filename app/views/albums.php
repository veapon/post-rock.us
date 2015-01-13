<!DOCTYPE html>
<html lang="en">
<head>
	<title>Albums</title>
	<?php include app_path().'/views/header.php'; ?>	
</head>
<body>
	<?php include app_path().'/views/banner.php'; ?>
	<div class="wrapper">			
		<article class="main entry-list">
			<?php
			foreach ($data as $row):

				echo '
					<div class="album-entry row opacity-container">
						<div class="opacity-bg"></div>
						<div class="col-md-4 col-cover">
							<a href="'.url('album/'.$row->album_id).'">
								<img src="'.Config::get('app.picHost').'/album/'.$row->album_id.'.jpg" class="img-responsive" alt="'.$row->album_name.'">
							</a>
						</div>

						<div class="col-md-8">
							<h3 class="entry-title"><a href="'.url('album/'.$row->album_id).'">'.$row->album_name.'</a></h3>
							<p class="entry-meta">
								By: '.$row->bands.'
							</p>
							<p class="entry-meta">
								Release: '.$row->release_date.'
							</p>
							<div class="tracks">
								'.str_replace("\n", "<br>", $row->tracks).'
							</div>
						</div>
					</div>
				';
			endforeach;

			echo '<div class="pager-wrapper">'.$data->links().'</div>';
			?>
		</article>
	</div>
	<script src="http://cdn.staticfile.org/jquery/2.1.1-rc2/jquery.min.js"></script>
	<script src="http://cdn.staticfile.org/twitter-bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>
