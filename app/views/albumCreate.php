<!DOCTYPE html>
<html lang="en">
<head>
	<title>
		<?php
			if (isset($data['id'])) {
				echo 'Band/update';
			} else {
				echo 'Band/create';
			}
		?>
		
	</title>
	<?php include app_path().'/views/header.php'; ?>	
	<link rel="stylesheet" href="http://cdn.staticfile.org/ladda-bootstrap/0.1.0/ladda-themeless.min.css">
	<link rel="stylesheet" href="http://cdn.staticfile.org/bootstrap-datepicker/1.2.0/css/datepicker.min.css">
</head> 
<body>
	<?php include app_path().'/views/banner.php'; ?>	
	<div class="wrapper">
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
							<div class="input-group dropdown">
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-user"></span>
								</span>
								<input id="txtBand" type="text" class="form-control" name="artist" placeholder="Band">	
								<ul class="dropdown-menu" role="menu">
										
								</ul>
								<input type="hidden" name="performer_id" id="txtPerId">
							</div>												
						</div>

						<div class="form-group">
							<label for="txtSongs">Tracks</label>
							<textarea id="txtSongs" class="form-control" rows="6" name="tracks" style="resize: vertical" placeholder="One track per line"></textarea>	
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
	<script src="<?php echo url();?>/assets/js/jquery.ui.widget.js"></script>
	<script src="<?php echo url();?>/assets/js/jquery.fileupload.js"></script>
	<script src="http://cdn.staticfile.org/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
<script>
$(function(){
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
	// btnApi click end

	// fileupload start
	$('#fileupload').fileupload({
        url: '<?php echo url("upload/tmp"); ?>',
        dataType: 'json',
        done: function (e, data) {      	
            $('#txtCover').val(data.result.url);
            $('#cover').attr('src', data.result.url);
        }
    })		
    // fileupload end

    // fileupload start
    // 表演者下拉列表事件
	$('.dropdown-menu').on('keyup', function(evt){
		var menuitem = $('.dropdown-menu li');
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
			select_item(curt_focus);
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
	$('#txtBand').on('keyup', function(evt){
		var menuitem = $('.dropdown-menu li');

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
		// 方向键不响应
		else if( evt.keyCode != 37 && evt.keyCode != 39 )
		{
			var key = $(this).val();
			if( !key )
			{
				$('.dropdown-menu').html('');
				return false;
			} 

			$.ajax({
				url: '<?php echo url("band/index"); ?>?f=json&q='+encodeURIComponent(key),
				dataType: 'json',
				success: function(data){

					if( data && data.length > 0 )
					{
						var html = '';
						for( var i in data )
						{
							html += '<li class="suggest_item" data-id="'+data[i]['performer_id']+'" onclick="select_item( $(this).index() ); hide_menu();"><a role="menuitem" href="javascript:;">'+data[i]['name']+'</a></li>';
						}

						if( html )
						{
							$('.dropdown-menu').html(html).slideDown('fast');
						}
						else
						{
							hide_menu();
						}
					} 
					else
					{
						hide_menu();
					}
				}
			}) // ajax end
		}
		
	})
	// Band search end
	
})
</script>
</body>
</html>
