<?php
	require_once("get.php");
    require_once("sec.php");

    sec_session_start();
    if(!isset($_SESSION["username"])){
        header("Location: index.php");
    }
    $_SESSION['token'] = uniqid();
?>
<!DOCTYPE html>
<html lang="sv">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="pic/favicon.png">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/message.css" />

	<title>Messy Labbage</title>
  </head>
	    <div id="container">
            <div id="messageboard" >
                <input class="btn btn-danger" type="button"  id="buttonLogout" name="logout" value="Logout" style="margin-bottom: 20px;" />
                <p id="numberOfMess">Antal meddelanden: <span id="nrOfMessages">0</span></p>
                Name:<br /> <input id="inputName" type="text" name="name" /><br />
                Message: <br />
                <textarea name="mess" id="inputText" cols="55" rows="6"></textarea>
                <input class="btn btn-primary" type="button" id="buttonSend" value="Write your message" />
                <input type="hidden"  name="TOKEN" id="token" value="<?php echo $_SESSION['token'] ?>" />
                <span class="clear">&nbsp;</span>

                <div id="messagearea"></div>
            </div>
        </div>
        <!-- This script is running to get the messages -->
        <script src="js/jquery.js"></script>
        <script src="js/Message.js"></script>
        <script src="js/MessageBoard.js"></script


        </body>
	</html>