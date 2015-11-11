<?php
    include "functions.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
    <title>Geocaching</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="shortcut icon" href="favicon.ico">
    <script src="scripts/jquery-2.1.4.min.js"></script>
    <script src="scripts/smooth-scroll.js"></script
    <script src='scripts/main.js'></script>
</head>

<body>
    <div class="header">
        Header
    </div>
    <div class="outer-wrapper">
        Main Section
        <?php
            $output = getCacheData("cache01.txt");
            if(!$output){
                echo "No file exists";
            }else{
                echo $output;
            }
        ?>
    </div>
    <div class="footer">
        Footer
    </div>
</body>
</html>
