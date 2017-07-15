<?php
//login
setcookie("TestCookieAuth", 'sessionId-'.md5('Vasya'), time(), "/");
session_destroy();

var_dump([
    'session' => $_SESSION,
    'cookie' => $_COOKIE
]);
