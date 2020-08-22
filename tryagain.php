<?php 
  session_start();
  require_once('lib/request.php');

  $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
  $hostName = $_SERVER['HTTP_HOST'];
  $domain = $protocol.'://'.$hostName."/";
  $u_id = $_GET['u_id'];
  $verification_url = $domain . 'verification.php?u_id=' . $u_id;
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
  <head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>Try Again</title>
    <link rel="stylesheet" type="text/css" href="success.css" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,700i&amp;display=swap" />
  </head>
  <body class="Root">
    <div class="single-root">
      <div class="main-view">
	      <div class="main-view-intro">
	        <div class="main-view-logo">
	        	<img class="view-image" src="rejected.png" alt="rejected">
	        </div>
	        <div class="main-view-title tryagain">
	          We can't proceed 
            <br>without verifying your ID.
	        </div>
	        <div class="main-view-body tryagain">
	          Please see our 
            <a href="https://support.authenteq.com/hc/en-us/sections/360003196699-Help-Guide" target="_blank">Help Guide</a> or
	          <br>contact support
	        </div>
	      </div>
        <a class="view-button tryagain" href="<?php echo $verification_url; ?>">Try Again</a>
        <a class="view-button" href="mailto:support@authenteq.com">Contact Support</a>
      </div>
    </div>
  </body>
</html>
