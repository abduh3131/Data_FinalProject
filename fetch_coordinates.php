<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "containers";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(['error' => 'Connection failed: ' . $conn->connect_error]));
}

$containerID = isset($_GET['containerID']) ? $_GET['containerID'] : '';

$sql = "SELECT Latitude, Longitude FROM View_live WHERE ContainerID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $containerID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $coordinates = $result->fetch_assoc();
    echo json_encode($coordinates);
} else {
    echo json_encode(['error' => 'No coordinates found for this container ID']);
}

$stmt->close();
$conn->close();
?>
