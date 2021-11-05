<!DOCTYPE html>
<html lang="en-gb">

<head>
	<?php require "head.inc.php"; ?>
	<script type="text/javascript" src="../js/playground.js"></script>
	<link rel="stylesheet" href="../css/playground.css" />
</head>

<body>
	<?php require "header.inc.php"; ?>
	<?php include "cookies.inc.php"; ?>
	<main>
		<h1>Playground, Testing different web technologies on this page.</h1>
		<button onclick="getDate()">Get date</button><br>
		The date is: <div id="timeDiv"></div>
		<?php
			# The same as javascript.
			$days_object = array("Mon","Tue","Wed","Thu","Fri");
			$days_literal = ["Mon","Tue","Wed","Thu","Fri"];
			$myArray = array();
			$myArray[] = "item1";
			$myArray[] = "item2";
			
			# Assigning with custom keys, only integers or strings allowed for keys.;
			$myCustomArray = array("myKey1" => "myValue1", "myKey2"=>"myValue2", "myKey3" =>"myValue3", 0 => "ValueIndex0");
			echo $myCustomArray["myKey1"]  . "<br>";
			echo $myCustomArray[0]  . "<br>";
			$month = array
			(
				array("Mon","Tue","Wed","Thu","Fri"),
				array("Mon","Tue","Wed","Thu","Fri"),
				array("Mon","Tue","Wed","Thu","Fri"),
				array("Mon","Tue","Wed","Thu","Fri"),
			);
			echo $month[0][3] . "<br>"; // outputs Thu
			$cart = array();
			$cart[] = array("id" => 37, "title" => "Burial at Ornans","quantity" => 1);
			$cart[] = array("id" => 345, "title" => "The Death of Marat","quantity" => 1);
			$cart[] = array("id" => 63, "title" => "Starry Night", "quantity" => 1);
			echo $cart[2]["title"]. "<br>";
			
			# Iterating througha associative array;
			foreach ($days_object as $value) {
				echo $value . "<br>";	
			}
			
			foreach ($myCustomArray as $key => $value) {
				echo "day[" . $key . "]=" . $value  . "<br>";
			}
				
			# Pro tip
			# When developing printr() will print out the whole array for debugging.
			print_r($month);
		
		
			# Adding elements to a php array;
			$month[] = array("Weekday 1", "Weekday 2", "Weekday 3", "Weekday 4", "Weekday 5");
			
			# Deleting elements from a php array.
			$days = array("Mon","Tue","Wed","Thu","Fri");
			unset($days[2]);
			unset($days[3]);
			print_r($days  . "<br>")  ;
		
			# Checking if a value has been set for a key.
			$oddKeys = array (1 => "hello", 3 => "world", 5 => "!");
			if (isset($oddKeys[0])) {
				// The code below will never be reached since $oddKeys[0] is not set!
				echo "there is something set for key 0"  . "<br>";
			}
			if (isset($oddKeys[1])) {
				// This code will run since a key/value pair was defined for key 1
				echo "there is something set for key 1, namely ". $oddKeys[1]  . "<br>";
			}
		
			# Sorting keys for php array.
			sort($days);
		
			# Sorting values for php array.
			asort($days);
			
			# Retrieve all keys from php array.
			array_keys($days);
			
			# Print all keys from php array.
			print_r(array_keys($days));
		
			# Used in games and widgets, random keys of a given length.
			array_rand($days,2); // Returns 2 random keys.
		
			print_r(array_reverse($days ));
		
			# Powerful method using array_walk();
			$someA = array("hello", "world");
			array_walk($someA, "doPrint");
			function doPrint($value,$key){
				echo $key . ": " . $value  . "<br>";
			}
			
			# Check if a value is in an array. in_array($needle, $haystack, $optionalStrict=false)
			$inArray = in_array("hello", $someA, false);
			echo "hello in array: $inArray"  . "<br>";
		
			# Shuffling array, will shuffle and make indexed array removing associative keys.
			echo shuffle($someA) . "<br>";
		
			
			# Superglobal Arrays.
			echo "<span>Server info and HTTP request headers sent by the client </span><br>";
			foreach ($_SERVER as $key => $value) {
				echo "[" . $key . "]=" . $value  . "<br>";
			}
		
			$previousPage = $_SERVER['HTTP_REFERER'];
			// Check to see if referer was our search page
			echo "<a href='". $previousPage ."'>Back to referer link</a>";
			
		
		?>
	</main>
	<?php require "footer.inc.php"; ?>
</body>

</html>