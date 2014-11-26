<?php
require_once("get.php");
require_once("post.php");
require_once("sec.php");


/*
* It's here all the ajax calls goes
*/
if(isset($_GET['function'])) {

	if($_GET['function'] == 'logout') {

    }
    elseif($_GET['function'] == 'add') {
	    $name = $_GET["name"];
		$message = $_GET["message"];

        $token = $_GET["token"];
        sec_session_start();

        if($_SESSION['token'] == $token){
		    addToDB($message, $name);
            header("Location: test/debug.php");
        } else {
            echo 'fel token';

        }


    }
    elseif($_GET['function'] == 'getMessages') {
        $arrayLength = $_GET['arrayLength'];
  	   	echo(json_encode(getMessages($arrayLength)));
    }
    elseif($_GET['function'] == 'getAllMessages') {
        echo(json_encode(getAllMessages()));
    }

}