<?php

namespace Core;

class Container
{
    protected $bindings = [];

    // adds things to the container
    public function bind($key, $resolver)
    {
        // the resolver is a function that will build up the database class however is appropriate for the project
        $this->bindings[$key] = $resolver;
    }

    // removes things from the container
    public function resolve($key)
    {
        if (!array_key_exists($key, $this->bindings)) {
            throw new \Exception("No matching binding found for your {$key}");
        } else {
            $resolver = $this->bindings[$key];
            return call_user_func($resolver);
        }
    }
}
