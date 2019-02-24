<?php



?>
<!DOCTYPE html>
<html>
<head>
    <?php require 'header.php' ?>
</head>
<body>
<h2>Sign-In Here:</h2>
<form method='post' action='action.php?action=signIn'>
<label for='email'>Email: </label>
<input type='text' id='email' name='email'>

<label for='password'>Password: </label>
<input type='text' id='password' name='password'>

<input type='submit' value='Sign-In!'>

</form>
<br>
<h1>OR</h1>
<br>
<h2>Create an Account Here: </h2>
<form method='post' action='action.php?action=createAccount'>

<label for='creatName'>Your Name: </label>
<input type='text' id='createName' name='name'>

<label for='createEmail'>Email: </label>
<input type='text' id='createEmail' name='email'>

<label for='createPassword'>Password: </label>
<input type='text' id='createPassword' name='password'>

<input type='submit' value='Create Account!'>

</form>



</body>
</html>