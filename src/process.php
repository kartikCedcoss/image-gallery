<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $target_dir = 'uploads/';
        $target_file = $target_dir . basename($_FILES["img_upload"]["name"]);




        if ($_FILES["img_upload"]["size"] > 500000) {
            echo "Image size should not exceed 2MB.";
        }

        move_uploaded_file($_FILES["img_upload"]["tmp_name"], $target_file);


        $_SESSION['image'] =  $target_file;
    }



    ?>

    <h1> Image Gallery </h1>
    <p> This Page displays the list of your uploaded images.</p>


    <form method="post" action="process.php" enctype='multipart/form-data'>
        <input type="file" name="img_upload"> <br> <br>
        <input type="submit" name="img_submit" value="Upload "><br><br>


    </form>
    <div>
        <?php
        session_destroy();




        $dir_path = "uploads/";
        $extensions_array = array('jpg', 'png', 'jpeg');

        if (is_dir($dir_path)) {
            $files = scandir($dir_path);

            for ($i = 0; $i < count($files); $i++) {
                if ($files[$i] != '.' && $files[$i] != '..') {
                    $file = pathinfo($files[$i]);
                    $extension = $file['extension'];
                    if (in_array($extension, $extensions_array)) {

                        echo "<img src='$dir_path$files[$i]' style='width:200px;height:200px;'></t></t> ";
                    }
                }
            }
        }






        ?>


    </div>
</body>

</html>