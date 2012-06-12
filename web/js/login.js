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
}

function onError(error) {
		$("#response_output").text(error);
}

/**
 * Add user form ajax handler
 */
$('#add_user_submit').live('click', function() {

	var  formData = $('#add_user_form').serialize();

	$.ajax({
		type: "POST",
		url: "app_dev.php/add_user",
		cache: false,
		data: formData,
		success: popDBDialog,
	});
		
	return false;
});

/**
 * Add school form ajax handler
 */
$('#add_school_submit').live('click', function() {

	var  formData = $('#add_school_form').serialize();

	$.ajax({
		type: "POST",
		url: "app_dev.php/add_school",
		cache: false,
		data: formData,
        success: popDBDialog
	});
		
	return false;
});

/**
 * Get school list form ajax handler
 */
$('a#school_list_page').live('click', function() {
    $.ajax({
        type: "GET",
        url:"app_dev.php/get_school_list",
        cache: "false",
        success: generateSchoolList
    });    
});

/**
 * DB Dialog ajax success handler
 */
function popDBDialog(response) {
    try {
        var data = $.parseJSON(response);
    } catch(err) {
        alert(err);	
    }

    var response_items = [];

    $.each(data, function(key, val) {
            response_items.push('<tr id="'+key+'"><td>'+key+':</td><td>'+val+'</td></tr>');
    });

    $('<table/>',{
			'class': 'response_table',
			html: response_items.join('')
		}).replaceAll("#response");
    
    $.mobile.changePage("#db_confirm_dialog");
}

/**
 * School List response handler
 * generates ul of schools returned from DB
 */
function generateSchoolList(response) {
    
    try {
        var school_data = $.parseJSON(response);
    } catch(err) {
        alert(err);
    }
    
    var schools = [];

    $.each(school_data, function(school) {
                var name = school;
                var phone = school.phone;
                var address = school.address; 
                
                //TODO expanding li for each school with phone, address, etc
                schools.push('<li><a href="'+name+'">'+name+'</a></li>');
            });

    $('#shool_list').replaceWith(schools.join(''));
};
