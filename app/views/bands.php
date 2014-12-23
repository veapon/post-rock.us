<!DOCTYPE html>
<html lang="en">
<head>
	<title>Bands</title>
	<?php include app_path().'/views/header.php'; ?>	
</head>
<body>
	<?php include app_path().'/views/banner.php'; ?>
	<div class="wrapper">
		<article class="main band-list">
			<?php
			foreach ($data as $row):

				$links = '';
				if ($row->homepage) {
					$links .= '
						<a href="'.$row->homepage.'" target="_blank" class="band-link" title="Official Site"><i class="fa fa-home"></i></a>
					';
				}
				if ($row->facebook) {
					$links .= '
						<a href="'.$row->facebook.'" target="_blank" class="band-link" title="Facebook"><i class="fa fa-facebook"></i></a>
					';
				}
				if ($row->twitter) {
					$links .= '
						<a href="'.$row->twitter.'" target="_blank" class="band-link" title="Twitter"><i class="fa fa-twitter"></i></a>
					';
				}
				if ($row->soundcloud) {
					$links .= '
						<a href="'.$row->soundcloud.'" target="_blank" class="band-link" title="SoundCloud"><i class="fa fa-soundcloud"></i></a>
					';
				}
				if ($row->bandcamp) {
					$links .= '
						<a href="'.$row->bandcamp.'" target="_blank" class="band-link" title="Bandcamp"><i class="fa fa-bold"></i></a>
					';
				}
				if ($links) {
					$links = '<p class="entry-meta">'.$links.'</p>';
				}
				echo '
					<div class="band-entry opacity-container row">
						<div class="opacity-bg"></div>
						<div class="col-md-6 col-cover">
							<a href="'.url('band/'.$row->id).'">
								<img src="'.Config::get('app.picHost').'/band/'.$row->id.'.jpg" class="img-responsive band-cover" alt="'.$row->name.'">
							</a>
						</div>

						<div class="col-md-6">
							<h3 class="entry-title"><a href="'.url('band/'.$row->id).'">'.$row->name.'</a></h3>
							'.$links.'
							<p class="entry-meta">
								<span class="meta-label">Region: </span>
								<a href="'.action('BandController@index', array('region'=>$row->region)).'">'.$row->region.'</a>
							</p>
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
