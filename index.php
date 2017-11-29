<?php
require_once('./vendor/autoload.php');
// Namespace
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use \LINE\LINEBot\MessageBuilder\ImageMessageBuilder;
use \LINE\LINEBot\MessageBuilder\LocationMessageBuilder;
use \LINE\LINEBot\MessageBuilder\StickerMessageBuilder;
use \LINE\LINEBot\MessageBuilder\VideoMessageBuilder;
// Token
$channel_token = '/avi4EmY8kTPWXO+awWk+ztd3I2HD9BAS/WHgY/GyKJnpmJ/M4lHlBxWFNr8V5x+IUV+4oEDPJOj02U9pGP19daIqHwkmWLyOOnElf0CrNzGgGTQOIkxjf00q2zQU2wH8kstcGc9yr17a6NqkTcofwdB04t89/1O/w1cDnyilFU=';
$channel_secret = 'b7ec1714f2db948a7ff3cfbe7e5164c2';
// Get message from Line API
$content = file_get_contents('php://input');
$events = json_decode($content, true);
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {

    switch($event['message']['type']) {

                    case 'text':
                    // Get replyToken
                            $replyToken = $event['replyToken'];
                            $ask = $event['message']['text'];
                            switch(strtolower($ask)) {
                                case 'm':
                                    $respMessage = 'What sup man. Go away!';
                                    break;
                                case 'f':
                                    $respMessage = 'Love you lady.';
                                    break;
                                case 'xx':
                                $originalContentUrl = 'https://cdn.shopify.com/s/files/1/1217/6360/products/Shinkansen_Tokaido_ShinFuji_001_1e44e709-ea47-41ac-91e4-89b2b5eb193a_grande.jpg?v=1489641827';
                                $previewImageUrl = 'https://cdn.shopify.com/s/files/1/1217/6360/products/Shinkansen_Tokaido_ShinFuji_001_1e44e709-ea47-41ac-91e4-89b2b5eb193a_grande.jpg?v=1489641827';

                                    $respMessage = 'นี้รูป';
                                    break;
                                default:
                                    $respMessage = 'What is your sex? mx or fx';
                                    break;
                            }

                        break;


                }

            $httpClient = new CurlHTTPClient($channel_token);
            $bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret));
            $textMessageBuilder = new TextMessageBuilder($respMessage);
            $textMessageBuilder = new ImageMessageBuilder($originalContentUrl, $previewImageUrl);
            $response = $bot->replyMessage($replyToken, $textMessageBuilder);

	}
}
echo "OK";
