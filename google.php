<?php

require_once 'C:\xampp\htdocs\web1\view\front office\GoogleAPI\vendor\autoload.php';
$gClient = new Google_Client();
$gClient->setClientId("190517350430-2cshmc54kqdgl2q4jbgmgd9hgfibekkb.apps.googleusercontent.com");
$gClient->setClientSecret("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");
$gClient->setApplicationName("CulturArt Moundo");
$gClient->setRedirectUri('http://localhost/web1/view/front%20office/site.php');
$gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email")





?>
