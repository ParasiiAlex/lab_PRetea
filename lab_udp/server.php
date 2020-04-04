<?php
    include_once "VideoStream.php";
    
    define('HOST_NAME',"localhost");
    define('PORT',"9000");
    define('PORT_2',"9001");
    
    $filePath = "./video/";

    $stream = new VideoStream();

    $socketResource2 = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);

    socket_set_option($socketResource2, SOL_SOCKET, SO_REUSEADDR, 1);
    
    socket_bind($socketResource2, 0, PORT_2);
    
    while (true) {
        socket_recvfrom($socketResource2, $buffer, 64, 0, $ip, $port);
        
        if (preg_match("/(.+\.mp4)\n\r\n\r/", $buffer, $matches)) {
            $videoName = $matches[1];
            $stream->setPath($filePath.$videoName);
            
            $socketResource = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
            socket_set_option($socketResource, SOL_SOCKET, SO_REUSEADDR, 1);
            socket_bind($socketResource, 0, PORT);
    
            echo date('H:i:s')." | ".$videoName.PHP_EOL;
            $stream->start($socketResource, HOST_NAME, PORT);
            
            socket_clear_error($socketResource);
        }
    }

