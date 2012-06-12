/******************************************
 * Form Handlers and page                 *
 * generators for TSSAA WebApp Fat Client *
 *****************************************/

/** 
 * Login form handler
 */
$('#login_form').on("submit", function(e) {

//		var formData = $("#login_form").serialize();
//
//		$.ajax({
//			type: "POST",
//			url: "app_dev.php/login",
//			cache: true,
//			data: formData,
//			//success: onSuccess,
//		});

        $.mobile.changePage("#options_page", "slideup", true, true);

		return false;
});

function onSuccess() {
    $.mobile.changePage("#options_page", "slideup", true, true);
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
 * Get school list ajax handler
 */
$("#school_list_page").on("pagebeforechange", function(e, obj) {
        alert("we are post pagebeforechange");
        $.ajax({
            type: "GET",
            url:"app_dev.php/get_school_list",
            cache: "false",
            success: generateSchoolList
        });    
});

/**
 * DB Dialog ajax success callback
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

    $('ul#school_list').html(schools.join(''));
    $('ul#school_list').listview("refresh");
};
