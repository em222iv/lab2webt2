<?php

/**
* Called from AJAX to add stuff to DB
*/
function addToDB($message, $user) {
	$db = null;

    if(empty($message) || empty($user)){
        return false;
    }
    strip_tags($message);
    strip_tags($user);
	try {
		$db = new PDO("sqlite:db.db");
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOEception $e) {
		die("Something went wrong -> " .$e->getMessage());
	}
	$date = time();

	$q = "INSERT INTO messages (message, name, Time) VALUES('$message', '$user','$date')";


	try {
        $stm = $db->prepare($q);
        $stm->execute();
        $result = $stm->fetchAll();
        if(!$result) {
            return "Could not find the user";
        }
	}
	catch(PDOException $e) {}
	
	$q = "SELECT * FROM users WHERE username = '" .$user ."'";

	try {
		$stm = $db->prepare($q);
		$stm->execute();
		$result = $stm->fetchAll();
		if(!$result) {
			return "Could not find the user";
		}
	}
	catch(PDOException $e) {
		echo("Error creating query: " .$e->getMessage());
		return false;
	}
	// Send the message back to the client
	echo "Message saved by user: " .json_encode($result);
	
}

