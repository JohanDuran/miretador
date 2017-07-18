<?php

use Cake\Core\Configure;
 
return [
    'HybridAuth' => [
        'providers' => [
            'Facebook' => [
                'enabled' => true,
                'keys' => [
                    'id' => '101304560544621',
                    'secret' => '2d1d2b02f65aa9611d0a4b7c43e4b464'
                ],
                'scope' => 'email, public_profile',
                "photo_size" => 300,
            ],
        ],
        'debug_mode' => Configure::read('debug'),
        'debug_file' => LOGS . 'hybridauth.log',
    ]
];
 
