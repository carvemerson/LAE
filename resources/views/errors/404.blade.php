<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>404 error</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	
	<style type="text/css" media="screen">
		.error-template {padding: 40px 15px;text-align: center;}
		.error-actions {margin-top:15px;margin-bottom:15px;}
		.error-actions .btn { margin-right:10px; }
	</style>

</head>
<body>
	<div class="container">
		<div class="row">
			<div class="error-template">
				<h1>Oops!</h1>
				<h2>404 Not Found</h2>
				<div class="error-details">
					Sorry, an error has occured, Requested page not found!<br>
				</div>
				<div class="error-actions">
					<a href="/" class="btn btn-primary">
						<i class="icon-home icon-white"></i> Take Me Home 
					</a>
					<a href="mailto:me@null-byte.info" class="btn btn-default">
						<i class="icon-envelope"></i> Contact Support 
					</a>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

