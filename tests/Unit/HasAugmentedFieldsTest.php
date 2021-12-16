<?php

use TillProchaska\KirbyAugmentedFields\AugmentedContent;

it('returns augmented content', function () {
    expect(page('test')->content())->toBeInstanceOf(AugmentedContent::class);
});
