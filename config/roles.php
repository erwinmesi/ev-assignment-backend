<?php

// The default role(s) in the system.
return [
    'default' => [
        'superadmin' => [
            'name' => 'superadmin',
            'description' => 'The user with the full access to the system.',
        ],

        'administrator' => [
            'name' => 'administrator',
            'description' => 'A user with permissions to manage majority of the system except another admin.',
        ],

        'author' => [
            'name' => 'author',
            'description' => 'A user with permissions to write and manage their own posts.',
        ],

        'editor' => [
            'name' => 'editor',
            'description' => 'A user with permissions to write and manage their own posts and others.',
        ],

        'subscriber' => [
            'name' => 'subscriber',
            'description' => 'A user with permissions to read and comment on posts.',
        ]
    ],
];
