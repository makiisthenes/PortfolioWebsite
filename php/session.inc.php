<?php
	# PHP Script in charge of checking if session has started, if hasnt then start one
	ini_set('session.gc_maxlifetime', 60 * 60 * 24); // Set session timestamp to 1 day.
	session_start();
	# $_SESSION variables are stored only on the server and not on the client.