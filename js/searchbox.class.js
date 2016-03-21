var SearchBox = function(){
	var section = new Section("#search");
	var onReports = $.customEvent();
	var onUsers = $.customEvent();
	var onAddEmployee = $.customEvent();
	
	$("#reportsButton").click(function(){
		onReports.trigger();
	})

	$("#usersButton").click(function(){
		onUsers.trigger();
	})
	
	$("#addEmployeeButton").click(function(){
		onAddEmployee.trigger();
	})
		
	return $.extend({},section,{
		 onReports:onReports
		,onUsers:onUsers
		,onAddEmployee:onAddEmployee
	});		
}
