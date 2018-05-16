$(document).ready(function(){
	$("#form-login, #form-signup").validate();
	$("#login_btn").click(function(){
		if( !$("#form-login").valid() ) {
			return false;
		}
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
		});
	});

	$("#signup_btn").click(function() {
		if( !$("#form-signup").valid() ) {
			return false;
		}
		var Name = $("#Name").val();
		var Mobile = $("#Mobile").val();
		var EmailID = $("#EmailID").val();
		var Password = $("#Password").val();
		var Password2 = $("#Password2").val();
		if( Password != Password2 ) {
			$("#error_container").html('<div class="alert alert-danger" role="alert">Both passwords are not same </div>');
			return false;
		}
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

function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  // console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
  // console.log('Name: ' + profile.getName());
  // console.log('Image URL: ' + profile.getImageUrl());
  console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
  var EmailId = profile.getEmail();
  $.ajax({
		url : 'includes/check_social_login.php',
		data : { EmailID:EmailID },
		type : 'POST',
		success : function(data){
			// data = JSON.parse(data);
			// if( data.status == 200 ) {
			// 	window.location = 'admin/';
			// } else {
			// 	$("#error_container").html('<div class="alert alert-danger" role="alert">Wrong email id or password </div>')
			// }
		}
	});
}

      // This is called with the results from from FB.getLoginStatus().
      function statusChangeCallback(response) {
        console.log(response);
        // The response object is returned with a status field that lets the
        // app know the current login status of the person.
        // Full docs on the response object can be found in the documentation
        // for FB.getLoginStatus().
        if (response.status === 'connected') {
          // Logged into your app and Facebook.
          testAPI();
        } else if (response.status === 'not_authorized') {
          // The person is logged into Facebook, but not your app.
          console.log("The person is logged into Facebook, but not your app.");
        } else {
          // The person is not logged into Facebook, so we're not sure if
          // they are logged into this app or not.
        }
      }

      // This function is called when someone finishes with the Login
      // Button.  See the onlogin handler attached to it in the sample
      // code below.
      function checkLoginState() {
        FB.getLoginStatus(function(response) {
          statusChangeCallback(response);
        });
      }

      window.fbAsyncInit = function() {
        FB.init({
          appId: '1488715811238543',
          cookie: true, // enable cookies to allow the server to access 
          // the session
          xfbml: true, // parse social plugins on this page
          version: 'v2.2' // use version 2.2
        });

        // Now that we've initialized the JavaScript SDK, we call 
        // FB.getLoginStatus().  This function gets the state of the
        // person visiting this page and can return one of three states to
        // the callback you provide.  They can be:
        //
        // 1. Logged into your app ('connected')
        // 2. Logged into Facebook, but not your app ('not_authorized')
        // 3. Not logged into Facebook and can't tell if they are logged into
        //    your app or not.
        //
        // These three cases are handled in the callback function.

        FB.getLoginStatus(function(response) {
          statusChangeCallback(response);
        });

      };

      // Load the SDK asynchronously
      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));

      // Here we run a very simple test of the Graph API after login is
      // successful.  See statusChangeCallback() for when this call is made.
      function testAPI() {
        console.log('Welcome!  Fetching your information.... ');
        FB.api('/me', function(response) {
          console.log("Fb response");
          console.log(response);
          console.log('Successful login for: ' + response.name);
          document.getElementById('status').innerHTML =
            'Thanks for logging in, ' + response.name + '!';
        });
      }
