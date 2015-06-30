$(function() {
	$(document).on('click', "#new_company_btn", function (e) {
	    e.preventDefault();
	    var form = "#new_company_form";

	    function ajaxsubmit(form) {
	    	var data = $(form).serialize();
		    $.ajax({ url: 'new_invoice.php',
		        type: 'post',
		        data: data,
		         beforeSend: function ( xhr ) {
		        xhr.overrideMimeType("text/plain; charset=x-user-defined");
		        },
		        success: function(data) {
		            console.log('success');
		            $('#newcomp').modal('hide');
		            location.reload();
		        },
		        error: function (data) {
		            alert("There was an error, please try again");
		        } // Success function
		    }); // Ajax Function
	    }
	    
	    error = 0;
	    $(form+' input').each(function() {
	    	var val = $(this).val();
	    	if(val == '') {
	    		$(this).parent().addClass('has-error');
	    		error = 1;
	    	}
	    });

	    if(error > 0) {
	    	// error
	    } else {
	    	ajaxsubmit(form);
	    }
	});
});