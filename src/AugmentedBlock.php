<?php

namespace TillProchaska\KirbyAugmentedFields;

use Kirby\Cms\Block;

class AugmentedBlock extends Block
{
    protected ?array $fieldDefinitions = null;

    public function __construct($props = [])
    {
        parent::__construct($props);

        $this->fieldDefinitions = $props['fieldDefinitions'];
    }

    public function content(): AugmentedContent
    {
        return new AugmentedContent(
            parent::content()->data(),
            $this->parent(),
            $this->fieldDefinitions,
        );
    }

    protected function setFieldDefinitions($definitions = null): void
    {
        $this->fieldDefinitions = $definitions;
    }
}
