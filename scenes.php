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
            
            if ($ip) {

                $name = get("http://$ip:8001/lightboard/system/name");
                if ($name) {
                    
                    echo wrap("script", [], "parent.parent.document.title='$name';");
                    echo wrap("h1", [], $name);

                    $result = get("http://$ip:8001/lightboard/scene/list");
                    $scenes = explode("\n", $result);
                    asort($scenes);
                    foreach ($scenes as $scene) {
                        echo wrap("a", ["href" => "groups.php?ip=$ip&scene=$scene",
                            "target" => "groups",
                            "onclick" => "clearMessagePanel();",
                            "ondblclick" => "loadScene(\"$ip\",\"$scene\");"], "$scene");
                    }
                    ?>

                    <a class="control" style="background-color: rgb(100,150,100);" onclick="post('<?php echo $ip; ?>', 'scene/resume', '');">Play</a>
                    <a class="control" style="background-color: rgb(150,100,100);" onclick="post('<?php echo $ip; ?>', 'scene/pause', '');">Pause</a>
                    <a class="control" style="background-color: rgb(100,100,100);" onclick="post('<?php echo $ip; ?>', 'system/sleep', '');">Sleep</a>
                    <a class="control" style="background-color: rgb(150,150,100);" onclick="post('<?php echo $ip; ?>', 'system/wake', '');">Wake</a>

                    <?php
                } else {
                    echo wrap("script", [], "parent.parent.document.title='LightBoard Controller';");
                    
                }
            } else {
                echo wrap("h1", [], "(offline)");
            }
        }
        ?>

    </body>

</html>