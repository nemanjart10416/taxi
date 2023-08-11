<?php

//X-Powered-By
//header('X-Powered-By: Our company\'s development team');

//Strict-Transport-Security
header("strict-transport-security: max-age=16070400");

//Content-Security-Policy: default-src *
//Ne diraj ako ne znas sta radis !!!
//header("Content-Security-Policy: default-src 'self';script-src 'self';img-src * data:;frame-ancestors 'none';");

//X-Frame-Options
header("X-Frame-Options: DENY");
header("X-Frame-Options: deny");

// Cross-Origin Resource Sharing(CORS)
//Ne diraj ako ne znas sta radis !!!
/*
header('Access-Control-Allow-Origin: https://domain.com');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept');
*/

//X-Content-Type-Options
header('X-Content-Type-Options: nosniff');


//Referrer-Policy
header("Referrer-Policy: no-referrer");

//permissions policy
header("Permissions-Policy: fullscreen=(self), geolocation=(*), camera=()");

/*
//prevent host header attack
$domains = ['abc.example.com', 'foo.bar.baz'];
if (!in_array($_SERVER['SERVER_NAME'], $domains)) {
    die();
}
*/

?>