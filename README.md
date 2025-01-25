# Laravel Gauge

[![Latest Version on Packagist](https://img.shields.io/packagist/v/starfolksoftware/gauge.svg?style=flat-square)](https://packagist.org/packages/starfolksoftware/gauge)
[![Total Downloads](https://img.shields.io/packagist/dt/starfolksoftware/gauge.svg?style=flat-square)](https://packagist.org/packages/starfolksoftware/gauge)

Add reviews and ratings capabilities to your Laravel applications.

## Installation

You can install the package via composer:

```bash
composer require starfolksoftware/gauge
```

To install the package, run the following command:

```bash
php artisan gauge:install
```

## Configurations

To disable migrations, add the following in the service provider:

```php
Gauge::ignoreMigrations();
```

To use a different `Review` model:

```php
Gauge::useReviewModel('App\\Models\\CoolReviewModel');
```

To specify the user model to be used with Gauge:

```php
Gauge::useUserModel('App\\Models\\UserTestModel');
```

To specify the reviews table name,

```php
Gauge::useReviewsTableName('reviews_table');
```

To turn on support for soft deletiong,

```php
Gauge::supportsSoftDeletes();
```

To turn on support or single reviews, that is, each user can only review a model at most once:

```php
Gauge::supportsSingleReviews();
```

To turn on support for teams

```php
Gauge::supportsTeams();
```

## Usage

To make a model reviewable, add the `Reviewable` trait as in the following:

```php
use StarfolkSoftware\Gauge\Reviewable;

class Item extends Model
{
    // ...
    use Reviewable;
    // ...
}
```

To create a review on a reviewable model,

```php
$item->review($user, $rating, $comment);
```

To retrieve the reviews of a model,

```php
$item->reviews;
```

To get the average rating for a model,

```php
$item->averageRating();
```

To get the total number of reviews for a model,

```php
$item->reviewCount();
```

To check if a model has been reviewed by a specific user,

```php
$item->hasReviewByUser($user);
```

To get all reviews for a model by a specific user,

```php
$item->reviewsByUser($user);
```

To delete all reviews for a model,

```php
$item->deleteAllReviews();
```

To get reviews with a specific rating,

```php
$item->reviewsWithRating($rating);
```

To get the highest rating given to a model,

```php
$item->highestRating();
```

To get the lowest rating given to a model,

```php
$item->lowestRating();
```

To get the latest review for a model,

```php
$item->latestReview();
```

To get the oldest review for a model,

```php
$item->oldestReview();
```

To calculate the distribution of ratings,

```php
$item->ratingDistribution();
```

To get all approved reviews for a model,

```php
$item->approvedReviews();
```

To get the total number of approved reviews,

```php
$item->approvedReviewCount();
```

To get the average rating for approved reviews,

```php
$item->averageApprovedRating();
```

To approve a specific review by ID,

```php
$item->approveReview($reviewId);
```

To approve all reviews for a model,

```php
$item->approveAllReviews();
```

To get reviews awaiting approval,

```php
$item->pendingReviews();
```

To get the total number of pending reviews,

```php
$item->pendingReviewCount();
```

To check if a model has approved reviews,

```php
$item->hasApprovedReviews();
```

To check if a model has pending reviews,

```php
$item->hasPendingReviews();
```

To mark a review as unapproved,

```php
$item->unapproveReview($reviewId);
```

To setup the team support, add the `TeamHasReviews` trait to the team model,

```php
use StarfolkSoftware\Gauge\TeamHasReviews;

class Team extends Model
{
    use TeamHasReviews;

    protected $table = 'teams';
}
```

To create a review for a team,

```php
$team->reviews()->save([
    //...
]);
```

To fetch reviews of a team,

```php
$team->reviews;
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Faruk Nasir](https://github.com/frknasir)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
