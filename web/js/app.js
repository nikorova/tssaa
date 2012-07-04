/******************************************
 * Form Handlers and page                 *
 * generators for TSSAA WebApp Fat Client *
 *****************************************/

/**
 * AJAX convenience wrapper
 */
function service_call(uri, args) {
	// TODO get session id and access_id
	request = { 
		payload: args.request_params,
		session: "TEST ID",
		access_id: "TEST ADMIN"
	};

	$.ajax(uri, { 
		type: args.hasOwnProperty(request_params) ? "POST" : "GET,
		data: request,
		success: args.on_success,
		error: args.on_fail
	});
}

/**
 * Login form ajax callback
 * TODO session management handled here?
 */
function loginSuccess(response) {
    $.mobile.changePage($("#options_page"), {
            transition: "slideup", 
            reverse: true, 
        }); 
}

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
    var school_data;

    try {
        school_data = $.parseJSON(response);
    } catch(err) {
        alert(err);
    }
    
    var schools_html = [];

    for (school in school_data) {
        school = school_data[school];
        var button = '<a ks_school_id=' + school.id + ' href="#edit_school' +
            '" class="edit_school">Edit This School</a>';
        
        var block = '<div data-role="collapsible"><h2>' +
            school.name + '</h2><p><strong>Phone: ' +
            school.phone + '</strong></p><p><strong>Address: ' +
            school.address + '</strong></p>' + button + '</div>';
        schools_html.push(block);
    }

    $('div#school_list').html(schools_html.join(''));

    $('div#school_list').on('click', 'a.edit_school', function (e) {
                var index = $(this).attr("ks_school_id");
                var school = school_data[index]; 
                $.each($("form#edit_school_form input"), function() {
                        var key = $(this).attr("name");
                        $(this).attr("value", school[key]);
                    });                
                editSchoolEntity(school);
            });

    $.mobile.changePage($("#school_list_page")); 
};

function editSchoolEntity(school) {
    $("#edit_school_form").on("submit", function (e) {
		var form_data = $("#edit_school_form").serializeArray();
		
		form_data.append({name: "id", value: school.id});
		
		service_call("app_dev.php/update_school", {
			request_params: form_data, 
			success: function () {$.mobile.changePage("#school_list_page")}
		}); 

		return false;
	});

    $.mobile.changePage("#edit_school_dialog", {
            transistion: "pop"
            });

}

$(document).on("pageinit", function(e, obj) {
    /** 
     * Login form handler
     */
    $("#login_page").on("submit", function(e, obj) {

        var formData = $("#login_form").serializeArray();

		service_call("app_dev.php/login", {
			request_params: formData,
			on_success: loginSuccess
		});

        return false;
    }); 
        

    /**
     * Add school form ajax handler
     */
    $('#add_school_submit').on('click', function(e, obj) {

        var  formData = $('#add_school_form').serializeArray();
	
		service_call("app_dev.php/add_school", {
			request_params: formData,
			on_success: popDBDialog
		});
        
        return false;
    });


});

$(document).on("pagebeforechange", function(e, obj) {
    /**
     * Get school list ajax handler
     */
    var url= $.mobile.path.parseUrl(obj.toPage);

    if ( url.hash  === "#school_list_page") {
		service_call("app_dev.php/get_school_list", {
			on_success: generateSchoolList
		});

        e.preventDefault();
    };
});

