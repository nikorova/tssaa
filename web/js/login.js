/******************************************
 * Form Handlers and page                 *
 * generators for TSSAA WebApp Fat Client *
 *****************************************/


$(document).on("pageinit", function(e, obj) {
    /** 
     * Login form handler
     */
    $("#login_page").on("submit", function(e, obj) {

        var formData = $("#login_form").serialize();

        $.ajax( "app_dev.php/login", {
            type: "POST",
            data: formData,
            contentType: 'application/x-www-form-urlencoded',
            success: loginSuccess
        });
        return false;
    }); 
        
    /**
     * Get school list ajax handler
     */
    $("#school_list_page_a").on("click", function(e, obj) {
        $.ajax("app_dev.php/get_school_list", {
            type: "GET",
            cache: "true",
            success: generateSchoolList
        });    
    });

    /**
     * Add school form ajax handler
     */
    $('#add_school_submit').on('click', function(e, obj) {

        var  formData = $('#add_school_form').serialize();

        $.ajax("app_dev.php/add_school", {
            type: "POST",
            cache: false,
            data: formData,
            success: popDBDialog
        });
        return false;
    });


});

/**
 * Login form ajax callback
 * TODO session management handled here?
 */
function loginSuccess(response) {
    alert("loginSuccess:\n" + response);
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
        alert(data);
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

    $.each(school_data, function() {
                var name = this.name;
                var phone = this.phone;
                var address = this.address; 

                var block = '<div data-role="collapsible"><h2>' +
                    this.name + '</h2><p><strong>Phone: ' +
                    this.phone + '</strong></p><p><strong>Address: ' +
                    this.address + '</strong></p></div>'
                
                schools.push('<li>' + block + '</li>');
            });

    $('ul#school_list').html(schools.join(''));
    $('ul#school_list').listview("refresh");
};
