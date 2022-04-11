<?php

use Kirby\Cms\Field;

return [
    'tillprochaska.augmented-fields.augmentations' => [
        'custom' => function (Field $field): int {
            return 1;
        },
    ],
];
