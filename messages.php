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
            
            foreach ( $messageSets as $messageSet ) {
                
                echo wrapStart("div", ["class"=>"messageset"]);
                
                $messages = explode(";;", $messageSet );
                $width = 98 / (count($messages));
                
                foreach ( $messages as $message ) {
                    echo wrap("input", ["type"=>"text", "value"=>"$message", "style"=>"width: ${width}%"]);
                }
                echo "<br>";
                
                echo wrapEnd("div");
            }
            
            }
    
        }
    ?>
</body>
</html>