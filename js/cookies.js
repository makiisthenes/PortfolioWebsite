window.addEventListener("load", function() {
	var cookie_dialog = document.getElementById("dialog_cookie");
	checkCookiesAccess(cookie_dialog);
	var cookies_accept_btn = document.getElementById("accept_cookies");
	var cookies_decline_btn = document.getElementById("decline_cookies");
	cookies_accept_btn.addEventListener("click", (event) =>{
		acceptCookies(cookie_dialog);
	});
	cookies_decline_btn.addEventListener("click", (event) =>{
		declineCookies(cookie_dialog);
	});

});



// localStorage is limited to 5MB across all major browsers.
// localStorage is quite insecure as it has no form of data protection and can be accessed by any code on your web page
var COOKIE_KEY = "acceptedCookies";
var PROFILE_INDEX = "profileIndex";
var EMAIL_SEND = "emailSent";
var MONTH_FILTER = "monthFilter";


// Check if localstorage has accepted cookies


// If cookies is not accepted then make sure, sessionStorage is set to false.
// If cookies is accepted then make sure to set localStorage is set to true.

function checkCookiesAccess(cookie_dialog){
	// Check if browser has cookie storage support.
	if (typeof(Storage) !== "undefined") {
   		// Check if accepted cookies is in storage or not.
		if (window.localStorage.getItem(COOKIE_KEY) === null){
			// Not found in localStorage.
			// Check if accepted in session storage or not.
			if (window.sessionStorage.getItem(COOKIE_KEY) === null){
				cookie_dialog.style.display = "block";
			}else{
				// Found in sessionStorage.
				;	
			}
		}else{
			// acceptedCookies found in localStorage
		}
    } else {
    	console.log("Browser does not support cookies!");
	}
};


function acceptCookies(cookie_dialog){
	localStorage.setItem(COOKIE_KEY, true);
	sessionStorage.setItem(COOKIE_KEY, true);
	$("#dialog_cookie").hide(300);
	
};

function declineCookies(cookie_dialog){
	sessionStorage.setItem(COOKIE_KEY, false);
	$("#dialog_cookie").hide(300);
};




