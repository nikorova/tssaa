/* Form handlers for tssaa fat client */

/** 
 * Login form handler
 */
$('#submit_button').live("click", function() {
		$.mobile.changePage("options_page", "slideup", true, true);

		var formData = $("#login_form").serialize();

		$.ajax({
			type: "POST",
			url: "app_dev.php/login",
			cache: false,
			data: formData,
			success: onSuccess,
			error: onError
		});

		return false;
});

function onSuccess(response) {
		var response_items = [];

		try {var data = $.parseJSON(response);}
		catch(err) {$("#response_output").text(err);};
		
		$.each(data, function(key, val) {
				response_items.push('<tr id="'+key+'"><td>'+key+':</td><td>'+val+'</td></tr>');
		});

		$('<table/>',{
			'class': 'response_table',
			html: response_items.join('')
		}).appendTo("#response_output");
}

function onError(error) {
		$("#response_output").text(error);
}

/**
 * Add user form handler
 */
$('#add_user_submit').live('click', function() {

	var  formData = $('#add_user_form').serialize();

	$.ajax({
		type: "POST",
		url: "app_dev.php/add_user",
		cache: false,
		data: formData,
		success: onAddUser,
		error: onAddUserError
	});
		
	return false;
});

function onAddUser(response) {
	    $.mobile.changePage('db_confirm_dialog', "", true, true);

		var response_items = [];

		try {
			var data = $.parseJSON(response);
		} catch(err) {
			alert(err);	
		}

		$.each(data, function(key, val) {
				response_items.push('<tr id="'+key+'"><td>'+key+':</td><td>'+val+'</td></tr>');
		});

		$('<table/>',{
			'class': 'response_table',
			html: response_items.join('')
		}).appendTo("#response");
}

function onAddUserError(err) {
		alert(err);
}

/**
 * Add school form handler
 */
$('#add_school_submit').live('click', function() {
	$.mobile.changePage('add_user_confirm_page', "slideup", true, true);

	var  formData = $('#add_school_form').serialize();

	$.ajax({
		type: "POST",
		url: "app_dev.php/add_school",
		cache: false,
		data: formData
	});
		
	return false;
});
