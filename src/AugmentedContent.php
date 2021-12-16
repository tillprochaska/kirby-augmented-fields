<?php

namespace TillProchaska\KirbyAugmentedFields;

use Kirby\Cms\Content;
use Kirby\Cms\Field;

class AugmentedContent extends Content
{
    public function get(string $key = null): mixed
    {
        if (null === $key) {
            return $this->fields();
        }

        return $this->augmentField($key, parent::get($key));
    }

    public function unaugmented(string $key = null): Field
    {
        return parent::get($key);
    }

    public function fields(): array
    {
        $fields = [];

        foreach (parent::fields() as $key => $field) {
            $fields[$key] = $this->augmentField($key, $field);
        }

        return $fields;
    }

    protected function augmentField(string $key, Field $field): mixed
    {
        $definition = $this->getFieldDefinition($key);
        $type = $definition['type'] ?? null;

        if (!$type) {
            return $field;
        }

        if (!method_exists(Augmentations::class, $type)) {
            return $field;
        }

        return Augmentations::{$type}($field, $definition);
    }

    protected function getFieldDefinition(string $key): ?array
    {
        $definitions = $this->parent()->blueprint()->fields();
        $definitions = array_change_key_case($definitions);
        $key = strtolower($key);

        return $definitions[$key] ?? null;
    }
}
