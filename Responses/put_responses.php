<?php
	// API1: To get Access Token

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
	// echo $accessToken . "<br>";

	// API2: Put Item
  $uniqItemId = uniq_alphanum();
  // echo $uniqItemId . "<br>";
  $itemName = $_POST['CDDCustomerFirstName'] . " " . $_POST['CDDClientMiddleName'] . " " . $_POST['CDDCustomersLastName'];
	$params2 = array(
		"Key" => $uniqItemId,
		"WorkflowKey" => "CustomerDueDiligence",
		"Id" => $uniqItemId,
		"Name" => $itemName
	);
	$headers2 = array(
		"Authorization: Bearer $accessToken",
		"Content-Type: application/json"
  );
	$putItem = httpPutRaw("https://aml.digipli.com:8080/api/Item/PutItem", json_encode($params2), $headers2);
	// print_r($putItem);
	// echo "<br>";

	// API3: Put Response Data
  $date = $_POST['dob'];
  $address = $_POST['PhysicalAddress'] . ' ' . $_POST['PhysicalAddressLine2'];
  $mailing_address = $_POST['MailingAddress'] . ' ' . $_POST['MailingAddressLine2'];
  list($DOBMonth, $DOBCalenderDays, $DOBYear) = explode('/', $date);
  $params3 = array(
  	"ItemId" => $uniqItemId, 
  	"WorkflowKey" => "CustomerDueDiligence", 
  	"Responses" => array(
  		"EntityType" => array("SelectedItems" => [$_POST['EntityType']]), 
  		"CustomerTitle" => array("SelectedItems" => [$_POST['CustomerTitle']]), 
  		"CDDCustomerFirstName" => array("Text" => $_POST['CDDCustomerFirstName']), 
  		"CDDClientMiddleName" => array("Text" => $_POST['CDDClientMiddleName']), 
  		"CDDCustomersLastName" => array("Text" => $_POST['CDDCustomersLastName']), 
  		"CustomerOtherNameYN" => array("BitValue" => isset($_POST['CustomerOtherNameYN']) ? true : false), 
  		"OtherNameType" => array("SelectedItems" => isset($_POST['OtherNameType']) ? [$_POST['OtherNameType']] : ''), 
  		"CustomerOtherName" => array("Text" => isset($_POST['CustomerOtherName']) ? $_POST['CustomerOtherName'] : ''), 
  		"DOBCalenderDays" => array("SelectedItems" => [$day_mask[$DOBCalenderDays]]), 
  		"DOBMonth" => array("SelectedItems" => [$month_mask[$DOBMonth]]), 
  		"DOBYear" => array("Text" => $DOBYear), 
  		"Email" => array("Text" => $_POST['Email']), 
  		"PhoneCountryCodePrimary" => array("Text" => $_POST['PhoneCountryCodePrimary']), 
  		"CustomerPrimaryPhonenumber" => array("Text" => $_POST['CustomerPrimaryPhonenumber']), 
  		"PhoneCountryCodeAlternate" => array("Text" => !empty($_POST['AlternatePhone']) ? $_POST['PhoneCountryCodeAlternate'] : ''), 
  		"AlternatePhone" => array("Text" => $_POST['AlternatePhone']), 
  		"PhysicalAddress" => array("Text" => $address), 
  		// "PhysicalAddressLine2" => array("Text" => $_POST['PhysicalAddressLine2']), 
  		"CountryOfResidence" => array("SelectedItems" => [$_POST['CountryOfResidence']]), 
  		"LNStateString" => array("Text" => $_POST['LNStateString']), 
  		"City" => array("Text" => $_POST['City']), 
  		"ZipCode" => array("Text" => $_POST['ZipCode']), 
  		"CountryofCitizenship" => array("SelectedItems" => [$_POST['CountryofCitizenship']]), 
  		"CopyToMailing" => array("BitValue" => isset($_POST['CopyToMailing']) ? false : true), 
  		"MailingAddress" => array("Text" => isset($_POST['MailingAddress']) ? $mailing_address : ''), 
  		// "MailingAddressLine2" => array("Text" => isset($_POST['MailingAddressLine2']) ? $_POST['MailingAddressLine2'] : ''), 
  		"MailingCountry" => array("SelectedItems" => isset($_POST['MailingCountry']) ? [$_POST['MailingCountry']] : ''), 
  		"ProvinceMailing" => array("Text" => isset($_POST['ProvinceMailing']) ? $_POST['ProvinceMailing'] : ''), 
  		"MailingCity" => array("Text" => isset($_POST['MailingCity']) ? $_POST['MailingCity'] : ''), 
  		"MailingZipCode" => array("Text" => isset($_POST['MailingZipCode']) ? $_POST['MailingZipCode'] : ''), 
  		"TIN" => array("Text" => str_replace("-", "", $_POST['TIN'])), 
  		"AccountPurpose" => array("SelectedItems" => $_POST['AccountPurpose']), 
  		"ProductsAndServices" => array("SelectedItems" => $_POST['ProductsAndServices']), 
  		"AccountValue" => array("SelectedItems" => [$_POST['AccountValue']]), 
  		"FundingSource" => array("SelectedItems" => $_POST['FundingSource']), 
  		"EmploymentStatus" => array("SelectedItems" => [$_POST['EmploymentStatus']])
		)
	);

	$headers3 = array(
		"UserId: 8010d7fc-f30e-4475-bb1c-3de7d29ebd18",
		"Authorization: Bearer $accessToken",
		"Content-Type: application/json"
  );
	$putResponse = httpPutRaw("https://aml.digipli.com:8080/api/Responses/PutResponses", json_encode($params3), $headers3);
	// print_r($putResponse);
  if ($putResponse == 200) 
    $success = "Record has been created successfully!";
  else
    $success = "Something went wrong!";
?>