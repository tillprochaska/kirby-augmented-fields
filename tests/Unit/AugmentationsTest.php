<?php

use Kirby\Cms\Blocks;
use Kirby\Cms\File;
use Kirby\Cms\Files;
use Kirby\Cms\Page;
use Kirby\Cms\Pages;
use Kirby\Toolkit\Collection;
use TillProchaska\KirbyAugmentedFields\AugmentedBlock;
use TillProchaska\KirbyAugmentedFields\AugmentedStructureObject;

beforeEach(function () {
    $this->page = page('test');
});

it('augments blocks field', function () {
    $blocks = $this->page->blocksField();

    expect($blocks)->toBeInstanceOf(Blocks::class);
    expect($blocks->first())->toBeInstanceOf(AugmentedBlock::class);

    expect($blocks->first()->firstName())->toEqual('John');
    expect($blocks->first()->isAdmin())->toBeBool();
    expect($blocks->first()->isAdmin())->toBeTrue();
})->only();

it('augments checkboxes field', function () {
    $field = $this->page->checkboxesField();
    expect($field)->toBeInstanceOf(Collection::class);
    expect($field)->toContain('one', 'two', 'three');
});

it('augments date field', function () {
    $field = $this->page->dateField();
    expect($field)->toBeInstanceOf(DateTime::class);
    expect($field)->toEqual(new DateTime('2021-01-01'));
});

it('augments files field', function () {
    $field = $this->page->filesField();
    expect($field)->toBeInstanceOf(Files::class);
    expect($field->count())->toEqual(2);
});

it('augments files field with multiselect disabled', function () {
    $field = $this->page->filesFieldSingle();
    expect($field)->toBeInstanceOf(File::class);
    expect($field->name())->toEqual('oscar-sutton-yihlaRCCvd4-unsplash');
});

it('augments layout field', function () {
    // TODO
});

it('augments multiselect field', function () {
    $field = $this->page->multiselectField();
    expect($field)->toBeInstanceOf(Collection::class);
    expect($field)->toContain('one', 'two', 'three');
});

it('augments pages field', function () {
    $field = $this->page->pagesField();
    expect($field)->toBeInstanceOf(Pages::class);
    expect($field->pluck('id'))->toContain('other-page-1', 'other-page-2');
});

it('augments pages field with multiselect disabled', function () {
    $field = $this->page->pagesFieldSingle();
    expect($field)->toBeInstanceOf(Page::class);
    expect($field->id())->toEqual('other-page-1');
});

it('augments structure field', function () {
    $field = $this->page->structureField();

    expect($field)->toBeInstanceOf(Structure::class);
    expect($field->first())->toBeInstanceOf(AugmentedStructureObject::class);

    expect($field->first()->firstName())->toEqual('John');
    expect($field->first()->isAdmin())->toBeBool();
    expect($field->first()->isAdmin())->toBeTrue();
});

it('augments tags field', function () {
    $field = $this->page->tagsField();
    expect($field)->toBeInstanceOf(Collection::class);
    expect($field)->toContain('one', 'two', 'three');
});

it('augments time field', function () {
    // TODO
});

it('augments toggle field', function () {
    $field = $this->page->toggleField();
    expect($field)->toBeBool();
    expect($field)->toBeTrue();
});

it('augments users field', function () {
    // TODO
});
