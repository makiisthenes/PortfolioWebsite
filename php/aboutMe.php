<!DOCTYPE html>
<html lang="en-GB">
<head>
	<?php require "head.inc.php"; ?>
	<link rel="stylesheet" href="../css/aboutMe.css">
	<script type="text/javascript" src="../js/aboutMe.js"></script>
</head>

<body>
	<?php require "header.inc.php"; ?>
	
	<?php include "cookies.inc.php"; ?>
	
    <main>
        <!-- Main Markup Block, the rest is replicated in all tabs. -->
        <div id="cover_frame">
            <div id="middle_image">
				<img id="main_title" src="../aboutMe_rsr/Title@2x.png"/>
                <img class="icon" src="../aboutMe_rsr/after_effect_icon.png"/>
                <img class="icon" src="../aboutMe_rsr/android_icon.png"/>
                <img class="icon" src="../aboutMe_rsr/appium_icon.png"/>
                <img class="icon" src="../aboutMe_rsr/ardiuno_icon.png"/>
                <img class="icon" src="../aboutMe_rsr/atom_icon.png"/>
                <img class="icon" src="../aboutMe_rsr/audacity_icon.png"/>
                <img class="icon" src="../aboutMe_rsr/blender_icon.png"/>
                <img class="icon" src="../aboutMe_rsr/bootstrap_icon.png"/>
                <img class="icon" src="../aboutMe_rsr/brackets_icon.png"/>
                <img class="icon" src="../aboutMe_rsr/bscode_icon.png"/>
                <img class="icon" src="../aboutMe_rsr/codeblocks_icon.png"/>
                <img class="icon" src="../aboutMe_rsr/css_icon.png"/>
                <img class="icon" src="../aboutMe_rsr/django_icon.png"/>
                <img class="icon" src="../aboutMe_rsr/eclipse_icon.png"/>
                <img class="icon" src="../aboutMe_rsr/electron_icon.png"/>
                <img class="icon" src="../aboutMe_rsr/git_icon.png"/>
                <img class="icon" src="../aboutMe_rsr/github_icon.png"/>
                <img class="icon" src="../aboutMe_rsr/html_icon.png"/>
                <img class="icon" src="../aboutMe_rsr/java_icon.png"/>
                <img class="icon" src="../aboutMe_rsr/js_icon.png"/>
                <img class="icon" src="../aboutMe_rsr/linux_icon.png"/>
                <img class="icon" src="../aboutMe_rsr/nodejs_icon.png"/>
                <img class="icon" src="../aboutMe_rsr/opencv_icon.png"/>
                <img class="icon" src="../aboutMe_rsr/paradigm_icon.png"/>
                <img class="icon" src="../aboutMe_rsr/photoshop_icon.png"/>
                <img class="icon" src="../aboutMe_rsr/postman_icon.png"/>
                <img class="icon" src="../aboutMe_rsr/pycharm_icon.png"/>
                <img class="icon" src="../aboutMe_rsr/python_icon.png"/>
                <img class="icon" src="../aboutMe_rsr/slack_icon.png"/>
                <img class="icon" src="../aboutMe_rsr/sublime_icon.png"/>
                <img class="icon" src="../aboutMe_rsr/swift_icon.png"/>
                <img class="icon" src="../aboutMe_rsr/tensorflow_icon.png"/>
                <img class="icon" src="../aboutMe_rsr/wireshark_icon.png"/>
                <img class="icon" src="../aboutMe_rsr/xd_icon.png"/>
            </div>
            <div id="bottom_panel">
                <button id="scrollDown"><img src="../aboutMe_rsr/right_arrow.png"></button>
            </div>
        </div>
        <!-- Back to normal flow here -->
        <div id="main_content">
            <section id="background" class="aboutSection">
                <img src="../aboutMe_rsr/background_title@2x.png" id="bgdtitle">
                <!-- Qoute here -->
                <qoute>“Imagination is more important than knowledge" </qoute>
                    <p>
                        My name is Michael Peres, I'm a computer science major at Queen Mary University of London. I spend my time
                        either completing assignments, programming or learning new concepts in different fields of CompSci. 
                        My goals and motivation are based off the amazing things technology can do for people. I enjoy making 
                        things taking different features from other technologies and art, making inspirational products that build trust
                        and excitement. I'm an advocate of everything open source, as it allows developers and normal 
                        people to look at code freely, improve, learn from and most importantly build from. It serves the greater good
                        and community of current and future developers.  My interest are mostly related to Cryptography, AI,  Embedded
                        Systems and Competitive Programming.
                    </p>
            </section>  
            <section id="books" class="aboutSection">
                <div id="bookshelf">
                    <img src="../aboutMe_rsr/book1@2x.png">
                    <img src="../aboutMe_rsr/book2@2x.png">
                    <img src="../aboutMe_rsr/book3@2x.png">
                    <img src="../aboutMe_rsr/book4@2x.png">
                </div>
            </section>
            <section id="qualify" class="aboutSection">
                <div id="blockSeperater">
					<!-- Make this type out animation when in view -->
                    <code>def </code><code>getQualifications</code><code>();</code>
                </div>
                <p id="code_qualify">
                    <!-- Qualification in Code format -->
                    >>> getA_Levels(); <br/>
                    >>> {"subjects":{"Chemistry":'B', "Maths":'A', "Physics":'A'}} <br/>
                    >>> Uxbridge College <br/>
                    >>> getBSc(); <br/>
                    >>> BSc Computer Science with Year in Industry <br/>
                    >>> Queen Mary University of London <br/>
                </p>
            
            </section>
            <section id="skills" class="aboutSection">
                <h2>Skills and Experience</h2>
                <section class="skill_box">
                    <!-- Skill Box Layout. -->
                    <figure>
                    <!-- Place Image of Company or Event. -->
                    <img src="../aboutMe_rsr/uas_logo.png" alt="Skill Image" class="skill_img">
                    <figcaption>Company Name</figcaption>
                    </figure>
                    <div class="skill_main animate__animated animate__backInLeft">
                        <h4>Software Team Leader - UAS Challenge 2021</h4>
                        <blockquote>
                              This challenge was about building a autonomous plane that would operate during humantarian aid missions, the drone had to be capable of flying autonomously from takeoff to landing and be able to recognise alphanumerical images on the ground while flying. This challenge brang alot of different fields together from engineering, design, manufacturing, electronics and software, and gave me a great insight and knowledge about the different teams and functions in a product development team. I dealt with the systems and programs operating on the drone.<br>
                            <a href="https://www.imeche.org/events/challenges/uas-challenge" target="_blank">https://www.imeche.org/events/challenges/uas-challenge</a>
                        </blockquote>
                    </div>
                    <div class="skill_meta">
                            <p>November 2020-July 2021</p>
                            <p>London, United Kingdom</p>
                    </div>
                </section>
                <section class="skill_box">
                    <!-- Skill Box Layout. -->
                    <figure>
                    <!-- Place Image of Company or Event. -->
                        <img src="../aboutMe_rsr/credit_logo.png" alt="Skill Image" class="skill_img">
                        <figcaption>Company Name</figcaption>
                    </figure>
                    <div class="skill_main">
                        <h4>Solo Coder - Credit Suisse Coding Challenge</h4>
                        <blockquote>
                              This coding challenge worked on modern problems faced in Fintech,
                            things like fraud detection, looking at probabilities and stock 
                            prices, making algorithms that solve these problems.  <br>
                            <a href="https://credit-suisse.com/pwp/hr/en/codingchallenge/#/" target="_blank">https://credit-suisse.com/pwp/hr/en/codingchallenge/#/</a>
                        </blockquote>
                    </div>
                    <div class="skill_meta">
                            <p>October 19th–November 9th 2020</p>
                            <p>London, United Kingdom</p>
                    </div>
                </section>
                <section class="skill_box">
                    <!-- Skill Box Layout. -->
                    <figure>
                    <!-- Place Image of Company or Event. -->
                    <img src="../aboutMe_rsr/showcode_logo@2x.png" alt="Skill Image" class="skill_img">
                    <figcaption>Company Name</figcaption>
                    </figure>
                    <div class="skill_main">
                        <h4>Team Member - Unicode 20/21 Coding Challenge</h4>
                        <blockquote>
                              This coding challenge covered a number of challenges from across various
                            fields, this was a team challenge, representing Queen Mary University.<br>
                            <a href="https://www.showcode.io/unicode/" target="_blank">https://www.showcode.io/unicode/</a>
                        </blockquote>
                    </div>
                    <div class="skill_meta">
                            <p>Dec 2020-2021</p>
                            <p>London, United Kingdom</p>
                    </div>
                </section>
                <section class="skill_box">
                    <!-- Skill Box Layout. -->
                    <figure>
                    <!-- Place Image of Company or Event. -->
                    <img src="../aboutMe_rsr/reply_logo.png" alt="Skill Image" class="skill_img">
                    <figcaption>Company Name</figcaption>
                    </figure>
                    <div class="skill_main">
                        <h4>Team Member - Reply Code 2021 Coding Challenge</h4>
                        <blockquote>
                              This coding challenge was a 5G network based problem which involved me and my teammate from QMUL tackling a problem relating to developing an alogrithm that would find the best locations for antennas to be placed on a 2d map, where certain buildings had specific connection and latency scores. <br>
                            <a href="https://challenges.reply.com/tamtamy/home.action" target="_blank">https://challenges.reply.com/tamtamy/home.action</a>
                        </blockquote>
                    </div>
                    <div class="skill_meta">
                            <p>March 11th 2021</p>
                            <p>London, United Kingdom</p>
                    </div>
                </section>
                <section class="graph_box">
                    <h4>Skills Bell Curve</h4>
                    <img src="../aboutMe_rsr/graph@2x.png" width="50%">
                </section>
            </section>
        </div>
        <div id="end_content">
            <a href="viewBlog.php"  ><button id="end">&gt;&gt;&gt; Blogs</button></a>
            <a href="myProjects.php"><button id="end">&gt;&gt;&gt; Projects</button></a>
        </div>
    </main>
	<?php require "footer.inc.php"; ?>
</body>
</html>