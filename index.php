<?php

    // Connect to DB
    $servername = "us-cdbr-east-05.cleardb.net";
    $username = "be4c22fe1bd451";
    $password = "0128e3d6";
    $database = "heroku_f4c1f1b843cd581";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully<br>";
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    if (isset($_POST['submit'])) {

        // Write to DB
        $user = $_POST['username'];
        $sql = "INSERT INTO `user` (username, age) VALUES ('$user')";
        $conn->exec($sql);
        echo "<Successfully inserted row<br>";

    }
?>

<h1>Heroku Deploy Test</h1>

<form action="" method="post">
    <input type="text" name="username" placeholder="username">
    <input type="submit" value="Add User" name="submit">
</form>

<h1>Users</h1>

<?php

    $result = $conn->query("SELECT * FROM `user`");

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

        $username = $row["username"];
        $age = $row["age"];
    
        echo "<h2>$username</h2>";
    }

?>