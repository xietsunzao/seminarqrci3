$(document).ready(function () {
	setTimeout(function () {
		$('#base-style').DataTable();
		$('#no-style').DataTable();
		$('#compact').DataTable();
		$('#table-style-hover').DataTable();
		$('#myTable').DataTable({
			dom: 'Blfrtip',
			buttons: [{
					extend: 'csv',
					title: 'Rekap Kehadiran Peserta',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5],
					},
				},
				{
					extend: 'excel',
					title: 'Rekap Kehadiran Peserta',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5],
					},
				},
				{
					extend: 'copy',
					title: 'Rekap Kehadiran Peserta',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5],
					},
				},
				{
					extend: 'pdf',
					pageSize: 'A4',
					title: 'Rekap Kehadiran Peserta',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5],
					},
					download: 'open',
					orientation: 'landscape',
					customize: function (doc) {
						var colCount = new Array();
						$('#myTable').find('tbody tr:first-child td').each(function () {
							if ($(this).attr('colspan')) {
								for (var i = 1; i <= $(this).attr('colspan'); $i++) {
									colCount.push('*');
								}
							} else {
								colCount.push('*');
							}
						});
						doc.content[1].table.widths = colCount;
						doc.styles.tableBodyEven.alignment = 'center';
						doc.styles.tableBodyOdd.alignment = 'center';
					}
				},
				{
					extend: 'print',
					oriented: 'portrait',
					pageSize: 'A4',
					title: 'Rekap Kehadiran Peserta',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5],
					},
				},
			],
		});
		$('#pendaftaranSeminar').DataTable({
			dom: 'Blfrtip',
			buttons: [{
					extend: 'csv',
					title: 'Data Pendaftaran Seminar',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5, 6, 7],
					},
				},
				{
					extend: 'excel',
					title: 'Data Pendaftaran Seminar',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5, 6, 7],
					},
				},
				{
					extend: 'copy',
					title: 'Data Pendaftaran Seminar',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5, 6, 7],
					},
				},
				{
					extend: 'pdf',
					pageSize: 'A4',
					title: 'Data Pendaftaran Seminar',
					download: 'open',
					orientation: 'landscape',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5, 6, 7],
					},
					customize: function (doc) {
						doc.styles.tableBodyEven.alignment = 'center';
						doc.styles.tableBodyOdd.alignment = 'center';
					},
				},
				{
					extend: 'print',
					oriented: 'portrait',
					pageSize: 'A4',
					title: 'Data Pendaftaran Seminar',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5, 6, 7],
					},
				},
			],
		});
	}, 350);
});


