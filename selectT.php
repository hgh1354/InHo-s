<?
	header('Content-Type: text/html; charset=utf-8');

	$servername = "localhost";
	$username = "ccit";
	$password = "ccit3124";
	$dbname = "ccit";

	$conn = new mysqli($servername, $username, $password, $dbname);
	
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT vId FROM hVideo";
	$result = $conn->query($sql);

	/*if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			echo "no: " . $row["no"]. "  a: " . $row["a"]. " name: " . $row["name"]. "<br>";
		}
		//$row = $result->fetch_assoc();
		//echo $row['vId'];
	} else {
		echo "0 results";
	}
	$conn->close();*/
?>
<?
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
?>
<iframe width="100%" height="400px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://www.youtube.com/embed/<?echo $row['vId']?>?controls=1&amp;rel=0&amp;autohide=1"
allowfullscreen></iframe>

<!--<img src="https://i.ytimg.com/vi/<?echo $row['vId']?>/0.jpg"/>-->
<?
		}
	} else {
		echo "0 results";
	}
	$conn->close();
?>
