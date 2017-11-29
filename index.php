<?php
require_once('./vendor/autoload.php');
// Namespace
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;
// Token
$channel_token = '/avi4EmY8kTPWXO+awWk+ztd3I2HD9BAS/WHgY/GyKJnpmJ/M4lHlBxWFNr8V5x+IUV+4oEDPJOj02U9pGP19daIqHwkmWLyOOnElf0CrNzGgGTQOIkxjf00q2zQU2wH8kstcGc9yr17a6NqkTcofwdB04t89/1O/w1cDnyilFU=';
$channel_secret = 'b7ec1714f2db948a7ff3cfbe7e5164c2';
// Get message from Line API
$content = file_get_contents('php://input');
$events = json_decode($content, true);
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {

        // Get replyToken
        $replyToken = $event['replyToken'];
        $ask = $event['message']['text'];
        switch(strtolower($ask)) {
            case '1':
                $respMessage = 'ตอนนี้ lineBot สามารถถามชื่อ,idผู้ใช้งาน,คำถามทั่วๆไป....';
                break;
            case 'f':
                $respMessage = "สวัสดี ID คุณคือ ".$events;
                break;
            default:
                $respMessage = 'lineBot ยังไม่ได้เรียนรู้ค้าบ พิม 1 เพื่อเรียนรู้';
                break;
        }
        $httpClient = new CurlHTTPClient($channel_token);
        $bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret));
        $textMessageBuilder = new TextMessageBuilder($respMessage);
        $response = $bot->replyMessage($replyToken, $textMessageBuilder);

	}
}
echo "OK";
