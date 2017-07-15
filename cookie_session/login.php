<?php
//login
setcookie("TestCookieAuth", 'sessionId-'.md5('Vasya'), time() + 3600, "/");

var_dump([
    'session' => $_SESSION,
    'cookie' => $_COOKIE
]);
