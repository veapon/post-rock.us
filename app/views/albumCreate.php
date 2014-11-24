<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Index</title>
	<link rel="stylesheet" href="http://cdn.staticfile.org/twitter-bootstrap/3.2.0/css/bootstrap.min.css">
	<style>
		body{
			background: url('<?php echo url();?>/bg.jpg') no-repeat bottom right fixed;
		}
		
		.paper{
			background: #FFF;
			padding: 40px 20px;
			border-radius: 4px;
		}

		.wrapper{
			width: 768px;
			margin: 0 auto;
		}

		.main{
			margin-top: 90px;
		}
		.entry{
			margin-bottom: 120px;
		}

		.entry, .entry-title, .entry-link{
			color: #FFF;
		}

		.form .cover{
			min-height: 160px;
			max-width: 360px;
		}

		.width-half{
			width: 50%;
		}
	</style>
</head>
<body>
	<div class="wrapper">
		<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="container">

			</div>
		</nav><!-- 
		<article class="main entry-list">
			<div class="entry row">

				<div class="col-md-6">
					<img src="http://doing.ws/wp-content/uploads/2014/09/s4406956.jpg" class="img-responsive" alt="Responsive image">
				</div>

				<div class="col-md-6">
					<h3>Rain Ep</h3>
					<p><a href="#" class="entry-link">Circadian Eyes</a></p>
				</div>
			</div>
			
			<div class="entry row">

				<div class="col-md-6">
					<img src="http://doing.ws/wp-content/uploads/2014/02/s9071230.jpg" class="img-responsive" alt="Responsive image">
				</div>

				<div class="col-md-6">
					<h3>Weathered (Wayside And Woodland Recordings, 2012) </h3>
					<p><a href="#" class="entry-link">Epic45</a></p>
				</div>
			</div>

			<div class="entry row">

				<div class="col-md-6">
					<img src="http://doing.ws/wp-content/uploads/2014/09/s4406956.jpg" class="img-responsive" alt="Responsive image">
				</div>

				<div class="col-md-6">
					<h3>Rain Ep</h3>
					<p><a href="#" class="entry-link">Circadian Eyes</a></p>
				</div>
			</div>

			<div class="entry row">

				<div class="col-md-6">
					<img src="http://doing.ws/wp-content/uploads/2014/09/s4406956.jpg" class="img-responsive" alt="Responsive image">
				</div>

				<div class="col-md-6">
					<h3>Rain Ep</h3>
					<p><a href="#" class="entry-link">Circadian Eyes</a></p>
				</div>
			</div>
		</article>	 -->

		<!-- <article class="main entry-detail">
			<div class="row">
				<div class="col-md-3">
					<img src="http://doing.ws/wp-content/uploads/2014/09/s4406956.jpg" class="img-responsive" alt="Responsive image">
				</div>

				<div class="col-md-9">
					<h3>Rain Ep</h3>
					<p><a href="#" class="entry-link">Circadian Eyes</a></p>
				</div>
			</div>
		</article> -->

		<div class="main form">
			<form role="form" class="paper" method="post">
				<div class="row">
					<div class="col-md-3">
						<img data-src="holder.js/100%x100%/text:Cover" alt="Cover" class="img-responsive img-thumbnail cover" id="cover">
						<input name="cover" id="txtCover" type="hidden" />
					</div>
					<div class="col-md-9">
						<div class="form-group">
							
							<div class="input-group">
								<div class="input-group-btn">
									<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">163<span class="caret"></span></button>
									<ul class="dropdown-menu" role="menu">
										<li><a href="javascript:;">163</a></li>
									</ul>
								</div><!-- /btn-group -->
								<input type="text" class="form-control" id="txtApi" placeholder="Album id">

								<span class="input-group-btn">
							        <button class="btn btn-default" type="button" id="btnApi">Get!</button>
							    </span>
							</div><!-- /input-group -->
						</div>

						<div class="form-group">
							<input id="txtArtist" type="text" class="form-control width-half" name="artist" placeholder="Artist">						
						</div>

						<div class="form-group">
							<input id="txtAlbum" type="text" class="form-control width-half" name="album" placeholder="Album">						
						</div>

						<div class="form-group">
							<input id="txtDate" type="text" class="form-control width-half" name="release" placeholder="Release date">						
						</div>

						<div class="form-group">
							<textarea id="txtSongs" class="form-control" rows="6" name="tracks" style="resize: vertical" placeholder="Tracks. One track per line."></textarea>					
						</div>
						<div class="form-group">
						<?php 
							if (isset($countries['AF'])) {
								echo '<select class="form-control width-half" name="region"><option value="0">Country/Region</option>';
								foreach ($countries as $v) {
									echo '<option value="'.$v.'">'.$v.'</option>';
								}
								echo '</select>';
							}
						?>
						</div>

						<div class="form-group">
							<button type="submit" class="btn btn-default">Submit</button>
						</div>
					</div>
				</div>
				
				
			</form>
		</div>		
	</div>

	<script src="http://cdn.staticfile.org/jquery/2.1.1-rc2/jquery.min.js"></script>
	<script src="http://cdn.staticfile.org/twitter-bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<script src="http://cdn.staticfile.org/holder/2.4.1/holder.js"></script>

<script>
$(function(){
	$('#btnApi').click(function(){
		var id = $('#txtApi').val();
		if (!id) {
			alert('Album id is required');
			return;
		}
		$.get('<?php echo url("spider"); ?>/album/'+id, function(res){
			if (res['status'] == 0) {
				return false;
			}
			
			$('#cover').attr('src', res['data']['cover']);
			$('#txtCover').val(res['data']['cover']);
			$('#txtAlbum').val(res['data']['name']);
			$('#txtDate').val(new Date(res['data']['releaseTime']).toDateString());

			// artists
			var strArtist = '';
			for (i in res['data']['artist']) {
				strArtist += ',' + res['data']['artist'][i]['name'];
			}
			$('#txtArtist').val(strArtist.substr(1));

			// songs
			var strSongs = '';
			for (i in res['data']['songs']) {
				strSongs += (i-0+1) + '. ' + res['data']['songs'][i]['name'] + "\n";
			}
			$('#txtSongs').val(strSongs);
		})
	})			
})
</script>
</body>
</html>
