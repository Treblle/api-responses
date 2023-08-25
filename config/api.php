<?php

declare(strict_types=1);

return [
    'headers' => [
        'default' => [
            'Content-Type' => 'application/vnd.api+json',
        ],
        'error' => [
            'Content-Type' => 'application/problem+json',
        ],
    ],
];
