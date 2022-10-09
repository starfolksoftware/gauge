# Laravel Gauge

[![Latest Version on Packagist](https://img.shields.io/packagist/v/starfolksoftware/gauge.svg?style=flat-square)](https://packagist.org/packages/starfolksoftware/gauge)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/starfolksoftware/gauge/run-tests?label=tests)](https://github.com/starfolksoftware/gauge/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/starfolksoftware/gauge/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/starfolksoftware/gauge/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
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
$branch->review($user, $rating, $comment)
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
$team->reviews
```

```php
$gauge = new StarfolkSoftware\Gauge();
echo $gauge->echoPhrase('Hello, StarfolkSoftware!');
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
