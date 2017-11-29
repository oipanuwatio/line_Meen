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

        // Line API send a lot of event type, we interested in message only.
		if ($event['type'] == 'message') {
      // Postback Event
if (($event instanceof \LINE\LINEBot\Event\PostbackEvent)) {
$logger->info('Postback message has come');
continue;
}

// Location Event
if  ($event instanceof LINE\LINEBot\Event\MessageEvent\LocationMessage) {
$logger->info("location -> ".$event->getLatitude().",".$event->getLongitude());
continue;
}

// Message Event = TextMessage
if (($event instanceof \LINE\LINEBot\Event\MessageEvent\TextMessage)) {
// get message text
$messageText=strtolower(trim($event->getText()));

}

} 
		}
	}
}
echo "OK";
