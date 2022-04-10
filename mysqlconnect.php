<?php
echo '<h4> Welcome!, This site is up and running. </h4>';
$dbhost = db_host;
$dbname = 'sgb_mysql_db';
$username = mysql_user;
$password = mysql_password;

$conn = new mysqli($dbhost, $username, $password, $dbname);
if($conn->connect_error) {
                die('Could not connect: ' . $conn->connect_error);
}
echo '--------- MySQL Connected successfully -------<br>';

$sql1 = "CREATE TABLE IF NOT EXISTS Names( id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(50));";
if ($conn->query($sql1) === TRUE) {
          echo "\nTable Names created successfully <br>";
              
              $sql = "insert into Names (name) values ('Swarna');";
              $sql = "insert into Names (name) values ('Lakshmi')
              //$sql .= "insert into persons (name,city) values ('Brevis','Chennai');";
              //$sql .= "insert into persons (name,city) values ('Milne','Bangalore');";
              if ($conn->query($sql) === TRUE) {
              echo "\n New record created successfully <br>";
              } 
                  else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                    }

} else {
          echo "Error creating table: " . $conn->error;
}

echo 'List of Names <br>';
$sql = "SELECT * FROM Names;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
          // output data of each row
           while($row = $result->fetch_assoc()) {
               echo " Name: " . $row["name"]. "<br>";
                 }
            } else {
                   echo "0 results";
                   }
$conn->close();
?>
