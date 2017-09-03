<?php

return [

    'users' => [
        'order' => 'created_at',
        'direction' => 'desc',
        'role' => 'all',
        'valid' => false,
        'confirmed' => false,
        'new' => false,
    ],
    'posts' => [
        'order' => 'created_at',
        'direction' => 'desc',
        'new' => false,
        'active' => false,
    ],
    'contacts' => [
        'new' => false,
    ],
    'comments' => [
        'new' => false,
        'valid' => false,
    ],

];