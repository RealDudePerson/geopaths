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
