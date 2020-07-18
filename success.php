<?php 
  session_start();
  require_once('lib/request.php');

  $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
  $hostName = $_SERVER['HTTP_HOST'];
  $domain = $protocol.'://'.$hostName."/";
  $loginURL = $domain . 'login.php';

	$success = "System is verifying your record...";
	// print_r($_GET);
	if(isset($_GET['code'])) {
  	require_once('Masking/country_sc.php');
		require_once('Responses/verified_responses.php');
	}
?>
<!DOCTYPE html> 
<html> 
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>DigiPli Application Login</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<style> 
	/*set border to the form*/ 
	
	form { 
		padding-left: 200px;
		padding-right: 200px;
		padding-top: 70px;
	} 
	/*assign full width inputs*/ 
	
	input[type=text], 
	input[type=password] { 
		width: 100%; 
		padding: 12px 20px; 
		margin: 8px 0; 
		display: inline-block; 
		border: 1px solid #ccc; 
		box-sizing: border-box; 
	} 
	/*set a style for the buttons*/ 
	
	button { 
		background-color: #1800b9; 
		color: white; 
		padding: 14px 20px; 
		margin: 8px 0; 
		border: none; 
		cursor: pointer; 
		width: 100%; 
	} 
	/* set a hover effect for the button*/ 
	
	button:hover { 
		opacity: 0.8; 
	}
	/*centre the display image inside the container*/ 
	
	.imgcontainer { 
		text-align: center; 
		margin: 24px 0 12px 0; 
	} 
	/*set image properties*/ 
	
	img.avatar { 
		width: 150px;
		height: 150px;
		border-radius: 50%; 
		
	} 
	/*set padding to the container*/ 
	
	.container-row { 
		padding-left: 200px;
		padding-right: 200px;
	} 
	/*set the forgot password text*/ 
	
	span.psw { 
		float: right; 
		padding-top: 16px; 
	} 
	/*set styles for span and cancel button on small screens*/ 
	
	@media screen and (max-width: 300px) { 
		span.psw { 
			display: block; 
			float: none; 
		} 
		.cancelbtn { 
			width: 100%; 
		} 
	} 
	label {
      font-family: 'Arial';
    }
</style> 
</head>

<body>
	<!--Step 1 : Adding HTML-->
	<form method="post" autocomplete="off" name="logindata" action="">
		<div class="imgcontainer"> 
			<img src="DigiPli1.png" alt="Logo" width="150px" height="118px" />
		</div> 

		<div class="container-row">
	    <div class="row">
	      <div class="col-md-12">

	        <?php if(isset($success)) { ?>
	          <div class="alert alert-success fade in">
	            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	            <strong>Success!</strong> <?php if(isset($success)){ echo $success; } ?>
	          </div>
	        <?php } ?>
	      </div>
	    </div>
			<label>Please click <a href="<?php echo $loginURL; ?>">here</a> to go to the home page</label>
			</div> 

	</form> 

</body> 

</html> 
