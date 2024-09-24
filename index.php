<?php

require "vendor/autoload.php";
require "init.php";

use Klein\Klein as Route;

try {

    $route = new Route();

    $route->get('/cv/[s:format]', function ($request) {
        return App\ProfileHandler::display($request);
    });
    

    $route->dispatch();

} catch (Exception $e) {

    err('ERROR ' . $e->getMessage());
    echo json_encode([
        'error' => $e->getMessage()
    ]);

}