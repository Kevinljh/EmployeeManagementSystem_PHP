<section id = "reports" style="display:none;">
	<div class = "sectionBackground"></div>
	<div class = "verticalCenter"></div>
	<div id = "reportsBox" class = "box dialogBox">
		<div class = "sectionTitle">Reports</div>
		<table id = "reportsTable" cellspacing="0" cellpadding="0">
			<tr><td>Seniority Report
				<input id="SeniorityReportCBox" class="rowIcon" name="ReportRadio" type="radio">
			</td></tr>
			<tr><td>Weekly Hours Worked
                <input id="WeeklyHoursWorkedCBox" class="rowIcon" name="ReportRadio" type="radio">
            </td></tr>
			<tr><td>Payroll Report
                <input id="PayRollCBox" class="rowIcon" name="ReportRadio" type="radio">
            </td></tr>
			<tr><td>Active Employment Report
                <input id="ActiveEmploymentReportCBox" class="rowIcon" name="ReportRadio" type="radio">
            </td></tr>
			<tr><td>Inactive Employment Report
                <input id="InactiveEmploymentReportCBox" class="rowIcon" name="ReportRadio" type="radio">
            </td></tr>
		</table>
		<div class = "buttonContainer">
			<input id = "reportsDone" type="button" class = "confirmButton bottomButton" value = "Done"/>
			<input id = "reportsConFirm" type="button" class = "confirmButton bottomButton" value = "Generate"/>
		</div>
	</div>
</section>