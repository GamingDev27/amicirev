<?php

/**
 *   Copyright 2018 Vimeo.
 *
 *   Licensed under the Apache License, Version 2.0 (the "License");
 *   you may not use this file except in compliance with the License.
 *   You may obtain a copy of the License at
 *
 *       http://www.apache.org/licenses/LICENSE-2.0
 *
 *   Unless required by applicable law or agreed to in writing, software
 *   distributed under the License is distributed on an "AS IS" BASIS,
 *   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *   See the License for the specific language governing permissions and
 *   limitations under the License.
 */
declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | Vimeo Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like.
    |
    */

    'connections' => [

        'main' => [
            'client_id' => env('VIMEO_CLIENT', 'ce334a131c743090d829d12467fe72834b1dd0f4'),
            'client_secret' => env('VIMEO_SECRET', 'IcDJ9kMebz4p/8bs4R/q9SEhnVdQwGQfN/IxoKWcjwQ+IWrrFOgY8rt0gw4Mj70OLjdg/Dno3I3tg4/q33gLJJEZW77oSdKVpS6nRGgK6jePp7H6wx8FHv86InnbwXm5'),//'IcDJ9kMebz4p/8bs4R/q9SEhnVdQwGQfN/IxoKWcjwQ+IWrrFOgY8rt0gw4Mj70OLjdg/Dno3I3tg4/q33gLJJEZW77oSdKVpS6nRGgK6jePp7H6wx8FHv86InnbwXm5'),
            'access_token' => env('VIMEO_ACCESS', 'af46799eb76db4f4d4fcbc7ff5f7531b')//'5b0dc7114c47ccd1576bcc49c4dead48'),
        ],

        'alternative' => [
            'client_id' => env('VIMEO_ALT_CLIENT', 'your-alt-client-id'),
            'client_secret' => env('VIMEO_ALT_SECRET', 'your-alt-client-secret'),
            'access_token' => env('VIMEO_ALT_ACCESS', null),
        ],

    ],

];
