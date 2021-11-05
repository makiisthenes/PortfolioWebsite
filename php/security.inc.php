<?php

	function mysql_entities_fix_string($conn, $string){
		return htmlentities(mysql_fix_string($conn, $string));
	}
	function mysql_fix_string($conn, $string){
		if (get_magic_quotes_gpc()) $string = stripslashes($string);
		return $conn->real_escape_string($string);
	}

	function not_found_error()
		{
			echo <<< _END
			We are sorry, but it was not possible to find
			the requested task.
			Please click the back button on your browser
			and try again. If you believe there is an error,
			please <a href="mailto:ec20433@qmul.ac.uk">email
			our administrator</a>. Thank you.
			_END;
		}