<?php
	# This is in charge of getting the posts.
	include "database.php";
	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		if (isset($_GET["limit"]) && isset($_GET["offset"])){
			if ($_GET["limit"] < 21){
				$limit = $_GET["limit"];
			}else{
				$limit = 20;
			}
			if ($_GET["offset"] < 0){
				$offset = 0;
			}else{
				$offset = $_GET["offset"];
			}
		}else{
			$offset = 0;
			$limit = 10;
		}
		
		$conn = db();
		$sql_query = "SELECT * FROM BLOG ORDER BY blogDate LIMIT $limit OFFSET $offset";
		$result = $conn->query($sql_query);
		if (!$result){
			echo $conn->error;
			die("Error has occured");
		}
		$rows = $result->num_rows;
		$data_rows = array();
		for ($j = 0 ; $j < $rows ; ++$j)
		{

			$result->data_seek($j);
			$blogTitle = htmlspecialchars($result->fetch_assoc()['blogTitle']);
			$result->data_seek($j);
			$blogImageSrc = htmlspecialchars($result->fetch_assoc()['blogImageSrc']);
			$result->data_seek($j);
			$blogImageCaption = htmlspecialchars($result->fetch_assoc()['blogImageCaption']);
			$result->data_seek($j);
			$blogText = htmlspecialchars($result->fetch_assoc()['blogText']);
			$result->data_seek($j);
			$topContent = htmlspecialchars($result->fetch_assoc()['topContent']);
			$result->data_seek($j);
			$blogDate = htmlspecialchars($result->fetch_assoc()['blogDate']);
			$result->data_seek($j);
			$blogID = htmlspecialchars($result->fetch_assoc()['ID']);
			$result->data_seek($j);
			$data_rows[] = array("blogTitle"=>$blogTitle, "blogImageSrc"=>$blogImageSrc, "blogImageCaption"=>$blogImageCaption, "blogText"=>$blogText, "topContent"=>$topContent, "blogDate"=>$blogDate, "blogID"=>$blogID);
			# ($blogTitle, $blogImageSrc, $blogImageCaption, $blogText, $topcontent, $blogDate, $blogID)
			
		}
		$result->close();
		$conn->close();
		echo json_encode($data_rows);
	}
	