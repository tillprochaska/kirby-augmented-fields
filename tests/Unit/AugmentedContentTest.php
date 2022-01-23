<?php

use Kirby\Cms\Field;
use Kirby\Cms\Structure;
use TillProchaska\KirbyAugmentedFields\AugmentedContent;

beforeEach(function () {
    $this->page = page('test');
    $this->content = new AugmentedContent($this->page->content()->data(), $this->page);
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
    expect($field->value())->toEqual("- firstName: John\n  lastName: Doe\n  isAdmin: true");
});

it('returns unaugmented fields', function () {
    $fields = $this->content->unaugmented();
    expect($fields)->toBeArray();
    expect($fields['datefield'])->toBeInstanceOf(Field::class);
});

it('augments field with custom augmentation method', function () {
    $field = $this->content->get('customField');
    expect($field)->toBeNumeric();
});

it('supports nested fields', function () {
    $definitions = [
        'nestedField' => [
            'type' => 'toggle',
        ],
    ];

    $data = ['nestedField' => '1'];
    $content = new AugmentedContent($data, $this->page, $definitions);

    expect($content->get('nestedField'))->toBeTrue();
});
