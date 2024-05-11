<?php
function route($name, $parameters = [], $absolute = true)
{
    // Check if the route exists
    if (app('router')->has($name)) {
        return app('url')->route($name, $parameters, $absolute);
    } else {
        // If the route doesn't exist, return the home URL or any other fallback URL
        return app('url')->to('/');
    }
}