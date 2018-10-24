<?php 
$accessToken = '86u2vAaIDSq2vD4io6OMJNH2gYB6vol2H5qRvrYdrfkmNcqQGr93yBBq/9JY98dHy1VJSu4Qufd/+KXmLPJbGk8oC4htv2LwfG4GinNRkGXbM9anHBVjqYizyf9h2tQJJAuYaNCMM5VHikk506vvHwdB04t89/1O/w1cDnyilFU=';
$ChannelId = '1615615812'
$jsonString = file_get_contents('php://input'); error_log($jsonString); 
$jsonObj = json_decode($jsonString); $message = $jsonObj->{"events"}[0]->{"message"}; 
$replyToken = $jsonObj->{"events"}[0]->{"replyToken"};

$messageData = [ 'type' => 'text', 'text' => $message->{"うははっは"} ]; 

// 返信時のレスポンス
// $response = [ 'replyToken' => $replyToken, 'messages' => [$messageData] ]; 

// 送信時のレスポンス
$response = [ 'to' => $ChannelId, 'messages' => [$messageData] ];

error_log(json_encode($response)); 

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

// これらの質問に回答して応募完了となります！
// (フォーマットは回答例をコピーして使ってください)

// Q1. お名前を教えてください

// Q2. 大学名を教えてください

// Q3. 卒業年度を教えてください

// Q4. 希望日程を教えてください(第3希望まで)