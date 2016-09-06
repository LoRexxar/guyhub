$('#search').click(function(){
	var s = $('#s').val();
	location.href = '/WebIndex/search?s='+s;
});
$('#login').click(function(){
	location.href = "/WebIndex/login";
});
$('#register').click(function(){
	location.href = "/WebIndex/register";
});
$('#out').click(function(){
	location.href = "/WebUser/signout";
});
$('.profile').click(function(){
	location.href = "/WebUser/profile";
});
$('#index').click(function(){
	location.href = "/WebUser/index";
});
$('#mail').click(function(){
	location.href = "/WebUser/s_mail";
});
$("#focus").click(function(){
	location.href = "/WebUser/focus";
});