<?php

use StarfolkSoftware\Gauge\Gauge;

it('can disable migrations', function () {
    Gauge::ignoreMigrations();

    expect(Gauge::$runsMigrations)->toBeFalse();
});

it('can update review model', function () {
    Gauge::useReviewModel('App\\Models\\ReviewTestModel');

    expect(Gauge::$reviewModel)->toBe('App\\Models\\ReviewTestModel');
});

it('can update user model', function () {
    Gauge::useUserModel('App\\Models\\UserTestModel');

    expect(Gauge::$userModel)->toBe('App\\Models\\UserTestModel');
});

it('can update review table name', function () {
    Gauge::useReviewsTableName('reviews_table');

    expect(Gauge::$reviewsTableName)->toBe('reviews_table');
});

it('can turn on support for soft delete', function () {
    Gauge::supportsSoftDeletes();

    expect(Gauge::$supportsSoftDeletes)->toBeTrue();
});

it('can turn on support for single reviews', function () {
    Gauge::supportsSingleReviews();

    expect(Gauge::$supportsSingleReviews)->toBeTrue();
});

it('can turn on support for teams', function () {
    Gauge::supportsTeams();

    expect(Gauge::$supportsTeams)->toBeTrue();
});
