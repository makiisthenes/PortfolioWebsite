<?php
	echo '
	<footer>
        <div id="news_letter">
            <form id="newsletter_form">
                <label>Email:</label>
                <input autocomplete="email" id="newsletter_input" type="email" name="newsletter_email" placeholder="Enter Email for notifications!" required>
                <input type="submit" value="Send" id="newsletter_submit"/>
            </form>
        </div>
		<!-- Spam Protection from bots JS Script -->
        <a href="mailto:" id="email_anchor">Email Me >>></a>
    </footer>';
