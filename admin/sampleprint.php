<html lang="en">
	<head>
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<script>
			window.onload = function(){ 
				tableToExcel('tblDataDL', 'Coaching Logs'); // this runs the download function
				setTimeout(function () {
					window.close(); // closes the tab when the link is opened
				}, 100);
			 }
			var tableToExcel = (function() { // download function
				var uri = 'data:application/vnd.ms-excel;base64,'
					, template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="https://www.w3.org/TR/html401"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
					, base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
					, format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
				return function(table, name) {
					if (!table.nodeType) table = document.getElementById(table)
					var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
					window.location.href = uri + base64(format(template, ctx))
				}
			})()
		</script>
		<style>
			table{
				width:100%;
			}
			tr>th{
				border: 2px solid;
				text-align:center;
			}tr>td{
				border: 1px solid;
			}
		</style>
	</head>
	<body>
		<div id="tblDataDL" hidden> <!-- hides table -->
			<table>
				<thead>
					<tr border="none">
						<th colspan="15"><h1><center>COACHING LOGS</center></h1></th>
					</tr>
				</thead>
				<thead>
					<tr>
						<th>STATUS</th>
						<th>AGENT NAME</th>
						<th>BRAND</th>
						<th>TL NAME</th>
						<th>SITE</th>
						<th>HIGHLIGHT POSITIVE PERFORMANCE</th>
						<th>AREAS OF OPPORTUNITY</th>
						<th>TARGET</th>
						<th>ACTUAL</th>
						<th>GLIDE TARGET</th>
						<th>5 WHYS</th>
						<th>ACTION PLAN</th>
						<th>FREQUENCY</th>
						<th>FOLLOW-UP DATE</th>
						<th>SMART GOAL AND COMMITMENT</th>
					</tr>
				</thead>
				<tbody id="tbody">
					<tr>
						<td>status</td>
						<td>fullname</td>
						<td>brand</td>
						<td>brand</td>
						<td>brand</td>
						<td>brand</td>
						<td>
							<table>
								<?php for($x=0;$x<3;$x++){?>
								<tr>
									<td><?=$x?></td>
								</tr>
								<?php }?>
							</table>
						</td>
						<td>
							<table>
								<?php for($x=0;$x<3;$x++){?>
								<tr>
									<td><?=$x?></td>
								</tr>
								<?php }?>
							</table>
						</td>
						<td>
							<table>
								<?php for($x=0;$x<3;$x++){?>
								<tr>
									<td><?=$x?></td>
								</tr>
								<?php }?>
							</table>
						</td>
						<td>
							<table>
								<?php for($x=0;$x<3;$x++){?>
								<tr>
									<td><?=$x?></td>
								</tr>
								<?php }?>
							</table>
						</td>
						<td>
							<table>
								<?php for($x=0;$x<3;$x++){?>
								<tr>
									<td><?$x?></td>
								</tr>
								<?php }?>
							</table>
						</td>
						<td>
							<table>
								<?php for($x=0;$x<3;$x++){?>
								<tr>
									<td><?=$x?></td>
								</tr>
								<?php }?>
							</table>
						</td>
						<td>
							<table>
								<?php for($x=0;$x<3;$x++){?>
								<tr>
									<td><?=$x?></td>
								</tr>
								<?php }?>
							</table>
						</td>
						<td>
							<table>
								<?php for($x=0;$x<3;$x++){?>
								<tr>
									<td><?=$x?></td>
								</tr>
								<?php }?>
							</table>
						</td>
						<td>This</td>
					</tr>
				</tbody>
			</table>
		</div>
		<!-- JQuery -->
	</body>
</html>