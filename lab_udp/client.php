<?php
    define('HOST_NAME', "localhost");
    define('PORT', "9000");
    define('PORT_2', "9001");
    set_time_limit(0);
    
    $videoName = isset($_GET['name']) ? $_GET['name'] : null;
    
    if ($videoName){
        $socketResource = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
    
        socket_set_option($socketResource, SOL_SOCKET, SO_REUSEADDR, 1);
        socket_bind($socketResource, 0, PORT);
    
        $header = "$videoName\n\r\n\r";
        socket_sendto($socketResource, $header, strlen($header), 0, HOST_NAME, PORT_2);
    
        getVideo($socketResource);
    }
    
    
    function getVideo($socketResource)
    {
        while (true) {
            socket_recvfrom($socketResource, $buffer, 4086, 0, $ip, $port);
            
            if ($buffer) {
                $body = sendHeaders($buffer);
                
                if ($body !== null) {
                    echo $body;
                    while (true) {
                        if (socket_recvfrom($socketResource, $buffer, 4086, 0, $ip, $port)) {
                            echo $buffer;
                            flush();
                        } else {
                            break;
                        }
                    }
                }
            }
        }
    }
    
    function sendHeaders($buffer)
    {
        $array = array();
        if (preg_match('/\\n\\r\\n\\r/', $buffer)) {
            $array = preg_split('/\\n\\r/', $buffer);
        }
        foreach ($array as $header) {
            if (strlen($header) > 10) {
                header($header);
            }
        }
        
        $endHeaders = strpos($buffer, "\n\r\n\r") + 4;
        
        return substr($buffer, $endHeaders);
    }
    
