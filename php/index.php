<!-- https://handlebarsjs.com/ -->
<!DOCTYPE html>
<html lang="en-GB">

<head>
	<?php require "head.inc.php" ?>
	<script type="text/javascript" src="../js/index.js"></script>
	<link rel="stylesheet" href="../css/index.css">
</head>

<body>
	<noscript><div class="no_js alert_banner">Javascript is not enabled, for the best experience please allow on this website.</div></noscript>
    <div class="alert_banner">No CSS frameworks or libraries or Javascript has been used. [Coursework 1]</div>
	
	<?php require "header.inc.php"; ?>
	
	<?php include "cookies.inc.php"; ?>
	
	<main>
        <!-- Main Markup Block, the rest is replicated in all tabs. -->
        <section id="main_container">
            <div id="main_wrapper">
                <div id="profile_pic_section">
                    <figure>
                        <img id="profile_pic" src="../profile.png" alt="my_profile_pic">
                    </figure>
                </div>
                <div id="interact_section">
                    <h2>Michael Peres</h2>
                    <div id="main_button_wrapper">
                        <a href="aboutMe.php">
                        <button id="main_button">3xplore&#62;&#62;&#62;</button>
                        </a>
                    </div>
                </div>
				
            </div>
        </section>
        <section id="background">
        <!-- Background Graphics -->
            <img id="code_block" src="../Code%20Background.png" width="100%;"/>
            <img id="blue_card" src="../blue_background.png"/>
        </section>
    	<div id="notification_section">
			<div class="notif">
				<h5>Notification 1</h5>
				<span>Check out my latest github repo!</span>
				<button class="close_btn">Close</button>
			</div>
			<div class="notif">
				<h5>Notification 2</h5>
				<span>Check out my latest github repo! Check out my latest github repo! </span>
				<button class="close_btn">Close</button>
			</div>
			<div class="notif">
				<h5>Notification 3</h5>
				<span>Check out my latest github repo!</span>
				<button class="close_btn">Close</button>
			</div>
		</div>
		<div id="profile_pic_toggle">
			<button id="profile_toggle_btn">Change Profile Image >>></button>
			<div id="profile_status">VIEW: AVATAR</div>
		</div>
    </main>
	<?php require "footer.inc.php"; ?>  
</body>

</html>