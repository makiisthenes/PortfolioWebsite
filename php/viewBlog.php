<?php require "session.inc.php"; ?>
<?php require "database.php";  ?>
<?php require "security.inc.php";  ?>
<!-- Add PHP Classes -->
<?php include "blog.class.php"; ?>
<?php 
	include "comment.class.php";
	# TODO: Create comment class for object and html generation.
?>
<!DOCTYPE html>
<html lang="en-GB">
<head>
	<?php require "head.inc.php" ?>
	<script type="text/javascript" src="../js/blog.js"></script>
	<link rel="stylesheet" href="../css/viewBlog.css">
</head>

<body>
    <header>
            <div id="main_header">
                <section id="header_nav">
				<nav>
					<a href="index.php" class="nav_title_anchor selected">Home</a>
					<a href="viewBlog.php" class="nav_title_anchor">Blogs</a> 
					<a href="aboutMe.php" class="nav_title_anchor">About Me</a> 
					<a href="myProjects.php" class="nav_title_anchor">Projects</a> 
					<a href="login.php" class="nav_title_anchor">MyAccount</a>
					<a href="playground.php" class="nav_title_anchor">Playground</a>
					<a href="store.php" class="nav_title_anchor">Shop</a>
					<a href="privacy.php" class="nav_title_anchor">Legal</a>
				</nav>
			</section>
			<section id="header_icon">
				<nav>
					<!-- Icons from: https://www.flaticon.com/ -->
					<a href="https://github.com/makiisthenes"><img src="../github.svg"></a>
					<a href="https://www.linkedin.com/in/michael-p-88b015200/"><img src="../linkedin.svg"></a>
					<a href="" id="email_icon"><img src="../email.svg"></a>
				</nav>
			</section>
            </div>
            <section id="title_panel">
                <h4>Blog</h4>
                <input id="blogSearchInput" type="text" placeholder="Search Blog..." name="blogSearchQuery" pattern="[a-zA-Z0-9]+" list="blog_suggest" maxlength="35">
				<datalist id="blog_suggest">
					<option class="blog_option" value="Example Selection Blog"></option>
				</datalist>
                <!-- No button, actively search field instead -->
                <?php 
					if (isset($_SESSION["auth"])){
						if ($_SESSION["auth"] == "auth"){
							echo '<button class="red_btn" id="log_out">Log Out</button>';
						}else{
							
						}
					}else{
						echo '<button class="blue_btn" id="sign_in">Sign In</button>';
					}
				?>
                <div id="profile_mask">
                    <img src="#" alt="Profile Pic"/>
                </div>
            </section>
    </header>
    <?php include "cookies.inc.php"; ?>
    <main>
		<?php
		# Deal with get requests with given ids use database to see if it found.
		# Article HTML Page use semantic for requirements.
		/** 
			<header>, <hgroup>, <nav>, <article>, <section>, <figure>, <figcaption> and <footer>.
		**/
		if ($_SERVER["REQUEST_METHOD"] == "GET") {
		 if (isset($_GET["id"])){
			 # Check if get request has an ID parameter.
			 $conn = db();
			 $blogID = mysql_entities_fix_string($conn, $_GET["id"]);
			 # Get info about this blog.
			 $qry = "SELECT * FROM BLOG WHERE ID = $blogID";
			 $result = $conn->query($qry);
			 $rows = $result->num_rows;
			 if ($rows == 1){
				 # Get data from row.
				 $result->data_seek(0);
				 $blogTitle = htmlspecialchars($result->fetch_assoc()['blogTitle']);
				 $result->data_seek(0);
				 $blogImgSrc = htmlspecialchars($result->fetch_assoc()['blogImageSrc']);
				 $result->data_seek(0);
				 $blogImageCaption = htmlspecialchars($result->fetch_assoc()['blogImageCaption']);
				 $result->data_seek(0);
				 $blogText = htmlspecialchars($result->fetch_assoc()['blogText']);
				 $result->data_seek(0);
				 $topContent = htmlspecialchars($result->fetch_assoc()['topContent']);
				 $result->data_seek(0);
				 $blogDate = htmlspecialchars($result->fetch_assoc()['blogDate']);
				 $result->data_seek(0);
				 $authorID = htmlspecialchars($result->fetch_assoc()['authorID']);
				 $result->data_seek(0);
				 # Parse html for this blog.
				 echo '
				 	<div id="gen_blog_main_wrapper">
					
						<div id="gen_blog_main_top_wrapper">
							<div id="gen_blog_main_top_elements_wrapper">
								<div id="gen_blog_main_top_header_left">
									<div id="gen_blog_main_top_header_left_title">
										'.$blogTitle.'
									</div>
									<div id="gen_blog_main_top_header_left_date">
										'.(new DateTime($blogDate))->format('l jS F Y').'
									</div>
								</div>
								<div id="gen_blog_main_top_header_right">
									<a href="viewBlog.php"><button class="go_back">Go Back</button></a>
								</div>
							</div>
						</div>
						<section id="gen_blog_main_content">
							<figure>
								<img src="'.$blogImgSrc.'" id="gen_blog_main_img" alt="Problem with webserver service storing images, I cant access file directory.">
								<figcaption></figcaption>
							</figure>
							<!-- This is where main content of article is. -->
							<article>
								'.
					 			$blogText
					 			.'		
							</article>
						</section>
						<section id="comment_content">
							<!-- This is the comment sections for the blog. -->
							<hr>
							<div id="comment_header">Comments</div>
							<!-- Example Comment Here. -->
							<tag id="comments"></tag>
							<div class="comment_wrapper">
								<div class="option_comment_wrapper">
									<a>
										<button class="option_btn">
											Delete
										</button>
									</a>
								</div>
								<div class="username_comment">
									<a href="">
										Username
									</a>
								</div>
								<div class="message_comment">
									<span>
										This is an example comment, and here as defualt, it can be taken off from line 141 on viewBlog.php. This is my comment I am really amazed, wow &#128514;&#128514;&#128514;&#128514;!!!
									</span>
								</div>
								<div class="date_comment">
									01-20-2002
								</div>
							</div>
							<!-- End of Example Comment -->	
							';
				 			# Here we list all of the comments and add the comment option depending on whether user is logged in or not.
				 			$isAuthor = false;
				 			if (isset($_SESSION["userID"])){
								if ($authorID == $_SESSION["userID"]){
									$isAuthor=true;
								}
							}
				 			getBlogComments($blogID, $isAuthor);
							
				 	# Adding comment area for users to enter message to user.
				 	if (isset($_SESSION["auth"])){
						if ($_SESSION["auth"] == "auth"){
							# Allow user to add comment.
							echo '
							<!-- Example Send Message Block -->
							<form class="user_input_wrapper" action="addComment.php" method="POST">
								 <input type="hidden" name="blogID" value="'.$blogID.'">
								<input type="text" name="input_comment" autocomplete="off" placeholder="Enter message here..." required/>
								<button type="submit">Comment</button>
							</form>
							<!-- End of Send Message Block -->';
						}else{
							# Identical Sign In to Comment.
							echo '
							<div class="user_input_wrapper">
								<a href="login.php"><button class="full-width-abs">Sign in to comment</button></a>
							</div>';
						}
					}else{
						# Identical Sign In to Comment.
						echo '
							<div class="user_input_wrapper">
								<a href="login.php"><button class="full-width-abs">Sign in to comment</button></a>
							</div>';
					}

				 	echo '</section></div>';

				 # Adding footer of blog.
				 echo '</main>';
				 require "footer.inc.php";
				 echo '
				 <script>
					$(".option_btn").on("click", function () {
					console.log($(this)[0].id);
					$.post("deleteComment.php", {blogID: "'.$blogID.'", commentID:$(this)[0].id}).done(function () {window.location.reload();});
					});
				 </script>
				 ';
				 echo '</body></html>';
			 }else{
				 die(not_found_error());
			 }
			 $result->close();
			 $conn->close();
			 exit();
		 };	
		}

		
		function getBlogComments($id, $isAuthor){
			$conn = db();
			$sql = "SELECT COMMENTS.ID, commentText, commentDate, username FROM COMMENTS JOIN USERS ON COMMENTS.userID = USERS.ID WHERE blogID = $id";
			# Link database COMMENTS and USERS together with assoc key.
			$result = $conn->query($sql);
			$rows = $result->num_rows;
			$comment_array = array();
			for ($j = 0 ; $j < $rows ; ++$j){
				$result->data_seek($j);
				$commentID = htmlspecialchars($result->fetch_assoc()['ID']);
				$result->data_seek($j);
				$commentText = htmlspecialchars($result->fetch_assoc()['commentText']);
				$result->data_seek($j);
				$commentDate = htmlspecialchars($result->fetch_assoc()['commentDate']);
				$result->data_seek($j);
				$username = htmlspecialchars($result->fetch_assoc()['username']);
				echo new Comment($commentID, $commentText, $commentDate, $username, $isAuthor);
				
			};
			if ($rows == 0){
				echo '<div id="nocomment">This blog has no comments.</div>';
			}
			
		}
	?>
		
		
		
        <!-- Main Content Here -->
        <section id="main_content">
			<h4 style="font-size: 2em;font-family: Heebo, sans-serif !important;margin: 50px 20px;font-weight: 600;text-decoration: underline;">Top Viewed </h4>
            <div class="top_blogs_container">
                <div class="top_blog_container">
                    <div class="top_blog_container_top_wrapper">
                        <figure class="top_blog_container_top_wrapper_figure">
                            <img src="../aboutMe_rsr/example_blog_img@2x.png" rel="nofollow">
                            <div class="top_blog_container_top_wrapper_caption_wrapper">
                                <figcaption>Simple Image Description Source:</figcaption>
                            </div>
                        </figure>
                    </div>
                    <div class="top_blog_container_bottom_wrapper">
                        	<?php
								$sql_query = "SELECT * FROM BLOG WHERE topContent = true ORDER BY blogDate DESC LIMIT 3";
								# This will be where we choose topContent based on number of views of blogs.
						
							?>
                            <hgroup class="top_blog_container_bottom_wrapper_header">
                                <h3>Header Name 1 testing omg this is the title lol</h3>
                            </hgroup>
                            <!-- Article Content [Send 300 words].-->
                            <div class="blur_effect_box">
                                <blockquote>
                                    This will contain a little extract of the article which the user can read, it will usually be a third to a half of the orginal article, and contain at least 300 words for Search Engine Opmitisation, this will open a new URL that is used to display the article.
                                    This will contain a little extract of the article which the user can read, it will usually be a third to a half of the orginal article, and contain at least 300 words for Search Engine Opmitisation, this will open a new URL that is used to display the article.
                                    This will contain a little extract of the article which the user can read, it will usually be a third to a half of the orginal article, and contain at least 300 words for Search Engine Opmitisation, this will open a new URL that is used to display the article.
                                    This will contain a little extract of the article which the user can read, it will usually be a third to a half of the orginal article, and contain at least 300 words for Search Engine Opmitisation, this will open a new URL that is used to display the article.
                                    
                                </blockquote>
                            </div>
                        <div class="top_blog_container_bottom_wrapper_status_bar">
                            <span>01/02/2021</span>
                            <button class="read_futher blue_btn" onclick="">Read More...</button>
                        </div>
                    </div>
                </div>
                
                
                <div class="top_blog_container">
                    <div class="top_blog_container_top_wrapper">
                        <figure class="top_blog_container_top_wrapper_figure">
                            <img src="../aboutMe_rsr/example_blog_img2@2x.png" rel="nofollow">
                            <div class="top_blog_container_top_wrapper_caption_wrapper">
                                <figcaption>Simple Image Description Source:</figcaption>
                            </div>
                        </figure>
                    </div>
                    <div class="top_blog_container_bottom_wrapper">
                        
                            <hgroup class="top_blog_container_bottom_wrapper_header">
                                <h3>Header Name 1 testing omg this is the title lol</h3>
                            </hgroup>
                            <!-- Article Content [Send 300 words].-->
                            <div class="blur_effect_box">
                                <blockquote>
                                    This will contain a little extract of the article which the user can read, it will usually be a third to a half of the orginal article, and contain at least 300 words for Search Engine Opmitisation, this will open a new URL that is used to display the article.
                                    This will contain a little extract of the article which the user can read, it will usually be a third to a half of the orginal article, and contain at least 300 words for Search Engine Opmitisation, this will open a new URL that is used to display the article.
                                    This will contain a little extract of the article which the user can read, it will usually be a third to a half of the orginal article, and contain at least 300 words for Search Engine Opmitisation, this will open a new URL that is used to display the article.
                                    This will contain a little extract of the article which the user can read, it will usually be a third to a half of the orginal article, and contain at least 300 words for Search Engine Opmitisation, this will open a new URL that is used to display the article.
                                </blockquote>
                            </div>
                        <div class="top_blog_container_bottom_wrapper_status_bar">
                            <span>01/02/2021</span>
                            <button class="read_futher blue_btn" onclick="">Read More...</button>
                        </div>
                    </div>
                </div>
                
                <div class="top_blog_container">
                    <div class="top_blog_container_top_wrapper">
                        <figure class="top_blog_container_top_wrapper_figure">
                            <img src="../aboutMe_rsr/example_blog_img3@2x.png" rel="nofollow">
                            <div class="top_blog_container_top_wrapper_caption_wrapper">
                                <figcaption>Simple Image Description Source:</figcaption>
                            </div>
                        </figure>
                    </div>
                    <div class="top_blog_container_bottom_wrapper">
                        
                            <hgroup class="top_blog_container_bottom_wrapper_header">
                                <h3>Header Name 1 testing omg this is the title lol</h3>
                            </hgroup>
                            <!-- Article Content [Send 300 words].-->
                            <div class="blur_effect_box">
                                <blockquote>
                                    This will contain a little extract of the article which the user can read, it will usually be a third to a half of the orginal article, and contain at least 300 words for Search Engine Opmitisation, this will open a new URL that is used to display the article.
                                    This will contain a little extract of the article which the user can read, it will usually be a third to a half of the orginal article, and contain at least 300 words for Search Engine Opmitisation, this will open a new URL that is used to display the article.
                                    This will contain a little extract of the article which the user can read, it will usually be a third to a half of the orginal article, and contain at least 300 words for Search Engine Opmitisation, this will open a new URL that is used to display the article.
                                    This will contain a little extract of the article which the user can read, it will usually be a third to a half of the orginal article, and contain at least 300 words for Search Engine Opmitisation, this will open a new URL that is used to display the article.
                                </blockquote>
                            </div>
                        <div class="top_blog_container_bottom_wrapper_status_bar">
                            <span>01/02/2021</span>
                            <button class="read_futher blue_btn" onclick="">Read More...</button>
                        </div>
                    </div>
                </div>
                
                
            </div>
            <!-- More Less Relevant Blogs and filter control. --> 
			<div id="blog_tag"></div>
            <section id="side_blogs_container">
                <!-- All other blogs placed here -->
                <section id="blog_tools_container">
                    <!-- Tools to filter blog posts -->
					<?php if (isset($_GET["filter"])){
						# In charge of changing the selected_filter
						$conn = db();
						$filter = mysql_entities_fix_string($conn, $_GET["filter"]);
							
					}else{
						$filter = "latest";
} 
					?> 
                    <button class="filter_btn grey_btn <?php if ($filter=='latest'){echo 'selected_filter';}else{echo "";} ?>" id="latest_filter" onclick="window.location.href = 'viewBlog.php?filter=latest#blog_tag'">Latest</button>
                    <button class="filter_btn grey_btn <?php if ($filter=='oldest'){echo 'selected_filter';}else{echo "";} ?>" id="oldest_filter" onclick="window.location.href = 'viewBlog.php?filter=oldest#blog_tag'">Oldest</button>
                    <button class="filter_btn grey_btn <?php if ($filter=='alpha'){echo 'selected_filter';}else{echo "";} ?>" id="alphabetical_filter" onclick="window.location.href = 'viewBlog.php?filter=alpha#blog_tag'">Alphabetical</button>
					
					<select class="grey_btn" id="month_select" style="padding: 5px;margin: 10px;">
						<!-- Auto generated months and get url. -->
					</select>
					<!--
                    <button class="filter_btn grey_btn nosupport" >Cryptography</button>
                    <button class="filter_btn grey_btn nosupport">Programming</button>
                    <button class="filter_btn grey_btn nosupport">Hardware</button>
					-->
                </section>
				<!-- Generated PHP Section, could use AJAX and animations to make it look better; -->
                <?php
					$conn = db();
					
					# $sql_query = "SELECT * FROM BLOG ORDER BY blogDate LIMIT 5 OFFSET 0"; // not in assessment requirements.
					$sql_query = "SELECT * FROM BLOG"; // Assessment requires us to sort with php sorting algorithm.
					$result = $conn->query($sql_query);
					if (!$result){
						echo $conn->error;
						die("Error has occured");
					}
					$rows = $result->num_rows;
					$data_rows = array();
					for ($j = 0 ; $j < $rows ; ++$j){

						$result->data_seek($j);
						$blogTitle = htmlspecialchars($result->fetch_assoc()['blogTitle']);
						$result->data_seek($j);
						$blogImageSrc = htmlspecialchars($result->fetch_assoc()['blogImageSrc']);
						$result->data_seek($j);
						$blogImageCaption = htmlspecialchars($result->fetch_assoc()['blogImageCaption']);
						$result->data_seek($j);
						$blogText = htmlspecialchars($result->fetch_assoc()['blogText']);
						$result->data_seek($j);
						$topContent = htmlspecialchars($result->fetch_assoc()['topContent']);
						$result->data_seek($j);
						$blogDate = htmlspecialchars($result->fetch_assoc()['blogDate']);
						$result->data_seek($j);
						$blogID = htmlspecialchars($result->fetch_assoc()['ID']);
						# ($blogTitle, $blogImageSrc, $blogImageCaption, $blogText, $topcontent, $blogDate, $blogID)
						$data_rows[] =  new blog($blogTitle, $blogImageSrc, $blogImageCaption, $blogText, false, $blogDate, $blogID);
					};
					# Check if GET has a filter variables. ["latest", "oldest", "alpha"]
					if ($_SERVER["REQUEST_METHOD"] == "GET") {
		 				if (isset($_GET["filter"])){
							$conn = db();
							$filter = mysql_entities_fix_string($conn, $_GET["filter"]);
							# Here we sort the blog objects depending on the filter specified.
							# https://stackoverflow.com/questions/355550/sorting-an-array-of-objects-in-php-in-a-specific-order
							switch ($filter){
								case "latest":
									# Sort array by date descending.
									usort($data_rows, "latest_sort");
									printArray($data_rows);
									break;
								case "oldest":
									# Sort array by date ascending.
									usort($data_rows, "oldest_sort");
									printArray($data_rows);
									break;
								case "alpha":
									# Sort array by alphabetical.
									usort($data_rows, "alphabet");
									printArray($data_rows);
									break;
							}
							if (strlen($filter) < 3 && is_numeric($filter)){
								# If filter contains one character that is numeric. 
								printArray(getObjectsWithCertainMonth($data_rows, (int)$filter));
							}
						}else{
							# Defualt listing is array by date descending.
								usort($data_rows, "latest_sort");
								printArray($data_rows);
							
							}
						$result->close();
					}
				
					# Custom Sorting Operating Function.
					# Latest 
					function latest_sort($a, $b) {
   						global $data_rows;
						$a = (int)(new DateTime($a->blogDate))->format('U');
						$b = (int)(new DateTime($b->blogDate))->format('U');
   						if ($a==$b)
       						return 0;
   						else
      						return ($a > $b ? -1 : 1);
					}
				
					# Sorting Comparison function for oldest first.
					function oldest_sort($a, $b) {
   						global $data_rows;
						$a = (int)(new DateTime($a->blogDate))->format('U');
						$b = (int)(new DateTime($b->blogDate))->format('U');
   						if ($a==$b)
       						return 0;
   						else
      						return ($a < $b ? -1 : 1);
					}
				
				
					# Sorting Comparison function for alphabetical first.
					function alphabet($a, $b) {
   						global $data_rows;
   						$a = ($a->blogTitle)[0];
						$b = ($b->blogTitle)[0];
   						if ($a==$b){
       						return 0;
						}
   						else{
      						if (($a < $b) == 1){
								return -1;
							}else{
								return 1;
							}
						}
					}
				
					# Return objects with given month.
					function getObjectsWithCertainMonth($db_array, $selected_month){
						$filtered_array = array();
						foreach ($db_array as $blog) {
							$elem_month = (new DateTime($blog->blogDate))->format('n');
							if ($selected_month == $elem_month){
								$filtered_array[] = $blog;
							}
						}
						return $filtered_array;
					}
				
				
					# In charge of printing array into HTML code.
					function printArray($array_elem){
						for ($i = 0; $i < count($array_elem); $i++){
							echo $array_elem[$i];
						}
					}
				
				
				?>
            </section>
            <div id="more_optional">
                <button class="blue_btn" id="more_blogs_btn">Load More Blogs...</button>
            </div>
        </section>
    </main>
	<?php require "footer.inc.php"; ?>
</body>
</html>