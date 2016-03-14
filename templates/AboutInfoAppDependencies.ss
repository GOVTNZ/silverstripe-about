<h1>Overview</h1>

<table class="dependency-list">
	<thead>
		<tr>
			<td>Name</td>
			<td>Version</td>
			<td>Source URL</td>
			<td>Source Reference</td>
		</tr>
	</thead>

	<tbody>
		<% loop $Dependencies %>
			<tr>
				<td>$Name</td>
				<td>$Version</td>
				<td><a href="$SourceURL" target="_blank">$SourceURL</a></td>
				<td>$SourceReference</td>
			</tr>
		<% end_loop %>
	</tbody>
</table>
