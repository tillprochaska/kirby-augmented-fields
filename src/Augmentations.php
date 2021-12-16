<?php

namespace TillProchaska\KirbyAugmentedFields;

use DateTime;
use Kirby\Cms\Blocks;
use Kirby\Cms\Field;
use Kirby\Cms\File;
use Kirby\Cms\Files;
use Kirby\Cms\Layouts;
use Kirby\Cms\Page;
use Kirby\Cms\Pages;
use Kirby\Cms\Structure;
use Kirby\Cms\User;
use Kirby\Cms\Users;
use Kirby\Toolkit\Collection;

class Augmentations
{
    public static function blocks(Field $field, array $definition): Blocks
    {
        return $field->toBlocks();
    }

    public static function checkboxes(Field $field, array $definition): Collection
    {
        return new Collection($field->split());
    }

    public static function date(Field $field, array $definition): DateTime
    {
        return new DateTime($field->value());
    }

    public static function files(Field $field, array $definition): null|File|Files
    {
        $multiple = $definition['multiple'] ?? true;

        if (!$multiple) {
            return $field->toFile();
        }

        return $field->toFiles();
    }

    public static function layout(Field $field, array $definition): Layouts
    {
        return $field->toLayouts();
    }

    public static function multiselect(Field $field, array $definition): Collection
    {
        return new Collection($field->split());
    }

    public static function pages(Field $field, array $definition): null|Page|Pages
    {
        $multiple = $definition['multiple'] ?? true;

        if (!$multiple) {
            return $field->toPage();
        }

        return $field->toPages();
    }

    public static function structure(Field $field, array $definition): Structure
    {
        return $field->toStructure();
    }

    public static function tags(Field $field, array $definition): Collection
    {
        return new Collection($field->split());
    }

    public static function time(Field $field, array $definition): Field
    {
        // TODO
        return $field;
    }

    public static function toggle(FIeld $field, array $definition): bool
    {
        return $field->toBool();
    }

    public static function users(Field $field, array $definition): null|User|Users
    {
        $multiple = $definition['multiple'] ?? true;

        if (!$multiple) {
            return $field->toUser();
        }

        return $field->toUsers();
    }
}
