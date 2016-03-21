var UsersBox = function(){
	var section = new Section("#users");
	var onDone = $.customEvent();
	
	$("#usersDone, #users .sectionBackground").click(function(){
		onDone.trigger();
	})
	
	$("#createUser").click(function(){
		var username = $("#newUsername").val();
		var password = $("#newPassword").val();
		var type = $("#newType").val();
		
		$.msgBox.success("Creaing user...",true);
		$.postCall("Users.create",username,password,type,function(){
			$("#newUsername").val("");
			$("#newPassword").val("");
			$.msgBox.success("Created user");
		},function(data){
			$.msgBox.error("An error occurred while trying to create user");
		})
	})

	return $.extend({},section,{
		onDone:onDone
	});		
}
