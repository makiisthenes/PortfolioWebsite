<?php require "session.inc.php"; ?>
<?php require "database.php"; ?> <!-- Online -->
<?php require "security.inc.php"; ?>
<?php
	if (isset($_SESSION["auth"])){
		if ($_SESSION["auth"] == "auth"){
			header('Location: dashboard.php');
			exit();
		}
	}
?>
<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$conn = db();
			if ($_GET["action"] == 1){
				// This is a login attempt.
				if ( isset($_POST["username"]) && isset($_POST["password"]) ) {
					
					# Preventing both SQL and XSS injection attacks.
					$username = mysql_entities_fix_string($conn, $_POST["username"]);
					$password = mysql_entities_fix_string($conn, $_POST["password"]);
					
					
					$result = $conn->query("SELECT * FROM USERS WHERE username='$username'");
					if ($result->num_rows == 1){
						# https://www.php.net/password-hash
						$row = $result->fetch_array(MYSQLI_ASSOC); // declared associative array.
						$result->data_seek(0);
						$hash = htmlspecialchars($row['password']);
						$result->data_seek(0);
						$userID = htmlspecialchars($row['ID']);
						$result->data_seek(0);
						if (password_verify($password, $hash)){
							$_SESSION["auth"] = "auth";
							$_SESSION["userID"] = $userID;
							$_SESSION["username"] = $username;
							header('Location: dashboard.php');
							exit();	
						}			
					}else{
						$_SESSION["login_status"] = "bad";
						header('Location: login.php');
						exit();
					}	
				}
			}else if ($_GET["action"] == 0){
				// This is a register attempt.
				if ( isset($_POST["username"]) && isset($_POST["password"])  && isset($_POST["email"])) {
					
					# Preventing both SQL and XSS injection attacks.
					$username = mysql_entities_fix_string($conn, $_POST["username"]);
					$password = mysql_entities_fix_string($conn, $_POST["password"]);
					$ip = $_SERVER['REMOTE_ADDR']; 
					# Todo, add ip to users column for account security.
					$ua = $_SERVER['HTTP_USER_AGENT'];
					# Hashing passwords with defualt salt. // Drop all accounts that do not have salt.
					$password = password_hash($password, PASSWORD_DEFAULT);
					
					$email = mysql_entities_fix_string($conn, $_POST["email"]);
					
					
					$username_check = $conn->query("SELECT * FROM USERS WHERE username='$username'");
					if ($username_check->num_rows > 0){
						$_SESSION["register_status"] = "username_error";
						header('Location: login.php');
						exit();
					}
					$email_check = $conn->query("SELECT * FROM USERS WHERE email='$email'");
					if ($email_check->num_rows > 0){
						$_SESSION["register_status"] = "email_error";
						header('Location: login.php');
						exit();
					}
					
					
					# Secure Version | Adding placement to make mysql secure and no mysql injection can occur.
					/*
					$stmt = $conn->prepare('INSERT INTO USERS VALUES(?,?,?)');
					$stmt->bind_param($username, $email, $password);
					$result = $stmt->execute();
					if ($result) {
						$conn->close();
						$_SESSION["register_status"] = "good";
						header('Location: login.php');
						exit();
					}else{
						$_SESSION["register_status"] = "unknown";
						echo $conn->error;
					}	
					*/
					$sql_query = "INSERT INTO USERS" . "(username, email, password) VALUES ('$username','$email', '$password')";
					# Add this to the database.
					$result = $conn->query($sql_query);
					if ($result) {
						$_SESSION["register_status"] = "good";
						header('Location: login.php');
						exit();
					}else{
						$_SESSION["register_status"] = "unknown";
						echo $conn->error;
					}	
					
			}
				// handle the posted data.
				# echo "Handling form data!";
				# You should always use to transmit login POST credentials
				# https://stackoverflow.com/questions/16501984/php-csrf-attack
				# urlencode() and urldecode(), htmlentities();
				# echo "Username: " . $_POST["username"] . "<br>";
				# echo "Password: " . $_POST["password"] . "<br>";
				# Check this combination with database.
				# If query string parameter doesn't exist.
				# If query string parameter doesn't contain a value.
				# If query string parameter value isn't the correct type or is out of acceptable range.
				# If value is required for a database lookup, but provided value doesn't exist in the database table.
				# include "database.inc.php";
				
		}
	}
?>

