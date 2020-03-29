<?php
    
    include_once "Server.php";
    
    $server = new Server();
    
    $authenticated = $server->checkCookie();
    
    if ($authenticated){
        header('Location: http://localhost/lab_pr_3/options-form.php/');
    } else {
        $method = isset($_POST['method']) ? $_POST['method'] : null;
    
        if ($method == 'get') {
            header('Location: http://localhost/lab_pr_3/get-form.php/');
        } elseif ($method == 'post') {
            header('Location: http://localhost/lab_pr_3/post-form.php/');
        }
    }
    
