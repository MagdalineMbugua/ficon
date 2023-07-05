<?php

use App\Enum\Roles;

return [
    Roles::BASIC => [
        'view_posts',
        'save_posts',
        'create_purchase',
        'create_comment',
        'view_comment',
        'update_comment',
        'delete_comment',
    ],

    Roles::STANDARD => [
        'view_posts',
        'save_posts',
        'create_post',
        'update_post',
        'create_purchase',
        'create_sale',
        'create_comment',
        'view_comment',
        'update_comment',
        'delete_comment',
    ],

    Roles::PREMIUM => [
        'view_posts',
        'save_posts',
        'create_post',
        'update_post',
        'create_purchase',
        'create_sale',
        'create_comment',
        'view_comment',
        'update_comment',
        'delete_comment',
        'view_analytics',
    ],

];
