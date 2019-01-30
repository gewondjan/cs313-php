<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout Page</title>
</head>
<body>
<h1>Welcome to the checkout page</h1>

<form method='post' action='confirmed.php'>
<label for='orderName'>Order Name</label>
<input type='text' id='orderName' name='orderName'>
<br>
<label for='addressLine'>Street Address</label>
<input type='text' id='addressLine' name='addressLine'>
<br>
<label for='city'>City</label>
<input type='text' id='city' name='city'>
<br>
<label for='states'>State</label>
<input list='states' name='state'>
<datalist id='states' name='state'>
<option value='AL'>
<option value='AK'>
<option value='AZ'>
<option value='AR'>
<option value='CA'>
<option value='CO'>
<option value='CT'>
<option value='DE'>
<option value='FL'>
<option value='GA'>
<option value='HI'>
<option value='ID'>
<option value='IL'>
<option value='IN'>
<option value='IA'>
<option value='KS'>
<option value='KY'>
<option value='LA'>
<option value='ME'>
<option value='MD'>
<option value='MA'>
<option value='MI'>
<option value='MN'>
<option value='MS'>
<option value='MO'>
<option value='MT'>
<option value='NE'>
<option value='NV'>
<option value='NH'>
<option value='NJ'>
<option value='NM'>
<option value='NY'>
<option value='NC'>
<option value='ND'>
<option value='OH'>
<option value='OK'>
<option value='OR'>
<option value='PA'>
<option value='RI'>
<option value='SC'>
<option value='SD'>
<option value='TN'>
<option value='TX'>
<option value='UT'>
<option value='VT'>
<option value='VA'>
<option value='WA'>
<option value='WV'>
<option value='WI'>
<option value='WY'>
</datalist>
<br>
<label for='zip'>Zip Code</label>
<input type='text' id='zip' name='zip'>
<br>
<input type='submit' value='Complete Purchase'>
</form>
<br>
<a href="cart.php">Go Back to Cart</a>
</body>
</html>