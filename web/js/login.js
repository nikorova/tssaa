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

$(document).on("pagebeforechange", function(e, obj) {
    /**
     * Get school list ajax handler
     */
    var url= $.mobile.path.parseUrl(obj.toPage);

    if ( url.hash  === "#school_list_page") {
        $.ajax("app_dev.php/get_school_list", {
            type: "GET",
            cache: "true",
            success: generateSchoolList
        });    

        e.preventDefault();
    };
});

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

    $.each(school_data, function() {
                var button = '<a ks_school_id=' + this.id + ' href="#edit_school' +
                    '" class="edit_school">Edit This School</a>';
                
                var block = '<div data-role="collapsible"><h2>' +
                    this.name + '</h2><p><strong>Phone: ' +
                    this.phone + '</strong></p><p><strong>Address: ' +
                    this.address + '</strong></p>' + button + '</div>';
                schools_html.push(block);
            });

    $('div#school_list').html(schools_html.join(''));

    $('div#school_list').on('click', 'a.edit_school', function (e) {
                var index = $(this).attr("ks_school_id");
                var school = school_data[index]; 

                console.log(index);
                console.dir(school);

                editSchoolEntity(school);
            });

    $.mobile.changePage($("#school_list_page")); 
};

function editSchoolEntity(school) {
    console.dir(school);
    console.log(school.name);
    console.log("oh hai");
    
    $("h2#school_object").html(school.name);

    $.mobile.changePage("#edit_school_dialog", {
            transistion: "pop"
            });
}
