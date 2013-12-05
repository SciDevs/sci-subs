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

  add_action('init', 'myStartSession', 1);
  add_action('wp_logout', 'myEndSession');
  add_action('wp_login', 'myEndSession');

  function myStartSession() {
    if(!session_id()) {
      session_start();
    }
  }

  function myEndSession() {
    session_destroy ();
  }

function createSubs($customer_id,$planId) {

        $customer = Braintree_Customer::find("customer".$customer_id);
        $payment_method_token = $customer->creditCards[0]->token;

        $result = Braintree_Subscription::create(array(
                'paymentMethodToken' => $payment_method_token,
                'planId' => $planId,
                'id' => date("YmdHis")
                ));

        if ($result->success) {
        //      echo("Success! Subscription " . $result->subscription->id . " is " . $result->subscription->status);

        } else {
                //echo("Validation errors:<br/>");
                foreach (($result->errors->deepAll()) as $error) {
                //      echo("- " . $error->message . "<br/>");
                }
        }


  }


  function createCustomers($customer_id) {
  	$result = Braintree_Customer::create(array(
  		"id" => $customer_id,
  		"firstName" => $_REQUEST["first_name"],
  		"lastName" => $_REQUEST["last_name"],
  		"creditCard" => array(
  			"number" => $_REQUEST["number"],
  			"expirationMonth" => $_REQUEST["month"],
  			"expirationYear" => $_REQUEST["year"],
  			"cvv" => $_REQUEST["cvv"],
        )
  		)); 

  	if ($result->success) {
  		//echo "success";   
  		createSubs($customer_id,$_REQUEST['planid']);
  	} else {
      deleteCustomer($customer_id);
  		//echo("Validation errors:<br/>");
  		//foreach (($result->errors->deepAll()) as $error) {
  			//$errormsg=$error->message;
  			//echo("- " . $error->message . "<br/>");
  		//}
  	}
  }

  function deleteCustomer($customer_id){
    wp_delete_user($customer_id);
  }

  add_action( 'user_register', 'myplugin_registration_save', 10, 1 );

  function myplugin_registration_save( $user_id ) {
   createCustomers($user_id);
   ?>
   <script type="text/javascript">
    location.href='<?php echo "http://".$_SERVER['HTTP_HOST']; ?>';
  </script>
  <?php
}
