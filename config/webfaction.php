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
    |
    */

    'username' => env('WF_USERNAME'),
    'password' => env('WF_PASSWORD'),
    'machine'  => env('WF_MACHINE')

];
