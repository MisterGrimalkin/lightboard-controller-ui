<html>

    <?php
    include("includes/header.html");
    include("includes/common.php");
    include("includes/wrapper.php");
    ?>

    <body>

        <?php
        if (isGet()) {
            $ip = filter_input(INPUT_GET, "ip");
            $scene = filter_input(INPUT_GET, "scene");

            if ($ip && $scene) {

                echo wrap("h1", ["onclick" => "loadScene(\"$ip\",\"$scene\");"], "$scene");

                $result = get("http://$ip:8001/lightboard/scene/$scene/list");
                if ( $result ) {
                    $groups = explode("\n", $result);
                    asort($groups);
                    foreach ($groups as $group) {
                        echo wrap("a", ["href" => "messages.php?ip=$ip&scene=$scene&group=$group", "target" => "messages"], "$group<br>");
                    }
                }
            }
        }
        ?>
    </body>
</html>