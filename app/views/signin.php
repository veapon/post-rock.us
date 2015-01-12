<!DOCTYPE html>
<html lang="en">
<head>
	<title>Signin</title>
	<?php include app_path().'/views/header.php'; ?>	
	<link rel="stylesheet" href="http://cdn.staticfile.org/ladda-bootstrap/0.1.0/ladda-themeless.min.css">
</head> 
<body>
	<?php include app_path().'/views/banner.php'; ?>	
	<div class="wrapper">
		<div class="main form">
			<form role="form" class="paper form-horizontal" method="post">
				<div class="from-group">
					<div class="alert alert-danger" role="danger" id="alert" style="display: none;">						
					</div>
				</div>

				<div class="form-group">
					<label for="email" class="col-sm-2 control-label">Email</label>
					<div class="col-sm-5">
						<input type="text" class="form-control" id="email" name="email">
					</div>												
				</div>

				<div class="form-group">
					<label for="pwd" class="col-sm-2 control-label">Password</label>
					<div class="col-sm-5">
						<input type="password" class="form-control" id="pwd" name="password">
					</div>												
				</div>

				<div class="form-group">
					<!-- <button type="submit" class="btn btn-primary ladda-button" id="btnSubmit" data-style="expand-right"><span class="ladda-label">Submit</span></button> -->
					<div class="col-sm-offset-2 col-sm-5">
						<label style="float: left;">
							<input type="checkbox" name="rem"> Remember me
						</label>
						<a href="<?php echo url('reset'); ?>" style="float: right; color: #666;">Forgot password</a>
					</div>
				</div>

				<div class="form-group">
					<!-- <button type="submit" class="btn btn-primary ladda-button" id="btnSubmit" data-style="expand-right"><span class="ladda-label">Submit</span></button> -->
					<div class="col-sm-offset-2 col-sm-4">
						<button data-style="expand-right" class="btn btn-default btn-sm ladda-button" data-size="s" id="btnSubmit"><span class="ladda-label">Signin</span><span class="ladda-spinner"></span></button>
					</div>
				</div>

			</form>
		</div>		
	</div>
	<script src="http://cdn.staticfile.org/jquery/2.1.1-rc2/jquery.min.js"></script>
</body>
</html>
