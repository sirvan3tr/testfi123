<?php
// check for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit('Sorry, this script does not run on a PHP version smaller than 5.3.7 !');
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once('libraries/password_compatibility_library.php');
}
// include the config
require_once('config/config.php');
require_once('config/setup.php');

// include the to-be-used language, english by default. feel free to translate your project and include something else
require_once('translations/en.php');

// include the PHPMailer library
require_once('libraries/PHPMailer.php');

// load the login class
require_once('classes/Login.php');

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$login = new Login();

// ... ask if we are logged in here:
// User has 2 level of activation
// Level 1: user has registered via email and has confirmed their email.
// Level 2: User needs to upload documents and add details of company
// Once those 2 levels are satisfied the user has access to the platform
if ($login->isUserLoggedIn() == true) {
    $userid = $login->returnUserdata($login->getUsername(), 'user_id');
    $usractiveLevel = $login->returnUserdata($login->getUsername(), 'user_active_lvl');
    // the user is logged in. Now determine the user type
    if ($usractiveLevel==4) {
      if($login->getUsertype() == 1) { // Buyer/Investor has a user_type equal to 1
          include("views/seller_logged_in.php");
      } else if($login->getUsertype() == 2) { // Buyer/Investor has a user_type equal to 2
          include("views/buyer_logged_in.php");
      }
    } else {
      echo 'You are not active, please add company and documents'.
            '<br> <a href="register.php">Click here to continue...</a>';
    }

} else {
    // the user is not logged in. you can do whatever you want here.
    include("views/not_logged_in.php");
}
