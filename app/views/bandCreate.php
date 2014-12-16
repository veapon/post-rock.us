<?php include app_path().'/views/header.php'; ?>
<body>
	<div class="wrapper">
		<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="container">
				
			</div>
		</nav>
		<div class="main form">
			<form role="form" class="paper" method="post" id="bandForm">
				<div class="from-grup">
					<div class="alert alert-danger" role="danger" id="alert" style="display: none;">						
					</div>
				</div>
				<div class="form-group">
					<div class="btn-upload" style="text-align: center;">						
						<img data-src="holder.js/100%x100%/text:Poster" alt="Cover" class="img-responsive img-thumbnail artist-cover" id="cover">
						<input name="poster" id="txtCover" type="hidden" />
						<input id="fileupload" type="file" name="file" class="file-upload">
					</div>
				</div>	

				<div class="form-group">
					<div class="input-group col-md-7">
						<span class="input-group-addon">
							<i class="fa fa-users"></i>
						</span>
						<input id="txtBand" type="text" class="form-control" name="name" placeholder="Band name" required value="<?php if(isset($data['name'])) echo $data['name'];?>" autocomplete="off">	
					</div>												
				</div>

				<div class="form-group">
					<div class="input-group col-md-7">
						<span class="input-group-addon">
							<i class="fa fa-home"></i>
						</span>
						<input id="txtSite" type="url" class="form-control" name="homepage" placeholder="Official site" value="<?php if(isset($data['homepage'])) echo $data['homepage'];?>" autocomplete="off">	
					</div>												
				</div>	

				<div class="form-group">
					<div class="input-group col-md-7">
						<span class="input-group-addon">
							<i class="fa fa-facebook"></i>
						</span>
						<input id="txtFacebook" type="url" class="form-control" name="facebook" placeholder="Facebook" value="<?php if(isset($data['facebook'])) echo $data['facebook'];?>" autocomplete="off">	
					</div>												
				</div>		

				<div class="form-group">
					<div class="input-group col-md-7">
						<span class="input-group-addon">
							<i class="fa fa-bold"></i>
						</span>
						<input id="txtBandcamp" type="url" class="form-control" name="bandcamp" placeholder="Bandcamp" value="<?php if(isset($data['bandcamp'])) echo $data['bandcamp'];?>" autocomplete="off">	
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
					<textarea id="txtProfile" class="form-control" name="profile" style="resize: vertical; height: 160px;" autocomplete="off"> 
						<?php if(isset($data['profile'])) echo $data['profile'];?>
					</textarea>	
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-default">Submit</button>
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
	$('#fileupload').fileupload({
        url: '<?php echo url("upload/tmp"); ?>',
        dataType: 'json',
        done: function (e, data) {      	
            $('#txtCover').val(data.result.url);
            $('#cover').attr('src', data.result.url).css('height', 'inherit');
        }
    })		

    $('#bandForm').on('submit', function(e){
    	e.preventDefault();
    	var data = $(this).serialize();
    	//console.log(data);
    	$.ajax({
    		url: '<?php echo url("band/create"); ?>',
    		type: 'post',
    		data: data, 
    		dataType: 'json'
    	}).done(function(res){
    		if (res.status == 0) {
    			$('#alert').html('Band <a href="<?php echo url('band'); ?>/'+res.band.id+'" class="alert-link"><b>'+res.band.name+'</b></a> already exists.').show();
    		} else if(res.status == 1) {

    		}
    	})
    })

})
</script>
</body>
</html>
