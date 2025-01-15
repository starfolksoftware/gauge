<?php

namespace StarfolkSoftware\Gauge;

final class Gauge
{
    /**
     * Indicates if Gauge migrations should be ran.
     *
     * @var bool
     */
    public static $runsMigrations = true;

    /**
     * The review model that should be used by Gauge.
     *
     * @var string
     */
    public static $reviewModel = 'App\\Models\\Review';

    /**
     * The user model that should be used by Gauge.
     *
     * @var string
     */
    public static $userModel = 'App\\Models\\User';

    /**
     * The reviews table name that should be used by Gauge.
     *
     * @var string
     */
    public static $reviewsTableName = 'reviews';

    /**
     * Indicates whether Gauge soft deletes reviews.
     *
     * @var bool
     */
    public static $supportsSoftDeletes = false;

    /**
     * Indicates if Gauge should support teams.
     *
     * @var bool
     */
    public static $supportsTeams = false;

    /**
     * Indicates if Gauge should support single reviews.
     *
     * @var bool
     */
    public static $supportsSingleReviews = false;

    /**
     * The team model that should be used by Gauge.
     *
     * @var string
     */
    public static $teamModel;

    /**
     * Get the name of the team model used by the application.
     *
     * @return string
     */
    public static function teamModel()
    {
        return self::$teamModel;
    }

    /**
     * Specify the team model that should be used by Gauge.
     *
     * @return static
     */
    public static function useTeamModel(string $model)
    {
        self::$teamModel = $model;

        return new self;
    }

    /**
     * Get a new instance of the team model.
     *
     * @return mixed
     */
    public static function newTeamModel()
    {
        $model = self::teamModel();

        return new $model;
    }

    /**
     * Find a team instance by the given ID.
     *
     * @param  mixed  $id
     * @return mixed
     */
    public static function findTeamByIdOrFail($id)
    {
        return self::newTeamModel()->whereId($id)->firstOrFail();
    }

    /**
     * Get the name of the review model used by the application.
     *
     * @return string
     */
    public static function reviewModel()
    {
        return self::$reviewModel;
    }

    /**
     * Get a new instance of the review model.
     *
     * @return mixed
     */
    public static function newReviewModel()
    {
        $model = self::reviewModel();

        return new $model;
    }

    /**
     * Specify the review model that should be used by Gauge.
     *
     * @return static
     */
    public static function useReviewModel(string $model)
    {
        self::$reviewModel = $model;

        return new self;
    }

    /**
     * Configure Gauge to not run its migrations.
     *
     * @return static
     */
    public static function ignoreMigrations()
    {
        self::$runsMigrations = false;

        return new self;
    }

    /**
     * Configure Gauge to support multiple teams.
     *
     * @return static
     */
    public static function supportsTeams(bool $value = true)
    {
        self::$supportsTeams = $value;

        return new self;
    }

    /**
     * Get the name of the user model used by the application.
     *
     * @return string
     */
    public static function userModel()
    {
        return self::$userModel;
    }

    /**
     * Get a new instance of the user model.
     *
     * @return mixed
     */
    public static function newUserModel()
    {
        $model = self::userModel();

        return new $model;
    }

    /**
     * Specify the user model that should be used by Gauge.
     *
     * @return static
     */
    public static function useUserModel(string $model)
    {
        self::$userModel = $model;

        return new self;
    }

    /**
     * Configure Gauge to support soft delete.
     *
     * @return static
     */
    public static function supportsSoftDeletes(bool $value = true)
    {
        self::$supportsSoftDeletes = $value;

        return new self;
    }

    /**
     * Sets reviews table name.
     *
     * @return static
     */
    public static function useReviewsTableName(string $value)
    {
        self::$reviewsTableName = $value;

        return new self;
    }

    /**
     * Sets reviews table name.
     *
     * @return static
     */
    public static function supportsSingleReviews(bool $value = true)
    {
        self::$supportsSingleReviews = $value;

        return new self;
    }
}
