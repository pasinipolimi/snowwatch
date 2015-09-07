<?php
/*
 * PHP Proxy
 * Responds to both HTTP GET and POST requests
 * Author: Abdul Qabiz
 * Created On: March 31st, 2006
 * Last Modified: Feb 22, 2015
 */
// Get the url of to be proxied
// Is it a POST or a GET?
$url = $_GET['url'];
//Start the Curl session
$session = curl_init($url);
// If it's a POST, put the POST data in the body
// Don't return HTTP headers. Do return the contents of the call
curl_setopt($session, CURLOPT_HEADER, false);
curl_setopt($session, CURLOPT_HTTPHEADER, array("User-Agent: Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.65 Safari/537.36"));
curl_setopt($session, CURLOPT_SSL_VERIFYPEER, FALSE);     
curl_setopt($session, CURLOPT_SSL_VERIFYHOST, 2); 
curl_setopt($session, CURLOPT_FOLLOWLOCATION, true);
//curl_setopt($ch, CURLOPT_TIMEOUT, 4);
curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
// Make the call
$response = curl_exec($session);
header("Content-Type: " . curl_getinfo($session, CURLINFO_CONTENT_TYPE));
echo $response;
curl_close($session);
?>