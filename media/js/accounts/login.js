$(function()
{
	//$("#profile-popup").hide();
	//$("#profile-popup").removeClass('hidden');
	//$("#login-tabs").tabs();
	/*$("#profile-user a").hover(function() {
		$("#profile-popup").show();
	},
	function() {
		//$("#profile-popup").toggleClass('hidden');
		$("#profile-popup").hide();
	});*/
    $('#login-tabs .nav-tabs a').click(function(e) {
        e.preventDefault();
        $(this).tab('show');
    });

    $('#login-tabs .login-providers a.openid-required').click(function(e) {
        e.preventDefault();
        $(this).parent().find('.openid-identifier').toggle();
    });
});