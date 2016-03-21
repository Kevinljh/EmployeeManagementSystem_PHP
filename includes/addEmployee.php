<section id = "addEmployee" style="display:none;">
	<div class = "sectionBackground"></div>
	<div class = "verticalCenter"></div>
	<div id = "addEmployeeBox" class = "box dialogBox">
		<div class = "sectionTitle">Add Employee</div>
		<table id = "addEmployeeTable" cellspacing="0" cellpadding="0">
			<tr>
				<td>Type:</td>
				<td>
					<div class = "selectContainer">
						<select class = "employeeType">
							<option value="fullTime">Full Time</option>
							<option value="partTime">Part Time</option>
							<option value="seasonal">Seasonal</option>
							<option class = "adminControl" value="contract">Contract</option>
						</select>
					</div>
				</td>
			</tr>
			<tr class = "field fullTimeField partTimeField seasonalField"><td>First Name:</td><td><input class = "firstName" type="text"/></td><td class = "fieldError"></td></tr>
			<tr class = "field fullTimeField partTimeField seasonalField"><td>Last Name:</td><td><input class = "lastName" type="text"/></td><td class = "fieldError"></td></tr>
			<tr class = "field fullTimeField partTimeField seasonalField"><td>Date of Birth:</td><td><input class = "dateOfBirth" type="text"/></td><td class = "fieldError"></td></tr>
			<tr class = "field fullTimeField partTimeField seasonalField"><td>Social Insurance Number:</td><td><input class = "sin" type="text"/></td><td class = "fieldError"></td></tr>
			<tr class = "field adminControl fullTimeField partTimeField"><td>Date Hired:</td><td><input class = "dateOfHire" type="text"/></td><td class = "fieldError"></td></tr>
			<tr class = "field adminControl fullTimeField partTimeField"><td>Date Terminated:</td><td><input class = "dateOfTermination" type="text"/></td><td class = "fieldError"></td></tr>
			<tr class = "field adminControl fullTimeField"><td>Salary:</td><td><input class = "salary" type="text"/></td><td class = "fieldError"></td></tr>
			<tr class = "field adminControl partTimeField unselectedField"><td>Hourly Wage:</td><td><input class = "hourlyRate" type="text"/></td><td class = "fieldError"></td></tr>
			<tr class = "field seasonalField unselectedField"><td>Season:</td><td><input class = "season" type="text"/></td><td class = "fieldError"></td></tr>
			<tr class = "field seasonalField unselectedField"><td>Season Year:</td><td><input class = "seasonYear" type="text"/></td><td class = "fieldError"></td></tr>
			<tr class = "field adminControl seasonalField unselectedField"><td>Piece Pay:</td><td><input class = "piecePay" type="text"/></td><td class = "fieldError"></td></tr>
			<tr class = "field adminControl contractField unselectedField"><td>Company Name:</td><td><input class = "companyName" type="text"/></td><td class = "fieldError"></td></tr>
			<tr class = "field adminControl contractField unselectedField"><td>Date of Incorporation:</td><td><input class = "dateOfIncorporation" type="text"/></td><td class = "fieldError"></td></tr>
			<tr class = "field adminControl contractField unselectedField"><td>Business Number:</td><td><input class = "businessNumber" type="text"/></td><td class = "fieldError"></td></tr>
			<tr class = "field adminControl contractField unselectedField"><td>Contract Start Date:</td><td><input class = "startDate" type="text"/></td><td class = "fieldError"></td></tr>
			<tr class = "field adminControl contractField unselectedField"><td>Contract Stop Date:</td><td><input class = "endDate" type="text"/></td><td class = "fieldError"></td></tr>
			<tr class = "field adminControl contractField unselectedField"><td>Contract Amount:</td><td><input class = "fixedAmount" type="text"/></td><td class = "fieldError"></td></tr>
		</table>
		<div class = "buttonContainer">
			<input id = "addEmployeeDone" type="button" class = "confirmButton bottomButton" value = "Done"/>
			<input id = "addEmployeeAdd" type="button" class = "confirmButton bottomButton" value = "Add"/>
		</div>
	</div>
</section>