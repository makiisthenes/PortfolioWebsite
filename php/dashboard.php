<?php include "session.inc.php"; ?>
<?php 
	if (isset($_SESSION["auth"])){
		if ($_SESSION["auth"] == "noauth"){
			header('Location: login.php');
			exit();
		}
	}else{
		header('Location: index.php');
		exit();
	}
?>
<!DOCTYPE html>
<html lang="en-GB">

<head>
	<?php require "head.inc.php"; ?>
	<link rel="stylesheet" href="../css/dashboard.css">
	<script type="text/javascript" src="../js/dashboard.js"></script>
</head> 
<body>
    <?php require "header.inc.php"; ?>
	<?php require "cookies.inc.php"; ?>
    <main>
        <!-- Main Content Here -->
		<div id="dashboard_header">
			<h2>MyAccount Dashboard</h2>
			<a href="logout.php"><button>Logout</button></a>
		</div>
        <div id="dashboard">
            <div id="blog_management">
                <h4>Blog Management Section</h4><br>
                <div id="blog_list">
                    <ul>
                        <li><span>Blog Name</span><button class="delete">Delete</button></li>
                        <li><span>Blog Name</span><button class="delete">Delete</button></li>
                        <li><span>Blog Name</span><button class="delete">Delete</button></li>
                        <li><span>Blog Name</span><button class="delete">Delete</button></li>
                        <li><span>Blog Name</span><button class="delete">Delete</button></li>
                        <li><span>Blog Name</span><button class="delete">Delete</button></li>
                        <li><span>Blog Name</span><button class="delete">Delete</button></li>
                        <li><span>Blog Name</span><button class="delete">Delete</button></li>
                        <li><span>Blog Name</span><button class="delete">Delete</button></li>
                        <li><span>Blog Name</span><button class="delete">Delete</button></li>
                        <li><span>Blog Name</span><button class="delete">Delete</button></li>
                        <li><span>Blog Name</span><button class="delete">Delete</button></li>
                        <li><span>Blog Name</span><button class="delete">Delete</button></li>
                        <li><span>Blog Name</span><button class="delete">Delete</button></li>
                        <li><span>Blog Name</span><button class="delete">Delete</button></li>
                        <li><span>Blog Name</span><button class="delete">Delete</button></li>
                        <li><span>Blog Name</span><button class="delete">Delete</button></li>
                        <li><span>Blog Name</span><button class="delete">Delete</button></li>
                        <li><span>Blog Name</span><button class="delete">Delete</button></li>
                        <li><span>Blog Name</span><button class="delete">Delete</button></li>
                        <li><span>Blog Name</span><button class="delete">Delete</button></li>
                        <li><span>Blog Name</span><button class="delete">Delete</button></li>
                        <li><span>Blog Name</span><button class="delete">Delete</button></li>
                        <li><span>Blog Name</span><button class="delete">Delete</button></li>
                        <li><span>Blog Name</span><button class="delete">Delete</button></li>
                        <li><span>Blog Name</span><button class="delete">Delete</button></li>
                        <li><span>Blog Name</span><button class="delete">Delete</button></li>
                        <li><span>Blog Name</span><button class="delete">Delete</button></li>
                        <li><span>Blog Name</span><button class="delete">Delete</button></li>
                        
                    </ul>
                </div>
            </div>
            <div id="form_wrapper">
                <form id="createBlog" method="post" action="addEntry.php" enctype="multipart/form-data">
					<input id='max' type='hidden' name='MAX_FILE_SIZE' value='5242880'>
                    <h4>Blog Creation Section</h4><br>
                    <label id="blog_title_label">Blog Title: </label>
                    <input class="" id="blogTitleEntry" type="text" autocomplete="off" name="blogTitle" label="blog_title_label" placeholder="Enter blog name: " />
                    <br>
                    <label id="blog_title_label">Enter Blog Entry below:</label><br>
                    <textarea class="" id="blog_contents" name="blog_contents" placeholder="Add blog article text here... Min Characters: 300"></textarea>
                    <label id="image_upload">Upload Blog Cover Image below:</label><br><br>
                    <input id="blog_image" class="" type="file" id="myFile" name="blog_image" accept="image/*"/>
					<br>
					<p>Max File Size: 5MB | .jpg .png files only.</p><br>
					<span>Notify newsletter users?</span><input type="checkbox" id="notify_checkbox" name="notify_checkbox"/>
                    <div id="form_buttons">
                        <input id="form_submit" type="submit" value="Create Blog!">
						<input type="button" id="clearBlogBtn" value="Clear Form Values!">
                    </div>
                </form>
            </div>
        </div>
    </main>
        <?php require "footer.inc.php"; ?>
    </body>
    </html>