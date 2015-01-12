<!DOCTYPE html>
<html lang="en">
<head>
	<title>Signup</title>
	<?php include app_path().'/views/header.php'; ?>	
	<link rel="stylesheet" href="http://cdn.staticfile.org/ladda-bootstrap/0.1.0/ladda-themeless.min.css">
</head> 
<body>
	<?php include app_path().'/views/banner.php'; ?>	
	<div class="wrapper">
		<div class="main form">
			<form role="form" class="paper form-horizontal" method="post">
				<div class="from-group">
					<div class="alert alert-success" role="success" id="alert" style="display: none;">						
					</div>
					<?php
					if(isset($success)) {
						echo '
						<div class="alert alert-success" role="success" id="alert">
							Done! You will be redirect to the <a href="'.url('signin').'" class="alert-link">signin</a> page in 3 seconds.			
						</div>
						<script>
							setTimeout(function(){location.href="'.url('signin').'"}, 3000)
						</script>
						';
					} elseif(isset($error)) {
						echo '
						<div class="alert alert-danger" role="danger" id="alert">
							'.$error.'			
						</div>
						';
					}
					?>
				</div>

				<div class="form-group">
					<label for="name" class="col-sm-2 control-label">Name</label>
					<div class="col-sm-5">
						<input type="text" class="form-control" id="name" name="name" value="<?php if(isset($name)) echo $name; ?>">
					</div>												
				</div>

				<div class="form-group">
					<label for="email" class="col-sm-2 control-label">Email</label>
					<div class="col-sm-5">
						<input type="email" class="form-control" id="email" name="email" value="<?php if(isset($email)) echo $email; ?>">
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
					<div class="col-sm-offset-2 col-sm-4">
						<button data-style="expand-right" class="btn btn-default btn-sm ladda-button" data-size="s" id="btnSubmit"><span class="ladda-label">Signup</span><span class="ladda-spinner"></span></button>
					</div>
				</div>

			</form>
		</div>		
	</div>
	<script src="http://cdn.staticfile.org/jquery/2.1.1-rc2/jquery.min.js"></script>
</body>
</html>
