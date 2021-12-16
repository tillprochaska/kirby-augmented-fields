<?php

namespace TillProchaska\KirbyAugmentedFields;

trait HasAugmentedFields
{
    public function content(string $langCode = null): AugmentedContent
    {
        $content = parent::content($langCode);

        return new AugmentedContent($content->data(), $content->parent());
    }
}
