<?php
/**
 * 録音後
 */

require "Services/Twilio.php";
require "util.php";

$sender = $_REQUEST["From"];
$recording_url = $_REQUEST["RecordingUrl"];
$id = addMessage($sender, $recording_url);
header("location: confirm.php?id=$id");
exit();
?>
