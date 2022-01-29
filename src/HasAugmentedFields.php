<?php

namespace TillProchaska\KirbyAugmentedFields;

use Kirby\Cms\Content;
use Kirby\Toolkit\Str;

trait HasAugmentedFields
{
    public function content(string $langCode = null): Content
    {
        $content = parent::content($langCode);

        $url = kirby()->request()->url();
        $isPanelUrl = Str::startsWith($url, kirby()->url('panel'));
        $isApiUrl = Str::startsWith($url, kirby()->url('api'));

        if ($isPanelUrl || $isApiUrl) {
            return $content;
        }

        return new AugmentedContent($content->data(), $content->parent());
    }
}
