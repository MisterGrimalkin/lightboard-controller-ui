<html>

<?php
    include("includes/header.html");
    include("includes/common.php");
    include("includes/wrapper.php");
?>

<body>
    
    <?php
        $ip = filter_input(INPUT_GET, "ip");
        if ( $ip ) {
            ?>
            <iframe name="scenes" width="230" height="1000" src="scenes.php?ip=<?php echo $ip; ?>" frameborder="0" style="float: left;"></iframe>
            <iframe name="groups" width="230" height="1000" src="" frameborder="0" style="float: left;"></iframe>
            <iframe id="messagePanel" name="messages" width="800" height="1000" src="" frameborder="0" style="float: left;"></iframe>
            <?php
        }
        ?>
    
</body>

</html>
    
    
