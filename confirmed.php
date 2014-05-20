<?php
/**
 * 確認後
 */

require "Services/Twilio.php";

$response = new Services_Twilio_Twiml();
/*
// @todo 音声ファイルに置き換える
$response->say(
    "メッセージを承りました。お電話ありがとうございました。",
    array("language" => "ja-jp")
    );
*/
$response->play("sound/confirmed.mp3");
print $response;
?>
