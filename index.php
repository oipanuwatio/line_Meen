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
            try {
                // Check to see user already answer
                $host = 'ec2-23-23-237-68.compute-1.amazonaws.com';
                $dbname = 'daul7v92bjhejv';
                $user = 'ngcyaacvbmhdnc';
                $pass = 'a1f26150d45b19c96a587497d6bbaf634785f7e6ece0e90c0e0007ea3e5977f5';
                $connection = new PDO("pgsql:host=$host;dbname=$dbname", $user, $pass);

                $sql = sprintf("SELECT * FROM poll WHERE user_id='%s' ", $event['source']['userId']);
                $result = $connection->query($sql);
                error_log($sql);
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
                      case 'z':
                          $respMessage = 'lineBot สามารถขอตอบคำถามง่ายๆทั่วไป เช่น ถามชื่อ,ขอดูรูป,ขอพิกัดและคำถามต่างๆ.......';
                          break;
                      case 'สวัสดี':
                          $respMessage = 'สวัสดีค้าบยินดีต้อนรับLineBotนะ.';
                          break;
                      case 'ชื่ออะไร':
                          $respMessage = 'ฉันชื่อมีน';
                          break;
                      case 'ขอเพลง':
                          $respMessage = 'https://www.youtube.com/watch?v=aatr_2MstrI&list=RDGMEMYH9CUrFO7CfLJpaD7UR85wVMaatr_2MstrI';
                          break;
				case 'ขอดูเกรด':
                          $respMessage = 'คุณได้F';
                          break;  
                      case 'ผู้สร้าง':
                          $respMessage = 'นาย ภาณุวัชร อุปันโน 581413031';
                          break;
											case 'คิดถึง':
											$packageId = 1;
													$stickerId = 410;
													$httpClient = new CurlHTTPClient($channel_token);
													$bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret));
													$textMessageBuilder = new StickerMessageBuilder($packageId, $stickerId);
													$response = $bot->replyMessage($replyToken, $textMessageBuilder);
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
                      $address = 'Chiang Rai Rajabhat University';
                      $latitude = '19.98047';
                      $longitude = '99.85144';
                      $httpClient = new CurlHTTPClient($channel_token);
                      $bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret));
                      $textMessageBuilder = new LocationMessageBuilder($title, $address, $latitude, $longitude);
                      $response = $bot->replyMessage($replyToken, $textMessageBuilder);
                          break;
                      case 'คำถาม':
                          $respMessage = "1+3 = ? \n\r กด 1ตอบ 1. \n\r กด 2ตอบ 2. \n\r กด 3ตอบ 3. \n\r กด 4ตอบ 4 \n\r
                          ";
                          break;
                      case '1':
                              // Insert
                              $params = array(
                                  'userID' => $event['source']['userId'],
                                  'answer' => '1',
                              );

                              $statement = $connection->prepare('INSERT INTO poll ( user_id, answer ) VALUES ( :userID, :answer )');
                              $statement->execute($params);
                              // Query
                              $sql = sprintf("SELECT * FROM poll WHERE answer='1' AND  user_id='%s' ", $event['source']['userId']);
                              $result = $connection->query($sql);

                              $amount = 1;
                              if($result){
                                  $amount = $result->rowCount();
                              }
                              $respMessage = 'เป็นคำตอบที่ผิด จำนวนคนตอบข้อ 1มี = '.$amount;
                              break;
                      case '2':
                            // Insert
                            $params = array(
                                'userID' => $event['source']['userId'],
                                'answer' => '2',
                            );

                            $statement = $connection->prepare('INSERT INTO poll ( user_id, answer ) VALUES ( :userID, :answer )');
                            $statement->execute($params);
                            // Query
                            $sql = sprintf("SELECT * FROM poll WHERE answer='2' AND  user_id='%s' ", $event['source']['userId']);
                            $result = $connection->query($sql);
                            $amount = 1;
                            if($result){
                                $amount = $result->rowCount();
                            }
                            $respMessage = 'เป็นคำตอบที่ผิด จำนวนคนตอบข้อ 2มี = '.$amount;
                            break;
                      case '3':
                            // Insert
                            $params = array(
                                'userID' => $event['source']['userId'],
                                'answer' => '3',
                            );

                            $statement = $connection->prepare('INSERT INTO poll ( user_id, answer ) VALUES ( :userID, :answer )');
                            $statement->execute($params);
                            // Query
                            $sql = sprintf("SELECT * FROM poll WHERE answer='3' AND  user_id='%s' ", $event['source']['userId']);
                            $result = $connection->query($sql);
                            $amount = 1;
                            if($result){
                                $amount = $result->rowCount();
                            }
                            $respMessage = 'เป็นคำตอบที่ผิด จำนวนคนตอบข้อ 3มี = '.$amount;

                            break;
                      case '4':
                            // Insert
                            $params = array(
                                'userID' => $event['source']['userId'],
                                'answer' => '4',
                            );

                            $statement = $connection->prepare('INSERT INTO poll ( user_id, answer ) VALUES ( :userID, :answer )');
                            $statement->execute($params);
                            // Query
                            $sql = sprintf("SELECT * FROM poll WHERE answer='4' AND  user_id='%s' ", $event['source']['userId']);
                            $result = $connection->query($sql);
                            $amount = 1;
                            if($result){
                                $amount = $result->rowCount();
                            }
                            $respMessage = 'ถูกต้องนะค้าบ จำนวนคนที่ตอบถูกมี = '.$amount;
                            break;
                      default:
                          $respMessage = 'ฉันอาจยังไม่ได้เรียนรู้คำสั่งนี้ เรียนรู้เพิ่มเติมพิม z';
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
          } catch(Exception $e) {
              error_log($e->getMessage());
          }
            $textMessageBuilder = new TextMessageBuilder($respMessage);
            $response = $bot->replyMessage($replyToken, $textMessageBuilder);
		}
	}
}
echo "lineBot By Panuwat Upunno.";
