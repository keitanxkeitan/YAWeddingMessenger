<?php
/**
 * ウェルカムメッセージ
 */

require "Services/Twilio.php";

$response = new Services_Twilio_Twiml();
/*
// @todo 音声ファイルに置き換える
$response->say(
    "お電話ありがとうございます。"
    . "この電話番号にて foo さん、bar さんへのお祝いメッセージを承ります。"
    . "頂戴したメッセージは、X月Y日の結婚式二次会にて、"
    . "新郎新婦にプレゼントいたします。"
    . "それまでは、お二人には内緒にしておいてください。",
    array("language" => "ja-jp")
    );
*/
$response->play("sound/welcome.mp3");
$response->redirect(
    "record.php",
    array("method" => "GET")
    );

print $response;
?>
