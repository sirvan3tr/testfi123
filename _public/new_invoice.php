<?php
// include the config
require_once('config/config.php');
require_once('config/setup.php');

// load the login class
require_once('classes/Login.php');

// load the Company class
require_once('classes/Company.php');

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$login = new Login();

$userid = $login->returnUserdata($login->getUsername(), 'user_id');
$userActiveLevel = $login->returnUserdata($login->getUsername(), 'user_active_lvl');

$company = new Company($userid, $userActiveLevel, 1);

// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {
    // the user is logged in. you can do whatever you want here.
    $person = ORM::for_table('users')->where('user_email', $_SESSION['user_email'])->find_one();
    if($person->user_type == 1) { // Buyer/Investor has a user_type equal to 1
    	// include the PHPMailer library
		require_once('libraries/PHPMailer.php');

		// include new invoice submission code
		require_once('classes/invoice.php');
        if (isset($messages)) { // if new invoice has been submitted there will be a message, form will be hidden
        	include('views/ty.php');
        } else {
	        include("views/new_company.php");
	        include("views/new_invoice.php");
        }
    } else if($person->user_type == 2) { // Buyer/Investor has a user_type equal to 2
        echo "You must be a invoice seller to submit new invoices!";
    }
} else {
    echo "You must be logged in first!";
}

?>
