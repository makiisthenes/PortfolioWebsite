<?php

	# Debugging
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	ob_start();
	require "database.php";
	require "security.inc.php";
	require "session.inc.php";
	# This will deal with submitting blog form data to the database and then redirecting to viewBlog.php file.
	# We will be using $_POST and $_FILES arrays mostly for this script.
	# Using procedural approach becuase not confident using php fully yet for adding entries.


	/**
		Notes: 
		ALTER TABLE blog MODIFY blogText MEDIUMTEXT;
		[x] Log users activity.
		[x] Sanitize and Check $_POST and $_FILES elements.
		[x] If needed url encode, or any other encoding.
		[x] Then assign variables to these $_FILES and $_POST.
		[x] Redirect back to viewBlog.php or give error to current file and redirect back to dashboard with an global variable set to error object.
	**/
	# Logging user activity.
	include "server_logger.php";
	# Sanitize and checking query string/data.
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		#echo "post request recieved!". "<br>";
		#print_r($_POST);
		#echo "<br>";
		#print_r($_FILES["blog_image"]);
		#echo "<br>";
		#echo  $_POST["blogTitle"];
		if (isset($_POST['notify_checkbox'])) {
		  $notifyUsers = "";
		} else {
		  $notifyUsers = false;
		}
		# echo "notify users: " . $notifyUsers? "true" : "false";
		
		if (isset($_POST["blogTitle"]) && isset($_POST["blog_contents"])){
			$conn = db();
			# Preventing both SQL and XSS injection attacks.
			$blogTitle = mysql_entities_fix_string($conn, $_POST["blogTitle"]);
			$blogText = mysql_entities_fix_string($conn, $_POST["blog_contents"]);
			$blogDate = date('Y-m-d H:i:s');
			$topContent = false;
			# echo "Uploaded image '$name'<br><img src='$name'>";
			if (isset($_FILES["blog_image"])){
				if ($_FILES["blog_image"]["size"] != 0){
					$imageValid = checkFileValid();
					if (!$imageValid){
						echo 
						'
						Invalid Image File Uploaded!! <br>
						Please click the back button on your browser
						and try again. If you believe there is an error,
						please <a href="mailto:ec20433@qmul.ac.uk">email
						our administrator</a>. Thank you.
						';
						exit();
					}
					$blogImageSrc = move_file();
				}
			}else{
				$blogImageSrc ="#";
			}
			$blogImageCaption = $blogTitle;
				# Secure Version | Adding placement to make mysql secure and no mysql injection can occur.
				
				/*
				$stmt = $conn->prepare('INSERT INTO BLOG');
				if ($stmt == false){
					echo $conn->error;
				};
				$stmt->bind_param('ssssis', $blogTitle,$blogImageSrc, $blogImageCaption,$blogText, $topContent, $blogDate);
				$result = $stmt->execute();
				*/
				# Insecure Version.
				$userID = $_SESSION["userID"];
				$sql_query = "INSERT INTO BLOG" . "(blogTitle, blogImageSrc, blogImageCaption, blogText, topContent, blogDate, authorID) VALUES ('$blogTitle' ,'$blogImageSrc', '$blogImageCaption','$blogText', '$topContent', '$blogDate', '$userID')";
				# Add this to the database.
				$result = $conn->query($sql_query);
				
				
				if (!$result){
					echo $conn->error;
					# $stmt->close();
					$conn->close();
					die("Fatal Error Adding SQL ");
					header('Location: dashboard.php');
				    exit();
				}else{
					# $stmt->close();
					$conn->close();
					header('Location: viewBlog.php');
					exit();
				}
			}else{
				# $stmt->close();
				$conn->close();
				header('Location: dashboard.php');
				exit();
			}
	
	};

	function checkFileValid(){
		# Checks if file is valid and sanitizes forged or weird files claiming to be images.
		# Transmission Errors
		# Maximum File Size: 5MB, 5242880B
		# Check has correct file extension.
		# Look at file exif to determine if file truely image. 
		# https://www.php.net/manual/en/function.exif-imagetype.php
		# extension=php_mbstring.dll
		# extension=php_exif.dll
		# extension=exif.so
		$myArray = $_FILES["blog_image"];
		# echo isset($myArray["error"]) ? "true1" : "false1";
		if (isset($myArray["error"])){
			# echo $myArray["error"];
			if ($myArray["error"] == UPLOAD_ERR_OK){
				if (isset($myArray["size"])){
					$file_size = $myArray["size"]; // File in bytes.
					# echo $file_size;
					if ($file_size < 5242880){
						$validExt = array("jpg", "png");
						$validMime = array("image/jpeg","image/png");
						foreach($_FILES as $fileKey => $fileArray ){
							$extension_expode = explode(".", $fileArray["name"]);
							$extension = end($extension_expode);
							if (in_array($fileArray["type"],$validMime) && in_array($extension, $validExt)) {
								return true;
								/** Not Supported;
								$filename = $myArray["name"];
								if (exif_imagetype($filename) == IMAGETYPE_JPEG || exif_imagetype($filename) == IMAGETYPE_PNG){
									return true;
								}
								**/
							}
						}
					}
				}
			}else{
				$error_code = $myArray["error"];
				# Make $error_code a global variable.
			}
		}
			# Type Restrictions	
			return false;
	};

	function getAvailableID(){
		# Should check the latest index of blogs and give incremented value.
		$sql_query = "SELECT ID FROM BLOG ORDER BY ID DESC LIMIT 1"; // Current Largest Index.
		# Retrieve result from database.
		$conn = db();
		$result = $conn->query($sql_query);
		if ($result -> num_rows == 0){
			return 0;
		}else{
			$index = htmlspecialchars($result->fetch_assoc()['ID']);
			return $index ++;
		}
		
	};


	function move_file(){
		# Errors moving file, debug this later...
		$blogImage = $_FILES["blog_image"];
		$filename = explode(".", $blogImage['name']);
		$name = "..\\blog_images\\". "blog_image" . getAvailableID() . "." . trim(end($filename));
		# echo $name;
		move_uploaded_file($_FILES['blog_image']['tmp_name'], $name); // relative to current position.
		$name = "\\\\coursework1\\\\php" . "\\\\blog_images\\\\". "blog_image" . getAvailableID() . "." . trim(end($filename));
		return $name;
	};
		