<!DOCTYPE html>
<html lang="en">
<head>
	<title>
		<?php
			if (isset($data['id'])) {
				echo 'Album/update';
			} else {
				echo 'Album/create';
			}
		?>
		
	</title>
	<?php include app_path().'/views/header.php'; ?>	
	<link rel="stylesheet" href="http://cdn.staticfile.org/ladda-bootstrap/0.1.0/ladda-themeless.min.css">
	<link rel="stylesheet" href="http://cdn.staticfile.org/bootstrap-datepicker/1.2.0/css/datepicker.min.css">
</head> 
<body>
	<?php include app_path().'/views/banner.php'; ?>	
	<div class="wrapper album-form-wrapper">
		<!-- album-from start -->
		<div class="main form album-from" id="albumFormWrapper">
			<form role="form" class="paper" method="post" id="albumForm">
				<div class="from-group">
					<div class="alert alert-danger" role="danger" id="alert" style="display: none;">						
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<div class="btn-upload">
							<?php 
							if (isset($data['album_cover'])) {					
								echo '<img class="cover" id="cover" src="'.$data['album_cover'].'">';
							} else {
								echo '
									<img class="cover" id="cover" style="display:none;">
									<p class="upload-holder" id="albumCoverHolder">COVER</p>
									';
							}
							if (isset($data['album_id'])) {
								echo '<input type="hidden" name="id" value="'.$data['album_id'].'">';
							}
							?>
							<input name="cover" id="txtCover" type="hidden" autocomplete="off"/>
							<input type="file" name="file" class="file-upload">
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
									<i class="fa fa-file-text-o"></i>
								</span>
								<input id="txtAlbum" type="text" class="form-control" name="album" placeholder="Album" value="<?php if(isset($data['album_name'])) echo $data['album_name'];?>" autocomplete="off">	
							</div>
												
						</div>

						<div class="form-group width-half">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</span>
								<input id="txtDate" type="text" class="form-control" name="release" placeholder="Released"  data-date-format="yyyy-mm-dd" value="<?php if(isset($data['release_date'])) echo $data['release_date'];?>" autocomplete="off">
							</div>													
						</div>
						<div class="form-group width-half">
							<div id="selectedBands" class="selected-bands">
								<?php 
								if (isset($data['bands'])) {
									foreach($data['bands'] as $v) {
										echo '<span class="label label-success selected-band">'.$v['name'].' <span class="cancle-select-band" aria-hidden="true">&times;</span></span><input type="hidden" id="txtBand'.$v['id'].'" value="'.$v['id'].'" name="bands[]">';
									}
								}
								?>
								<!-- <span class="label label-success selected-band">Success <span class="cancle-select-band" aria-hidden="true">&times;</span></span> -->
							</div>
							<div class="input-group dropdown">
								<span class="input-group-addon">
									<i class="fa fa-users"></i>
								</span>
								<input id="txtBand" type="text" class="form-control" name="artist" placeholder="Band" autocomplete="off">	
								<ul class="dropdown-menu band-suggest-result" role="menu">
										
								</ul>								
							</div>												
						</div>

						<div class="form-group">
							<label for="txtSongs">Tracks</label>
							<textarea id="txtSongs" class="form-control" rows="6" name="tracks" style="resize: vertical" placeholder="One track per line" autocomplete="off"><?php if(isset($data['tracks'])) echo $data['tracks'];?></textarea>	
						</div>

						<div class="form-group">
							<button data-style="expand-right" class="btn btn-primary ladda-button" data-size="s" id="btnSubmit"><span class="ladda-label">Submit</span><span class="ladda-spinner"></span></button>
						</div>
					</div>
				</div>			
			</form>
		</div>
		<!-- album-from end -->
		
		<!-- band-from start -->
		<div class="main form band-form" id="bandFormWrapper">
			<form role="form" class="paper" method="post" id="bandForm">
				<div class="from-grup">
					<div class="alert alert-danger" role="danger" id="alert" style="display: none;">						
					</div>
				</div>
				<div class="form-group">
					<div class="btn-upload" style="text-align: center;">
						<p class="upload-holder" id="bandCoverHolder">COVER</p>
						<img src="" class="cover band-cover" id="bandCover" style="display:none;">				
						<input name="poster" id="txtBandCover" type="hidden" />
						<input type="file" name="bandFile" class="file-upload">
					</div>
				</div>	

				<div class="form-group">
					<div class="input-group col-md-7">
						<span class="input-group-addon">
							<i class="fa fa-users"></i>
						</span>
						<input id="txtBand2" type="text" class="form-control" name="name" placeholder="Band name" required autocomplete="off">	
					</div>												
				</div>

				<div class="form-group">
					<div class="input-group col-md-7">
						<span class="input-group-addon">
							<i class="fa fa-home"></i>
						</span>
						<input id="txtSite" type="url" class="form-control" name="homepage" placeholder="Official site" autocomplete="off">	
					</div>												
				</div>	

				<div class="form-group">
					<div class="input-group col-md-7">
						<span class="input-group-addon">
							<i class="fa fa-facebook"></i>
						</span>
						<input id="txtFacebook" type="url" class="form-control" name="facebook" placeholder="Facebook" autocomplete="off">	
					</div>												
				</div>		
				<div class="form-group">
					<div class="input-group col-md-7">
						<span class="input-group-addon">
							<i class="fa fa-twitter"></i>
						</span>
						<input id="txtTwitter" type="url" class="form-control" name="twitter" placeholder="Twitter" autocomplete="off">	
					</div>												
				</div>	
				<div class="form-group">
					<div class="input-group col-md-7">
						<span class="input-group-addon">
							<i class="fa fa-soundcloud"></i>
						</span>
						<input id="txtSoundcloud" type="url" class="form-control" name="soundcloud" placeholder="Soundcloud" autocomplete="off">	
					</div>												
				</div>	

				<div class="form-group">
					<div class="input-group col-md-7">
						<span class="input-group-addon">
							<i class="fa fa-bold"></i>
						</span>
						<input id="txtBandcamp" type="url" class="form-control" name="bandcamp" placeholder="Bandcamp" autocomplete="off">	
					</div>												
				</div>	

				<div class="form-group">
					<div class="input-group col-md-7">
						<span class="input-group-addon">									
							<span class="fa fa-globe"></span>
						</span>								
						<?php 
							if (isset($countries['AF'])) {
								echo '<select class="form-control" name="region" required autocomplete="off"><option value="">Country/Region</option>';
								foreach ($countries as $v) {
									echo '<option value="'.$v.'">'.$v.'</option>';
								}
								echo '</select>';
							}
						?>
					</div>
				</div>
				
				<div class="form-group">
					<label for="txtProfile">Profile</label>
					<textarea id="txtProfile" class="form-control" name="profile" style="resize: vertical; height: 160px;" autocomplete="off"></textarea>
				</div>

				<div class="form-group">
					<!-- <button type="submit" class="btn btn-primary ladda-button" id="btnSubmit" data-style="expand-right"><span class="ladda-label">Submit</span></button> -->
					<button data-style="expand-right" class="btn btn-primary ladda-button" data-size="s" id="btnBandSubmit"><span class="ladda-label">Submit</span><span class="ladda-spinner"></span></button>
					<button class="btn btn-default" id="btnBandCancle" type="button">Cancle</button>
				</div>

			</form>
		</div>	
		<!-- band-from end -->		
	</div>
	<script src="http://cdn.staticfile.org/jquery/2.1.1-rc2/jquery.min.js"></script>
	<script src="http://cdn.staticfile.org/twitter-bootstrap/3.2.0/js/bootstrap.min.js"></script>

	<script src="<?php echo url();?>/assets/js/jquery.ui.widget.js"></script>
	<script src="<?php echo url();?>/assets/js/jquery.fileupload.js"></script>
	<script src="http://cdn.staticfile.org/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
	<script src="http://cdn.staticfile.org/ladda-bootstrap/0.1.0/spin.min.js"></script>
	<script src="http://cdn.staticfile.org/ladda-bootstrap/0.1.0/ladda.min.js"></script>	
