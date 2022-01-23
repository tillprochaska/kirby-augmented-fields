<?php

namespace TillProchaska\KirbyAugmentedFields;

use Kirby\Cms\Content;
use Kirby\Cms\Field;

class AugmentedContent extends Content
{
    protected ?array $fieldDefinitions;

    public function __construct(array $data = [], $parent = null, ?array $fieldDefinitions = null)
    {
        $this->fieldDefinitions = $fieldDefinitions;

        parent::__construct($data, $parent);
    }

    public function get(string $key = null): mixed
    {
        if (null === $key) {
            return $this->fields();
        }

        return $this->augmentField($key, parent::get($key));
    }

    public function unaugmented(string $key = null): Field|array
    {
        if (null === $key) {
            return parent::fields();
        }

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

        $custom = kirby()->option('till-prochaska.augmented-fields.augmentations')[$type] ?? null;

        if (is_callable($custom)) {
            return $custom($field, $definition);
        }

        if (method_exists(Augmentations::class, $type)) {
            return Augmentations::{$type}($field, $definition);
        }

        return $field;
    }

    protected function getFieldDefinition(string $key): ?array
    {
        $definitions = $this->fieldDefinitions;

        if (null === $definitions) {
            $definitions = $this->parent()->blueprint()->fields();
        }

        $definitions = array_change_key_case($definitions);
        $key = strtolower($key);

        return $definitions[$key] ?? null;
    }
}
