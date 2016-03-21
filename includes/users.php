<section id = "users" style="display:none">
	<div class = "sectionBackground"></div>
	<div class = "verticalCenter"></div>
	<div id = "usersBox" class = "box dialogBox">
		<div class = "sectionTitle">Create User</div>
		<table cellspacing="0" cellpadding="0">
			<tr><td>Username:</td><td><input id = "newUsername" class = "dataField" type="text"/></td></tr>
			<tr><td>Password:</td><td><input id = "newPassword" class = "dataField" type="password"/></td></tr>
			<tr><td>Type:</td><td><div class = "selectContainer"><select id = "newType"><option value="general">General</option><option value="admin">Admin</option></select></div></td></tr>
		</table>
		<div class = "buttonContainer">
			<input id = "createUser" type="button" class = "confirmButton bottomButton" value = "Create"/>
			<input id = "usersDone" type="button" class = "confirmButton bottomButton" value = "Done"/>
		</div>
	</div>
</section>