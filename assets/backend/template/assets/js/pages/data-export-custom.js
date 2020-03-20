$(document).ready(function () {
	setTimeout(function () {
		$('#basic-btn').DataTable({
			dom: 'Bfrtip',
			buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
		});
		$('#cbtn-selectors').DataTable({
			dom: 'Bfrtip',
			buttons: [{
				extend: 'copyHtml5',
				exportOptions: {
					columns: [0, ':visible']
				}
			}, {
				extend: 'excelHtml5',
				exportOptions: {
					columns: ':visible'
				}
			}, {
				extend: 'pdfHtml5',
				exportOptions: {
					columns: [0, 1, 2, 5]
				}
			}, 'colvis']
		});
		$('#excel-bg').DataTable({
			dom: 'Bfrtip',
			buttons: [{
				extend: 'excelHtml5',
				customize: function (xlsx) {
					var sheet = xlsx.xl.worksheets['sheet1.xml'];
					$('row c[r^="F"]', sheet).each(function () {
						if ($('is t', this).text().replace(/[^\d]/g, '') * 1 >= 500000) {
							$(this).attr('s', '20');
						}
					});
				}
			}]
		});
		$('#pdf-json').DataTable({
			dom: 'Bfrtip',
			buttons: [{
				text: 'JSON',
				action: function (e, dt, button, config) {
					var data = dt.buttons.exportData();
					$.fn.dataTable.fileSave(new Blob([JSON.stringify(data)]), 'Export.json');
				}
			}]
		});
	}, 350);
});
