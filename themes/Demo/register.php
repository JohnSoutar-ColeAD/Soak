<?php

// register.php
// Page with registration form aside

get_header();

?>

<div class="article-container row">
	<article class="col-lg-8">
		<h2><?php get_pageTitle(); ?></h2>
		<?php get_pageContent(); ?>
	</article>
    <div class="col-lg-4">
        <hr />
    <?php

        if ($Site->Session->loggedIn()) {
            echo "<h3>You are already logged in as ". $Site->Session->User->username . "</h3>";
            ?>
            <?
        } else {
    ?> 
        <form action="register.php" method="post" role="form">
            <div class="form-group col-lg-8">
                <input type="text" class="form-control" name="username" placeholder="Username" />
                <input type="password" class="form-control" name="password" placeholder="********"/>
            </div>

            <div class="form-group col-lg-8">
                <input type="text" class="form-control" name="firstName" placeholder="First name" />
                <input type="text" class="form-control" name="lastName" placeholder="Last name" />
                <input type="text" class="form-control" name="emailAddress" placeholder="Email address" />
            </div>
            <div class="form-group col-lg-8">
                <button type="submit" class="btn">Register</button>
            </div>

        </form>
        <?
        
            }

        ?>
    </div>
</div>



<?php

get_footer();

?>