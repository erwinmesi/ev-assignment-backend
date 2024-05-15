<?php

// The default role(s) in the system.
return [
    'default' => [
        'superadmin' => [
            'name' => 'superadmin',
            'description' => 'The user with the full access to the system.',
        ],

        'admin' => [
            'name' => 'admin',
            'description' => 'A user with permissions to manage majority of the system except another admin.',
        ]
    ],
];
