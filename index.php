<?php 
$accessToken = '86u2vAaIDSq2vD4io6OMJNH2gYB6vol2H5qRvrYdrfkmNcqQGr93yBBq/9JY98dHy1VJSu4Qufd/+KXmLPJbGk8oC4htv2LwfG4GinNRkGXbM9anHBVjqYizyf9h2tQJJAuYaNCMM5VHikk506vvHwdB04t89/1O/w1cDnyilFU=';
$ChannelId = 'Ucf360ad69aa1c30177b3bedb82e9a5e3';
$jsonString = file_get_contents('php://input'); error_log($jsonString); 
$jsonObj = json_decode($jsonString); $message = $jsonObj->{"events"}[0]->{"message"}; 
$replyToken = $jsonObj->{"events"}[0]->{"replyToken"};
if (strlen($message->{'text'}) > 0){
  $messageData = [
    [ 'type' => 'text', 
      'text' => 'Q2. 大学名を教えてください'
    ]
  ];
}

$messageData = [ 'type' => 'text', 'text' => 'うははっは' ]; 

// 返信時のレスポンス
// $response = [ 'replyToken' => $replyToken, 'messages' => [$messageData] ]; 

// 送信時のレスポンス
$response = [ 'to' => $ChannelId, 'messages' => [$messageData] ];

error_log(json_encode($response)); 

// if($replyToken != null){
  // 返信時
  // $ch = curl_init('https://api.line.me/v2/bot/message/reply'); 
  // 送信時
  $ch = curl_init('https://api.line.me/v2/bot/message/push'); 

  curl_setopt($ch, CURLOPT_POST, true); 
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST'); 
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response)); 
  curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json; charser=UTF-8', 'Authorization: Bearer ' . $accessToken )); 
  $result = curl_exec($ch); error_log($result); 
  curl_close($ch);

// }

