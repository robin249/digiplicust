<?php

	// API 1: To get Access Token
	$params1 = array(
		"grant_type" => "password",
		"client_id" => "InsuroApi",
		"client_secret" => "FA1770D12CF542EDB65884AA1E731B0B",
		"scope" => "api openid",
		"username" => "DigiPliAPI",
		"password" => "AP!account2",
	);
	$headers1 = array(
		"UserId: 8010d7fc-f30e-4475-bb1c-3de7d29ebd18",
		"Content-Type: application/x-www-form-urlencoded"
  );
	$accessToken = httpPost("$api_domain/RegTechOneAuth/connect/token", $params1, $headers1);
	// echo $accessToken . "<br>";
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
	if (isset($res->documentData)) {
		$documentNumber = $res->documentData->documentNumber;
		$issuingCountry = $res->documentData->issuingCountry;
		$documentType = $res->documentData->documentType;
		$firstName = $res->documentData->givenNames;
		$lastName = $res->documentData->surname;
		$fullName = $res->documentData->surnameAndGivenNames;
		$dateOfBirth = $res->documentData->dateOfBirth;
		$dateOfIssue = $res->documentData->dateOfIssue;
		$dateOfExpiry = $res->documentData->dateOfExpiry;
		$jurisdiction = $res->documentData->jurisdiction;
		$faceImage = $res->documentData->faceImage->content;
		$frontImage = $res->documentData->croppedFrontImage->content;
		$backImage = $res->documentData->croppedBackImage->content;

		$faceUrl = "images/face_$u_id.png";
		$frontUrl = "images/front_$u_id.png";
		$backUrl = "images/back_$u_id.png";

        // API3: GET Item Data
        $headers3 = array(
          "Authorization: Bearer $accessToken",
         );
        $getItem = httpGet("$api_domain:8080/api/item/GetItemById?ItemId=$u_id", $headers3);

        // print_r($getItem);
        $getRes = json_decode($getItem);

        if ($getRes->WorkflowKey == 'CustomerDueDiligence') {
            $params4 = array(
            "ItemId" => $u_id,
            "WorkflowKey" => $getRes->WorkflowKey,
            "Responses" => array(
                "GIDVResults" => array("SelectedItems" => ['sdi_ab0a325d0ef0434c8f631eaae877a017']),
                "GIDVDocNumber" => array("Text" => isset($documentNumber) ? $documentNumber : ''),
                "GIDVIssuingCountry" => array("SelectedItems" => isset($issuingCountry) ? [$country_sc_mask[$issuingCountry]] : ''),
                "GIDVDocType" => array("Text" => isset($documentType) ? $documentType : ''),
                "GIDVFirstName" => array("Text" => isset($firstName) ? $firstName : ''),
                "GIDVLastName" => array("Text" => isset($lastName) ? $lastName : ''),
                "GIDVFullName" => array("Text" => isset($fullName) ? $fullName : ''),
                "GIDVFaceImage" => array("Text" => isset($faceImage) ? base64_to_jpeg($faceImage, $faceUrl, $domain) : ''),
                "GIDVFrontImage" => array("Text" => isset($frontImage) ? base64_to_jpeg($frontImage, $frontUrl, $domain) : ''),
                "GIDVBackImage" => array("Text" => isset($backImage) ? base64_to_jpeg($backImage, $backUrl, $domain) : ''),
                "GIDVDOB" => array("DateTimeValue" => isset($dateOfBirth) ? $dateOfBirth . 'T00:00:00.000Z' : ''),
                "GIDVDateOfIssue" => array("DateTimeValue" => isset($dateOfIssue) ? $dateOfIssue . 'T00:00:00.000Z' : ''),
                "GIDVDateOfExpiry" => array("DateTimeValue" => isset($dateOfExpiry) ? $dateOfExpiry . 'T00:00:00.000Z' : ''),
                "GIDVIssuingJurisdiction" => array("Text" => isset($jurisdiction) ? $jurisdiction : '')
                )
            );
        } else {
            $params4 = array(
            "ItemId" => $u_id,
            "WorkflowKey" => $getRes->WorkflowKey,
            "Responses" => array(
                "RPVerificationStatus" => array("SelectedItems" => ['sdi_ab0a325d0ef0434c8f631eaae877a017']),
                "RPIDdocNumber" => array("Text" => isset($documentNumber) ? $documentNumber : ''),
                "RPIDCountry" => array("SelectedItems" => isset($issuingCountry) ? [$country_sc_mask[$issuingCountry]] : ''),
                "RPIDDocType" => array("Text" => isset($documentType) ? $documentType : ''),
                "RPIDFirrstName" => array("Text" => isset($firstName) ? $firstName : ''),
                "RPIDLastName" => array("Text" => isset($lastName) ? $lastName : ''),
                "RPIDFullName" => array("Text" => isset($fullName) ? $fullName : ''),
                "RPIDCustomerFaceImage" => array("Text" => isset($faceImage) ? base64_to_jpeg($faceImage, $faceUrl, $domain) : ''),
                "RPIDImageFront" => array("Text" => isset($frontImage) ? base64_to_jpeg($frontImage, $frontUrl, $domain) : ''),
                "RPIDImageBack" => array("Text" => isset($backImage) ? base64_to_jpeg($backImage, $backUrl, $domain) : ''),
                "RPIDDOB" => array("DateTimeValue" => isset($dateOfBirth) ? $dateOfBirth . 'T00:00:00.000Z' : ''),
                "RPIDDateofIssue" => array("DateTimeValue" => isset($dateOfIssue) ? $dateOfIssue . 'T00:00:00.000Z' : ''),
                "RPIDdateofExpiry" => array("DateTimeValue" => isset($dateOfExpiry) ? $dateOfExpiry . 'T00:00:00.000Z' : ''),
                "RPIDJuris" => array("Text" => isset($jurisdiction) ? $jurisdiction : '')
                )
            );

        }

		// print_r($params4);
		$headers4 = array(
			"UserId: 8010d7fc-f30e-4475-bb1c-3de7d29ebd18",
			"Authorization: Bearer $accessToken",
			"Content-Type: application/json"
	  );
		$verifiedResponse = httpPutRaw("$api_domain:8080/api/Responses/PutResponses", json_encode($params4), $headers4);
		// print_r($verifiedResponse);
	  if ($verifiedResponse == 200) 
	    $success = "Your record has been verified successfully!";
	  else
	    $success = "Something went wrong!";
  }
?>

