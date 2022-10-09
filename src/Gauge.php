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
        return static::$teamModel;
    }

    /**
     * Specify the team model that should be used by Gauge.
     *
     * @param  string  $model
     * @return static
     */
    public static function useTeamModel(string $model)
    {
        static::$teamModel = $model;

        return new static();
    }

    /**
     * Get a new instance of the team model.
     *
     * @return mixed
     */
    public static function newTeamModel()
    {
        $model = static::teamModel();

        return new $model();
    }

    /**
     * Find a team instance by the given ID.
     *
     * @param  mixed  $id
     * @return mixed
     */
    public static function findTeamByIdOrFail($id)
    {
        return static::newTeamModel()->whereId($id)->firstOrFail();
    }

    /**
     * Get the name of the review model used by the application.
     *
     * @return string
     */
    public static function reviewModel()
    {
        return static::$reviewModel;
    }

    /**
     * Get a new instance of the review model.
     *
     * @return mixed
     */
    public static function newReviewModel()
    {
        $model = static::reviewModel();

        return new $model();
    }

    /**
     * Specify the review model that should be used by Gauge.
     *
     * @param  string  $model
     * @return static
     */
    public static function useReviewModel(string $model)
    {
        static::$reviewModel = $model;

        return new static();
    }

    /**
     * Configure Gauge to not run its migrations.
     *
     * @return static
     */
    public static function ignoreMigrations()
    {
        static::$runsMigrations = false;

        return new static();
    }

    /**
     * Configure Gauge to support multiple teams.
     *
     * @param  bool  $value
     * @return static
     */
    public static function supportsTeams(bool $value = true)
    {
        static::$supportsTeams = $value;

        return new static();
    }

    /**
     * Get the name of the user model used by the application.
     *
     * @return string
     */
    public static function userModel()
    {
        return static::$userModel;
    }

    /**
     * Get a new instance of the user model.
     *
     * @return mixed
     */
    public static function newUserModel()
    {
        $model = static::userModel();

        return new $model();
    }

    /**
     * Specify the user model that should be used by Gauge.
     *
     * @param  string  $model
     * @return static
     */
    public static function useUserModel(string $model)
    {
        static::$userModel = $model;

        return new static();
    }

    /**
     * Configure Gauge to support soft delete.
     *
     * @param  bool  $value
     * @return static
     */
    public static function supportsSoftDeletes(bool $value = true)
    {
        static::$supportsSoftDeletes = $value;

        return new static();
    }

    /**
     * Sets reviews table name.
     *
     * @param  string  $value
     * @return static
     */
    public static function useReviewsTableName(string $value)
    {
        static::$reviewsTableName = $value;

        return new static();
    }

    /**
     * Sets reviews table name.
     *
     * @param  bool  $value
     * @return static
     */
    public static function supportsSingleReviews(bool $value = true)
    {
        static::$supportsSingleReviews = $value;

        return new static();
    }
}
