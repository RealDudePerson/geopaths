<?php
    include "functions.php";
?>
<!DOCTYPE html>
<html>
<head>
    <?php
        printHead("Geocaching","");
    ?>
</head>

<body>
    <?php
        printHeader("");
    ?>
    <div class="body">
    <div class="outer-wrapper">
    <div class="content-wrapper">
        <h2>Cache01</h2>
        <?php
            $output = getCacheData("cache01.txt");
            if(!$output){
                echo "No file exists";
            }else{
                echo $output;
            }
        ?>
    </div>
    </div>
    </div>
    <?php
        printFooter();
    ?>
</body>
</html>
