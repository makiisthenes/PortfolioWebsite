// This will deal with signing in to myaccount.
$(function(){
	document.title = "Portfolio Coursework | MyAccount Login";
	// Client side form validation.
	var login_form = $("#login_form");
	var register_form = $("#register_form");
	login_form.find("input[type=text], textarea").val("");;
	register_form.find("input[type=text], textarea").val("");;
	var login_error = $("#login_error");
	var register_error = $("#register_error");
	var login_username = $("#login_username_input");
	var login_password = $("#login_password_input");
	var login_submit = $("#login_submit");
	var reg_username = $("#register_username_input");
	var reg_email = $("#register_email_input");
	var reg_password = $("#register_password_input");
	var reg_submit = $("#register_submit");
	
	
	// Event listener for login. Do better one later, copied from stack overflow.
	let d = document, [inputs, knapp] = [
    d.querySelectorAll('.black_input'),
    d.querySelector('#login_submit')]
	knapp.disabled = true

	for (i = 0; i < inputs.length; i++) {
		inputs[i].addEventListener('input',() => {
			let values = []
			inputs.forEach(v => values.push(v.value))
			knapp.disabled = values.includes('') && (values.length > 5);
		})
	}
	
	
	login_submit.on("submit", (e)=>{
		e.preventDefault();
		// General Checking with Javascript.
		login_submit.submit();
	});
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
});