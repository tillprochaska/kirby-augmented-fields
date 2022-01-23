<?php

namespace TillProchaska\KirbyAugmentedFields;

use Kirby\Cms\StructureObject;

class AugmentedStructureObject extends StructureObject
{
    protected ?array $fieldDefinitions = null;

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
