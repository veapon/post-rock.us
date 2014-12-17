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
		<article class="main entry-list">
			<?php
			foreach ($data as $row):

				echo '
					<div class="entry row">
						<div class="entry-bg"></div>
						<div class="col-md-4 col-cover">
							<a href="'.url('album/'.$row->album_id).'">
								<img src="'.Config::get('app.picHost').$row->album_cover.'" class="img-responsive" alt="'.$row->album_name.'">
							</a>
						</div>

						<div class="col-md-8">
							<h3 class="entry-title"><a href="'.url('album/'.$row->album_id).'">'.$row->album_name.'</a></h3>
							<p class="entry-meta">
								<a href="#">'.$row->artist_name.'</a>
							</p>
							<p class="entry-meta">
								'.$row->release_date.'
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
