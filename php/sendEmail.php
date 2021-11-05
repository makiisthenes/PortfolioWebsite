<?php declare(strict_types=1);
	# PHP File in charge of handling email and adding to database of emails
	// Check if email is of type string only!!!
	

	// Added email to database of emails. 
	$email = $_GET["newsletter_email"];
	echo $email . " was added to MySQL database.";