<?php
// include the config
require_once('config/config.php');
require_once('config/setup.php');

// load the login class
require_once('classes/Login.php');

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$login = new Login();


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
			require_once('classes/new_company.php');
	        include("views/new_company.php");   
	        include("views/new_invoice.php");
        }
        ?>
        <script type="text/javascript" src="static/js/new_company.js"></script>
        <?php
    } else if($person->user_type == 2) { // Buyer/Investor has a user_type equal to 2
        echo "You must be a invoice seller to submit new invoices!";
    }
} else {
    echo "You must be logged in first!";
}

?>
<script type="text/javascript">
$(function () {
	/*
	$(document).on('click', "#new_invoice_btn", function (e) {
	    e.preventDefault();
	    var data = $("#new_invoice_form").serialize();
	    console.log(data);
	    
	    
	    $.ajax({ url: 'classes/invoice.php',
	        type: 'post',
	        data: data,
	         beforeSend: function ( xhr ) {
	        xhr.overrideMimeType("text/plain; charset=x-user-defined");
	        },
	        success: function(data) {
	            alert('Success');
	        },
	        error: function (data) {
	            alert("There was an error. Image could not be added, please try again");
	        } // Success function
	    }); // Ajax Function


	});*/

})
</script>