<?php
//setting header to json
header('Content-Type: application/json');

//database
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'iot');

//get connection
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if(function_exists('date_default_timezone_set')) date_default_timezone_set('Asia/Jakarta');
$tanggal = date("Y-m-d");

$periode = isset($_GET["periode"]) ? $_GET["periode"] : null;

if(!$mysqli){
  die("Connection failed: " . $mysqli->error);
}

if ($periode == "harian") {
	$query = sprintf("
		SELECT CONCAT(YEAR(waktu),'/',MONTH(waktu),'/',DAY(waktu)) AS waktu, avg(suhu) As suhu, avg(lembab) as lembab
		FROM log
		GROUP BY YEAR(waktu),MONTH(waktu),DAY(waktu)
			");

} elseif ($periode == "bulanan") {
	$query = "
		SELECT CONCAT(YEAR(waktu),'/',MONTH(waktu)) AS waktu, avg(suhu) As suhu, avg(lembab) as lembab
		FROM log
		GROUP BY YEAR(waktu),MONTH(waktu)
	";

} elseif ($periode == "today") {
	$query = "SELECT waktu, suhu, lembab FROM log WHERE waktu LIKE '%$tanggal%'";

} else {
	//query to get data from the table
	$query = sprintf("SELECT waktu, suhu, lembab FROM log");
}


//execute query
$result = $mysqli->query($query);

//loop through the returned data
$data = array();
foreach ($result as $row) {
  $data[] = $row;
}

//free memory associated with result
$result->close();

//close connection
$mysqli->close();

//now print the data
print json_encode($data);
