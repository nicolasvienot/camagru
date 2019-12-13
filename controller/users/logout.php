<?php

    session_start();
	if (isset($_SESSION['user_logged']) && $_SESSION['user_logged'] != "") {
		$_SESSION['user_logged'] = "";
		$_SESSION['user_id'] = "";
		header("Location: /");
    }
    
    // session_unset - Frees all session variables (It is equal to using: $_SESSION = array();)
    // unset($_SESSION['Products']); - Unset only Products index in session variable. (Remember: You have to use like a function, not as you used)
    // session_destroy — Destroys all data registered to a session

?>