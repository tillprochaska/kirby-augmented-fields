<?php

use Kirby\Cms\Field;
use Kirby\Cms\Structure;
use TillProchaska\KirbyAugmentedFields\AugmentedContent;

beforeEach(function () {
    $page = page('test');
    $this->content = new AugmentedContent($page->content()->data(), $page);
});

it('handles fields without field definition', function () {
    $field = $this->content->get('fieldWithoutDefinitionInBlueprint');
    expect($field)->toBeInstanceOf(Field::class);
    expect($field->value())->toEqual('Lorem Ipsum');
});

it('handles non-existant fields', function () {
    $field = $this->content->get('fieldThatDoesNotExistInContentFile');
    expect($field)->toBeInstanceOf(Field::class);
    expect($field->value())->toBeNull();
});

it('handles fields with no augmentation method', function () {
    $field = $this->content->get('fieldWithoutAugmentationMethod');
    expect($field)->tobeInstanceOf(Field::class);
    expect($field->value())->toBeString();
    expect($field->value())->toEqual('Hello World!');
});

it('augments field values', function () {
    $field = $this->content->get('structureField');
    expect($field)->toBeInstanceOf(Structure::class);
});

it('augments field values if casing of field name is different', function () {
    $field = $this->content->get('STRUCTUREFIELD');
    expect($field)->tobeInstanceOf(Structure::class);
});

it('returns all fields augmented', function () {
    expect($this->content->get()['structurefield'])->toBeInstanceOf(Structure::class);
    expect($this->content->fields()['structurefield'])->toBeInstanceOf(Structure::class);
});

it('returns unaugmented field', function () {
    $field = $this->content->unaugmented('structureField');
    expect($field)->toBeInstanceOf(Field::class);
    expect($field->value())->toEqual("- firstName: John\n  lastName: Doe");
});

it('augments field with custom augmentation method', function () {
    $field = $this->content->get('customField');
    expect($field)->toBeNumeric();
});
