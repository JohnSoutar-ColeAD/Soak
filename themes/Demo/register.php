<?php

// Page.php
// Main page template
get_header();

?>

<div class="article-container">
	<article>
		<h2><?php get_pageTitle(); ?></h2>
		<?php get_pageContent(); ?>
	</article>
    <div>
    <?php

        if ($Site->Session->loggedIn()) {
            echo "You are logged in as ". $Site->Session->User->username;
        } else {
    ?> 

        <hr />
        <form action="register.php" method="post">
            <input type="text" name="username" placeholder="Username" /><br />
            <input type="password" name="password" placeholder="********"/>
            <input type="password" name="password_confirm" placeholder="********"/><br />
            <input type="text" name="firstName" placeholder="First name" />
            <input type="text" name="lastName" placeholder="Last name" /><br />
            <input type="text" name="emailAddress" placeholder="Email address" />

            <input type="submit" value="Register" />

        </form>
    </div>
</div>

<?
    	
    }

get_footer();

?>