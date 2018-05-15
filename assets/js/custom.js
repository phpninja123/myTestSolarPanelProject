$(document).ready(function(){
	$("#login_btn").click(function(){
		var EmailID = $("#EmailID").val();
		var Password = $("#Password").val();

		$.ajax({
			url : 'includes/check_login.php',
			data : { EmailID:EmailID, Password:Password },
			type : 'POST',
			success : function(data){
				data = JSON.parse(data);
				if( data.status == 200 ) {
					window.location = 'admin/';
				} else {
					$("#error_container").html('<div class="alert alert-danger" role="alert">Wrong email id or password </div>')
				}
			}
		})
	});

	$("#signup_btn").click(function(){
		var Name = $("#Name").val();
		var Mobile = $("#Mobile").val();
		var EmailID = $("#EmailID").val();
		var Password = $("#Password").val();

		$.ajax({
			url : 'includes/user_signup.php',
			data : { Name:Name, Mobile:Mobile, EmailID:EmailID, Password:Password },
			type : 'POST',
			success : function(data){
				data = JSON.parse(data);
				if( data.status == 200 ) {
					window.location = 'login.html';
				} else {
					$("#error_container").html('<div class="alert alert-danger" role="alert">Wrong email id or password </div>')
				}
			}
		})
	});
});