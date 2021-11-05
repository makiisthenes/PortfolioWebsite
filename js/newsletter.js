// Deals with sending async emails to database using AJAX and php.
$(function(){
	// check cookies to see if email has been sent.
	if (window.sessionStorage.getItem(window.EMAIL_SEND) === null){
		sessionStorage.setItem(window.EMAIL_SEND, 0);
	}else{
		if (window.sessionStorage.getItem(window.EMAIL_SEND) == 1){
			// console.log("Email has already been send.")
			$("#newsletter_form").html("<span>Email has been sent!</span>");
		}	
	}
	

	$("#newsletter_submit").on("click", function(event){
		// Prevent defualt.
		event.preventDefault();
		var formData = $("#newsletter_input").val();
		console.log(formData);
		$.get("../php/sendEmail.php", "newsletter_email="+formData);
		console.log("Form Data GET has been sent.")
		changeEmailView();

	});

	function changeEmailView(){
		// Removes input from email and make it a span;
		$("#newsletter_form").hide(500);
		setTimeout(function(){
			window.sessionStorage.setItem(window.EMAIL_SEND, 1);
			$("#newsletter_form").html("<span>Email has been sent!</span>");
			$("#newsletter_form").show(500);
			
		}, 500)
	}
	
});