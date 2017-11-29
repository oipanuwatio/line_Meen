<?php
require_once('./vendor/autoload.php');
// Namespace
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\LocationMessageBuilder;
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
        // Location
        $title = 'I am here';
        $address = 'Fitness 7 Ratchada';
        $latitude = '13.7743425';
        $longitude = '100.5680782';
        $httpClient = new CurlHTTPClient($channel_token);
        $bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret));
        if ($event['type'] == 'message') {
        $textMessageBuilder = new LocationMessageBuilder($title, $address, $latitude, $longitude);}else ($event['type'] == 'image'){
        $textMessageBuilder = new LocationMessageBuilder($title);
        }
        $response = $bot->replyMessage($replyToken, $textMessageBuilder);

	}
}
echo "OK";
