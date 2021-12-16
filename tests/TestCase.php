<?php

namespace TillProchaska\KirbyAugmentedFields\Tests;

use Kirby\Cms\App;
use PHPUnit\Framework\TestCase as BaseTestCase;

/**
 * @internal
 * @coversNothing
 */
class TestCase extends BaseTestCase
{
    public const KIRBY_DIR = __DIR__.'/support/kirby';

    protected App $kirby;

    protected function setUp(): void
    {
        $this->kirby = new App([
            'roots' => [
                'blueprints' => __DIR__.'/support/kirby/blueprints',
                'content' => __DIR__.'/support/kirby/content',
            ],

            'pageModels' => [
                'test' => TestPage::class,
            ],
        ]);
    }
}