<!DOCTYPE html>
<html lang="en-GB">
<head>
	<?php require "head.inc.php"; ?>
	<link rel="stylesheet" href="../css/login.css">
	<script type="text/javascript" src="../js/login.js"></script>
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
    </header>
	<?php include "cookies.inc.php"; ?>
	<div id="background_image_box">
		<img src="../project_background.png" width="100%"/>
	</div>
	<div class="side_text left align ">
		<div class="text_wrapper">
			<p class="vertical_left"> maki | sign in or register to get access to blogs , and much more... | maki | sign in or register to get access to blogs , and much more... |</p>
		</div>
	</div>
	<div class="side_text right align">
		<p class="vertical_right "> maki | sign in or register to get access to blogs , and much more... | maki | sign in or register to get access to blogs , and much more... |</p>
	</div>
    <main>
        <!-- Main Content Here -->
		<div id="main_container">
			<form id="login_form" action="login.php?action=1" method="post">
			<div id="login">
				<div id="login_title">
					<h1>Login.</h1>
				</div>
					<div id="login_box">
						<div class="login_input">
							<span class="action_span">username</span>
							<div class="black_input_box" >
								<input id="login_username_input" class="black_input" type="text" placeholder="Username" name="username" pattern="[a-zA-Z0-9]+" autofocus="false" maxlength="50" autofocus required />
							</div>
						</div>
						<div class="login_input">
							<span class="action_span">password</span>
							<div class="black_input_box" >
								<!-- Pattern: Password (UpperCase, LowerCase and Number) -->
								<input class="black_input" type="password" name="password" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" autofocus="false" maxlength="50" value="" placeholder="Password (UpperCase, LowerCase and Number)" required />
							</div>
						</div>
					</div>
					<div class="action_box">
						<input type="submit" class="action_button" id="login_submit" value="login" disabled/>
						<p class="status_error" id="login_error">
							<?php 
								if (isset($_SESSION["login_status"])){
									if ($_SESSION["login_status"] == "bad"){
										echo "username or password not found or incorrect.";
									}
									unset($_SESSION["login_status"]);
								}
							?>
							</p>
					</div>
				</div>
				</form>
				<form id="register_form" action="login.php?action=0" method="post">
				<div id="register">
					<div id="reg_col1">
						<div id="register_title">
							<h1>Create Account.</h1>
						</div>	
						<div class="register_input">
							<span class="action_span">username</span>
							<div class="register_input_box" >
								<input id="register_username_input" class="register_box" type="text" name="username" pattern="[a-zA-Z0-9]+" autofocus="false" maxlength="50" placeholder="Username" required />
							</div>
						</div>	
							
						<div class="register_input">
							<span class="action_span">password</span>
							<div class="register_input_box" >
								<input id="register_password_input" class="register_box" type="password" name="password" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" autofocus="false" placeholder="Password (UpperCase, LowerCase and Number)" maxlength="50" required />
							</div>
						</div>		
						
						<div class="action_box">
							<input type="submit" class="action_button" id="register_submit" value="create account" />
							<p class="status_error" id="register_error">
							<?php 
								if (isset($_SESSION["register_status"])){
									if ($_SESSION["register_status"] == "username_error"){
										echo "Username has already been used";
									}else if ($_SESSION["register_status"] == "email_error"){
										echo "Email has already been used";
									}else if ($_SESSION["register_status"] == "unknown"){
										echo "Something is horribly wrong with the backend, please contact me ASAP!";
									}else if ($_SESSION["register_status"] == "good"){
										echo "Account Made Successfully!";
									}
									unset($_SESSION["register_status"]);
								}
							?>
							</p>
						</div>
					</div> 	
					<div id="reg_col2">
						<div id="register_title">
							<h1 class="hidden">placeholder</h1>
						</div>
						
						<div class="register_input">
							<span class="action_span">email</span>
							<div class="register_input_box" >
								<input id="register_email_input" class="register_box" type="email" name="email" autofocus="false" maxlength="50" required placeholder="Email" />
							</div>
						</div>
						<div class="register_input">
							<span class="action_span">subscribe to newsletter</span>
							<div class="register_input_box" >
								<input id="register_news_input" class="register_box" type="checkbox" name="subscriber" />
							</div>
						</div>
					</div>
					</div>
				</form>
		</div>
    </main>
    <?php require "footer.inc.php" ?>
</body>
</html>