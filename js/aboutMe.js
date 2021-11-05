// jQuery Onload shorthand function notation.
$(function () {
	document.title = "Portfolio Coursework | About Me";
	window.addEventListener("load", function() {
		
		
		
		// Unpause animations and show html display when images have completely loaded.
		$('#middle_image').waitForImages().done(function() { 
  			$("#main_title")[0].style.animationPlayState = 'running';
			$("img.icon:nth-child(even)").each(function(){
				$(this).addClass("play");
				$(this)[0].style.animationPlayState = 'running';
			});
			$("img.icon:nth-child(odd)").each(function(){
				$(this).addClass("play");
				$(this)[0].style.animationPlayState = 'running';
				
			});
		});
		
		
		// Continue here.
		
		
	});
});




 // Make all icons, hover and move randomly very minute movements, and make bottom arrow jump about up and down.
// Animation for typing of "def getQualifications()"
/* 
	var i = 0;
	var txt = 'def getQualifications();';
	var speed = 50;

	function typeWriter() {
	  if (i < txt.length) {
		document.getElementById("demo").innerHTML += txt.charAt(i);
		i++;
		setTimeout(typeWriter, speed);
	  }
	}

*/