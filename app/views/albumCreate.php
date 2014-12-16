<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Index</title>
	<link rel="stylesheet" href="http://cdn.staticfile.org/twitter-bootstrap/3.2.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://cdn.staticfile.org/bootstrap-datepicker/1.2.0/css/datepicker.min.css">
	<link rel="stylesheet" href="<?php echo url('assets/css');?>/pr.css">
</head>
<body>
	<div class="wrapper">
		<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="container">

			</div>
		</nav>
		<div class="main form">
			<form role="form" class="paper" method="post">
				<div class="row">
					<div class="col-md-3">
						<div class="btn-upload">						
							<img data-src="holder.js/100%x100%/text:Cover" alt="Cover" class="img-responsive img-thumbnail cover" id="cover">
							<input name="cover" id="txtCover" type="hidden" />
							<input id="fileupload" type="file" name="file" class="file-upload">
						</div>
					</div>
					<div class="col-md-9">
						<div class="form-group width-half">
							
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

						<div class="form-group width-half">
							<div class="input-group">
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-user"></span>
								</span>
								<input id="txtArtist" type="text" class="form-control" name="artist" placeholder="Artist">	
							</div>												
						</div>

						<div class="form-group width-half">
							<div class="input-group">
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-file"></span>
								</span>
								<input id="txtAlbum" type="text" class="form-control" name="album" placeholder="Album">	
							</div>
												
						</div>

						<div class="form-group width-half">
							<div class="input-group">
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
								<input id="txtDate" type="text" class="form-control" name="release" placeholder="Released"  data-date-format="yyyy-mm-dd">
							</div>													
						</div>
						
						<div class="form-group width-half">
							<div class="input-group">
								<span class="input-group-addon">									
									<span class="glyphicon glyphicon-globe"></span>
								</span>								
								<?php 
									if (isset($countries['AF'])) {
										echo '<select class="form-control" name="region"><option value="0">Country/Region</option>';
										foreach ($countries as $v) {
											echo '<option value="'.$v.'">'.$v.'</option>';
										}
										echo '</select>';
									}
								?>
							</div>
						</div>

						<div class="form-group">
							<label for="txtSongs">Tracks</label>
							<textarea id="txtSongs" class="form-control" rows="6" name="tracks" style="resize: vertical" placeholder="One track per line"></textarea>	
						</div>

						<!-- <div class="form-group">
							<label for="txtLinks">Links</label>
							<textarea id="txtLinks" class="form-control" rows="3" name="tracks" style="resize: vertical" placeholder="Markdown is supported"></textarea>	
						</div> -->

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
	<script src="<?php echo url();?>/assets/js/jquery.ui.widget.js"></script>
	<script src="<?php echo url();?>/assets/js/jquery.fileupload.js"></script>
	<script src="http://cdn.staticfile.org/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
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

	$('#fileupload').fileupload({
        url: '<?php echo url("album/upload"); ?>',
        dataType: 'json',
        done: function (e, data) {      	
            $('#txtCover').val(data.result.url);
            $('#cover').attr('src', data.result.url);
        }
    })		

    $('#txtDate').datepicker({autoclose: true});
})
</script>
</body>
</html>
