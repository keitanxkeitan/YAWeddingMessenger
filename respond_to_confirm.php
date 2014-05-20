<?php
/**
 * 確認反応
 */

require "Services/Twilio.php";
require "util.php";

$id = $_GET["id"];
$message = getMessage($id);

switch ($_REQUEST["Digits"]) {
case "1":
    updateMessageFlag($id, 1);
    header("location: confirmed.php");
    exit();
case "2":
case "3":
    updateMessageFlag($id, 2);
    header("location: record.php");
    exit();
default:
    header("location: confirm.php?id=$id");
    exit();
}
?>
