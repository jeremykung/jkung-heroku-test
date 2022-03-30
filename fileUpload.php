<?php

echo $_SERVER['PHP_SELF'];

if (isset($_POST["upload"])) {

    if (isset($_FILES['file_upload'])) {

    } else {

        // Get file path
        $postUrl = $_POST['upload_url'];
    
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
    
        $sql = "INSERT INTO `img` (img_url) VALUES ('$postUrl')";
        $conn->exec($sql);
        echo "<br>Successfully Uploaded<br>"; 

    }    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
    <script src="https://app.simplefileupload.com/buckets/2ca1d48bcae2e3413c2c5e030da2ba43.js"></script>
</head>
<body>

<!-- <form action="">
    <input type="hidden" id="user_avatar_url" name="user[avatar_url]" class="simple-file-upload">
</form> -->

<!-- SIMPLE FILE UPLOAD -->
<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" id="upload_url" name="upload_url" class="simple-file-upload">
    <input type="submit" value="Upload" name="upload">
</form>

<!-- FILE SYSTEM -->
<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="file_upload">
    <input type="submit" value="Upload" name="upload">
</form>

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

    // Show Images
    // use the PDO query() method to retrieve data and store in $result variable
    $result = $conn->query("SELECT * FROM `img`");

    // fetch an associative array for each row of data in $result object
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

        $id = $row["img_id"];
        $imgUrl = $row["img_url"];

        echo "<img src='$imgUrl'>";
    }

?>

</body>
</html>


