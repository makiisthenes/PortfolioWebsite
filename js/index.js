// Start of JS script for index page.

// Onload check cookies permissions
// Check if profile state is set, if not set to avatar.
// When profile pict changed, set cookie to state profile pic on every load.
function preloadImage(url){
    var img=new Image();
    img.src=url;
}
// preloadImage("../me.jpeg");
// on window load;
$(function () {
	document.title = "Portfolio Coursework | Home";
	// Changing profile image;
	var profile_toggle = document.getElementById("profile_toggle_btn");
	profile_toggle.addEventListener("click", changeProfileImage);
	var profile_image = document.getElementById("profile_pic");
	var PROFILE_SRC = ["../profile.png", "../me.jpeg"];
	var profile_index = 0;
	var profile_status = document.getElementById("profile_status");
	function changeProfileImage(){
		console.log(PROFILE_SRC[(profile_index+1) % PROFILE_SRC.length]);
		profile_image.src = PROFILE_SRC[(profile_index+1) % PROFILE_SRC.length];

		profile_index = (profile_index+1) % PROFILE_SRC.length;
		if (profile_index == 1){
			console.log("Real Image Selected")
			profile_status.textContent = "VIEW: REAL";
			profile_image.setAttribute("transform", "scale(0.5)");
			profile_image.style.borderRadius = "10%";
			profile_image.style.border = "solid 3px black";
			sessionStorage.setItem(window.PROFILE_INDEX, 1);
		}else{
			profile_image.setAttribute("transform", "scale(1)");
			profile_status.textContent = "VIEW: AVATAR";
			profile_image.style.borderRadius = "100%";
			profile_image.style.border = "none"
			sessionStorage.setItem(window.PROFILE_INDEX, 0);
			
		}
	}


	// Add close button function to notifications displayed in menu.
	var notif_elems = document.getElementsByClassName("close_btn");
	function close_notif(idx, event){
		this.parentNode.style.WebkitAnimationPlayState = "running";
		// wait 1250ms
		window.setTimeout(() => {this.parentNode.style.display ='none';}, 1251);
	}
	
	// Notifications functionality.
	for (var i = 0; i < notif_elems.length; i++) {
		notif_elems[i].addEventListener('click', close_notif.bind(notif_elems[i], i));
	}
	// https://stackoverflow.com/questions/54724029/addeventlistener-on-class


	// Make sure the notifications when closed is stored in cookies, to stop them appearing again.
	// dismissed_messages setCookies for notifications.
	
	
	
	// Check cookies to see which profile image index is saved in local storage.
	if (window.sessionStorage.getItem(window.PROFILE_INDEX) === null){
		sessionStorage.setItem(window.PROFILE_INDEX, 0);
	}else{
		if (window.sessionStorage.getItem(window.PROFILE_INDEX) == 1){
			changeProfileImage();
		}
		
	}

})