<?php 
	# Check the window url and then make a specific elem class selected.
	echo '
		<header>
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
		</header>';
	# Book states not adding php end tag improves performance of script. Something buffer... jada.