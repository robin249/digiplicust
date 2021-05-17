<?php
	$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
	$hostName = $_SERVER['HTTP_HOST'];
	$domain = $protocol.'://'.$hostName."/";

	$api_domain = "https://aml.digipli.com";
?>