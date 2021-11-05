// This script will dynamically adds the mailto: attribute when a div is hovered over, so avoid bots from scraping my email from hrefs and getting spam messages on my email.

// Using jQuery

$(function () {
	// On window load.
	var email_anchor  = $("#email_anchor");
	email_protector(email_anchor);
	var email_icon = $("#email_icon");
	email_protector(email_icon);
});

function email_protector(elem){
	elem.hover(
		function(){
			add_href($(this));
  		}, 
		function(){
  			remove_href($(this));
		});
}

function add_href(elem){
	console.log("Mail link added to anchor tag...");
	// Can add function to build email from smaller parts to make it harder to scrape...
	elem.attr("href", "mailto:"+"ec20433@qmul.ac.uk");
}
function remove_href(elem){
	console.log("Mail link removed from anchor tag...");
	elem.attr("href", "");
}