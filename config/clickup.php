<?php

return [

    /*
    -----------------------------------------------------------------------------
    | ClickUp API Token
    |-----------------------------------------------------------------------------
    |
    | If your are using a personal API token, you can set it here.
    |
    */

    'api_token' => env('CLICKUP_API_TOKEN'),

    /*
    |--------------------------------------------------------------------------
    | ClickUp OAuth
    |--------------------------------------------------------------------------
    |
    | ID, secret and url to make API requests using OAuth
    |
    */
    'oauth' => [
        'id' => env('CLICKUP_CLIENT_ID'),

        'secret' => env('CLICKUP_CLIENT_SECRET'),

        'url' => env('CLICKUP_OAUTH_URL', 'https://app.clickup.com/api'),
    ],

    /*
    |--------------------------------------------------------------------------
    | ClickUp API Base URL
    |--------------------------------------------------------------------------
    |
    | The base URL for the ClickUp API. Right now it's v2
    |
    */
    'base_url' => env('CLICKUP_API_URL', 'https://api.clickup.com/api/v2'),

    /*
    -----------------------------------------------------------------------------
    | ClickUp Default Workspace ID
    |-----------------------------------------------------------------------------
    |
    | If you are going to work just with one workspace, you can set the default
    | workspace ID here.
    |
    */

    'workspace_id' => env('CLICKUP_WORKSPACE_ID'),

];
