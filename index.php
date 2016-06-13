<html>

    <?php
    include("includes/header.html");
    include("includes/common.php");
    include("includes/wrapper.php");
    ?>

    <body onload="onLoad()">

        <div style="padding:5px; font-size: large;">
            <label for="ipaddress">LightBoard IP</label>&nbsp;<input id="ipaddress" name="ipaddress" type="text" onchange="loadBoard();"/>
        </div>

        <iframe id="board" name="board" width="1300" height="1000" src="" frameborder="0" style="float: left;"></iframe>

    </body>

</html>


