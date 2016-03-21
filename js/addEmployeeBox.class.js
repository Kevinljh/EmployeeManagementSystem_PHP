var AddEmployeeBox = function(){
	var section = new Section("#addEmployee");
	var onDone = $.customEvent();
	
	$("#addEmployeeDone, #addEmployee .sectionBackground").click(function(){
		onDone.trigger();
	})
	
	$("#addEmployee .employeeType").change(function(){
		var type = $(this).val();
		$(".unselectedField").removeClass("unselectedField");
		$("#addEmployeeTable .field:not(." + type + "Field)").addClass("unselectedField");
	})
	
	$("#addEmployeeAdd").click(function(){
		tryToAddEmployee(false);
	})
	
	$("#addEmployee .field input").blur(function(){
		tryToAddEmployee(true);
	})
	
	function tryToAddEmployee(justCheckErrors){
		var type = $("#addEmployee .employeeType").val();
		if(!justCheckErrors){
			$.msgBox.success("Adding employee...",true);
		}
		if(type != "contract"){
			var firstName = $("#addEmployee .firstName").val();
			var lastName = $("#addEmployee .lastName").val();
			var dateOfBirth = $("#addEmployee .dateOfBirth").val();
			var sin = $("#addEmployee .sin").val();
			
			if(type != "seasonal"){
				var dateOfHire = $("#addEmployee .dateOfHire").val();
				var dateOfTermination = $("#addEmployee .dateOfTermination").val();
				
				if(type == "fullTime"){
					var salary = $("#addEmployee .salary").val();
					var fn = justCheckErrors ? "Employees.CheckFullTimeInfoErrors" : "Employees.AddFullTimeEmployee";
					
					$.postCall(fn,firstName,lastName,dateOfBirth,sin,dateOfHire,dateOfTermination,salary,function(data){
						if(!justCheckErrors){
							if(data){
								$.msgBox.success("Full time employee added");
								$("#addEmployee .field input").val("");										
							}else{
								$.msgBox.error("An error occurred");
							}
						}else{
							displayErrors(data);
						}
					},function(data){
						console.log(data);
						$.msgBox.error("An error occurred");
					})
				}else{
					var hourlyRate = $("#addEmployee .hourlyRate").val();
					var fn = justCheckErrors ? "Employees.CheckPartTimeInfoErrors" : "Employees.AddPartTimeEmployee";
					
					$.postCall(fn,firstName,lastName,dateOfBirth,sin,dateOfHire,dateOfTermination,hourlyRate,function(data){
						if(!justCheckErrors){
							if(data){
								$.msgBox.success("Part time employee added");
								$("#addEmployee .field input").val("");										
							}else{
								$.msgBox.error("An error occurred");
							}
						}else{
							displayErrors(data);
						}
					},function(){
						$.msgBox.error("An error occurred");
					})					
				}
			}else{
				var season = $("#addEmployee .season").val();
				var seasonYear = $("#addEmployee .seasonYear").val();
				var piecePay = $("#addEmployee .piecePay").val();
				var fn = justCheckErrors ? "Employees.CheckSeasonalInfoErrors" : "Employees.AddSeasonalEmployee";
				
				$.postCall(fn,firstName,lastName,dateOfBirth,sin,season,seasonYear,piecePay,function(data){
					if(!justCheckErrors){
						if(data){
							$.msgBox.success("Seasonal employee added");
							$("#addEmployee .field input").val("");										
						}else{
							$.msgBox.error("An error occurred");
						}
					}else{
						displayErrors(data);
					}
				},function(){
					$.msgBox.error("An error occurred");
				})	
			}
		}else{
			var dateOfIncorporation = $("#addEmployee .dateOfIncorporation").val();
			var companyName = $("#addEmployee .companyName").val();
			var businessNumber = $("#addEmployee .businessNumber").val();
			var startDate = $("#addEmployee .startDate").val();
			var endDate = $("#addEmployee .endDate").val();
			var fixedAmount = $("#addEmployee .fixedAmount").val();
			var fn = justCheckErrors ? "Employees.CheckContractInfoErrors" : "Employees.AddContractEmployee";
			
			$.postCall(fn,dateOfIncorporation,companyName,businessNumber,startDate,endDate,fixedAmount,function(data){
				if(!justCheckErrors){
					if(data){
						$.msgBox.success("Contract employee added");
						$("#addEmployee .field input").val("");										
					}else{
						$.msgBox.error("An error occurred");
					}
				}else{
					displayErrors(data);
				}
			},function(){
				$.msgBox.error("An error occurred");
			})				
		}		
	}
	
	function displayErrors(errors){
		for(var field in errors){
			$("." + field).closest("tr").find(".fieldError").html(errors[field]);
		}
	}
	
	
	return $.extend({},section,{
		onDone:onDone
	});		
}
