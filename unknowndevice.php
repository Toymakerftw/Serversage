<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ServerSage</title>
    <link rel='stylesheet' type='text/css' media='screen' href='css/main.css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body style="margin: 50px;">
<p style="  text-align: center  " class="gridtableheader"> Unknown Devices</p>
    <br>
    <table style="  text-align: center  "class="table">
        <thead>
			<tr>
				<th>Hostname</th>
				<th>IP Address</th>
				<th>Mac Address</th>
				<th>Action</th>
			</tr>
		</thead>

        <tbody>
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
            $sql = "SELECT * FROM currentiptable WHERE ip NOT IN (SELECT ip FROM knowiptable)";
			$result = $connection->query($sql);

            if (!$result) {
				die("Invalid query: " . $connection->error);
			}

            // read data of each row
			while($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>" . $row["hname"] . "</td>
                    <td>" . $row["ip"] . "</td>
                    <td>" . $row["mac"] . "</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='known.php?ip=$row[ip]&mac=$row[mac]&hname=$row[hname]'>Add as Known Device</a>
                        <a class='btn btn-danger btn-sm' href='dump.php?ip=$row[ip]'>Monitor Traffic</a>
                    </td>
                </tr>";
            }


            $connection->close();
            ?>
        </tbody>
    </table>
</body>
</html>
