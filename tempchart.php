
<?php
$servername = "localhost";
$username = "root";
$password = "root@passwd";
$database = "serversage";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

      // Check connection
if ($connection->connect_error) {
  die("Connection failed: " . $connection->connect_error);
}
// read all row from database table
$sql1 = "SELECT cpu_temp FROM (SELECT * FROM stats ORDER BY id DESC LIMIT 5000)Var1 ORDER BY id ASC;";
$sql = "SELECT time FROM (SELECT * FROM stats ORDER BY id DESC LIMIT 5000)Var1 ORDER BY id ASC;";


$result = $connection->query($sql);
$result1 = $connection->query($sql1);


	$valoresY=array();//montos
	$valoresX=array();//fechas

	while ($ver=mysqli_fetch_row($result)) {
		$valoresX[]=$ver[0];
	}
    while ($ver1=mysqli_fetch_row($result1)) {
        $valoresY[]=$ver1[0];
	}

	$datosX=json_encode($valoresX);
	$datosY=json_encode($valoresY);

 ?>
<div id="myplot"></div>
<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
<script type="text/javascript">
	function crearCadenaLineal(json){
		var parsed = JSON.parse(json);
		var arr = [];
		for(var x in parsed){
			arr.push(parsed[x]);
		}
		return arr;
	}
</script>


<script type="text/javascript">

	datosX=crearCadenaLineal('<?php echo $datosX ?>');
	datosY=crearCadenaLineal('<?php echo $datosY ?>');

	var trace1 = {
		x: datosX,
		y: datosY,
        mode: "lines",
        type: "scatter"
	};

	var data = [trace1];

    var layout = {
        xaxis: {range: [1, 12], title: "Time"},
        yaxis: {range: [5, 75], title: "Temprature in Celsius"},  
        title: "CPU TEMPRATURE vs. TIME"
    };

	Plotly.newPlot('myplot', data,layout);
</script>