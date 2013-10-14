<?php require('inc/common.php'); ?>
<?php

    /////////////////////////////////////////
    // ABANDON HOPE ALL YE WHO ENTER HERE  //
    //    This is unstable, unsafe code    //
    //     ...anything could happen...     //
    /////////////////////////////////////////

    // You have been warned

    $Session = new Session();
    if ($Session->loggedIn()) {
    	echo "You are logged in as ". $Session->User->username;
    	echo "<br />";
    	echo '<a href="logout.php">Log out</a>';
    } else {
    	?> 
        <form action="login.php" method="post">
            <input type="text" name="username" placeholder="Username" />
            <input type="password" name="password" placeholder="********"/>

            <input type="submit" value="Log in" />
            <br />
            (john.s:test)
        </form>
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
    	<?
    }
    echo "<br /><br />";
    var_dump($_COOKIE);
?>    
