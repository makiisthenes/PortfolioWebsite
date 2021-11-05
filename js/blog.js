var offset = 15;
var limit = 10;
var anchor_url = "viewBlog.php?id=";
window.addEventListener("load", function () {
	document.title = "Portfolio Coursework | Blogs";
	
	
	// Adding all months to selection.
	// selected="selected"
	$("#month_select").append("<option value=\"\">Select Month:</option>");
	var MONTHS = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
	if (sessionStorage.getItem("monthFilter") != null){
		var selected = sessionStorage.getItem("monthFilter");	
	}else{
		var selected = 0;	
	}
	for (let i=0; i<MONTHS.length; i++){
		if (parseInt(selected) == (i+1)){
			var option = $("<option value='"+(i+1)+"' onclick=\"window.location.href='viewBlog.php?filter="+i+"#blog_tag;\""+ i +"selected='selected'>"+MONTHS[i]+"</option>");
		}else{
			var option = $("<option value='"+(i+1)+"' onclick=\"window.location.href='viewBlog.php?filter="+i+"#blog_tag;\""+ i +">"+MONTHS[i]+"</option>");	
		}
		$("#month_select").append(option);
	}
	
	$("#month_select").change(function () {
		sessionStorage.setItem("monthFilter", $(this).val());
		window.location.href='viewBlog.php?filter='+$(this).val()+'#blog_tag';
		
	});
	
	
	
	// Deals with content delivery and redirecting for signin.
	try{
		var signin_btn = document.getElementById("sign_in");
		signin_btn.addEventListener("click", function () {
			window.location.href = "/coursework1/php/login.php";
		});
	}catch (error){
		;
	}
	
	// Deals with content delivery and redirecting for signout.
	try{
		var signin_btn = document.getElementById("log_out");
		signin_btn.addEventListener("click", function () {
			window.location.href = "/coursework1/php/logout.php";
		});
	}catch (error){
		;
	}
	
	// GET data continously async using AJAX, witg select element.
	var datalist = $("blog_suggest");
	
	// Underscore JS Library to stop overloading server from input.
	$("#blogSearchInput").on("keypress", _.debounce(function () {
		var search_value = $(this).val();
		// Empty datalist options.
		datalist.empty();
		console.log(search_value);
		var search_qry = "../php/getBlogTitles.php";
		// Sent get requests to get blog title with title parameter...
		var data = "";
		$.get(search_qry, "title="+search_value.trim(), function(data, status, jqXHR_obj){
			// jqXHR is a jqXHR object.
			// Handling the JSON Response.
			console.log(dataType.status); //Status Code: 200, 404...
			if (status == "success"){
				for (var i=0; i<data.length; i++){
					// console.log(data[i].name.charAt(0));
					// console.log(search_value.charAt(0));
					// console.log(data[i].name);
					var option = $("<option class='blog_option' value='"+ data[i].name +"'></option>");
					datalist.append(option);
					console.log("Added to datalist class.")
				}
			}
			else{
			  console.log("Function call to getBlogTitles.php request couldn't get a result.");
				var option = $("<select class='blog_option' value='failure'>Failed to get results from server. Try again later.</select>");
					datalist.appendTo(option);
			}
		}, dataType);
		// When request is done.
		jqXHR_obj.done(function(data){});
		// If request failed.
		jqXHR_obj.fail(function (jqXHR){
			console.log("Error: " + jqXHR.status);
		});
		// Always do on request.
		jqXHR_obj.always(()=>{});
	}, 500));
	
	
	// https://www.codesd.com/item/sort-divs-based-on-child-element-values.html
	// This code below is incorrect fix later.
	
	
	// Add the json elements to side_blogs_container div element below.
	
	$("#more_blogs_btn").on("click", ()=>{
		// Send get request, parse response and increment offset globally by limit.
		var url = "getPosts.php";
		var param = "limit="+limit+"&"+"offset="+offset;
		$.get(url, param, function(data, status){
			console.log("Sent request!");
			if (status == 200){  // Issue is here, see what $.get does properly.
				
				// Parse data from JSON, which is just text based formatting.
				// JSON Format: [{},{},{},{}]
				var dataJS = JSON.parse(data);
				for (let row in dataJS){
					let blogTitle = row["blogTitle"];
					let blogDate = row["blogDate"];
					let blogUrl = anchor_url + row["blogID"];
					// Parse into DOM elements.
					html = ' <div class="full_width_narrow_blog_post"><div class="full_width_narrow_blog_post_header"><hgroup><h4>' + blogTitle +'</h4></hgroup><button class="blue_btn" onclick=\'window.location.href="'+ blogURL+'";\'>Read More...</button></div><p>'+blogDate+'</p></div>';
					var blogListElem = $(hmtl);
					// Append to bottom of div side_blogs_container.
					blogListElem.appendTo($("#side_blogs_container"));
				}	
			}	
		})
		
		window.offset = 5 + window.limit;
	});

	
	// Changing selected button class dependant on the window url query.
	// var encodedStr = window.location.pathname;
	// const url = decodeURIComponent(encodedStr);
	
	
	
});

