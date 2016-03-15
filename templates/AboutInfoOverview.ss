<h1>Overview</h1>

<% if ApplicationVersioned %>
	<h2>Application Version</h2>
	<table class="app-version">
		<thead>
		</thead>

		<tbody>
			<tr>
				<td>App version:</td>
				<td class="value">$AppVersion</td>
			</tr>
			<tr>
				<td>Date tagged:</td>
				<td class="value">$DateTagged</td>
			</tr>
		</tbody>
	</table>
<% end_if %>

<h2>Key module versions:</h2>

<table>
	<thead>
		<tr>
			<td>Module</td><td>Version</td>
		</tr>
	</thead>

	<tbody>
		<% loop $KeyModuleVersions %>
			<tr>
				<td>$ModuleName</td>
				<td class="value">$Version</td>
			</tr>
		<% end_loop %>
	</tbody>
</table>
