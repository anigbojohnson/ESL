<?php
	require_once "stripe-php-master/init.php";
	require_once "products.php";

	$stripeDetails = array(
		"secretKey" => "sk_test_EM2ISBho1i2VztmQH8iQwtO600WczQnjpf",
		"publishableKey" => "pk_test_bMToQz9lq4TgR3V5Qe6jRygh00I6c2oSfG"
	);

	// Set your secret key: remember to change this to your live secret key in production
	// See your keys here: https://dashboard.stripe.com/account/apikeys
	\Stripe\Stripe::setApiKey($stripeDetails['secretKey']);
?>
