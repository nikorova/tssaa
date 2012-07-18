/******************************************
 * Form Handlers and page                 *
 * generators for TSSAA WebApp Fat Client *
 *****************************************/
$.fn.serializeObject = function () {
	var o = {};
	var a = this.serializeArray();

	$.each(a, function() {
		if (o[this.name] !== undefined) {
			if (!o[this.name].push) {
				o[this.name] = [o[this.name]];
			}
			o[this.name].push(this.value || '');
		} else {
			o[this.name] = this.value || '';
		}
	});
	return o;
};

function login_call(user_name, password) {
	var nonce = generateNonce(16);
	var nonce64 = base64encode(nonce);

	var created = ISODateString(new Date());

	var clientShaInput = nonce + created + password;

	var digest = b64_sha1(clientShaInput);

	var x_wsse_header = "UsernameToken Username=\""
		+ user_name + "\", PasswordDigest=\""
		+ digest + "\", Nonce=\""
		+ nonce64 + "\", Created=\""
		+ created + "\"";

	$.ajax("../app_dev.php/login", {
		type: "GET",
		beforeSend: function (xhr) {xhr.setRequestHeader("X-WSSE", x_wsse_header);},
	});

	return false;
}

/**
 * AJAX convenience wrapper
 * @param uri target uri for request
 * @param args object comprised of args for ajax call 
 */
function service_call(uri, args) {
	$.ajax(uri, { 
		type: args.hasOwnProperty("request_params") ? "POST" : "GET",
	// JSON.stringify will return undefined if args.request_params is undef 
	data: JSON.stringify(args.request_params),
	success: on_success,
	error: on_failure,
	complete: on_complete,
	});

	function on_success (response, textStatus, jqXHR) {
		console.log("log: on_success: " + textStatus);

		data = JSON.parse(response);

		if (data.status === "success") {
			// TODO check if payload prop
			args.on_success(data.payload);	
		} else {
			// TODO exception definitions
			args.on_failure(textStatus, data.exception);
		}
	}

	function on_failure (jqXHR, textStatus, errorThrown) {
		console.log("log: on_failure: " + textStatus);

		if (args.on_failure) {		
			args.on_failure(textStatus, errorThrown);
		} else {
			// Do nothing
		}
	}

	function on_complete (jqXHR, textStatus) {
		console.log("log: on_complete: " + textStatus);

		if (args.on_complete) {
			args.on_complete(jqXHR, textStatus);
		} else {
			// Do nothing
		}
	}
	return false;
}

/**
 * Login form ajax callback
 * TODO session management handled here?
 */
function loginSuccess(login_payload) {
	$("h2#options_welcome_banner strong").text(login_payload);
	$.mobile.changePage($("#options_page"), {
		transition: "slideup", 
		reverse: true, 
	}); 
}

/**
 * DB Dialog ajax success callback
 */
function popDBDialog(response) {
	$("#response").text("Success! New school added!");
	$.mobile.changePage("#db_confirm_dialog");
}

/**
 * School List response handler
 * generates ul of schools returned from DB
 */
function generateSchoolList(school_data) {
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
		var form_data = $("#edit_school_form").serializeObject();		
		if( !form_data.id){
			form_data.id = school.id;
		}

		service_call("app_dev.php/update_school", {
			request_params: form_data, 
			on_success: function () {$.mobile.changePage("#school_list_page")}
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
		var user_name = $("#login_input").val();
		var password = $("#pass_input").val();

		login_call(user_name, password);

		return false;
	}); 


	/**
	 * Add school form ajax handler
	 */
	$('#add_school_submit').on('click', function(e, obj) {
		var  formData = $('#add_school_form').serializeObject();

		service_call("app_dev.php/add_school", {
			request_params: formData,
			on_success: popDBDialog
		});

		return false;
	});
});

/**
 * Get school list ajax handler
 */
$(document).on("pagebeforechange", function(e, obj) {
	var url= $.mobile.path.parseUrl(obj.toPage);

	if ( url.hash  === "#school_list_page") {
		service_call("app_dev.php/get_school_list", {
			on_success: generateSchoolList
		});

		e.preventDefault();
	};
});

