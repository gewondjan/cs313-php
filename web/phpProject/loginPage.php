<?php
    require 'header.php';
    require 'navbar.php';

    session_start();

?>
<!DOCTYPE html>
<html>
<head>
    <?php add_header(); ?>
</head>
<body>
<div id='navbar'><?php showNavbar(); ?></div>
<h2>Sign-In Here:</h2>
<br>

<form method='post' action='action.php?action=signIn'>
<label for='email'>Email: </label>
<input type='text' id='email' name='email' value='ryan@test.com'>
<br>

<label for='password'>Password: </label>
<input type='password' id='password' name='password' value='ryanPassword'>
<br>

<input type='submit' value='Sign-In!'>

</form>
<br>
<h1>OR</h1>
<br>
<h2>Create an Account Here: </h2>
<form method='post' action='action.php?action=createAccount'>

<label for='creatName'>Your Name: </label>
<input type='text' id='createName' name='name'>
<br>
<label for='createEmail'>Email: </label>
<input type='text' id='createEmail' name='email'>
<br>
<label for='createPassword'>Password: </label>
<input type='password' id='createPassword' name='password'>
<br>
<input type='submit' value='Create Account!'>

</form>



</body>
</html>