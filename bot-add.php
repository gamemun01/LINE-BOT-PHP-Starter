<?php
$access_token = 'tSuz/4zK1UvDKJYWwiuEmV0Cm6sF5u7H7QrjUjMe47fF2WQ5aNJ0+A4M2vHbawsia6jc3hSm/WeehniZKEVS99Vu9wh5kcV687TWucM2yr2hjOjkwLSmuK4jdnTHmN+LehyiOvJeVVyRz15dAcYZdAdB04t89/1O/w1cDnyilFU=';
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message') {
			if ($event['message']['type'] == 'text') {
			// Get text sent
				$text = $event['message']['text'];
				// Get replyToken
				$replyToken = $event['replyToken'];
				// Build message to reply back	
				if (strtoupper($text) == "#R"){
					$messages = [
					  'type' => 'text',
					  'text' => "ต้องการสมัคร?"
					];
				} else {
					$message = null;
					if ($event['source']['type'] == 'user')  {
							$message = "รหัสผู้ใช้คือ".$event['source']['userId']."Return message : ".$text;
						} else if ($event['source']['type'] == 'group') {
							$message = "รหัสกลุ่มคือ".$event['source']['groupId']."Return message : ".$text
						} else {
							$message = "รหัสห้องคือ".$event['source']['roomId']."Return message : ".$text
						}
					$messages = [
						'type' => 'text',
						'text' => $message
					];
				}
				
			} elseif ($event['message']['type'] == 'sticker') {
				$sticker = $event['message']['sticker'];
				// Get replyToken
				$replyToken = $event['replyToken'];
				// ‘type’ => ‘sticker’,
				// ‘packageId’ => ‘4’,
				//‘stickerId’ => ‘300’
				// Build message to reply back
				$messages = [
				  'type' => 'sticker',
				  'packageId' => '2',
				  'stickerId' => '525'
				];     
			} 
			
			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
      
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);
			echo $result . "\r\n";
		} elseif ($event['type'] == 'follow') {
			// Get text sent
				// Get replyToken
				$replyToken = $event['replyToken'];
				// Build message to reply back
				$messages = [
				  'type' => 'text',
				  'text' => "Thank for added".$event['type']['source']['userId']
				 ];
			
			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
      
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);
			echo $result . "\r\n";
		
		}
	}
}
echo "OK";
