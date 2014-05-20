<?php

// DB Constants
$db_host = "localhost";
$db_name = "wedding_messenger";
$db_user = "root";
$db_passwd = "foobarbaz";

function addMessage($sender, $recording_url) {
    global $db_name, $db_host, $db_user, $db_passwd;

    mysql_connect($db_host, $db_user, $db_passwd)
	or die("Could not connect: " . mysql_error());

    mysql_select_db($db_name) or die("Could not select database");


    // make sure inputs are db safe
    $sender = mysql_real_escape_string($sender);
    $recording_url = mysql_real_escape_string($recording_url);

    // Performing SQL query
    $query = sprintf("insert into messages (date, sender, audio_url, flag)".
		     " values (now(), '%s', '%s', 0)",
		     $sender,
		     $recording_url);

    mysql_query($query) or die("Query failed: " . mysql_error());

    $id = mysql_insert_id();
    mysql_close();
    return $id;
}

function updateMessageFlag($id, $flag = 0) {
    global $db_name, $db_host, $db_user, $db_passwd;

    mysql_connect($db_host, $db_user, $db_passwd)
	or die("Could not connect: " . mysql_error());

    mysql_select_db($db_name) or die("Could not select database");

    // make sure inputs are db safe
    $id = mysql_real_escape_string($id);
    $flag = mysql_real_escape_string($flag);

    // Performing SQL query
    $query = sprintf("update messages set flag=%d where id=%d",
		     $flag,
		     $id);

    mysql_query($query) or die("Query failed: " . mysql_error());
    mysql_close();
}

function getMessages() {
    global $db_name, $db_host, $db_user, $db_passwd;

    mysql_connect($db_host, $db_user, $db_passwd)
	or die("Could not connect: " . mysql_error());

    mysql_select_db($db_name) or die("Could not select database");

    // Performing SQL query
    $query = sprintf("select * from messages;");

    $result = mysql_query($query) or die("Query failed: " . mysql_error());

    $messages = array();
    while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
	$messages[] = array(
	    "id" => $line["id"],
	    "date" => $line["date"],
	    "sender" => $line["sender"],
	    "audio_url" => $line["audio_url"],
	    "flag" => $line["flag"]
	    );
    }

    mysql_close();

    return $messages;
}

function getMessage($id) {
    global $db_name, $db_host, $db_user, $db_passwd;

    mysql_connect($db_host, $db_user, $db_passwd)
	or die("Could not connect: " . mysql_error());

    mysql_select_db($db_name) or die("Could not select database");

    // make sure inputs are db safe
    $id = mysql_real_escape_string($id);

    // Performing SQL query
    $query = sprintf("select * from messages where id=%d", $id);

    
    $result = mysql_query($query) or die("Query failed: " . mysql_error());

    $message = array();
    if ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
	$message["id"] = $line["id"];
	$message["date"] = $line["date"];
	$message["sender"] = $line["sender"];
	$message["audio_url"] = $line["audio_url"];
    }

    mysql_close();
    
    return $message;
}

?>
