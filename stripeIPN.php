<?php
	require_once "config.php";

	\Stripe\Stripe::setVerifySslCerts(false);

	// Token is created using Checkout or Elements!
	// Get the payment token ID submitted by the form:
	$subscriptionID = $_GET['id'];

	if (!isset($_POST['stripeToken']) || !isset($subscription[$subscriptionID])) {
		header("Location: pricing.php");
		exit();
	}

	$token = $_POST['stripeToken'];
	$email = $_POST["stripeEmail"];

	// Charge the user's card:
	$charge = \Stripe\Charge::create(array(
		"amount" => $subscription[$subscriptionID]["price"],
		"currency" => "usd",
		"description" => $subscription[$subscriptionID]["title"],
		"source" => $token,
	));

	//send an email
	//store information to the database
	echo 'Success! You have been charged $' . ($subscription[$subscriptionID]["price"]/100);
?>
