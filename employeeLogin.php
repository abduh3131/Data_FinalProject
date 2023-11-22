<?php
header('Content-Type: text/plain; charset=UTF-8');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "containers";

$email = $_POST['email'];
$ssn = str_replace('-', '', $_POST['ssn']); 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM employees WHERE Email = ? AND REPLACE(SSN, '-', '') = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $ssn);

$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    echo "success";
} else {
    echo "failure";
}

$stmt->close();
$conn->close();
?>
