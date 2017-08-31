<?php
$access_token = 'kuUdonSDUPLTXqdyd8azEnk+siHNkrCJ4m/mUl26viGE2CGzlLEpTCFFrlw8ctu07cy59xkVUnDJvTM2S+rykYeJoMbYpKPCWyNvBhZltj/NCct8/eTVBvQmALe9pBOatoFDkaT0U0/mlMAgAJdM4QdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
 // Loop through each event
 foreach ($events['events'] as $event) {
  // Reply only when message sent is in 'text' format
  if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
   // Get text sent
   $text = $event['message']['text'];
   // Get replyToken
   $replyToken = $event['replyToken'];

   // Build message to reply back
   $messages = [
    'type' => 'text',
    'text' => $text
   ];

   $q = $_POST['q'];

# data needs to be POSTed to the Play url as JSON.
# (some code from http://www.lornajane.net/posts/2011/posting-json-data-with-php-curl)
$data3 = array("q" => "$q");
$data_string3 = json_encode($data3);

$ch3 = curl_init('https://inforn.000webhostapp.com/phpconnect.php');
curl_setopt($ch3, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch3, CURLOPT_POSTFIELDS, $data_string3);
curl_setopt($ch3, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch3, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data_string))
);
curl_setopt($ch3, CURLOPT_TIMEOUT, 5);
curl_setopt($ch3, CURLOPT_CONNECTTIMEOUT, 5);

//execute post
$result3 = curl_exec($ch3);

//close connection
curl_close($ch3);
   $messages3 = [
    'type' => 'text',
    'text' => $result3
   ];


   
   
   // Make a POST Request to Messaging API to reply to sender
   $url = 'https://api.line.me/v2/bot/message/reply';
   $data = [
    'replyToken' => $replyToken,
    'messages' => [$messages3],
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
