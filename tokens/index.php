<?php
    include "../functions.php";
?>
<!DOCTYPE html>
<html>
<?php
    printHead("Token Log Index","../");
?>

<body>
    <?php
        printHeader("../");
    ?>
    <div class="body">
    <div class="outer-wrapper">
    <div class="content-wrapper">
        <h2>Log Find List</h2>
        <?php
            $logs = printLogList();
            echo "<ul>";
            foreach($logs as $token){
                $tokenSubStr = substr($token,0,7);
                echo "<li><a href='$token'>$tokenSubStr</a></li>";
            }
            echo "</ul>";
        ?>
    </div>
    </div>
    </div>
    <?php
        printFooter();
    ?>
</body>
</html>