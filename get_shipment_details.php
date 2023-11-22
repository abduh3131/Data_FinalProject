<?php
header('Content-Type: text/html; charset=UTF-8');

$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "containers";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$trackingID = isset($_POST['trackingID']) ? $_POST['trackingID'] : '';

$sql = "SELECT CustomerName, ContainerID, DestinationPort, PortCity, PortCountry, TrackingID, ShipmentStatus, ContainerSize FROM View_Comprehensive_Shipment_Status WHERE TrackingID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $trackingID);

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "Customer Name: " . $row["CustomerName"] . "<br>";
        echo "Container ID: " . $row["ContainerID"] . "<br>";
        echo "Destination Port: " . $row["DestinationPort"] . "<br>";
        echo "Port City: " . $row["PortCity"] . "<br>";
        echo "Port Country: " . $row["PortCountry"] . "<br>";
        echo "Tracking ID: " . $row["TrackingID"] . "<br>";
        echo "Shipment Status: " . $row["ShipmentStatus"] . "<br>";
        echo "Container Size: " . $row["ContainerSize"] . "<br><br>";
    }
} else {
    echo "No shipment found for this tracking ID.";
}

$stmt->close();
$conn->close();
?>
