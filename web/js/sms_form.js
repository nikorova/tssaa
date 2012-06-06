/**
 * Send sms form handler
 */
$('#send_sms_submit').live('click', function() {

	var  formData = $('#send_sms_form').serialize();

	$.ajax({
		type: "POST",
		url: "app_dev.php/send_sms",
		cache: false,
		data: formData,
        success: popDialog
	});
		
	return false;
});

/**
 * Dialog handler
 */
function popDialog(response) {
    //$("#db_confirm_dialog div h1.dialog_title").html(title);
    
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
		}).replaceAll("#sms_response");
    
    $.mobile.changePage("#sms_response_dialog");
}
