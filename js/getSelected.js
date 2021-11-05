// This script will determine which nav element is should have the 'selected' classname.

$(function(){
	var url = document.URL;
	var url = url.split("/");
	var url = url[url.length-1];
	nav_element = $("section#header_nav nav a");
	// Iterate the list.
	for (let i=0; i<nav_element.length; i++){
		nav_element[i].classList.remove('selected');
		if (nav_element[i].getAttribute("href") == url){
			nav_element[i].classList.add("selected");
		}
	}
})

