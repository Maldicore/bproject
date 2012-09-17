function newAlert (type, message) {
    $("#alert-area").append($("<div class='alert-message alert alert-" + type + " fade in' data-alert='alert'><p> " + message + " </p></div>"));
    $(".alert-message").delay(2000).fadeOut("slow", function () { $(this).remove(); });
	}


/*
 * DatePicker Call
 */
$(document).ready(function() {
	$(document).on('focus', '.datepicker', function() {
		$(this).datepicker({
			format : 'dd/mm/yyyy',
			autoclose : true
		});
	});
});

$(document).on('focus','.aform',function() {
	$(".aform").validationEngine({'custom_error_messages' : {
		'custom[number]' : {
	        'message': "Please enter a value."
	   	},
		'required' : {
	        'message': "Please fill this."
	   	}
	}});
});

$(document).on('click','.delbtn',function(){
	event.preventDefault();
	$.fn.dialog2.helpers.confirm("Are You Sure You Want to Delete?", {
        confirm: function() { 
        	url = $('.delbtn').attr('href');
        	//alert(url);
        	window.location.href = url;
        	}, 
        decline: function() {}
    });
	
});

$(document).on('click','.delbtnF',function(){
	event.preventDefault();
	$.fn.dialog2.helpers.confirm("Are You Sure You Want to Delete?", {
        confirm: function() { 
        	url = $('.delbtnF').attr('href');
        	//alert(url);
        	window.location.href = url;
        	}, 
        decline: function() {}
    });
	
});

$(document).on('focus','.uform',function(){
			var uploader = new qq.FileUploader({
            	multiple:false,
                element: document.getElementById('file-upload-area'),
                action: 'Docs/upload',
                debug: true,
                allowedExtensions: ['pdf','jpg','png','gif','doc','xls','ppt','odt','odp','ods'],
                onComplete: function(id, fileName, responseJSON){
                	$('#DocFile').val(responseJSON.file);
                	//do something here to reflect the complete
                },
                //onSubmit: function(id, fileName){},
                //onCalcel: function(id, fileName){},
                //params: {id: i},
                //extraDropzones: [qq.getByClass(document, 'qq-upload-extra-drop-area')[0]]
            });
});

$(document).ready(function() {
	$(".autopopup").click(function() {
		var selectedVal = $(this).val();
		//console.log(selectedVal);
		if (selectedVal == 'add') {
			//TODO: Check this on production launch!
			var srvr = "";
			srvr = (window.location.pathname.substring(0,window.location.pathname.lastIndexOf("/")));
			var add_link = srvr +"/"+ $(this)[0].id + "/add"
			$('</div>').dialog2({
				title : $(this).find("option:selected").text(),
				content : add_link,
				id : "add_" + $(this)[0].id,
				showCloseHandle : true,
				removeOnClose : true,
				closeOnEscape : true,
				closeOnOverlayClick : true,
			});
			event.preventDefault();
		}
		;
	});
});