<script>
$(function(){
	$('#btnSubmit').removeAttr('disabled');
	$('#txtDate').datepicker({autoclose: true});

	// btnApi click start
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
			
			$('#albumCoverHolder').hide();
			$('#cover').attr('src', res['data']['cover']).show();
			$('#txtCover').val(res['data']['cover']);
			$('#txtAlbum').val(res['data']['name']);
			$('#txtDate').val(new Date(res['data']['releaseTime']).toDateString());

			// songs
			var strSongs = '';
			for (i in res['data']['songs']) {
				strSongs += (i-0+1) + '. ' + res['data']['songs'][i]['name'] + "\n";
			}
			$('#txtSongs').val(strSongs);

			// artists
			var strArtist = '';
			for (i in res['data']['artist']) {
				strArtist += ',' + res['data']['artist'][i]['name'];
			}
			$('#txtBand').val(strArtist.substr(1)).focus();
		})
	})	
	// btnApi click end

	// fileupload start
	$('.file-upload').each(function(){
		var field = $(this).attr('name');
		$(this).fileupload({
	        url: '<?php echo url("upload/tmp"); ?>?field='+field,
	        dataType: 'json',
	        done: function (e, data) {
	        	if (data.result.field == 'file') {
	        		$('#txtCover').val(data.result.url);
	 				$('#albumCoverHolder').hide();
	            	$('#cover').attr('src', data.result.url).show();
	        	} else if (data.result.field == 'bandFile') {
	        		$('#txtBandCover').val(data.result.url);
	 				$('#bandCoverHolder').hide();
	            	$('#bandCover').attr('src', data.result.url).show();
	        	}
	            
	            $('.btn-upload').css('border', 'none');
	        }
	    })
	})		
    // fileupload end

    // search start
    // 表演者下拉列表事件
	$('.band-suggest-result').on('keyup', function(evt){
		var menuitem = $('.suggest_item');
		var curt_focus = $('.suggest_item a:focus').parent('li').index();

		// up键事件
		if( evt.keyCode == 38 )
		{
			if( curt_focus > 0 )
			{
				menuitem.eq(curt_focus-1).find('a').focus();
			}
			else if( curt_focus ==0 )
			{
				$('#txtBand').focus();
			}

		}
		// down 键
		else if( evt.keyCode == 40 )
		{
			
			if( curt_focus == menuitem.length - 1 )
			{
				menuitem.first().find('a').focus();
			}
			else if( curt_focus >= 0 )
			{
				menuitem.eq(curt_focus-0+1).find('a').focus();
			}				
		}
		// 回车
		else if( evt.keyCode == 13 )
		{
			select_item(menuitem.eq(curt_focus).data());
			hide_menu();
		}
		// ESC
		else if( evt.keyCode == 27 )
		{
			hide_menu();
		}

		return false;
	})

	// Band search start
	$('#txtBand').on('input', function(evt){
		
		var key = $.trim($(this).val());
		if( !key )
		{
			hide_menu();
			$('.band-suggest-result').html('');
			return false;
		} 

		get_suggest(key);

	}).on('focus', function(evt){
		var key = $.trim($(this).val());
		if( !key )
		{
			hide_menu();
			$('.band-suggest-result').html('');
			return false;
		} 

		get_suggest(key);
	}).on('keyup', function(evt){
		var menuitem = $('.suggest_item');
		// down键
		if( evt.keyCode == 40 )
		{
			if( menuitem.length == 0 ) return false;

			var curt_focus = $('.suggest_item a:focus').parent('li').index();
			
			if( curt_focus == -1 )
			{
				menuitem.first().find('a').focus();
			}

			return false;
		}
		else if( evt.keyCode == 27 )
		{
			hide_menu();
		}
	})
	// Band search end

	// remove selected band
	$('body').on('click', '.selected-band', function(){
		$('#txtBand'+$(this).data('id')).remove();
		$(this).remove();
	})

	// album form submit start
    $('#albumForm').on('submit', function(e){
    	e.preventDefault();

    	// validation
	 	if ($('.selected-band').length < 1) {
	 		$('#alert').html('You must select a band.').show();
	 		$('#txtBand').parents('.form-group ').addClass('has-error');
	 		return false;
	 	}
    	
    	var l = Ladda.create(document.querySelector('#btnSubmit'));
	 	l.start();
	 	$('#fileupload').fileupload('disable');

    	var data = $(this).serialize();
    	//console.log(data);
    	$.ajax({
    		url: '<?php if(isset($data["id"])){ echo url("album/update"); }else{ echo url("album/create"); }?>',
    		type: 'post',
    		data: data, 
    		dataType: 'json'
    	}).done(function(res){
    		if (res.status == -1) {
    			$('#alert').html('Band <a href="<?php echo url('band'); ?>/'+res.band.id+'" class="alert-link"><b>'+res.band.name+'</b></a> already exists.').show();
    		} else if(res.status == 0) {
    			var msg = typeof res.msg == 'undefined' ? 'Something went wrong.' : res.msg;
    			$('#alert').html(msg).show();
    		} else if(res.status == 1) {
    			location.href = res.url;
    		}
    	}).always(function(){
    		l.stop();
    		$('#fileupload').fileupload('enable');
    	})
    })
    // album form submit end

    // band form submit start
    $('#bandForm').on('submit', function(e){
    	e.preventDefault();
    	var l = Ladda.create(document.querySelector('#btnBandSubmit'));
	 	l.start();
	 	$('#fileuploadBand').fileupload('disable');

    	var data = $(this).serialize();
    	//console.log(data);
    	$.ajax({
    		url: '<?php echo url("band/create"); ?>',
    		type: 'post',
    		data: data, 
    		dataType: 'json'
    	}).done(function(res){
    		if(res.status == 0) {
    			// failed to create band
    			$('#alert').html('Something went wrong.').show();
    		} else if(res.status == 1 || res.status == -1) {
    			// success
    			$('#bandFormWrapper').fadeOut(100, function(){
    				select_item(res.band);
    			})    			
    		}
    	}).always(function(){
    		l.stop();
    		$('#fileuploadBand').fileupload('enable');
    	})
    })
    // band form submit end
	
	// show band form
    $('body').on('click', '.ln-create-band', function(){
    	hide_menu();
    	$('#txtBand2').val($(this).data('name'));
    	$('#bandFormWrapper').fadeIn(300);
    })

    // hide band form
    $('#btnBandCancle').click(function(e){
    	e.preventDefault();
    	$('#bandFormWrapper').fadeOut(300);
    })
})

