<?php
require_once('./vendor/autoload.php');
// Namespace
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use \LINE\LINEBot\MessageBuilder\ImageMessageBuilder;
use \LINE\LINEBot\MessageBuilder\LocationMessageBuilder;
use \LINE\LINEBot\MessageBuilder\StickerMessageBuilder;

// Token
$channel_token = '/avi4EmY8kTPWXO+awWk+ztd3I2HD9BAS/WHgY/GyKJnpmJ/M4lHlBxWFNr8V5x+IUV+4oEDPJOj02U9pGP19daIqHwkmWLyOOnElf0CrNzGgGTQOIkxjf00q2zQU2wH8kstcGc9yr17a6NqkTcofwdB04t89/1O/w1cDnyilFU=';
$channel_secret = 'b7ec1714f2db948a7ff3cfbe7e5164c2';
// LINEBot
$httpClient = new CurlHTTPClient($channel_token);
$bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret));
// Get message from Line API
$content = file_get_contents('php://input');
$events = json_decode($content, true);
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {

        // Line API send a lot of event type, we interested in message only.
		if ($event['type'] == 'message') {
            // Get replyToken
            $replyToken = $event['replyToken'];

            switch($event['message']['type']) {

                case 'image':
                    $messageID = $event['message']['id'];
                    // Create image on server.
                    $fileID = $event['message']['id'];
                    $response = $bot->getMessageContent($fileID);
                    $fileName = 'linebot.jpg';
                    $file = fopen($fileName, 'w');
                    fwrite($file, $response->getRawBody());
                    // Reply message
                    $respMessage = 'Hellooo, your image ID is '. $messageID;

                    break;//ปิดimage
                case 'location':
                    $address = $event['message']['address'];
                    // Reply message
                    $respMessage = 'Hellooo, your address is '. $address;

                    break;//ปิดlocation
                case 'text':
                              $ask = $event['message']['text'];
                  switch(strtolower($ask)) {
                      case '1':
                          $respMessage = 'lineBot สามารถขอตอบถามง่ายๆทั่วไป เช่น ถามชื่อ,ขอดูรูป,ขอพิกัดและคำถามต่างๆ.......';
                          break;
                      case 'สวัสดี':
                          $respMessage = 'สวัสดีค้าบยินดีต้อนรับLineBotนะ.';
                          break;
                      case 'ขอรูป':
                      $originalContentUrl = 'http://www.fotorelax.com/forum/index.php?action=dlattach;topic=27706.0;attach=384891';
    $previewImageUrl = 'http://www.fotorelax.com/forum/index.php?action=dlattach;topic=27706.0;attach=384891';
    $httpClient = new CurlHTTPClient($channel_token);
    $bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret));
    $textMessageBuilder = new ImageMessageBuilder($originalContentUrl, $previewImageUrl);
    $response = $bot->replyMessage($replyToken, $textMessageBuilder);
                          break;
                      default:
                          $respMessage = 'ฉันอาจยังไม่ได้เรียนรู้คำสั่งนี้ เรียนรู้เพิ่มเติมพิม 1';
                          break;
                  }

                    $httpClient = new CurlHTTPClient($channel_token);
                    $bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret));

                    break;//ปิดtext
                default:
                    // Reply message
                    $respMessage = 'lineBotยังไม่ได้เรียนรู้เกียวกับรูปแบบข้อความนี้';
                    break;
            }
            $textMessageBuilder = new TextMessageBuilder($respMessage);
            $response = $bot->replyMessage($replyToken, $textMessageBuilder);
		}
	}
}
echo "lineBot By Panuwat Upunno.";
