<?php
    
    include_once "Server.php";
    
    $server = new Server();
    
    $method = $server->getMethod();
    
    if ($method == 'GET') {
        if ($server->validateGET()) {
        
        } else {
            $server->setError(1);
        }
    } elseif ($method == 'POST') {
        if ($server->validatePOST()) {
        
        } else {
            $server->setError(1);
        }
    } else {
        $server->setError(1);
    }
    
    if ($server->getError()) {
        header('Location: http://localhost/lab_pr_3/');
    } else {
        $server->setCookie();
        header('Location: http://localhost/lab_pr_3/options-form.php/');
    }
    
    exit();