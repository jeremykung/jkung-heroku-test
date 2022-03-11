<?php

if (isset($_POST["upload"])) {

    var_dump($_FILES);
    echo $_FILES['myUpload']['name'];
    
    $destinationFolder = "./images/";
    $filepath = $destinationFolder.$_FILES['myUpload']['name'];
    if (move_uploaded_file($_FILES['myUpload']['tmp_name'], $filepath)) {
        echo "<br>Upload Successful<br>";
    } else {
        echo "<br>move_upload_file failed";
    };
}


?>

<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="myUpload">
    <input type="submit" value="Upload" name="upload">
</form>