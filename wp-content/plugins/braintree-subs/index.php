<?php
/*
  Plugin Name: Braintree Subs
  Version: 1.0
  Author URI: -
  Plugin URI: -
  Description:  
  Author: Anjana/Ranjana
  License: GPL2
 */

  define('SUBSDIR', dirname(__FILE__) . '/');
  define('SUBSINC', SUBSDIR . 'braintree/');

# Dependencies                            
  require_once(SUBSINC . 'lib/Braintree.php');
  Braintree_Configuration::environment("sandbox");
  Braintree_Configuration::merchantId("hnmgp6x6wby926nt");
  Braintree_Configuration::publicKey("6987ypmynf8hsgzj");
  Braintree_Configuration::privateKey("323cd775a11e6459a11cd0e532912719");

  function subscription_activate() {

  }

  register_activation_hook(__FILE__, 'subscription_activate');

  function subscription_deactivate() {

  }

  register_deactivation_hook(__FILE__, 'subscription_deactivate');


  function createSubs($customer_id) {

  	$customer = Braintree_Customer::find($customer_id);
  	$payment_method_token = $customer->creditCards[0]->token;
  	//$planId=$_REQUEST['planId'];
        //$price=$_GET["price"];

  	$result = Braintree_Subscription::create(array(
  		'paymentMethodToken' => $payment_method_token,
  		'planId' =>'sci-subs-monthly',// $_REQUEST['planId']
  		'id' => $customer_id
  		));

  	if ($result->success) {
  		echo("Success! Subscription " . $result->subscription->id . " is " . $result->subscription->status);

  	} else {
  		echo("Validation errors:<br/>");
  		foreach (($result->errors->deepAll()) as $error) {
  			echo("- " . $error->message . "<br/>");
  		}
  	}

  }


   function createCustomers($customer_id) {//echo "=>".$customer_id; exit;
  	$result = Braintree_Customer::create(array(
  		"id" => $customer_id,
  		"firstName" => $_REQUEST["first_name"],
  		"lastName" => $_REQUEST["last_name"],
  		"creditCard" => array(
  			"number" => $_REQUEST["number"],
  			"expirationMonth" => $_REQUEST["month"],
  			"expirationYear" => $_REQUEST["year"],
  			"cvv" => $_REQUEST["cvv"],
  			/*"billingAddress" => array(
  				"postalCode" => $_REQUEST["zip"]
  				)*/
  		)
  		)); 
  
  	if ($result->success) {
  		echo "success";   
  		createSubs($customer_id);
  	} else { exit;
  		echo("Validation errors:<br/>");
  		foreach (($result->errors->deepAll()) as $error) {
  			$errormsg=$error->message;
  			echo("- " . $error->message . "<br/>");
  		}
  	}
 }
add_action( 'user_register', 'myplugin_registration_save', 10, 1 );

function myplugin_registration_save( $user_id ) {
	echo "====>".$user_id;  //print_r($_REQUEST); die();
	createCustomers($user_id);
    
}
