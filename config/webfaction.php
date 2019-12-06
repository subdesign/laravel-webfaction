<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Webfaction config settings
    |--------------------------------------------------------------------------
    |
    | username (string) – a valid WebFaction control panel username
    | password (string) – a valid WebFaction control panel user’s password
    | machine (string) – the case-sensitive machine name (for example, Web55); optional for accounts with only one machine
    | debug (boolean) – show debug information
    | debug_level (integer) – available options: 0,1,2
    |
    */

    'username'    => env('WF_USERNAME'),
    'password'    => env('WF_PASSWORD'),
    'machine'     => env('WF_MACHINE'),
    'debug'       => env('WF_DEBUG', false),
    'debug_level' => env('WF_DEBUG_LEVEL', 2)
];
