<?php
    include "functions.php";
?>
<!DOCTYPE html>
<html>
<?php
    printHead("Geopaths","");
?>

<body>
    <?php
        printHeader("");
    ?>
    <div class="body">
    <div class="outer-wrapper">
    <div class="content-wrapper">
        <h2>Logs</h2>
        <p>Click <a href='tokens/index.php'>here</a> to view the find log for the existing tokens.</p>
        <h2>About Geopaths</h2>
        <p>Geopaths is my attempt at creating a tracking system for little QR tokens. The tokens are placed into existing hidden <a href="https://en.wikipedia.org/wiki/Geocaching" target="_blank">geocaches</a>. When they are found, a user scans the code and submits some information on where they found it. The idea is to then place the token in another location, in order to see how far it can travel. Check out the logs above to see where they have been.</p>
        <p>This has been done before.</p>
        <p>You can read about <a href='https://en.wikipedia.org/wiki/Geocoin' target="_blank">geocoins on wikipedia</a>. The Travel Bug is a &quot;trackable&quot; that can be obtained from Geocaching.com. I didn't feel like buying one so I made my own website instead. If you want to buy one instead, you can do so <a href="http://shop.geocaching.com/default/trackable-items/travel-bugs" target"_blank">here</a>.</p>
        <p><a href="http://geokrety.org/" target="_blank">Geokrety.org</a> also does essentially the same thing as Geopaths. You can register and create your own trackable there. As stated earlier I just wanted to make my own version to say that I did.</p>
        <p>If you are thikning that you want to set up something to do this yourself, you can get the code for this project from Github. It is free and avaiable to modify and use. Check it out: <a href="https://github.com/idiotonuni/geopaths" target="_blank">github.com/idiotonuni/geopaths</a>.</p>
    </div>
    </div>
    </div>
    <?php
        printFooter();
    ?>
</body>
</html>
