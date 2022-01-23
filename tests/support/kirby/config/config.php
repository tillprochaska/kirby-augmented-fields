<?php

use Kirby\Cms\Field;

return [
    'till-prochaska.augmented-fields.augmentations' => [
        'custom' => function (Field $field): int {
            return 1;
        },
    ],
];
