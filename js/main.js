var App = (function(){
	function run(){		
		$.msgBox.init();
		$.postCall.config({
			 prefix: "php/"
			,suffix: ".class.php"
		})
				
		var loginBox 	= new LoginBox();
		var searchBox 	= new SearchBox();
		var reportsBox 	= new ReportsBox();
		var usersBox 	= new UsersBox();
		var addEmployeeBox = new AddEmployeeBox();
		
		if(!isLogged()){
			setTimeout(loginBox.show,200);
		}
		
		loginBox.onLogin(function(e){
			//
			// Update login status
			//
			isLogged(true);
			userType(e.type);
			
			//
			// If admin logged in, show admin controls
			//
			if(e.type == "admin"){
				showAdminControls();
			}

			//
			// Hide login box and show main search section
			//
			loginBox.hide();
			setTimeout(searchBox.show, 150);
		});
		
		searchBox.onReports(function(){
			searchBox.blur();
			reportsBox.dialogyShow();
		})
		
		searchBox.onAddEmployee(function(){
			searchBox.blur();
			addEmployeeBox.dialogyShow();
		})
		
		reportsBox.onDone(function(){
			reportsBox.dialogyHide();
			searchBox.focus();
		})
		
		searchBox.onUsers(function(){
			searchBox.blur();
			usersBox.dialogyShow();
		})
		
		usersBox.onDone(function(){
			usersBox.dialogyHide();
			searchBox.focus();
		})
		
		addEmployeeBox.onDone(function(){
			addEmployeeBox.dialogyHide();
			searchBox.focus();
		})
	}
	
	function isLogged(logged){
		if(typeof logged === "undefined") return $("meta[name='isLogged']").attr("content") === "true";
		$("meta[name='userType']").attr("content",logged?"true":"false");
	}
	
	function userType(type){
		if(typeof type === "undefined") return $("meta[name='userType']").attr("content");
		$("meta[name='userType']").attr("content",type);
	}
	
	function hideAdminControls(){
		if($("#adminControl").length == 0){
			//
			// jQuery's hide method doesn't work well here, because it adds an inline style which has the
			// highest css specifify, which screws up other classes
			// Instead, just add a style tag with the adminControl class in it
			//
			$("head").prepend("<style id = 'adminControl'>.adminControl{ display:none; }</style>");
		}
	}
	
	function showAdminControls(){
		//
		// jQuery's show method doesn't work well here, because it adds an inline style which has the
		// highest css specifify, which screws up other classes
		// Instead, just remove the style tag with the adminControl class in it
		//
		$("#adminControl").remove();
	}
	
	return{
		 run:run
	}
})();

$(window).load(App.run);