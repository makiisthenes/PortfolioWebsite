<?php
    require "session.inc.php";
	require "database.php";
	require "security.inc.php";
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (isset($_POST["commentID"]) && isset($_POST["blogID"])){	
			if (isset($_SESSION["auth"])){
				if ($_SESSION["auth"] == "auth"){
					$conn = db();
					
					# Required parameters.
					$blogID = mysql_entities_fix_string($conn, $_POST["blogID"]);
					$commentID = mysql_entities_fix_string($conn, $_POST["commentID"]);
					$userID = $_SESSION["userID"];
					$sql = "DELETE COMMENTS FROM COMMENTS JOIN BLOG ON COMMENTS.blogID = BLOG.ID WHERE COMMENTS.blogID = $blogID AND COMMENTS.ID = $commentID and BLOG.authorID = $userID";
					# Execute query and redirect.
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
						echo $conn->error;
						not_found_error();
					}
				}
			}
		}
	}