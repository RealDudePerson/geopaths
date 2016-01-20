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
            foreach($logs as $token){
                echo "<a href='$token'>$token</a><br>";
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