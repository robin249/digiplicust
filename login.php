<?php 
  session_start();

  $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
  $hostName = $_SERVER['HTTP_HOST'];
  $domain = $protocol.'://'.$hostName."/";

	if (isset($_SESSION['is_user'])) {
	  header('Location: ' . $domain . 'index.php');
	}
  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if($_POST['uname']=='Digidemo' && $_POST['psw']=='Pa55word!') {
    	$_SESSION['is_user'] = 'true';
    	header('Location: ' . $domain . 'index.php');
    	// exit();
    } else {
    	$error = "Invalid username and password.";
    }
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
	
	.container-table {
	  display: table;
	}
	.vertical-center-row {
	  display: table-cell;
	  vertical-align: middle;
	}
	.pt-70 {
	  padding-top: 70px;
	}

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

		<div class="container container-table">
			<div class="row vertical-center-row">
			  <div class="col-md-6 col-md-offset-3">

			    <?php if(isset($error)) { ?>
			      <div class="alert alert-danger fade in">
			        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			        <strong>Error!</strong> <?php if(isset($error)){ echo $error; } ?>
			      </div>
			    <?php } ?>
			  </div>
			  <div class="col-md-6 col-md-offset-3">
			    <label><b>Username</b></label> 
			    <input type="text" placeholder="Enter Username" name="uname" required> 
			  </div>
			  <div class="col-md-6 col-md-offset-3">
			    <label><b>Password</b></label> 
			    <input type="password" placeholder="Enter Password" name="psw" required> 
			  </div>
		    <div class="col-md-6 col-md-offset-3">
			    <button type="submit">Login</button> 
			  </div>
			</div> 
		</div> 

	</form> 

</body> 

</html> 
