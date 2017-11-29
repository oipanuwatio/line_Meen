<?php
require_once('./vendor/autoload.php');
// Namespace
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;
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

                    break;
                case 'location':
                    $address = $event['message']['address'];
                    // Reply message
                    $respMessage = 'Hellooo, your address is '. $address;

                    break;
                case 'text':
                              $ask = $event['message']['text'];
                  switch(strtolower($ask)) {
                      case 'm':
                          $respMessage = 'What sup man. Go away!';
                          break;
                      case 'f':
                          $respMessage = 'Love you lady.';
                          break;
                      default:
                          $respMessage = 'What is your sex? M or F';
                          break;
                  }

                    $httpClient = new CurlHTTPClient($channel_token);
                    $bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret));

                    break;
                default:
                    // Reply message
                    $respMessage = 'Please send image only';
                    break;
            }
            $textMessageBuilder = new TextMessageBuilder($respMessage);
            $response = $bot->replyMessage($replyToken, $textMessageBuilder);
		}
	}
}
echo "OK";
