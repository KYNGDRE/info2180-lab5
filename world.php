<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';
// $results='';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$country = isset($_GET["country"]) ? $_GET["country"] : '';
$lookup = isset($_GET["lookup"]) ? $_GET["lookup"] : '';

if ($lookup === 'cities') {
    // Query for cities
    // $stmt = $conn->prepare("SELECT cities.name AS city_name, cities.district, cities.population 
    //                          FROM cities 
    //                          JOIN countries ON cities.country_code = countries.code 
    //                          WHERE countries.name LIKE ?");

// $stmt = $conn->prepare("SELECT * FROM cities JOIN countries ON countries.code = cities.country_code WHERE country_code = (SELECT code FROM countries WHERE name = ?)");
  $stmt = $conn->prepare("SELECT cities.name AS city_name, cities.district, cities.population FROM cities JOIN countries ON cities.country_code = countries.code WHERE countries.name LIKE ?");  
    
    $param = "%" . $country . "%";
    $stmt->bind_param("s", $param);
    $stmt->execute();

    $results = $stmt->get_result();
  
    echo "Country: " . htmlspecialchars($country);

  
    ?>
  <table>
    <tr>
      <th>Name</th>
      <th>District</th>
      <th>Population</th>
    </tr>

  <?php foreach ($results as $row): ?>
    <tr>
      <td><?= htmlspecialchars($row['city_name']) ?></td>
      <td><?= htmlspecialchars($row['district']) ?></td>
      <td><?= htmlspecialchars($row['population']) ?></td>
    </tr>
 
  <?php endforeach; ?>
  </table>
<?php
} elseif ($country !== '') {
    // Query for countries
    $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE ?");
    $param = "%" . $country . "%";
    $stmt->bind_param("s", $param);
    $stmt->execute();
    $results = $stmt->get_result();
} else {
    // Default query for all countries
    $stmt = $conn->prepare("SELECT * FROM countries");
    $stmt->execute();
    $results = $stmt->get_result();
}


/*
<?php*/
if ($lookup === 'cities') {
  // echo 'TESTER';
  /*
  ?>
  <table>
    <tr>
      <th>Name</th>
      <th>District</th>
      <th>Population</th>
    </tr>

  <?php foreach ($results as $row): ?>
    <tr>
      <td><?= htmlspecialchars($row['city_name']) ?></td>
      <td><?= htmlspecialchars($row['district']) ?></td>
      <td><?= htmlspecialchars($row['population']) ?></td>
    </tr>
 
  <?php endforeach; ?>
  </table>
<?php*/

} else {
    echo "<table>
            <tr>
                <th>Country Name</th>
                <th>Continent</th>
                <th>Independence Year</th>
                <th>Head of State</th>
            </tr>";
    while ($row = $results->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['name']) . "</td>
                <td>" . htmlspecialchars($row['continent']) . "</td>
                <td>" . htmlspecialchars($row['independence_year']) . "</td>
                <td>" . htmlspecialchars($row['head_of_state']) . "</td>
              </tr>";
    }
    echo "</table>";
}

// $stmt->close();
$conn->close();
?>