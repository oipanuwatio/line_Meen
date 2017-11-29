<?php
require_once('./vendor/autoload.php');
// Namespace
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;
$channel_token = '/avi4EmY8kTPWXO+awWk+ztd3I2HD9BAS/WHgY/GyKJnpmJ/M4lHlBxWFNr8V5x+IUV+4oEDPJOj02U9pGP19daIqHwkmWLyOOnElf0CrNzGgGTQOIkxjf00q2zQU2wH8kstcGc9yr17a6NqkTcofwdB04t89/1O/w1cDnyilFU=';
$channel_secret = 'bf90329eeb27a9f4e20e53599edb6043';
//Get message from Line API
$content = file_get_contents('php://input');
$events=json_decode($content, true);
if (!is_null($events['events'])) {
//Loop through each event foreach($events['events']as $event){
// Line API send a lot of event type, we interested in message only. if ($event['type'] == 'message') {
switch($event['message']['type']) {
case 'text':
//Get replyToken
$replyToken = $event['replyToken']; //Reply message
$respMessage='Hello, your message is '.$event['message']['text'];
$httpClient=newCurlHTTPClient($channel_token); $bot=newLINEBot($httpClient, array('channelSecret'=> $channel_secret)); $textMessageBuilder=newTextMessageBuilder($respMessage);
} }
} }
$response=$bot->replyMessage($replyToken, $textMessageBuilder); break;
echo "OK";
