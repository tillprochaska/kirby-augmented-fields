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
                'config' => __DIR__.'/support/kirby/config',
                'plugins' => __DIR__.'/support/kirby/plugins',
            ],

            'pageModels' => [
                'test' => TestPage::class,
            ],
        ]);

        $this->kirby->extend(require __DIR__.'/../plugin/extensions.php');
    }
}
