$(function(){
	document.title = "Portfolio Coursework | Playground";
});




// Making Asynchronous Requests using AJAX. Learn about Web Services using PHP.
function getDate(){
	$("#timeDiv").load("../php/currentTime.php");
}

// Using AJAX GET Requests.
