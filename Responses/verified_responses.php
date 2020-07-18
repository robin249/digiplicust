<?php

	// API 1: To get Access Token
	$params1 = array(
		"grant_type" => "password",
		"client_id" => "InsuroApi",
		"client_secret" => "FA1770D12CF542EDB65884AA1E731B0B",
		"scope" => "api openid",
		"username" => "DigiPliAPI",
		"password" => "AP!account1",
	);
	$headers1 = array(
		"UserId: 8010d7fc-f30e-4475-bb1c-3de7d29ebd18",
		"Content-Type: application/x-www-form-urlencoded"
  );
	$accessToken = httpPost("https://aml.digipli.com/RegTechOneAuth/connect/token", $params1, $headers1);

	// API 2 Get user detail
	$clientId = "P4I1wQpTgmaergZ6DzcM";
	$clientSecret = "he64wgL7SI7sku3BIs1UVhm79LbBmCiAgXyTzMPq";
	$u_id = $_GET['u_id'];
	$code = $_GET['code'];
	$redirectUrl = $domain . "success.php?u_id=$u_id";

	$headers2 = array(
		"Authorization: Basic " . base64_encode("$clientId:$clientSecret"),
	 );
	$putItem = httpGet("https://api.app.authenteq.com/web-idv/verification-result?redirectUrl=$redirectUrl&code=$code", $headers2);

	// API 3: Put Verified Response Data
	$res = json_decode($putItem);
	// print_r($putItem);
	if (isset($res->documentData)) {
		$documentNumber = $res->documentData->documentNumber;
		$issuingCountry = $res->documentData->issuingCountry;
		$documentType = $res->documentData->documentType;
		$firstName = $res->documentData->givenNames;
		$lastName = $res->documentData->surname;
		$dateOfBirth = $res->documentData->dateOfBirth;
		$dateOfIssue = $res->documentData->dateOfIssue;
		$dateOfExpiry = $res->documentData->dateOfExpiry;
		$jurisdiction = $res->documentData->jurisdiction;

		$params3 = array(
	  	"ItemId" => $u_id, 
	  	"WorkflowKey" => "CustomerDueDiligence", 
	  	"Responses" => array(
	  		"GIDVResults" => array("SelectedItems" => ['sdi_ab0a325d0ef0434c8f631eaae877a017']), 
	  		"GIDVDocNumber" => array("Text" => isset($documentNumber) ? $documentNumber : ''),
	  		"GIDVIssuingCountry" => array("SelectedItems" => isset($issuingCountry) ? [$country_sc_mask[$issuingCountry]] : ''),
	  		"GIDVDocType" => array("Text" => isset($documentType) ? $documentType : ''),
	  		"GIDVFirstName" => array("Text" => isset($firstName) ? $firstName : ''),
	  		"GIDVLastName" => array("Text" => isset($lastName) ? $lastName : ''),
	  		"GIDVDOB" => array("DateTimeValue" => isset($dateOfBirth) ? $dateOfBirth . 'T00:00:00.000Z' : ''),
	  		"GIDVDateOfIssue" => array("DateTimeValue" => isset($dateOfIssue) ? $dateOfIssue . 'T00:00:00.000Z' : ''),
	  		"GIDVDateOfExpiry" => array("DateTimeValue" => isset($dateOfExpiry) ? $dateOfExpiry . 'T00:00:00.000Z' : ''),
	  		"GIDVIssuingJurisdiction" => array("Text" => isset($jurisdiction) ? $jurisdiction : '')
			)
		);

		// print_r($params3);
		$headers3 = array(
			"UserId: 8010d7fc-f30e-4475-bb1c-3de7d29ebd18",
			"Authorization: Bearer $accessToken",
			"Content-Type: application/json"
	  );
		$verifiedResponse = httpPutRaw("https://aml.digipli.com:8080/api/Responses/PutResponses", json_encode($params3), $headers3);
		// print_r($verifiedResponse);
	  if ($verifiedResponse == 200) 
	    $success = "Your record has been verified successfully!";
	  else
	    $success = "Something went wrong!";
  }
?>