function hide_menu()
{
	$('.band-suggest-result').hide();
}

function select_item(band)
{
	// illegal data
	if (typeof band.id == 'undefined' || typeof band.name == 'undefined') return false;

	// band already selected
	if ($('#txtBand'+band.id).val()) return false;

	$('#selectedBands').append('<span class="label label-success selected-band" data-id="'+band.id+'" title="'+band.name+'">'+band.name+' <span class="cancle-select-band" aria-hidden="true">&times;</span></span><input type="hidden" name="bands[]" value="'+band.id+'" id="txtBand'+band.id+'">');
}

function get_suggest(key)
{
	$.ajax({
		url: '<?php echo url("bands"); ?>?f=json&q='+encodeURIComponent(key),
		dataType: 'json',
		success: function(data){
			var html = '';
			if( data && data.length > 0 )
			{
				for( var i in data )
				{
					html += '<li class="suggest_item" data-id="'+data[i]['id']+'" data-name="'+data[i]['name']+'" onclick="select_item( $(this).data() ); hide_menu();"><a role="menuitem" href="javascript:;">'+data[i]['name']+'</a></li>';
					
				}
			} 
			html += '<li class="suggest_item"><a class="ln-create-band" role="menuitem" href="javascript:;" data-name="'+key+'">+ Create '+key+'\'s profile</a></li>';
			$('.band-suggest-result').html(html).slideDown('fast');
		}
	}) // ajax end
}
</script>
</body>
</html>
