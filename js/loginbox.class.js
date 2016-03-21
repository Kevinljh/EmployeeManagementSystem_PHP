var LoginBox = function(){
	var tryingLogin = false;
	var section = new Section("#login");
	var onLogin = $.customEvent();
	
	$(".loginCredential").keydown(function(e){
		if(e.keyCode == 13){
			tryLogin();
		}
	});
	
	$("#loginButton").click(tryLogin);
	
	function tryLogin(){
		if(!tryingLogin){
			tryingLogin = true;
			
			//
			// Send a request to server to login with user given credentials
			//
			var username = $("#username").val();
			var password = $("#password").val();
			$.postCall("Users.login",username,password,function(type){
				//
				// If correct credentials, trigger login event and pass to event type of user that logged in
				//
				if(type !== false){
					onLogin.trigger({ type:type });
				}else{
					tryingLogin = false;
					$.msgBox.error("Invalid Credentials");
				}
			},function(errorMessage){
				tryingLogin = false;
				console.log(errorMessage);
				$.msgBox.error("An error occurred while trying to log in.");
			})
		}
	}
	
	// Add functionality to section.show
	function show(){
		section.show();
		
		// When the login box is shown, focus on username box so user doesn't have to click it to focus on it
		$("#username").focus();
	}
	
	//
	// Extend (inherit) section functionality (i.e. show, hide) with specific login box functionality
	//
	return $.extend({},section,{
		onLogin:onLogin,
		
		// Override section.show with custom show function with more specific funtionality
		show:show
	});
}
