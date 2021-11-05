<?php
    require "session.inc.php";
	require "database.php";
	require "security.inc.php";
	# Called from form.
	
	/**
		[] Steps to complete...
		[] Check if request is POST.
		[] Check if comment parameter is set.
		[] Check if user is logged in to do action, if not report user and block IP to prevent further reverse engineering.
		[] Sanitize query.
		[] Connect to database.
		[] Execute Query with content.
		[] Redirect user to same blog if possible, else go to blog main page.
	**/
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (isset($_POST["input_comment"]) && isset($_POST["blogID"])){	
			if (isset($_SESSION["auth"])){
				if ($_SESSION["auth"] == "auth"){
					$conn = db();
					$userID = $_SESSION["userID"];
					$username = $_SESSION["username"];
					$comment = mysql_entities_fix_string($conn, $_POST["input_comment"]);
					$blogID =  mysql_entities_fix_string($conn, $_POST["blogID"]);
					$commentDate = date('Y-m-d H:i:s');
					$sql = "INSERT INTO COMMENTS" . "(blogID, userID, commentText, commentDate) VALUES ('$blogID' ,'$userID', '$comment','$commentDate')";
					$result = $conn->query($sql);
					if ($result){
						# If query went successfully, then continue to redirect.
						if (isset($_SERVER["HTTP_REFERER"])){
							$header = "Location: " . $_SERVER["HTTP_REFERER"]. "#comments";
							header($header);
							exit();
						}else{
							header("Location: viewBlog.php");
							exit();
						}
					}else if (!$result){
						# Error adding comment.
						not_found_error();
						
					}
				}
			}
			else{
				echo "Stop trying to reverse engineer this website, you have been flagged as a malicous user and IP reported to the relative authorities";
				not_found_error();
			}
		}else{
			not_found_error();
		}
	}

