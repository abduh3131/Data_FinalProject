<?php
header('Content-Type: text/html; charset=UTF-8');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "containers";
$view = isset($_GET['view']) ? $_GET['view'] : '';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!preg_match('/^[a-z_]+$/', $view)) {
    die("Invalid view name");
}

$sql = "SELECT * FROM " . $view;
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        foreach($row as $key => $value) {
            echo htmlspecialchars($key) . ": " . htmlspecialchars($value) . "<br>";
        }
        echo "<hr>";
    }
} else {
    echo "No results or invalid view";
}

$conn->close();
?>
