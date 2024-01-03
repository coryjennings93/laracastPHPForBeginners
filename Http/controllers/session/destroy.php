<?php

use Core\Authenticator;

$logout = new Authenticator();

// log the user out
$logout->logout();


header('location: /');
exit();
