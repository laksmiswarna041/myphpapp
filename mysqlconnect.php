<?php

echo "<h2>Welcome! This site is up and running.</h2>";

$dbhost = "localhost";
$dbname = "sgb_db";
$username = "sgb";
$password = "swarna99@GB";

$conn = new mysqli($dbhost, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Could not connect: " . $conn->connect_error);
}

echo "MySQL Connected successfully!<br><br>";

$sql1 = "CREATE TABLE IF NOT EXISTS Names (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50)
)";

if ($conn->query($sql1) === TRUE) {
    echo "Table Names created successfully.<br><br>";
} else {
    die("Error creating table: " . $conn->error);
}


// Insert names only if they don't already exist
$sql = "INSERT INTO Names (name)
        SELECT 'Swarna'
        WHERE NOT EXISTS (
            SELECT 1 FROM Names WHERE name = 'Swarna'
        )";

$conn->query($sql);

$sql = "INSERT INTO Names (name)
        SELECT 'Lakshmi'
        WHERE NOT EXISTS (
            SELECT 1 FROM Names WHERE name = 'Lakshmi'
        )";

$conn->query($sql);


echo "<h3>List of Names</h3>";

$sql = "SELECT * FROM Names";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        echo "Name: " . $row["name"] . "<br>";
    }

} else {
    echo "0 results";
}

$conn->close();

?>
