// Could update this webpage to use Google Chart
//https://developers.google.com/chart/interactive/docs

$(function(){
	document.title = "Portfolio Coursework | Dashboard";
	var form_submit_btn, blogTitle, blogText, blogImg, form, clear_btn;
	form = document.getElementById("createBlog");
	form_submit_btn = document.getElementById("form_submit");
	// Prevent Defualt of form
	blogTitle = document.getElementById("blogTitleEntry");
	blogText = document.getElementById("blog_contents");
	blogImg = document.getElementById("blog_image");
	clear_btn = document.getElementById("clearBlogBtn");



	// Creates and deals with blog forms.

	clear_btn.addEventListener("click", function (e) {
		e.preventDefault();	
		var confirm_input  = window.confirm("Are you sure you want to clear the form?");
		if (confirm_input == true){
			console.log("Clearing form");
			form.reset();  
		}else{
			console.log("Form action was cancelled!");
			return;
		}
	});
		

	form_submit_btn.addEventListener("click", function (e) {
		// console.log("Submit button was pressed!");
		e.preventDefault();
		// console.log(blogTitle.value);
		if (blogTitle.value.trim() == "" || blogTitle.value.trim() == null){
			// Add outline class onto input field...
			console.log("Nothing shown in blog title entry!!");
			alert("The blog title is empty.");
			// Add outline on input of blog title.
			blogTitle.className = "input_warning";
		}
		if (blogText.value.trim() == "" || blogTitle.value.trim() == null){
			// Add outline class onto input field...
			console.log("Nothing shown in blog textarea entry!!");
			// Add outline on input of blog title.
			alert("Blog textarea is empty!!");
			blogText.className = "input_warning";
		}
		/* If file is empty. */
		if (blogImg.value.trim() == "" || blogImg.value.trim() == null){
			var imageConfirm = window.confirm("Are you sure you don't want to upload an image?");
			if (imageConfirm == false){
				blogImg.className = "input_warning";
			}else{
				blogImg.className = "";
				
			}

		}
		// Check if file is bigger than 5MB.
		console.log("Checking size of file!");
		var max_size = document.getElementById("max").value;
		if (blogImg.files && blogImg.files.length ==1){
			if (blogImg.files[0].size > max_size) {
				alert("The file must be less than " + (max_size/1024/1024) + "MB" + "\n Current size is: " + (blogImg.files[0].size/1024/1024).toFixed(2) + "MB in size!.");
				blogImg.className = "input_warning";
				return;
			}
		}
		

		if (blogText.value.trim()  == "" || blogText.value.trim() == null || blogTitle.value.trim()  == "" ||  blogTitle.value.trim()  == null || imageConfirm == false){
			return;
		}
		var confirm_input  = window.confirm("Are you sure you want to submit the form?");
		if (confirm_input == true){
			form.submit();
			console.log("Form submitting!!");
		}else{
			console.log("Form action was cancelled!");
			return;
		}
		/*
		$form.submit(function(){
			$.post($(this).attr('action'), $(this).serialize(), function(response){
				 // Redirect to dashboard using current information.
				window.location.href = "/dashboard.html";
			  },'json');
			  // Something went wrong, error notice here.
				window.location.href = "/dashboard.html";
		   });
		   */
	});

	blogTitle.addEventListener('keypress', (event) =>{textValueChecker(event, blogTitle)} );

	blogText.addEventListener('keypress',  (event) =>{textValueChecker(event, blogText)} );

	function textValueChecker(e, elem){
		console.log(e);
		console.log("Key was pressed in this element")
		if (elem.value.length > 0){
			elem.className = "";
		}
		return;
	}
});