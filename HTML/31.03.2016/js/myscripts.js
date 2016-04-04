/*$(document).ready(function(){
	$('.photo1 a').click(function(e){
		e.preventDefault();
	})
});

/* dialog */
/*$(function() {
	$( ".dialog1").dialog({
		autoOpen: false,
		draggable:false,
		modal:true,
		width: 'auto',
		height: 'auto',
		dialogClass: "loadingDialog",
		autoReposition: true,
		maxWidth: 480,
			position: {
			my: "center",
			at: "center",
			of: window
		},
		
		 open: function(){
			jQuery('.ui-widget-overlay').bind('click',function(){
				jQuery('#dialog,#login').dialog('close');
			})
		}

	});
 
	$( ".photo1" ).click(function() {
		var calldialog = $(this).data().calldialog;
		$('.' + calldialog).dialog( "open" );
	});

	$(window).resize(function() {
		$("#login").dialog("option", "position", {my: "center", at: "center", of: window});
	});
});
*/