<?php
/**
 * 録音
 */

require "Services/Twilio.php";

$response = new Services_Twilio_Twiml();
/*
// @todo 音声ファイルに置き換える
$response->say(
    "それでは、foo さん、bar さんにお届けするお祝いのメッセージを"
    . "発信音のあとに続いて、60秒以内でお話しください。"
    . "完了したら「#」を押してください。準備はよろしいですか？"
    . "最初にお名前をお願いいたします。それではどうぞ！",
    array("language" => "ja-jp")
    );
*/
$response->play("sound/record.mp3");
$response->record(
    array(
	"maxLength" => "60",
	"action" => "recorded.php",
	"method" => "POST",
	"timeout" => 15
	)
    );

print $response;
?>
