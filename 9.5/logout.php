<?php

use src\Session;

require_once 'src/Session.php';
$session = new Session();
$session->forgetSession();