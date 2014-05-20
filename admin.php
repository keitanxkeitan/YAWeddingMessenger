<?php

require "messages.php";

$messages = getMessages();

header("Content-type: application/json");
echo json_encode($messages);
?>
