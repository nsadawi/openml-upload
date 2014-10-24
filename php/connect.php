<?php
/**
  Here I show how to connect to openml api and retrieve a session hash
  This hash should be used to communicate with openml api to upload or download data
  See submit.php
*/

$URL = 'http://openml.liacs.nl/api/?f=openml.authenticate';
// Get cURL resource
$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $URL,//'http://testcURL.com',
    CURLOPT_USERAGENT => 'Codular Sample cURL Request',
    CURLOPT_POST => 1,
    CURLOPT_POSTFIELDS => array(
        username => 'n.sadawi@gmail.com',
        password => md5('libya2011')
    )
));
// Send the request & save response to $resp
$resp = curl_exec($curl);
echo $resp;
// Close request to clear up some resources
curl_close($curl);


      
      
/**
 * Makes a request using cURL with authentication headers and returns the response. 
 * @param url Decibel REST API URL.
 * @param applicationID Decibel Application ID.
 * @param applicationKey Decibel Application Key.
 * @return URL response.
 */
 	
/*
  function request($url, $applicationID, $applicationKey)
  {	
	// Initialize the cURL session with the request URL
	$session = curl_init($url); 

	// Tell cURL to return the request data
	curl_setopt($session, CURLOPT_RETURNTRANSFER, true); 

	// Set the HTTP request authentication headers
	$headers = array(
		'DecibelAppID: ' . $applicationID,
		'DecibelAppKey: ' . $applicationKey,
		'DecibelTimestamp: ' . date('Ymd H:i:s', time())
	);
	curl_setopt($session, CURLOPT_HTTPHEADER, $headers);

	// Execute cURL on the session handle
	$response = curl_exec($session);
	
	return $response;
  }
*/
    

    
	
?>
