<?php

require_once('./vendor/autoload.php');
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;
$channel_token = '/avi4EmY8kTPWXO+awWk+ztd3I2HD9BAS/WHgY/GyKJnpmJ/M4lHlBxWFNr8V5x+IUV+4oEDPJOj02U9pGP19daIqHwkmWLyOOnElf0CrNzGgGTQOIkxjf00q2zQU2wH8kstcGc9yr17a6NqkTcofwdB04t89/1O/w1cDnyilFU=';
$channel_secret = 'b7ec1714f2db948a7ff3cfbe7e5164c2';
// Get message from Line API
$content = file_get_contents('php://input');
$events = json_decode($content, true);
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {

        // Line API send a lot of event type, we interested in message only.
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
            // Get replyToken
            $replyToken = $event['replyToken'];
            // Split message then keep it in database.
            $appointments = explode(',', $event['message']['text']);
            if(count($appointments) == 2) {
                $host = 'ec2-23-23-237-68.compute-1.amazonaws.com';
                $dbname = 'daul7v92bjhejv';
                $user = 'ngcyaacvbmhdnc';
                $pass = 'a1f26150d45b19c96a587497d6bbaf634785f7e6ece0e90c0e0007ea3e5977f5';
                $connection = new PDO("pgsql:host=$host;dbname=$dbname", $user, $pass);

                $params = array(
                    'time' => $appointments[0],
                    'content' => $appointments[1],
                );

                $statement = $connection->prepare("INSERT INTO appointments (time, content) VALUES (:time, :content)");
                $result = $statement->execute($params);

                $respMessage = 'Your appointment has saved.';
            }else{
                $respMessage = 'You can send appointment like this "12.00,House keeping." ';
            }

            $httpClient = new CurlHTTPClient($channel_token);
            $bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret));
            $textMessageBuilder = new TextMessageBuilder($respMessage);
            $response = $bot->replyMessage($replyToken, $textMessageBuilder);

		}
	}
}
echo "OK";
