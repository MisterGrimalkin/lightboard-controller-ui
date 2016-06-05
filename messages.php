<html>

<?php
    include("includes/header.html");
    include("includes/common.php");
    include("includes/wrapper.php");
?>

<body>
    
    <?php 
        if ( isGet() ) {
    
            $ip = filter_input(INPUT_GET, "ip");
            $scene = filter_input(INPUT_GET, "scene");
            $group = filter_input(INPUT_GET, "group");
            
            if ( $ip && $scene && $group ) {
            
                echo wrap("div", ["class"=>"messagesetheader"], "$group");

                $messageSets = explode("\n", get("http://$ip:8001/lightboard/scene/$scene/group/$group/list"));
                
                $setCount = count($messageSets);
                $messageCount = 0;
                
                echo wrapStart("div", ["id"=>"messageList"]);

                $si = 0;
                foreach ( $messageSets as $messageSet ) {

                    echo wrapStart("div", ["class"=>"messageset"]);

                    $messages = explode(";;", $messageSet );
                    $width = 98 / (count($messages));
                    
                    $messageCount = count($messages);

                    $mi = 0;
                    foreach ( $messages as $message ) {
                        echo wrap("input", ["id"=>"msg-$si-$mi", "type"=>"text", "value"=>"$message", "style"=>"width: ${width}%"]);
                        $mi++;
                    }

                    $si++;

                    echo "<br>";

                    echo wrapEnd("div");
                }
                
                echo wrap("script", [], "setCount=$setCount; msgCount=$messageCount;");
                
                echo wrapEnd("div");
                
                echo wrap("button", ["class"=>"control", "style"=>"width: 50px;", "type"=>"button", "onclick"=>"addMessageRow($width);"], "Add");
                echo wrap("button", ["class"=>"control", "style"=>"width: 50px;", "type"=>"button", "onclick"=>"clearMessages(\"$ip\", \"$scene\", \"$group\");"], "Clear");
                echo wrap("button", ["class"=>"control", "style"=>"width: 50px;", "type"=>"button", "onclick"=>"saveMessages(\"$ip\", \"$scene\", \"$group\");"], "Save");
            }
    
        }
    ?>
</body>
</html>