<?php 
  session_start();
  require_once('lib/request.php');

  $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
  $hostName = $_SERVER['HTTP_HOST'];
  $domain = $protocol.'://'.$hostName."/";
  $loginURL = $domain . 'datepicker/login.php';

	$success = "System is verifying your record...";
	// print_r($_GET);
	if(isset($_GET['code'])) {
  	$page_title = "Success";
    $page_header = "Congratulations!";
    $page_body = "Your account is approved.";
	} else {
    $page_title = "Submission";
    $page_header = "";
    $page_body = "Thanks for your submission.<br><br>Your application is being processed <br>and you'll hear from us shortly.";

  }
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
  <head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $page_title; ?></title>
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
	        <br>
	        <br>
	        <div class="main-view-title">
	          <?php echo $page_header; ?>
	        </div>
	        <div class="main-view-body">
	          <?php echo $page_body; ?> 
          </div>
	      </div>
      </div>
    </div>
  </body>
</html>
