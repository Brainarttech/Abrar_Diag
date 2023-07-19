<?php
// die;
    function getShortenUrl($longLink){
        return $longLink;
        $url ="https://api.rebrandly.com/v1/links";
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        $payload = json_encode( array( "destination"=> $longLink , "domain"=>array( "fullName" => "rebrand.ly") ) );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $headers = array();
        $headers[] = 'Content-Type:application/json';
        $headers[] = 'Apikey: 3a69851522f54b5ab69f982b6dda2f8c';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        $obj = json_decode($result , true);
        if($obj["errors"] && count($obj["errors"]) > 0){
            $obj["shortUrl"] = $longLink;
        }
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close ($ch);
        return ($obj ? $obj["shortUrl"] : "");
    }

    function sms($numbers, $msgBody){

        // $postRequest = array(
        //     "api_secret" => "JM_SECOND",
        //     "api_token" => "46467e811ad730b5d0e5d22a4f550eb06a90c85525",
        //     "to" => $numbers ,
        //     "from" => "JoyiaMotors",
        //     "message" => $msgBody);
        
       
        // $cURLConnection = curl_init('lifetimesms.com/plain');
        // curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, $postRequest);
        // curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
        
        // $apiResponse = curl_exec($cURLConnection);
        // curl_close($cURLConnection);
        // print_r($apiResponse);
        
        // $apiResponse - available data from the API request
        // $jsonArrayResponse = json_decode($apiResponse);
        // return $jsonArrayResponse;
        
        
        //updated by nabeel on 1-9-2020
        
         $postRequest = 'http://pk.eocean.us/APIManagement/API/RequestAPI?user=asandadc&pwd=ADy%2fYIdG332xntfIlxFSui5VSPor1RFbWNGb4FBLfpmpCBYU%2fbmh0xZg6A0TkoHB1w%3d%3d&sender=AS%20and%20ADC&reciever=' . urlencode($numbers) . '&msg-data=' . urlencode($msgBody) . '&response=string';
         
            $cSession = curl_init();
            curl_setopt($cSession, CURLOPT_URL, $postRequest);
            curl_setopt($cSession, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($cSession, CURLOPT_HEADER, false);
            $result = curl_exec($cSession);
            curl_close($cSession);
            
            
            if (strpos($result, 'Message accepted for delivery') !== false) {
                $status = 'sent';
                return true;
            } else if (strpos($result, 'API Execute Successfully!') !== false) {
                $status = 'sent';
                return true;
            } else {
                $status = 'failure';
                return false;
            }
    }
    function sendReportToServer($file_name_with_full_path,$target_url)
    {
        $whitelist = array(
            '127.0.0.1',
            '::1'
        );
        
        if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
        
            if (function_exists('curl_file_create')) { // php 5.5+
            $cFile = curl_file_create($file_name_with_full_path);
            } else { // 
            $cFile = '@' . realpath($file_name_with_full_path);
            }
            $post = array('file'=> $cFile);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$target_url);
            curl_setopt($ch, CURLOPT_POST,1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            $result=curl_exec ($ch);
            curl_close ($ch);
        }
    }
    
// echo http_build_query($_POST);
// return

// ************** edit by mateen masood *******************
$file = explode("/" , $_POST["file"]); 
$target_file ='./'.ltrim($_POST['file'] , '\.\./');
$handle    = fopen($target_file, "r");
$data      = fread($handle, filesize($target_file));

$fileUploaded =urlencode( $file[2]);
$filePath = "../uploads/$fileUploaded";
file_put_contents( $filePath, $data );
fclose($handle);
$url = "https://app.abrar-diagnostics.com/uploads/".(urlencode($fileUploaded) ); 

//$shortenedUrl = getShortenUrl($url);
$shortenedUrl = $url;
$target_url = "https://app.abrar-diagnostics.com/web/addServiceRemote.php";
sendReportToServer($filePath,$target_url);        
$response = sms($_POST['phone'], "Your report is now ready.\r\nPlease find link below of your report: $shortenedUrl");

   echo $response; 
  
?>
