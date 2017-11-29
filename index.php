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
                    $respMessage = 'image ID is '. $messageID;

                    break;//ปิดimage
                case 'location':
                    $address = $event['message']['address'];
                    // Reply message
                    $respMessage = 'ที่อยู่ของคุณ '. $address;

                    break;//ปิดlocation
                case 'text':
                              $ask = $event['message']['text'];
                  switch(strtolower($ask)) {
                      case '1':
                          $respMessage = 'lineBot สามารถขอตอบคำถามง่ายๆทั่วไป เช่น ถามชื่อ,ขอดูรูป,ขอพิกัดและคำถามต่างๆ.......';
                          break;
                      case 'สวัสดี':
                          $respMessage = 'สวัสดีค้าบยินดีต้อนรับLineBotนะ.';
                          break;
                      case 'ชื่ออะไร':
                          $respMessage = 'ฉันชื่อมีน';
                          break;
                      case 'ผู้สร้าง':
                          $respMessage = 'นาย ภาณุวัชร อุปันโน 581413031';
                          break;
                      case 'ขอรูป':
                      $originalContentUrl = 'https://cdn.shopify.com/s/files/1/1217/6360/products/Shinkansen_Tokaido_ShinFuji_001_1e44e709-ea47-41ac-91e4-89b2b5eb193a_grande.jpg?v=1489641827';
                      $previewImageUrl = 'https://cdn.shopify.com/s/files/1/1217/6360/products/Shinkansen_Tokaido_ShinFuji_001_1e44e709-ea47-41ac-91e4-89b2b5eb193a_grande.jpg?v=1489641827';
                    //originalContentUrl:URLที่เกบ็รูปภาพความยาวไม่เกนิ 1000ตวัอกัษร,ต้องเป็นhttps,ไฟล์JPEG, กวา้งยาวสูงสุด1024x1024พิกเซลและขนาดไม่เกนิ 1MB
                    //previewImageUrl:URLภาพที่ใช้สาหรับทาpreviewความยาวไม่เกนิ 1000ตัวอกั ษร,ต้องเป็นhttps,ไฟล์ JPEG,กวา้งยาวสูงสุด240x240พิกเซลและขนาดต้องไม่เกนิ 1MB
                      $httpClient = new CurlHTTPClient($channel_token);
                      $bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret));
                      $textMessageBuilder = new ImageMessageBuilder($originalContentUrl, $previewImageUrl);
                      $response = $bot->replyMessage($replyToken, $textMessageBuilder);
                          break;
                      case 'ขอที่อยู่':
                      $title = 'I am here';
    $address = 'Fitness 7 Ratchada';
    $latitude = '13.7743425';
    $longitude = '100.5680782';
    $httpClient = new CurlHTTPClient($channel_token);
    $bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret));
    $textMessageBuilder = new LocationMessageBuilder($title, $address, $latitude, $longitude);
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
