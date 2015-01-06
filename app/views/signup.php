<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<?php include app_path().'/views/header.php'; ?>	
	<link rel="stylesheet" href="http://cdn.staticfile.org/ladda-bootstrap/0.1.0/ladda-themeless.min.css">
</head> 
<body>
	<?php include app_path().'/views/banner.php'; ?>	
	<div class="wrapper">
		<div class="main form">
			<form role="form" class="paper" method="post" id="bandForm">
				<div class="from-grup">
					<div class="alert alert-danger" role="danger" id="alert" style="display: none;">						
					</div>
				</div>

				<div class="form-group">
					<div class="input-group col-md-7">
						<span class="input-group-addon">
							<i class="fa fa-user"></i>
						</span>
						<input id="txtUser" type="text" class="form-control" name="name" required>	
					</div>												
				</div>

				<div class="form-group">
					<div class="input-group col-md-7">
						<span class="input-group-addon">
							<i class="fa fa-lock"></i>
						</span>
						<input id="txtPwd" type="password" class="form-control" name="password" required>	
					</div>												
				</div>

				<div class="form-group">
					<!-- <button type="submit" class="btn btn-primary ladda-button" id="btnSubmit" data-style="expand-right"><span class="ladda-label">Submit</span></button> -->
					<button data-style="expand-right" class="btn btn-primary ladda-button" data-size="s" id="btnSubmit"><span class="ladda-label">Submit</span><span class="ladda-spinner"></span></button>
				</div>

			</form>
		</div>		
	</div>
	<script src="http://cdn.staticfile.org/jquery/2.1.1-rc2/jquery.min.js"></script>
	<script src="http://cdn.staticfile.org/twitter-bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<script src="http://cdn.staticfile.org/ladda-bootstrap/0.1.0/spin.min.js"></script>
	<script src="http://cdn.staticfile.org/ladda-bootstrap/0.1.0/ladda.min.js"></script>	
<script>
$(function(){
	$('#btnSubmit').removeAttr('disabled');
	$('#fileupload').fileupload({
        url: '<?php echo url("upload/tmp"); ?>',
        dataType: 'json',
        done: function (e, data) {      	
            $('#txtCover').val(data.result.url);
            $('#cover').attr('src', data.result.url).css('height', 'inherit');
        }
    })		

	// band form submit start
    $('#bandForm').on('submit', function(e){
    	e.preventDefault();
    	var l = Ladda.create(document.querySelector('#btnSubmit'));
	 	l.start();
	 	$('#fileupload').fileupload('disable');

    	var data = $(this).serialize();
    	//console.log(data);
    	$.ajax({
    		url: '<?php if(isset($data["id"])){ echo url("band/update"); }else{ echo url("band/create"); }?>',
    		type: 'post',
    		data: data, 
    		dataType: 'json'
    	}).done(function(res){
    		if (res.status == -1) {
    			$('#alert').html('Band <a href="<?php echo url('band'); ?>/'+res.band.id+'" class="alert-link"><b>'+res.band.name+'</b></a> already exists.').show();
    		} else if(res.status == 0) {
    			$('#alert').html('Something went wrong.').show();
    		} else if(res.status == 1) {
    			location.href = res.url;
    		}
    	}).always(function(){
    		l.stop();
    		$('#fileupload').fileupload('enable');
    	})
    })
    // band form submit end

})
</script>
</body>
</html>
