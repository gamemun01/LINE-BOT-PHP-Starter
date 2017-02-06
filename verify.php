<?php
$access_token = 'qWlMPkW5K6I7qvOnt5LevdrH8/u7/tue/IgyEdU4+DwQGGYZz9EUC4I5WqKCCHlxa6jc3hSm/WeehniZKEVS99Vu9wh5kcV687TWucM2yr3mTAR7rqjD2uFbCzW+ionvCnqBcCicrSw5rCw0tPPdywdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
