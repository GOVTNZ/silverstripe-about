<h1>Overview</h1>

<table>
	<thead>
	</thead>

	<tbody>
		<tr>
			<td>App version:</td>
			<td>$AppVersion</td>
		</tr>
		<tr>
			<td>Date tagged:</td>
			<td></td>
		</tr>
	</tbody>
</table>

<h2>Key module versions:</h2>
<ul>
	<% loop $KeyModuleVersions %>
		<li>$ModuleName: $Version</li>
	<% end_loop %>
</ul>
