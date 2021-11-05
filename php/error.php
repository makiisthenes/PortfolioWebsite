<!-- 404 error page, redirect to this page if path not found. --> 
<!DOCTYPE html>
<html lang="en-GB">
	<head>
		<?php require "head.inc.php"; ?>
		<link rel="stylesheet" href="../css/error.css">
		<script type="text/javascript" src="../js/error.js"></script>
	</head>
	<body>
		<?php require "header.inc.php"; ?>
		<?php require "cookies.inc.php"; ?>
		<main>
			<h1>404 Error</h1>
			<br>
			<?php 
				$link = $_SERVER["HTTP_REFERER"];
				echo "<a id=\"return_link\" href=\"". $link ."\">Go back to last page >>></a>"; 
			?>
		</main>
	<?php include "footer.inc.php"; ?>
	</body>
	<script>document.title = "Portfolio Coursework | 404"</script>
</html>