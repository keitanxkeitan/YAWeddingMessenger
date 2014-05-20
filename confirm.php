<?php
/**
 * 確認
 */

require "Services/Twilio.php";
require "util.php";

$id = $_GET["id"];
$message = getMessage($id);

$response = new Services_Twilio_Twiml();
$gather = $response->gather(
    array(
	"action" => "respond_to_confirm.php?id=$id",
	"method" => "POST",
	"numDigits" => "1",
	"timeout" => "10")
    );
/*
// @todo 音声ファイルに置き換える
$gather->say(
    "いただいたメッセージを再生します。",
    array("language" => "ja-jp")
    );
*/
$gather->play("sound/confirm1.mp3");
$gather->play($message["audio_url"]);
/*
// @todo 音声ファイルに置き換える
$gather->say(
    "このメッセージをお届けしてよろしければ、数字の「1」を"
    . "もう一度録音する場合は、数字の「3」を押してください。",
    array("language" => "ja-jp")
    );
*/
$gather->play("sound/confirm2.mp3");
$response->redirect(
    "confirm.php?id=$id",
    array("metho" => "GET")
    );

print $response;
?>
