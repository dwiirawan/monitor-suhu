<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<title>Data Monitoring Suhu dan Kelembaban</title>

		<!-- Load Datatable & Bootsrap CSS -->
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="datatables/lib/css/dataTables.bootstrap.min.css"/>
	</head>
	<body>
		<div class="container">
			<div style="background: whitesmoke;padding: 10px;">
				<h1 style="margin-top: 0;">Data Monitoring Suhu dan Kelembaban</h1>
			</div>

			<div class="table-responsive">
				<table class="table table-bordered" id="table-iot">
					<thead>
						<tr>
						    <th>No</th>
							<th>Wilayah</th>
							<th>Suhu</th>
							<th>Kelembaban</th>
							<th>Waktu</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
			
			<b>
			    <a href="today.php">Grafik Hari Ini</a> <br />
			    <a href="harian.php">Grafik Rerata Harian</a> <br />
			    <a href="bulanan.php">Grafik Rerata Bulanan</a> <br />
			    <a href="all.php">Grafik Semua Data</a> <br />
			</b>	
		</div>

		<!-- Load Jquery & Datatable JS -->
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="datatables/datatables.min.js"></script>
		<script type="text/javascript" src="datatables/lib/js/dataTables.bootstrap.min.js"></script>
		<script>
		var tabel = null;

		$(document).ready(function() {
		    tabel = $('#table-iot').DataTable({
		        "columnDefs": [ {
		            "searchable": false,
		            "orderable": false,
		            "targets": 0
		        } ],
		        
		        "processing": true,
		        "serverSide": true,
		        "ordering": true, // Set true agar bisa di sorting
		        "order": [[ 4, 'desc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
		        "ajax":
		        {
		            "url": "view.php", // URL file untuk proses select datanya
		            "type": "POST"
		        },
		        "deferRender": true,
		        "pageLength": 10,
		        "aLengthMenu": [[10, 50, 100],[ 10, 50, 100]], // Combobox Limit
		        "columns": [
		            {
					    "data": "id",
					    render: function (data, type, row, meta) {
					        return meta.row + meta.settings._iDisplayStart + 1;
					    }
					},
		            { "render": function ( data, type, row ) { // Tampilkan kolom aksi
		                    var html  = "Gombong, Kebumen"
		                    return html
		                }
		            },
		            { "data": "suhu" }, 
		            { "data": "lembab" },  
		            { "data": "waktu" },
		        ],
		    });

		});
		</script>
		
	</body>
</html>
