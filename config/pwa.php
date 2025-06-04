<?php

return [
    'name' => env('APP_NAME', 'Your App Name'),
    'short_name' => 'YourApp',
    'theme_color' => '#ffffff',
    'background_color' => '#ffffff',
    'icons' => [
        [
            'src' => '/images/icons/icon-192x192.png',
            'sizes' => '192x192',
            'type' => 'image/png',
        ],
        [
            'src' => '/images/icons/icon-512x512.png',
            'sizes' => '512x512',
            'type' => 'image/png',
        ],
    ],
    'start_url' => '/',
    'display' => 'standalone',
    'orientation' => 'portrait',
    'scope' => '/',
    'lang' => 'en',
];
