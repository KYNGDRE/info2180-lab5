<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

// THE PDO DOES NOT CONNECT TO THE DATA BASE!!!!!!!!!!!!!!!!!!!!!!!
//SO I USED mysqi instead
// $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

// $dsn = "mysql:host=localhost;dbname=world;charset=utf8mb4";
// $conn = new PDO($dsn, $username, $password);
// $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// $stmt = $conn->query("SELECT * FROM countries");


// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully";

// if (isset($_GET["country"])){
//   $country = $_GET["country"];
//   // $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%';");
//   $sql = "SELECT * FROM countries WHERE name LIKE '%$country%';";
//   $results = $conn->query($sql);
// } else{
//   $sql = "SELECT * FROM countries";
//   $results = $conn->query($sql);
// }


if (isset($_GET["country"])) {
  $country = $_GET["country"];
  $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE ?");
  $stmt->bind_param("s", $param);
  $param = "%" . $country . "%";
  $stmt->execute();
  $results = $stmt->get_result();
  
} else {
  $results = $conn->query("SELECT * FROM countries");
}

?>
<ul>
<?php foreach ($results as $row): ?>
  <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
<?php endforeach; ?>
</ul>
