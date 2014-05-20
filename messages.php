<?php

require "util.php";

$messages = getMessages();

header("Content-type: application/json");
echo json_encode($messages);
?>
