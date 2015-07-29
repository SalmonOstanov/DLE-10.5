$(function() {

	$( "#logindialog" ).dialog({
		autoOpen: false,
		show: 'fade',
		hide: 'fade',
		resizable: false,
		width: 300
	});

	$('#loginlink').click(function(){
		$('#logindialog').dialog('open');
		return false;
	});
});

$(function() {

	$( "#polldialog" ).dialog({
		autoOpen: false,
		resizable: false,
		width: 450
	});

	$('#polllink').click(function(){
		$('#polldialog').dialog('open');
		return false;
	});
});

$(document).ready(function(){
		$('#topmenu li.sublnk').hover(
		function() {
			$(this).addClass("selected");
			$(this).find('ul').stop(true, true);
			$(this).find('ul').show('fast');
		},
		function() {
			$(this).find('ul').hide('fast');
			$(this).removeClass("selected");
		}
	);
});

var auth_window;

$(document).ready(function(){
	$('.sociallogin a').on('click',function(){
	   var href = $(this).attr('href');
       var width  = 820;
       var height = 420;
       var left   = (screen.width  - width)/2;
       var top   = (screen.height - height)/2-100;   

       auth_window = window.open(href, 'auth_window', "width="+width+",height="+height+",top="+top+",left="+left+"menubar=no,resizable=no,scrollbars=no,status=no,toolbar=no");
       return false;
	})
});