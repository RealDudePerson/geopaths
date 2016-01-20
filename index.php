<?php
    include "functions.php";
?>
<!DOCTYPE html>
<html>
<head>
    <?php
        printHead("Geocaching","");
    ?>
    <script src='scripts/datatables.min.js'></script>
    
</head>

<body>
    <?php
        printHeader("");
    ?>
    <div class="body">
    <div class="outer-wrapper">
    <div class="content-wrapper">
        <h2>About Geopaths</h2>
        <p>Geopaths is my attempt at creating a tracking system for little QR tokens. The tokens are placed into existing hidden <a href="https://en.wikipedia.org/wiki/Geocaching" target="_blank">geocaches</a>. When they are found, a user scans the code and submits some information on where they found it. The idea is to then place the token in another location, in order to see how far it can travel. Below you can see how far the first one has gone.</p>
        <p><a href='tokens/'>tokens</a></p>
    </div>
    </div>
    </div>
    <?php
        printFooter();
    ?>
</body>
</html>
